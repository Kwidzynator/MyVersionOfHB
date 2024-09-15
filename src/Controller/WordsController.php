<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WordsController extends AbstractController
{
    #[Route('/words', name: 'app_words')]
    public function index(): Response
    {


        return $this->render('games/words.html.twig', [
            'controller_name' => 'WordsController',
        ]);
    }
}
