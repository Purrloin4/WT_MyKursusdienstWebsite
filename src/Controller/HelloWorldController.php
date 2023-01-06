<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController {

    #[Route("/welcome", name: "welcome")]
    public function welcome(): Response {
        return new Response("<html lang='en'>
                                    <head><title>First Symfony</title></head>
                                    <body><h1>Welcome!</h1></body>
                                    </html>");
    }

    #[Route("/hello/{name}", name: "hello_world")]
    public function hello(string $name): Response {
        $niceThings = array("smart", "nice", "clever", "handsome", "boring");
        $index = rand(0,count($niceThings)-1);
        $property = $niceThings[$index];
        return new Response("<html lang='en'>
                                    <head><title>First Symfony</title></head>
                                    <body><h1>Welcome!</h1><p>$name, you are a $property visitor </p></body>
                                    </html>");
    }
}