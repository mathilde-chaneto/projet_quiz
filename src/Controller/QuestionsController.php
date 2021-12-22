<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\User;
use App\Entity\Play;
use App\Entity\Answer;
use App\Entity\Questions;
use App\Entity\Quiz;


use App\Repository\QuestionsRepository;
use App\Repository\CategoryRepository;
use App\Repository\AnswerRepository;
use App\Repository\UserRepository;
use App\Repository\PlayRepository;
use App\Repository\QuizRepository;

use App\Form\QuizType;
use App\Form\AnswerType;
use App\Form\QuestionsType;
use App\Form\QuestionsDeleteType;
use App\Form\AnswerSelectedType;
use App\Form\QuestionsQuizSelectedType;
use App\Form\QuizSelectedType;
use App\Form\CategorySelectedType;

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
class QuestionsController extends AbstractController
{
    /**
     * @Route("questions", name="questions")
     */
    public function load(QuestionsRepository $questionsRepo, QuizRepository $quizRepo, UserInterface $user, Request $request): Response
    {
        $id = 50;
        $creatorQuestions = $questionsRepo->findBy(["quiz" => $quizRepo->findAllQuizBase($id)]);
        //dump($questionsRepo->findBy(["quiz" => $quizRepo->findAllQuizBase($id)]));
       
        $questionsUser = $questionsRepo->findBy(["quiz" => $quizRepo->findBy(["user" => $user])]);
        //dump($questionsRepo->findBy(["quiz" => $quizRepo->findBy(["user" => $user]) ]));
       

        $question = new Questions();

        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        $title =  $form->get('title')->getData();
        $infoplus =  $form->get('infoplus')->getData(); 
        $questionQuiz =  $form->get('quiz')->getData();
    

        if ($form->isSubmitted() && $form->isValid()) {

            $questionsQuiz =  $request->request->get('questions');
            dump($questionsQuiz);

            $questionsQuizId = $questionsQuiz['quiz']['name'];
            dump($questionsQuizId);
            
            $quiz = $quizRepo->find($questionsQuizId);

            $question->setQuiz($quiz);
            $question->setTitle($title);
            $question->setInfoplus($infoplus);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_questions');
        }



        return $this->render('questions/index.html.twig', [
           "creatorQuestions" => $creatorQuestions,
           "questionsUser" => $questionsUser,
           "form" => $form->createView()
        ]);


    }

    
       /**
     * @Route("/questions/edit/{id}", name="edit-question", requirements={"id": "\d+"})
     */
    public function edit(Questions $questions, UserInterface $user, QuizRepository $quizRepo, Request $request): Response
    {
     
        $form = $this->createForm(QuestionsType::class, $questions);
        $form->handleRequest($request);

        $title =  $form->get('title')->getData();
        $infoplus =  $form->get('infoplus')->getData(); 
        $questionQuiz =  $form->get('quiz')->getData();
    

        if ($form->isSubmitted() && $form->isValid()) {

            $questionsQuiz =  $request->request->get('questions');
            dump($questionsQuiz);

            $questionsQuizId = $questionsQuiz['quiz']['name'];
            dump($questionsQuizId);
            
            $quiz = $quizRepo->find($questionsQuizId);

            $questions->setQuiz($quiz);
            $questions->setTitle($title);
            $questions->setInfoplus($infoplus);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_questions');
        }

        return $this->render('questions/edit.html.twig', [
            "form" => $form->createView()
         ]);
 
    }

    /**
     * @Route("/questions/delete/{id}", name="delete-question", requirements={"id"="\d+"})
     */
    public function delete(Questions $questions, Request $request)
    {
        $form = $this->createForm(QuestionsDeleteType::class, $questions);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questions);
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_questions');
        }

        return $this->render('questions/delete.html.twig', [
            "form" => $form->createView()
         ]);
        
    }
}
