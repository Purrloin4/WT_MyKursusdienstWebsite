<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Feedback;
use App\Entity\Reservation;
use App\Entity\Student;
use App\Repository\BookRepository;
use App\Repository\CourseRepository;
use App\Repository\FeedbackRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CouBooksController extends AbstractController {

    private array $stylesheets;

    public function __construct() {
        $this->stylesheets[] = 'main.css';
    }

    #[Route("/", name: "home")]
    public function home(FeedbackRepository $feedbackRepo): Response {
        $feedback = $feedbackRepo->findAll();
        return $this->render('main.html.twig',[
            'stylesheets'=> $this->stylesheets,
            'feedback'=>$feedback
        ]);
    }

    #[Route("/courses", name: "courses")]
    public function courses(CourseRepository $courseRepo): Response {
        $courses = $courseRepo->findAll();
        // $courses = $courseRepo->findAllWithBooks();
        $this->stylesheets[] = 'courses.css';
        return $this->render('courses.html.twig',[
            'stylesheets'=> $this->stylesheets,
            'courses' => $courses
        ]);
    }

    #[Route("/reservation/{step<[0-9]+>}/{fase<[0-9]+>}", name: "reservation")]
    public function reservation(Request $request, EntityManagerInterface $em, int $step = 1, int $fase = 0): Response {
        // get reservation from session or create new one
        // (never store entities from the database in the session)
        $session = $request->getSession();

        $reservation = new Reservation();
        $form = null;
        // creating forms for each step
        switch ($step) {
            case 1:
                $form = $this->createFormBuilder(null)
                    // ref: https://symfony.com/doc/current/reference/forms/types.html
                    ->add('fase', ChoiceType::class, [
                        'choices'=>['bac1'=>1, 'bac2'=>2, 'bac3'=>3, 'master'=>4],
                        'mapped'=>false])
                    ->add('email', TextType::class, ['mapped' => false])
                    ->add('submit',SubmitType::class, ['label'=> 'Next...'])
                    ->getForm();
                break;
            case 2:
                $form = $this->createFormBuilder($reservation)
                    // ref: https://symfony.com/doc/current/reference/forms/types/entity.html
                    ->add('books', EntityType::class, [
                        'class' => Book::class,
                        'choices' => $em->getRepository(Book::class)->findByFase($fase),
                        'choice_label' => 'title',
                        'multiple' => true, // allow multiple selection
                        'expanded' => true  // render checkbox in stead of select box
                    ])
                    ->add('submit',SubmitType::class, ['label'=> 'Confirm reservation'])
                    ->getForm();
                break;
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // handing forms for each step
            switch ($step) {
                case 1:
                    $email = $form->get('email')->getData();
                    $fase = $form->get('fase')->getData();
                    $session->set('email',$email);
                    return $this->redirectToRoute('reservation',['step' => 2,'fase' => $fase]);
                case 2 :
                    $reservation = $form->getData();

                    $email = $session->get('email');
                    $student = $em->getRepository(Student::class)->findOneBy(['email'=>$email]);
                    if ($student == null) {
                        $student = new Student();
                        $student->setEmail($email);
                        $em->persist($student);
                    }
                    $reservation->setStudent($student);
                    $em->persist($reservation);
                    $em->flush();
                    $session->remove('email');
                    return $this->redirectToRoute('home');
            }
        }

        $this->stylesheets[] = 'reservation.css';
        return $this->render('reservation.html.twig',[
            'stylesheets'=> $this->stylesheets,
            'reservation_form' => $form
        ]);
    }

    #[Route("/about", name: "about")]
    public function about(): Response {
        return $this->render('about.html.twig',[
            'stylesheets'=> $this->stylesheets
        ]);
    }

    #[Route("/feedback", name: "feedback")]
    public function feedback(Request $request, EntityManagerInterface $em): Response {
        // create form
        // ref : https://symfony.com/doc/current/forms.html
        $feedback = new Feedback();
        $form = $this->createFormBuilder($feedback)
            ->add('author', TextType::class)
            ->add('text',TextareaType::class, ['label' => 'Feedback'])
            ->add('save',SubmitType::class, ['label' => 'Submit Feedback'])
            ->getForm();

        // check if form was submitted and handle data
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();
            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        $this->stylesheets[] = 'feedback.css';
        return $this->render('feedback.html.twig',[
            'stylesheets'=> $this->stylesheets,
            'feedback_form'=>$form
        ]);
    }

}