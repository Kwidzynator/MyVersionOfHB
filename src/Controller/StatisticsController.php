<?php

namespace App\Controller;

use App\Entity\WordsRemembering;
use App\Entity\RememberingNumbers;
use App\Entity\ReactionTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class StatisticsController extends AbstractController
{
    #[Route('/statistics', name: 'app_statistics')]
    #[IsGranted('ROLE_USER')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $wordsRememberingRecords = $entityManager->getRepository(WordsRemembering::class)->findAll();
        $numbersRememberingRecords = $entityManager->getRepository(RememberingNumbers::class)->findAll();
        $reflexStatsRecords = $entityManager->getRepository(ReactionTime::class)->findAll();


        return $this->render('default/statistics.html.twig', [
            'wordsRecords' => $wordsRememberingRecords,
            'numbersRecords' => $numbersRememberingRecords,
            'reflexRecords' => $reflexStatsRecords,
        ]);
    }
}