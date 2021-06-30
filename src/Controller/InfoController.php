<?php


namespace App\Controller;

use App\Entity\Play;
use App\Entity\Questions;
use App\Repository\PlayRepository;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




/**
     * @Route("/info", name="dev-quiz_info_")
     */
class InfoController extends AbstractController
{
    /**
     * @Route("", name="quiz_info", methods={"POST"})
     */
    public function player(Request $request, QuizRepository $quizRepo, UserRepository $userRepo, PlayRepository $playRepo): Response
    {

        // get parameters passed in js in POST here
        // $request->request : get informations passed in POST

        // id of user
       $userPlay = (int) $request->request->get('userId');

       // id of quiz
       $quizPlay = (int) $request->request->get('quizId');

       //score
       $scorePlay = (int) $request->request->get('score');


        // find the quiz with this id ex: 136
      $quizFind = $quizRepo->find($quizPlay);

       // find quiz with id of user ex 44
       $quiz = $quizRepo->findByUser($userPlay);

        // find the play object with id of quiz : result = array with objects
       $getPlayWithIdQuiz = $playRepo->findByQuiz($quizPlay);
      


        // find all quiz of user with id of user.
        if($quizRepo->findByUser($userPlay)){

                    // if don't find play with id of quiz, create new play object
                    if(!$playRepo->findByQuiz($quizPlay)) {

                    $player = new Play();
                    $player->setUser($this->getUser()); 
                    $player->setQuiz($quizFind);
                    $player->setScore($scorePlay);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($player);
                    $em->flush();
                  
                
                    }

                     //if find the play with this id of quiz, get the id of play and update his score.
                    else {

                      // find the play object with id of quiz : result = array with objects
                        $getPlayWithIdQuiz = $playRepo->findByQuiz($quizPlay);
                    
                        
                        foreach ($getPlayWithIdQuiz as $keyPlay => $getPlay){
                            $test[] = [
                                   "id" => $getPlay->getId(),
                                    "score" => $getPlay->setScore($scorePlay),
                            ];
                
                            $this->getDoctrine()->getManager()->flush();
                        }

                       
                    
                    }
                   
                
        }

       //when we get these informations, we can create a new entry in Play table in BDD
       
       // create a new response to reply  front-end after the request
       $response = new Response( 'Score: '.$scorePlay.' Player : '.$userPlay.' Quiz: '.$quizPlay ,Response::HTTP_OK);

       return $response;
    }


    /**
     * @Route("/questions/{id}", name="detail_info", requirements={"id" : "\d+"})
     */
    public function questions(Questions $questions ): Response
    {

        //configure a route we can access in front side to get informations we need to 
        //compare user answer and correct answer 
        
        return $this->json($questions, Response::HTTP_OK, [], [
            'groups' => ['detail_info'],
        ]);
    }
}
