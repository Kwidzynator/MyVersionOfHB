<?php

namespace App\Controller;

use App\Repository\WordsRememberingRepository;
use SplQueue;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class WordsRememberController extends AbstractController
{
    #[Route('/wordsRemembering', name: 'app_wordsRemembering')]
    public function index(WordsRememberingRepository $repository, SessionInterface $session): Response
    {
        $queue = new SplQueue();


        // Generowanie listy losowych słów
        for ($i = 0; $i < 230; $i++) {
            $randomWord = $repository->randomWord();
            $queue->enqueue($randomWord);
        }

        /* wyjaśnienie dla mnie
            jeśli rozumiem dobrze to tak:
            $session->set utala wartość dla danej sesji którą można sobie przekazywać
            dzięki czemu mogę też przekazywać wartości o uzyskanym wyniku
        */
        $session->set('health_left', 3);
        $session->set('word_list', $queue);
        $session->set('used_words', new SplQueue());
        $session->set('streak', 0);

        return $this->render('games/wordsRemember.html.twig', [
            'controller_name' => 'WordsController',
        ]);
    }

    #[Route('/nextWord', name: 'app_next_word')]
    public function nextWord(SessionInterface $session): JsonResponse
    {
        $wordList = $session->get('word_list', new SplQueue());
        $usedWords = $session->get('used_words', []);


        if (count($wordList) === 0) {
            return new JsonResponse(['word' => 'wow you won congrats.']);
        }

        $nextWord = $wordList->dequeue();

        if (empty(trim($nextWord))) {

            if (!$usedWords->isEmpty()) {
                $randomIndex = array_rand(iterator_to_array($usedWords));
                $nextWord = iterator_to_array($usedWords)[$randomIndex];
            } else {
                $nextWord = 'avocado';
            }
        }
        $streak = $session->get('streak');

        $session->set('streak', $streak + 1);
        $session->set('last_word', $nextWord);
        $session->set('word_list', $wordList);
        $session->set('used_words', $usedWords);

        return new JsonResponse([
            'word' => $nextWord,
        ]);
    }

    #[Route('/seen', name: 'app_seen')]
    public function seen(SessionInterface $session): JsonResponse
    {
        $usedWords = $session->get('used_words', []);
        $wordList = $session->get('word_list', new SplQueue());

        if ($wordList->isEmpty()) {

            return new JsonResponse(['correct' => false], 400); // in case of list being empty, which is unlikely to happen but ye
        }

        $currentWord = $session->get('last_word');

        $isCorrect = in_array($currentWord, iterator_to_array($usedWords));

        if(!$isCorrect) {
            $usedWords->enqueue($currentWord);
        }

        return new JsonResponse(['correct' => $isCorrect]);
    }

    #[Route('/set_health', name: 'app_health')]
    public function setHealth(SessionInterface $session): JsonResponse{
        $health = $session->get('health_left');
        if($health - 1 <= 0 ){
            $session->set('health_left', 0);
            return new JsonResponse([
                'status' => 'game_over',
                'health' => 0
            ]);
        }
        $session->set('health_left', $health - 1);
        return new JsonResponse([
            'status' => 'still_in_game',
            'health' => $health - 1
        ]);
    }
}