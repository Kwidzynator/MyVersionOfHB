<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LoginSucceedController extends AbstractController
{
    #[Route('/home', name: 'app_login_succeed')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {

        return $this->render('default/loginSuccess.html.twig', [
            'controller_name' => 'LoginSucceedController',
        ]);
    }
}
