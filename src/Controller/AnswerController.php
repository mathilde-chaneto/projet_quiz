<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\User;
use App\Entity\Play;
use App\Entity\Answer;
use App\Entity\Questions;
use App\Entity\Quiz;


use App\Form\AnswerType;
use App\Form\AnswerSelectedType;
use App\Form\AnswerDeleteType;

use App\Form\QuestionsSelectedType;
use App\Form\QuestionsDeleteType;
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
class AnswerController extends AbstractController
{
     /**
     * @Route("answers", name="answers")
     */
    public function load(AnswerRepository $answerRepo, QuestionsRepository $questionsRepo, QuizRepository $quizRepo, UserInterface $user, Request $request): Response
    {
        //$id = 50;
        //$creatorQuestions = $questionsRepo->findBy(["quiz" => $quizRepo->findAllQuizBase($id)]);
        //dump($answerRepo->findBy(["questions" => $questionsRepo->findBy(["quiz" => $quizRepo->findAllQuizBase($id)]) ]));

        //$questionsUser = $questionsRepo->findBy(["quiz" => $quizRepo->findBy(["user" => $user])]);
        //dump($questionsRepo->findBy(["quiz" => $quizRepo->findBy(["user" => $user]) ]));

        $userAnswer = $answerRepo->findBy(["questions" => $questionsRepo->findBy(["quiz" => $quizRepo->findBy(["user" => $user])]) ]);
       
        $answer = new Answer();

        $formAnswer = $this->createForm(AnswerType::class, $answer);
        $formAnswer->handleRequest($request);

       
        $nameAnswer = $formAnswer->get('nameAnswer')->getData();
        $isCorrect = $formAnswer->get('is_correct')->getData();
        $questions = $formAnswer->get('questions')->getData();
    
      

        if ($formAnswer->isSubmitted() && $formAnswer->isValid()) {

            $arrayQuestion =  $request->request->get('answer');
            dump($arrayQuestion);
            var_dump($request->request->all());

            $questionId = (int) $arrayQuestion['questions']['title'];
            dump($questionId);

            $qts = $questionsRepo->find($questionId);  
            dump($questions);
            
            $answer->setNameAnswer($nameAnswer);
            $answer->setIsCorrect($isCorrect);
            $answer->setQuestions($qts);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_answers');
        }


        return $this->render('answer/index.html.twig', [
            "userAnswer" => $userAnswer,
            "formAnswer" => $formAnswer->createView()
        ]);


    }
    
    /**
     * @Route("answers/edit/{id}", name="edit-answer", requirements={"id": "\d+"})
     */
    public function edit(Answer $answer, UserInterface $user, QuizRepository $quizRepo, QuestionsRepository $questionsRepo, Request $request): Response
    {

        $formAnswer = $this->createForm(AnswerType::class, $answer);
        $formAnswer->handleRequest($request);

        $getData = $formAnswer->getData();
        dump($getData);

        $nameAnswer = $formAnswer->get('nameAnswer')->getData();
        $isCorrect = $formAnswer->get('is_correct')->getData();
        $questions = $formAnswer->get('questions')->getData();
    
      

        if ($formAnswer->isSubmitted() && $formAnswer->isValid()) {

            $arrayQuestion =  $request->request->get('answer');
            dump($arrayQuestion);
            var_dump($request->request->all());

            $questionId = (int) $arrayQuestion['questions']['title'];
            dump($questionId);

            $qts = $questionsRepo->find($questionId);  
            dump($questions);
            
            $answer->setNameAnswer($nameAnswer);
            $answer->setIsCorrect($isCorrect);
            $answer->setQuestions($qts);



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_answers');
        }


        
        return $this->render('answer/edit.html.twig', [
            "formAnswer" => $formAnswer->createView()
            
        ]);
    }

      /**
     * @Route("answer/delete/{id}", name="delete-answer", requirements={"id"="\d+"})
     */
    public function delete(Answer $answer, Request $request)
    {
        $formAnswer = $this->createForm(AnswerDeleteType::class, $answer);
        $formAnswer->handleRequest($request);

        if ($formAnswer->isSubmitted() && $formAnswer->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($answer);
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_answer');
        }

        return $this->render('answer/delete.html.twig', [
            "formAnswer" => $formAnswer->createView()
         ]);
        
    }

    
    
}
