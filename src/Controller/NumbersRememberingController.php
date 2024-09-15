<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\RememberingNumbers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class NumbersRememberingController extends AbstractController
{
    #[Route('/numbers', name: 'app_numbers')]
    #[IsGranted('ROLE_USER')]
    public function index(SessionInterface $session): Response
    {
        $session->set('score', 0);
        $session->set('time', 1.5);

        return $this->render('games/numbers.html.twig', [
            'controller_name' => 'WordsController',
        ]);
    }
    #[Route('/draw_number', name: 'app_draw_number')]
    #[IsGranted('ROLE_USER')]
    public function drawNumber(SessionInterface $session): JsonResponse{
        $numberLength = $session->get('score');
        $timeToSee = $session->get('time');

        $randomNumber = $this->generateRandomNumber($numberLength);

        $session->set('randomNumber', $randomNumber);


        //we don't want this game to be too difficult, so we add 0.5 second
        if($numberLength > 3){
            $session->set('time', $timeToSee + 1.5);
        }
        return new JsonResponse([
            'time' => $timeToSee,
            'randomNumber' => $randomNumber,
        ]);
    }

    private function generateRandomNumber($length) : string{
        $randomNumber = "";
        for($i = 0; $i <= $length; $i++){
            $randomNumber .= rand(0, 9);
        }
        return $randomNumber;
    }

    #[Route('/compare_numbers', name: 'app_compare_numbers', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function compareNumbers(Request $request, SessionInterface $session): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $userInput = $data['input'] ?? '';
        $storedNumber = $session->get('randomNumber', '');

        // Compare the user's input with the stored number
        $isCorrect = $userInput === $storedNumber;

        if($isCorrect){
            $score = $session->get('score');
            $session->set('score', $score + 1);
        }

        return new JsonResponse([
            'correct' => $isCorrect,
        ]);
    }

    #[\Symfony\Component\Routing\Annotation\Route('/back_to_the_pit', name: 'app_menu')]
    #[IsGranted('ROLE_USER')]
    public function goBack(): Response{
        return $this->redirectToRoute('app_login_succeed');

    }

    #[\Symfony\Component\Routing\Annotation\Route('/get_score_numbers', name: 'app_get_score_numbers')]
    #[IsGranted('ROLE_USER')]
    public function getScoreNumbers(SessionInterface $session): JsonResponse{
        return new JsonResponse(['score' => $session->get('score')]);
    }

    #[\Symfony\Component\Routing\Annotation\Route('/save_score_numbers', name: 'app_save_score_numbers')]
    #[IsGranted('ROLE_USER')]
    public function saveScoreNumbers(SessionInterface $session, EntityManagerInterface $entityManager): JsonResponse{

            /** @var Login $user */
            $user = $this->getUser();

            if (!$user instanceof UserInterface) {
                return new JsonResponse(['error' => 'User not found'], 400);
            }

            $score = $session->get('score');

            if ($score === null) {
                return new JsonResponse(['error' => 'No reflex time found in session'], 400);
            }

            // Create and persist the new ReactionTime entity
            $entity = new RememberingNumbers();
            $entity->setUser($user);
            $entity->setNumbersRemembered($score);

            $entityManager->persist($entity);
            $entityManager->flush();

            return new JsonResponse([
                'success' => true,
                'message' => 'Score saved successfully',
            ]);
    }

}
