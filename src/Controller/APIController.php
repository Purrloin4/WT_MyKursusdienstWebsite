<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use PhpParser\Node\Expr\Throw_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/api/check_user', name: 'check_user', methods: ['POST'])]
    public function checkUser(Request $request, StudentRepository $studentRepository): Response {
        $email = $request->request->get('email');
        if ($email == null) {
            return $this->json(['status' => 'error','msg' => 'no email given'], 400);
        }

        $student = $studentRepository->findOneBy(['email'=>$email]);
        if ($student == null) {
            return $this->json(['status' => 'nok', 'msg' => 'email not found'], 404);
        }

        return $this->json(['status' => 'ok','msg' => 'user already registered']);
    }
}
