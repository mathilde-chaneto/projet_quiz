<?php

namespace App\Controller;

use App\Entity\Play;
use App\Entity\User;
use App\Entity\Questions;
use App\Entity\Quiz;
use App\Form\AnswerType;
use App\Repository\QuestionsRepository;
use App\Repository\AnswerRepository;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/quiz/{id}", name="quiz-read", requirements={"id": "\d+"})
     */
    public function read(Quiz $quiz, QuestionsRepository $questionsRepo, AnswerRepository $answerRepo, Questions $questionsObject, $id, Request $request): Response
    {
        //fetch all questions bound to one quiz
        $questions = $questionsRepo->findByQuiz($id);
        // result = object array
         
        // create an array with Question's methods
        foreach($questions as $question) {
            $cpt = 0;
            $answers = $answerRepo->findByQuestion($question->getId());
            foreach($answers as $answer){
                if($answer->getIsCorrect()){
                    $cpt++;                    
                }

                $ans[] = [
                    'answerId' => $answer->getId(),
                    'answerName' => $answer->getName(),
                    'answerIsCorrect' => $answer->getIsCorrect(),
                ] ;
                
            }
        $arrayQuestionsAnswer[] = [
            'questionId' => $question->getId(),
            'questionTitle' => $question->getTitle(),
            'countAnswer' => $cpt,
            'answers' => $ans
        ];
            unset($ans);
            unset($answers);
        }
          //dd($arrayQuestionsAnswer);

       /*$form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }*/

        return $this->render('main/quiz-read.html.twig', [
            //"questionsByQuiz" => $questions,
            //"answers" => $answers,
            'arrayQuestionsAnswer' => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            //"form" => $form->createView(),

        ]);

    
    }

    /**
     * @Route("/create/quiz", name="create-quiz")
     */
    public function create_quiz(): Response
    {
        return $this->render('main/create-quiz.html.twig');
    }

}
