<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Quiz;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
     * @Route("/", name="dev-quiz_")
     */
class CategoryController extends AbstractController
{
   /**
     * @Route("/categories", name="categories")
     */
    public function categories(QuizRepository $quizRepo, Request $request, UserInterface $user, CategoryRepository $categoryRepo, SessionInterface $session): Response
    {

        //dump($user);

        $id = 50;

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $icone = $form->get('icone')->getData(); 
            $name =  $form->get('nameCategory')->getData();
            $resume =  $form->get('resume')->getData();  
           

            dump($icone);
            dump($name);
            dump($resume);
            
            if ($icone != null) {
                
                $newFileName = uniqid() . '.' . $icone->guessClientExtension();

          
                $icone->move('medias', $newFileName);


                //dd($user->setImage($newFileName)) show the new name of $newFileName;

                $category->setIcone($newFileName);
            } 
            
            if ($icone == null) {

                
                $newFileName = uniqid() . '.' . 'icons8-utilisateur-48.png';

                $icone->move('medias', $newFileName);
 
                $category->setIcone($newFileName);
            }


            if ($name != null){

                $category->setNameCategory($name);

            }
            
            if ($resume != null){

                $category->setResume($resume);

            }

            $category->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();


           return $this->redirectToRoute('dev-quiz_categories');
        }

        dump($categoryRepo->findBy(["user" => $user->getId() ]));
        
        return $this->render('categories/index.html.twig', [
            "quiz" => $quizRepo->findAllQuizBase($id), 
            "categoryUserId" => $categoryRepo->findBy(["user" => $user->getId() ]),
            "form" => $form->createView()
                       
        ]);
    }

    
    /**
     * @Route("/category/{id}/quizz", name="category-quizz", requirements={"id": "\d+"} )
     */
    public function categoryQuiz(Category $category, QuizRepository $quizRepo, UserInterface $user): Response
    {
        $catgQuiz = $quizRepo->findBy(["category" => $category->getId()]);
    
        
        dump($catgQuiz);

        return $this->render('quizz-folder/quiz-category.html.twig', [
            "category" => $category,
            "catgQuiz" =>$catgQuiz,
            "user" => $user
        ]);
    }

     /**
     * @Route("/category/edit/{id}", name="edit-category", requirements={"id": "\d+"})
     */
    public function edit(Category $category, QuizRepository $quizRepo, UserInterface $user, Request $request): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

            $icone = $form->get('icone')->getData(); 
            $name =  $form->get('nameCategory')->getData();
            $resume =  $form->get('resume')->getData();  

            dump($icone);
            dump($name);
          


        if ($form->isSubmitted() && $form->isValid()) {

            $icone = $form->get('icone')->getData(); 
            $name =  $form->get('nameCategory')->getData();
            $resume =  $form->get('resume')->getData();  
           
            dump($icone);
            dump($name);
          
            
            if ($icone != null) {
                
                $newFileName = uniqid() . '.' . $icone->guessClientExtension();

                $icone->move('medias', $newFileName);

                $category->setIcone($newFileName);
            } 
            
            if ($icone == null) {

                $newFileName = uniqid() . '.' . 'icons8-utilisateur-48.png';

                $icone->move('medias', $newFileName);
 
                $category->setIcone($newFileName);

                dump($icone);
            }


            if ($name != null){

                $category->setNameCategory($name);

            }
            
            if ($resume != null){

                $category->setResume($resume);

            }

            $category->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success','Vos changement ont bien été pris en compte.');

            return $this->redirectToRoute('dev-quiz_categories');
        }

        return $this->render('categories/edit.html.twig', [
            'form' => $form->createView(),
            "quiz" => $quizRepo->findBy(["category" => $category->getId()]), 
            "category"=> $category
        ]);
    }

     /**
     * @Route("/category/delete/{id}", name="delete-category", requirements={"id"="\d+"})
     */
    public function delete(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
          
           return $this->redirectToRoute('dev-quiz_categories');
        }

        return $this->render('answer/delete.html.twig', [
            "form" => $form->createView()
         ]);
        
    }
}
