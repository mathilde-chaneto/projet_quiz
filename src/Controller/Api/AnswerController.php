<?php

namespace App\Controller\Api;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/api/answer/", name="api_answer_")
     */
class AnswerController extends AbstractController
{
    /**
     * @Route("/{id}", name="list", methods={"POST"}, requirements={"id": "\d+"})
     */
    public function index(AnswerRepository $answerRepo ): Response
    {
        $answer = $answerRepo->findAll();
        return $this->json($answer, 200, [], [
            "groups" => ['answer_list'],
        ]);
    }
}
