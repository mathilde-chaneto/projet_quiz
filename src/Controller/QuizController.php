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
        // result = object array
        $questions = $questionsRepo->findByQuiz($id);
        
         
        // create an array with Question's methods
        foreach($questions as $question) {

            $cpt = 0;

            $typeInput = null;

            $answers = $answerRepo->findByQuestion($question->getId());


            foreach($answers as $answer){

                if($answer->getIsCorrect()){

                    $cpt++; 

                    if($cpt > 1) {
                    $typeInput = "checkbox";

                    }else{
                        $typeInput = "radio";
                    }

                }

                $ans[] = [
                    'answerId' => $answer->getId(),
                    'answerName' => $answer->getSuperName(),
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

        //dd($typeInput);
        // dd($arrayQuestionsAnswer);

      

        return $this->render('main/quiz-read.html.twig', [
            'arrayQuestionsAnswer' => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            "typeInput" => $typeInput,

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
