<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class ReflexController extends AbstractController
{
    #[Route('/reflex', name: 'app_reflex')]
    public function index(SessionInterface $session) : Response
    {
        return $this->render('games/reflex.html.twig', [
            'controller_name' => 'reflexController',
        ]);
    }
}