<?php


namespace App\Controller;


use App\Entity\User;
use App\Entity\Quiz;
use App\Entity\Questions;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\InputBag;
use App\Repository\QuizRepository;

/**
 * json datas, we can acces with http request GET
 */

/**
     * @Route("/info", name="dev-quiz_info_")
     */
class InfoController extends AbstractController
{
    /**
     * @Route("/{id}", name="quiz_info", requirements={"id" : "\d+"})
     */
    public function quiz(Quiz $quiz): Response
    {
        

        return $this->json($quiz, Response::HTTP_OK, ['test'], [
            'groups' => ['quiz_info'],
        ]);
    }


      /**
     * @Route("/user/{id}", name="user_info", requirements={"id" : "\d+"})
     */
    public function user(User $user, Request $request): Response
    {
        
        var_dump($request->getContent());
        
        return $this->json($user, Response::HTTP_OK, [], [
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
