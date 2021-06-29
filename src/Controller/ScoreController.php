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


/**
     * @Route("/", name="dev-quiz_")
     */
class ScoreController extends AbstractController
{
      /**
     * @Route("/score/{id}", name="score", requirements={"id": "\d+"})
     */
    public function score(PlayRepository $play, QuizRepository $quiz, UserRepository $userRepo, User $user): Response
    {
        return $this->render('main/score.html.twig', [
            "player" => $play->findByUser($user),
            "quiz" => $quiz->findByUser($user),
            "user" => $user,
        ]);
    }

}
