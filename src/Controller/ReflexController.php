<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ReflexController extends AbstractController
{
    #[Route('/reflex', name: 'app_reflex')]
    #[IsGranted('ROLE_USER')]
    public function index() : Response
    {

        return $this->render('games/reflex.html.twig', [
            'controller_name' => 'reflexController',
        ]);
    }

    #[Route('/screenChangingTime', name: 'app_screen_changing_time')]
    #[IsGranted('ROLE_USER')]
    public function changingTime() : JsonResponse
    {
        //two variables for making it easier to read
        $seconds = rand(4, 13);

        $miliseconds = rand(0, 999);

        return new JsonResponse(['time_to_start' => $seconds, 'miliseconds' => $miliseconds]);
    }

    #[Route('/startTimer', name: 'app_start_timer')]
    #[IsGranted('ROLE_USER')]
    public function startTimer(SessionInterface $session): JsonResponse
    {
        // Capture current time in seconds with microsecond precision
        $startTime = microtime(true);

        // Store start time in session or database
        $session->set('start_time', $startTime);

        return new JsonResponse(['status' => 'Timer started']);
    }

    #[Route('/stopTimer', name: 'app_stop_timer')]
    #[IsGranted('ROLE_USER')]
    public function stopTimer(SessionInterface $session): JsonResponse
    {
        // Retrieve the start time from the session
        $startTime = $session->get('start_time');

        if ($startTime === null) {
            return new JsonResponse(['error' => 'Timer not started'], 400);
        }

        // Capture the current time
        $endTime = microtime(true);

        // Calculate the elapsed time in milliseconds
        $elapsedTime = ($endTime - $startTime) * 1000; // Convert seconds to milliseconds

        return new JsonResponse(['elapsed_time_ms' => $elapsedTime]);
    }
    #[Route('/back_to_the_pit', name: 'app_menu')]
    #[IsGranted('ROLE_USER')]
    public function goBack(): Response{
        return $this->redirectToRoute('app_login_succeed');

    }
}