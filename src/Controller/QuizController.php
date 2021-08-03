<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Play;
use App\Entity\Answer;
use App\Entity\Questions;
use App\Entity\Quiz;
use App\Form\AnswerType;
use App\Repository\QuestionsRepository;
use App\Repository\AnswerRepository;
use App\Repository\UserRepository;
use App\Repository\PlayRepository;
use App\Repository\QuizRepository;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;



/**
     * @Route("/", name="dev-quiz_")
     */
class QuizController extends AbstractController
{
 
    /**
     * @Route("/user/{id}/quiz", name="quiz", requirements={"id": "\d+"})
     */
    public function quiz(User $user, QuizRepository $quizRepo, SessionInterface $session): Response
    {
        
        // dd($user);

        //get id of user in session
        $sessionId = $session->set('user_id', $user->getId());
        //dump($user->getId());
        
        return $this->render('main/quiz.html.twig', [
            "quiz" => $quizRepo->findAll(),            
        ]);
    }

    /**
     * @Route("/quiz/{id}", name="quiz-read", requirements={"id": "\d+"})
     */
    public function read(Quiz $quiz,  QuestionsRepository $questionsRepo, AnswerRepository $answerRepo ,Request $request, SessionInterface $session): Response
    {
        $sessionGetId = $session->get('user_id');
        //dump($sessionGetId);

      
        //fetch all questions bound with id of quiz
        $questionAll = $questionsRepo->findByQuiz($quiz->getId());
    
        // result = object array

        $arrayQuestionsAnswer = [];
        // create an array with Question's methods
        foreach($questionAll as $question) {

            //dd($questions);
            $cpt = 0;

            $typeInput = null;


                    // object answer in array :  fetch all answer bound to a question
                    $answers = $answerRepo->findByQuestion($question->getId());
                
                    $ans = [];
                    //dd($answers);

                    foreach($answers as $answer){

                        $ans[] = [
                            'answerId' => $answer->getId(),
                            'answerName' => $answer->getSuperName(),
                            'answerIsCorrect' => $answer->getIsCorrect(),
                        ] ;

                            if($answer->getIsCorrect()){
            
                                $cpt++; 
            
                            }
                        
                    }
                
            
                    $arrayQuestionsAnswer[] = [
                        'questionId' => $question->getId(),
                        'questionTitle' => $question->getTitle(),
                        'questionInfoplus' => $question->getInfoplus(),
                        'countAnswer' => $cpt,
                        'answers' => $ans
                    ];
                        unset($ans);
                        unset($answers);
                
            
        }



        return $this->render('main/quiz-read.html.twig', [
            "arrayQuestionsAnswer" => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            "userId" => $sessionGetId,
        

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
