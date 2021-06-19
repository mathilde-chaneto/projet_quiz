<?php

namespace App\Controller;

use App\Entity\Play;
use App\Entity\User;
use App\Repository\QuizRepository;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/", name="dev-quiz_")
     */
class AccountController extends AbstractController
{
     /**
     * @Route("/account", name="account")
     */
    public function account(): Response
    {
        return $this->render('main/account.html.twig');
    }

     

}
