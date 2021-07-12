<?php

namespace App\Controller;

use App\Entity\Play;
use App\Entity\User;
use App\Repository\PlayRepository;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
     * @Route("/", name="dev-quiz_")
     */
class ScoreController extends AbstractController
{
      /**
     * @Route("/score/{id}", name="score", requirements={"id": "\d+"})
     */
    public function score(PlayRepository $playRepo, QuizRepository $quiz, UserRepository $userRepo, User $user, SessionInterface $session): Response
    {
        $sessionGetId = $session->get('user_id');
        //(dump($this->getUser()));

        return $this->render('main/score.html.twig', [
            "player" => $playRepo->findByUser($user),
            "quiz" => $quiz->findAll(),
            
        ]);
    }

}
