<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\ReactionTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
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


        $endTime = microtime(true);


        $elapsedTime = ($endTime - $startTime) * 1000;

        $session->set('elapsed_time', $elapsedTime);

        return new JsonResponse(['elapsed_time_ms' => $elapsedTime]);
    }
    #[Route('/back_to_the_pit', name: 'app_menu')]
    #[IsGranted('ROLE_USER')]
    public function goBack(): Response{
        return $this->redirectToRoute('app_login_succeed');

    }

    #[Route('/save_score_reflex', name: 'app_save_score_reflex')]
    #[IsGranted('ROLE_USER')]
    public function saveScoreReflex(SessionInterface $session, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var Login $user */
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            return new JsonResponse(['error' => 'User not found'], 400);
        }

        // Retrieve the reflex time from the session
        $reflexTime = $session->get('elapsed_time');

        if ($reflexTime === null) {
            return new JsonResponse(['error' => 'No reflex time found in session'], 400);
        }

        // Create and persist the new ReactionTime entity
        $entity = new ReactionTime();
        $entity->setUser($user);
        $entity->setTime($reflexTime);

        $entityManager->persist($entity);
        $entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'message' => 'Score saved successfully',
        ]);
    }
}