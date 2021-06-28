<?php


namespace App\Controller;

use App\Entity\User;
use App\Entity\Quiz;
use App\Entity\Questions;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
     * @Route("/info", name="dev-quiz_info_")
     */
class InfoController extends AbstractController
{
    /**
     * @Route("/{id}", name="list", requirements={"id" : "\d+"})
     */
    public function index(Quiz $quiz): Response
    {
        
        return $this->json($quiz, Response::HTTP_OK, [], [
            'groups' => ['user_info'],
        ]);
    }

    /**
     * @Route("/questions/{id}", name="detail_info", requirements={"id" : "\d+"})
     */
    public function questions(Questions $questions ): Response
    {
        
        return $this->json($questions, Response::HTTP_OK, [], [
            'groups' => ['detail_info'],
        ]);
    }
}
