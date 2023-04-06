<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CouBooksController extends AbstractController
{
    private array $stylesheets;

    public function __construct()
    {
        $this->stylesheets[] = 'main.css';
    }

    #[Route('/', name: 'home')]
    public function home(FeedbackRepository $feedbackRepo): Response {
        $feedback = $feedbackRepo->findAll();
        return $this->render('main.html.twig', [
            'stylesheets' => $this->stylesheets,
            'feedback' => $feedback,
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('about.html.twig', [
            'stylesheets' => $this->stylesheets,
        ]);
    }

    #[Route('/courses', name: 'courses')]
    public function courses(): Response
    {
        $this->stylesheets[] = 'courses.css';
        return $this->render('courses.html.twig', [
            'stylesheets' => $this->stylesheets,
        ]);
    }

    #[Route('/feedback', name: 'feedback')]
    public function feedback(Request $request, EntityManagerInterface $em): Response
    {
        $feedback = new Feedback();
        $form = $this->createFormBuilder($feedback)
            ->add('author', TextType::class)
            ->add('text',TextareaType::class)
            ->add('save',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();
            $em->persist($feedback);
            $em->flush();
        }

        $this->stylesheets[] = 'feedback.css';
        return $this->render('feedback.html.twig', [
            'stylesheets' => $this->stylesheets,
            'form' => $form,
        ]);
    }

    #[Route('/reservation', name: 'reservation')]
    public function reservation(): Response
    {
        $this->stylesheets[] = 'reservation.css';
        return $this->render('reservation.html.twig', [
            'stylesheets' => $this->stylesheets,
        ]);
    }


}