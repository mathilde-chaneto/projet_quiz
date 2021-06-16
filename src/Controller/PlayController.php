<?php

namespace App\Controller;

use App\Repository\PlayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/", name="dev-quiz_")
     */
class PlayController extends AbstractController
{
      /**
     * @Route("/score", name="score")
     */
    public function score(PlayRepository $play): Response
    {
        return $this->render('main/score.html.twig', [
            "player" => $play->findAll(),
        ]);
    }

}
