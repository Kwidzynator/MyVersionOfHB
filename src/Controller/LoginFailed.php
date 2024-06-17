<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginFailed extends AbstractController
{

    #[Route('/fail', name: 'app_login_failed')]
    public function index(): Response
    {
        return $this->render('default/loginFailed.html.twig', [
            'controller_name' => 'LoginSucceedController',
        ]);
    }
}