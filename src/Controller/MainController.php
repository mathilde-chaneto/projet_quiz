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
class MainController extends AbstractController
{
    /**
     * @Route("", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }

   

    /**
     * @Route("/signup", name="sign-up")
     */
    public function sign_up(): Response
    {
        return $this->render('main/sign-up.html.twig');
    }

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

    /**
     * @Route("/score", name="score")
     */
    public function score(): Response
    {
        return $this->render('main/score.html.twig');
    }

     /**
     * @Route("/account", name="account")
     */
    public function account(): Response
    {
        return $this->render('main/account.html.twig');
    }

      /**
     * @Route("/account/update", name="account-update")
     */
    public function account_update(): Response
    {
        return $this->render('main/account_update.html.twig');
    }

}
