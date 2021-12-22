<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Play;
use App\Entity\Answer;
use App\Entity\Questions;
use App\Entity\Quiz;

use App\Form\QuizType;
use App\Form\AnswerType;
use App\Form\QuestionsType;
use App\Form\AnswerSelectedType;
use App\Form\QuestionsQuizSelectedType;
use App\Form\QuizSelectedType;
use App\Form\CategorySelectedType;



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
    public function quiz(QuizRepository $quizRepo, CategoryRepository $categoryRepo, Request $request, UserInterface $user): Response
    {
        $id = 50;
        //dump($quizRepo->findBy(["user" => $user->getId($id)]));
        //dump($quizRepo->findAllQuizBase($id));
        

        $quiz = new Quiz();
   
        
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        $nameQuiz =  $form->get('name')->getData();
        $quizCategory =  $form->get('category')->getData(); 
 

        if ($form->isSubmitted() && $form->isValid()) {
  
            $arrayQuestionsQuiz =  $request->request->get('quiz');
            $quizCategory = (int) $arrayQuestionsQuiz['category']['nameCategory'];
            dump($quizCategory);

           dump($categoryRepo->find($quizCategory));
           $catg = $categoryRepo->find($quizCategory);     
             

            $quiz->setCategory($catg);
            $quiz->setUser($user);
            $quiz->setName($nameQuiz);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($quiz);
            $entityManager->flush();


           return $this->redirectToRoute('dev-quiz_quizz');
        }

        return $this->render('quizz-folder/quizz.html.twig', [
            "quiz" => $quizRepo->findAllQuizBase($id),
            "quizzUser" => $quizRepo->findBy(["user" => $user]),
            "form" => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/quiz/{id}", name="quiz-read", requirements={"id": "\d+"})
     */
    public function read(Quiz $quiz, QuizRepository $quizRepo, PlayRepository $playRepo,QuestionsRepository $questionsRepo, AnswerRepository $answerRepo, UserInterface $user): Response
    {
      
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

                        $lines_arr = preg_split('/\n/', $answer->getNameAnswer());
                        $ans[] = [
                            'answerId' => $answer->getId(),
                            'answerName' => $answer->getNameAnswer(),
                            'answerIsCorrect' => $answer->getIsCorrect(),
                            'number' => $lines_arr
                        ] ;

                        

                        if(preg_match('/[\``"^£$%&*()}{@#~?><>,|=_+¬-]/', $answer->getNameAnswer())) {

                            $specialCharacter = true;
                        }else {
                            $specialCharacter = false;
                        }

                            if($answer->getIsCorrect()){
            
                                $cpt++; 
            
                            }
                        
                    }
                
                    dump($ans);
            
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
      dump($specialCharacter);
   
    
 



        return $this->render('quizz-folder/quiz-read.html.twig', [
            "arrayQuestionsAnswer" => $arrayQuestionsAnswer,
            "quiz" => $quiz,
            "quizAll" => $quizAll,
            "player" => $playRepo->findByUser($user->getId()),
            "user"=> $user,
            "count"=>count($questionAll),
            "questionByQuiz" => $questionAll,
            "specialCharacter" =>  $specialCharacter,
     
        
        

        ]);
    }
    


      /**
     * @Route("/edit/quiz/{id}", name="edit-quiz", requirements={"id": "\d+"})
     */
    public function edit(Quiz $quiz, UserInterface $user, CategoryRepository $categoryRepo,Request $request): Response
    {

        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        $name =  $form->get('name')->getData();
        $category =  $form->get('category')->getData(); 

        if ($form->isSubmitted() && $form->isValid()) {
  
            dump($name);
          
            dump($category);
            
            if ($name != null){

                $quiz->setName($name);

            }
            
           $data =  $request->request->get('quiz');
           $id = $data['category']['nameCategory'];
          
           dump($categoryRepo->find($id));
           $catg = $categoryRepo->find($id);            

            $quiz->setCategory($catg);

            $quiz->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();


           return $this->redirectToRoute('dev-quiz_quizz');
        }
        
        return $this->render('quizz-folder/quiz-edit.html.twig', [
            "quiz" => $quiz,
            "form" => $form->createView()
        ]);
    }

     /**
     * @Route("/delete/quiz/{id}", name="delete-quiz", requirements={"id"="\d+"})
     */
    public function delete(Quiz $quiz, Request $request)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quiz);
            $em->flush();

            $this->addFlash('success-delete','Le quiz a bien été supprimé.');

            return $this->redirectToRoute('dev-quiz_quizz');
        
    }



   

}
