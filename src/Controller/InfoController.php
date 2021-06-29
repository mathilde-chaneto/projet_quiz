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
     * @Route("", name="quiz_info", methods={"POST"}, requirements={"id" : "\d+"})
     */
    public function player(Request $request, QuizRepository $quizRepo, UserRepository $userRepo, SessionInterface $session): Response
    {
        $player = new Play();

        $playRepo = $this->getDoctrine()->getRepository(Play::class);

        // get parameters passed in js in POST here
        // $request->request : get informations passed in POST

        // id of user
       $userPlay = intval($request->request->get('userId'));

       // id of quiz
       $quizPlay = intval($request->request->get('quizId'));

       //score
       $scorePlay = intval($request->request->get('score'));

       //get id of user in session
       $sessionScore = $session->set('score', $scorePlay);


        // find the quiz with this id
       $quizFind = $quizRepo->find($quizPlay);

       // find quiz with id of user
       $quiz = $quizRepo->findByUser($userPlay);

      /* $test = $playRepo->findByQuiz($quizPlay);
       dd($test);*/


        // if quiz with this id of user exist, set Play entity
        if($quizRepo->findByUser($userPlay)){

                    
                    if(!$playRepo->findByQuiz($quizPlay)) {

                    $player->setUser($this->getUser()); 
                    $player->setQuiz($quizFind);
                    $player->setScore($scorePlay);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($player);
                    $em->flush();
                  
                
                    }

                     //if play with this id of quiz exist,
                  if($playRepo->findByQuiz($quizPlay)) {

                    //how i am suppose to get id of play and update the score ?
                    $getPlayId = $playRepo->findOneBy([0]);
                    
                    $getObjectPlay = $playRepo->find($getPlayId);

                    $getObjectPlay->setScore($scorePlay);
                    $this->getDoctrine()->getManager()->flush();
                    
                    }
                   
                
        }

       //when we get these informations, we can create a new entry in Play table in BDD
       
       // create a new response to reply  front-end after the request
       $response = new Response(Response::HTTP_OK);

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
