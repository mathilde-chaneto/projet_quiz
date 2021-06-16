<?php

namespace App\Controller;

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
     * @Route("/score", name="score")
     */
    public function score(PlayRepository $play, QuizRepository $quiz, UserRepository $user): Response
    {
        return $this->render('main/score.html.twig', [
            "player" => $play->findAll(),
            "quiz" => $quiz->findAll(),
            "user" => $user->findAll(),
        ]);
    }

}
