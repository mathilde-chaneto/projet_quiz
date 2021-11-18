<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Play;
use App\Entity\Answer;
use App\Entity\Questions;
use App\Entity\Quiz;

use App\Form\QuizType;


use App\Repository\QuestionsRepository;
use App\Repository\CategoryRepository;
use App\Repository\AnswerRepository;
use App\Repository\UserRepository;
use App\Repository\PlayRepository;
use App\Repository\QuizRepository;


use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
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
     * @Route("/liste/quizz", name="quizz")
     */
    public function quiz(QuizRepository $quizRepo, Categoryrepository $categeoryRepo,Request $request, UserInterface $user): Response
    {
        $quiz = new Quiz();

        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        $name =  $form->get('name')->getData();
        $category =  $form->get('category')->getData();  
       
        dump($name);
        dump($category);

        /*$er = $this->getDoctrine()
    ->getEntityManager()
    ->getRepository(' Category::class');

$form = $this->createForm($type, $entity, array(
    'category_repository ' => $entityRepo*/


        if ($form->isSubmitted() && $form->isValid()) {

            $name =  $form->get('name')->getData();
        
            $category =  $form->get('category')->getData();  
           
            dump($name);
          
            dump($category);
            
            /*if ($name != null){

                $category->setName($name);

            }
            
            if ($resume != null){

                $category->setResume($resume);

            }

            $quiz->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();*/


           return $this->redirectToRoute('dev-quiz_quizz');
        }
        
        return $this->render('quizz-folder/quizz.html.twig', [
            "quiz" => $quizRepo->findAllQuizBase(),
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/category/{id}/quizz", name="category-quizz", requirements={"id": "\d+"} )
     */
    public function categoryQuiz(Category $category, QuizRepository $quizRepo, QuestionsRepository $questionsRepo): Response
    {
        $catgQuiz = $quizRepo->findBy(["category" => $category->getId()]);
        $id = $catgQuiz[0]->getId();
        $showQuestion = $questionsRepo->findBy(["quiz" => $id]);
        //dump($catgQuiz[0]->getId());
       // dump($showQuestion);
        //var_dump($catgQuiz[0]);
       //$testId = $catgQuiz[0];
        //dump($testId->getId());

        return $this->render('quizz-folder/quiz-category.html.twig', [
            "category" => $category,
            "catgQuiz" =>$catgQuiz
        ]);
    }
    

    /**
     * @Route("/quiz/{id}", name="quiz-read", requirements={"id": "\d+"})
     */
    public function read(Quiz $quiz, QuizRepository $quizRepo, PlayRepository $playRepo,QuestionsRepository $questionsRepo, AnswerRepository $answerRepo, UserInterface $user): Response
    {
   
        //dump($sessionGetId);

      
        //fetch all questions bound with id of quiz
        $questionAll = $questionsRepo->findByQuiz($quiz->getId());
        $quizAll = $quizRepo->findBy(["category" => $quiz->getCategory() ]);
        dump($quizAll);
    
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
                            'answerName' => $answer->getNameAnswer(),
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

        $test = $playRepo->findByUser($user->getId());
        
      dump($test);
 



        return $this->render('quizz-folder/quiz-read.html.twig', [
            "arrayQuestionsAnswer" => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            "quizAll" => $quizAll,
            "player" => $playRepo->findByUser($user->getId()),
            "user"=> $user,
            "count"=>count($questionAll),
            "questionByQuiz" => $questionAll
        
        

        ]);
    }
    

   

}
