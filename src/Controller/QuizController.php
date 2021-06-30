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
        //get this user
        $thisUser = $this->getUser();

        //get id of user in session
        $sessionId = $session->set('user_id', $user->getId());
   

        //check if quiz object is bound to this user exist. If it dosen't, create quiz
        if(!$quizRepo->findByUser($thisUser)){
        
            //dd($quiz->getUser());
            //dd($user->getId());

            //create an assiociative array with key : name of quiz and value : name of icon
            $quizzes = [
                "Accessibilité" => "accessibilité-48.png",
                "Sécurité" => "bouclier-48.png",
                "Protocol" =>  "protocol-48.png",
                "Internet" => "internet-48.png",
                "Langage web" => "code-48.png",
                "Frameworks"=>  "frameworks-48.png",
                "Terminal" => "terminal-48.png",
                "Base de données" => "bdd-48.png" 
            ];
         
            //browse the previous array and set quiz object
            foreach($quizzes as $key => $quizConfig){
               
                $quiz = new Quiz();
                $quiz->setIcone($quizConfig);
                $quiz->setName($key);
                $quiz->setUser($thisUser); 
               // $quiz->setDetail() 

                $em = $this->getDoctrine()->getManager();
                $em->persist($quiz);
                $em->flush();
               
            }

        }     

           /* $detail = [
                "Au delà des obligations légales, la prise en compte de l’accessibilité numérique participe à l’inclusion des personnes handicapées dans la société.",
            ];*/
            

        return $this->render('main/quiz.html.twig', [
            "quiz" => $quizRepo->findByUser($user),            
        ]);
    }

    /**
     * @Route("/quiz/{id}", name="quiz-read", requirements={"id": "\d+"})
     */
    public function read(Quiz $quiz, QuestionsRepository $questionsRepo, AnswerRepository $answerRepo, PlayRepository $playRepo,Request $request, SessionInterface $session): Response
    {
        $sessionGetId = $session->get('user_id');

        $questions = [
            
            "Pourquoi améliorer l'accessibilité du site web est-elle importante ?" => [
                
                    "En France, plus de 20% de la population est 
                    touchée par un handicap permanent. Il est du devoir des webdesigners, développeurs et plus 
                    largement des concepteurs de s'assurer que le plus de personnes soit en mesure d'accéder aux services, quel que soit le contexte d'utilisation, 
                    afin de proposer la meilleure expérience utilisateur possible." => [

                
                            "Parce que c'est une bonne pratique" => false,
                            "Pour toucher un public plus large et permettre à tout le monde d'utiliser le site" => true
                        
                    ]
                
            ],

            "Que désigne l'accessibilité web ?" => [
            
                    "Un site internet designé, développé et rédigé avec l’accessibilité web en tête offre à tous un accès égal au site, à l’offre et au contenu qu’il propose.Rendre son site facile d'accès permet de montrer à tous les internautes 
                    que vous veillez à garantir un accès égal pour tout le monde sans discriminations et d'élargir l'audience du site. " => [
                    
                            "C'est de rendre le site accessible " => false,
                            "L’ensemble des techniques et bonnes pratiques ayant pour objectif de rendre un site internet accessible à tous" => true
                        
                    ]
                
            ],

            "Quels sont les handicaps à prendre en compte ?"  => [
                
                    "Les troubles 'Dys' recouvrent un panel de fonctions cognitives : du langage écrit au langage oral en passant par la concentration et la mémoire ainsi que les capacités motrices. Les handicaps physiques peuvent être visuel,
                    auditif, moteur (c'est à dire à se déplacer ou à mouvoir une partie du corps." => [
                    
                    
                            "Les handicaps physiques " => false,
                            "Les handicaps mentaux" => false,
                            "Les handicaps physiques, mentaux, cognitifs, ainsi que les personnes souffrants de troubles 'Dys'"=> true ,
                    ]
                
            ],

            "En quoi l'UX design joue un rôle majeur dans l'accessibilité web ? " => [
                
                        "L’objectif de l’UX Design est de concevoir, ou d’offrir, une expérience utilisateur optimale : la meilleure expérience possible. Dans la conception, le choix de la disposition des visuels, les contrastes, choix iconographiques 
                        ou des couleurs, sont autant d'éléments qui peuvent faciliter ou empêcher la lecture et la compréhension" => [
                    
                            "ben j'en sais rien moi, je suis pas UX designer mais développeur" => false,
                            "Pour faire de beaux contenus" => false,
                            "L'UX design prend en compte tous ces handicaps et troubles afin d'avoir un design adapté" => true 
                        
                    ]
                
            ],

            "Alliée à l'UX design, elle aide à avoir un contenu clair et hiérarchisé, de qui s'agit-il ?" => [
                
                    "L'UI designer s'occupe plus particulièrement de faire en sorte que le design de l'interface utilisateur corresponde aux attentes de son commanditaire et réponde aux besoins des utilisateurs. Alors que l'UX designer sera plutôt sur l'architecture et l'ergonomie du site. Le 'SEO' (Search Engine Optimisation) ou le référencement naturel défini l'ensemble des techniques mises en oeuvre pour améliorer la position d'un site web sur les pages de résultats des moteurs de recherches. Ce qui facilite aussi la navigation des internautes malvoyants ou aveugles qui surfent grâce à des lecteurs d'écrans. 
                    Donc pensez optimisation de la structure de votre site avec les bonnes balises notamment" => [

                        
                            "Euh l'UI design ? " => false,
                            "Je ne sais pas" => false,
                            "SEO"=> true 
                    ]
                
            ]
        
    ];

    // find the play object with id of quiz : result = array with objects
    //$getPlayWithIdQuiz = $playRepo->findByQuiz($quiz->getId());
                    

   
        

    if(!$questionsRepo->findByQuiz($quiz->getId())) {
        

        foreach($questions as $key1 =>$titlesAll){
                $questionsq = new Questions();
                // title questions
                $questionsq->setTitle($key1);
            
                //var_dump($titlesAll);

                //echo 'Question: ' . $key1 . "<br />\n";
        
                foreach($titlesAll as $key2 => $info){
                    //echo 'key2 / info: ' . $key2 . "<br />\n";
                        //info
                        //var_dump($key2);
                        $questionsq->setInfoplus($key2);
                        //quiz object
                        $questionsq->setQuiz($quiz);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($questionsq);
                        $em->flush();
                 
               
                       
                        foreach($info as $answerKey => $bool){
                                //answer
                                //echo 'answerKey / answer: ' . $answerKey . "<br />\n";
                                $answerBDD = new Answer($answerKey);

                                //isCorrect
                                $answerBDD->setIsCorrect($bool);
                                $answerBDD->setQuestions($questionsq);
                        
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($answerBDD);
                                $em->flush();
                        
                        }

                    
                }
            
        }
        
    }else{


            //fetch all questions bound with id of quiz
            $questionAll = $questionsRepo->findByQuiz($quiz->getId());
            // result = object array
        
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
                
                                    if($cpt > 1) {
                                    $typeInput = "checkbox";
                
                                    }else{
                                        $typeInput = "radio";
                                    }
                
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
    
        }
     

        return $this->render('main/quiz-read.html.twig', [
            "arrayQuestionsAnswer" => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            "typeInput" => $typeInput,
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
