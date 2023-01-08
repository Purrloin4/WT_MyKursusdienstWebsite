<?php

namespace App\Controller;

use App\Repository\FeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function courses(): Response {
        $this->stylesheets[] = 'courses.css';
        return $this->render('courses.html.twig',[
            'stylesheets'=> $this->stylesheets
        ]);
    }

    #[Route("/reservation", name: "reservation")]
    public function reservation(): Response {
        $this->stylesheets[] = 'reservation.css';
        return $this->render('reservation.html.twig',[
            'stylesheets'=> $this->stylesheets
        ]);
    }

    #[Route("/about", name: "about")]
    public function about(): Response {
        return $this->render('about.html.twig',[
            'stylesheets'=> $this->stylesheets
        ]);
    }

    #[Route("/feedback", name: "feedback")]
    public function feedback(): Response {
        $this->stylesheets[] = 'feedback.css';
        return $this->render('feedback.html.twig',[
            'stylesheets'=> $this->stylesheets
        ]);
    }

}