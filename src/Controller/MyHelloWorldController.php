<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyHelloWorldController extends AbstractController {

    #[Route("/mywelcome", name: "welcome")]
    public function welcome(): Response {
        return new Response("<html lang='en'>
                                         <head><title>First Symfony</title></head>
                                         <body><h1>Welcome!</h1></body>
                                         </html>");
    }

    #[Route("/myhello/{name}", name: "hello")]
    public function hello(string $name): Response {
        //get random property
        $properties = ['very', 'very very', 'very very very'];
        $properties = $properties[array_rand($properties)];

        return new Response("<html lang='en'>
                                         <head><title>First Symfony</title></head>
                                         <body><h1>Hello!</h1><p>$name, how are you?</p>
                                         <p>You are a $properties handsome man.</p></body>
                                         </html>");
    }
}
