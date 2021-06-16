<?php

namespace App\Controller;

use App\Entity\Play;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/", name="dev-quiz_")
     */
class QuizController extends AbstractController
{
 
    /**
     * @Route("/quiz", name="quiz")
     */
    public function quiz(QuizRepository $quiz, UserRepository $user): Response
    {
        return $this->render('main/quiz.html.twig', [
            "quiz" => $quiz->findAll(),
            "users" => $user->findAll(),
        ]);
    }

    /**
     * @Route("/quiz/{id}", name="question-read", requirements={"id": "\d+"})
     */
    public function read(): Response
    {
        
        return $this->render('main/question-read.html.twig');
    }

    /**
     * @Route("/create/quiz", name="create-quiz")
     */
    public function create_quiz(): Response
    {
        return $this->render('main/create-quiz.html.twig');
    }

}
