<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginSucceedController extends AbstractController
{
    #[Route('/home', name: 'app_login_succeed')]
    public function index(): Response
    {

        return $this->render('default/loginSuccess.html.twig', [
            'controller_name' => 'LoginSucceedController',
        ]);
    }
}
