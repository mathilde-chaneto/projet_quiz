<?php


namespace App\Controller;

use App\Entity\User;
use App\Entity\Play;
use App\Entity\Questions;
use App\Repository\PlayRepository;
use App\Repository\QuizRepository;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\InputBag;
use Psr\Log\LoggerInterface;




/**
     * @Route("/info", name="dev-quiz_info_")
     */
class InfoController extends AbstractController
{
    /**
     * @Route("/{id}", name="quiz_info", methods={"POST"}, requirements={"id": "\d+"})
     */
    public function player(Request $request, QuizRepository $quizRepo, PlayRepository $playRepo, User $user, LoggerInterface $logger): Response
    {

        // get parameters passed in js in POST here
        // $request->request : get informations passed in POST

        $data = json_decode($request->getContent(), true);


       // id of quiz ex = 184
       $quizPlay = (int) $data{'quiz'};
       

       //score ex = 1
       $scorePlay = (int) $data{'scoreGame'};

       //$logger->info('info quiz: ' . print_r($request->request->get('quiz','defaultNull')));
       //$logger->info('info scoreGame: ' . print_r($request->request->get('scoreGame','default score game')));
      // $logger->info('info all: ' . print_r($request->request->all()));


        // find the quiz with this id ex: 184
      $quizFind = $quizRepo->find($quizPlay);

        //dump($this->getUser());

                    // if don't find play with this id of user, create new play object :
                    if(!$playRepo->findByUser($user)) {

                    $player = new Play();
                    $player->setUser($user); 
                    $player->setQuiz($quizFind);
                    $player->setScore($scorePlay);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($player);
                    $em->flush();
                  
                
                    }
                     //if find the play with this id of user
                    else {

                        // if play object with user id exit but there isn't quiz matching with $quizFind
                        if(!$playRepo->findByQuiz($quizFind)){
                                
                            // insert new row in bdd (create new play object)
                            $playerAdd = new Play();
                            $playerAdd->setUser($user); 
                            $playerAdd->setQuiz($quizFind);
                            $playerAdd->setScore($scorePlay);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($playerAdd);
                            $em->flush();

                        }
                    
                    }
                    
                    // if play object with quiz id and user id exist
                    if ($playRepo->findByQuiz($quizFind) && $playRepo->findByUser($user)) {

                        // find the play object with id of quiz: result = array with objects
                        $getPlayWithIdQuiz = $playRepo->findByQuiz($quizFind);

                         // find the play object with id of user: result = array with objects
                         $getPlayWithIdUser = $playRepo->findByUser($user);

                         // browse play object with quiz id
                         foreach ($getPlayWithIdQuiz as $getPlay) {
                             
                            // browse play object with user id
                             foreach ($getPlayWithIdUser as $getPlayUser) {
                            
                            // update score
                            $info[] = [
                                   "id" => $getPlay->getId(),
                                   "player" => $getPlayUser->getuser($user),
                                    "score" => $getPlay->setScore($scorePlay),
                                    "quiz" => $getPlay->getQuiz($quizFind),
                                   
                            ];
                        }
                        $this->getDoctrine()->getManager()->flush();
                        }
                    }
                    
                   

       //when we get these informations, we can create a new entry in Play table in BDD
       
       // create a new response to reply  front-end after the request
       $response = new Response("quiz : " .$quizPlay. " score : ".$scorePlay ,Response::HTTP_OK);

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
