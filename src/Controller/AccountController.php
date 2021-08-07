<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\AccountDisplayType;
use App\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
     * @Route("/", name="dev-quiz_")
     */
class AccountController extends AbstractController
{
     /**
     * @Route("/account/{id}", name="account", requirements={"id": "\d+"})
     */
    public function account(UserRepository $userRepo, $id, User $user): Response
    {
        $form = $this->createForm(AccountDisplayType::class, $user);

        return $this->render('main/account.html.twig', [
            'form' => $form->createView(),
            'userRepo' => $userRepo->find($id),
        ]);
    }

    /**
     * @Route("/account/edit/{id}", name="account-edit", requirements={"id": "\d+"})
     */
    public function edit(User $user, Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer): Response
    {
        
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData(); 
            $password =  $form->get('password')->getData(); 
            $encodePass = $encoder->encodePassword($user, $password);
       
            $email =  $form->get('email')->getData();
            $username =  $form->get('username')->getData();  

            //dd($imageFile), in this case it's null;
            //dd($email) show email;
           // dd($username) show username;
        
            
            if ($imageFile != null) {
                
                $newFileName = uniqid() . '.' . $imageFile->guessClientExtension();

          
                $imageFile->move('avatar', $newFileName);


                //dd($user->setImage($newFileName)) show the new name of $newFileName;

                $user->setImage($newFileName);
            } 

            if ($imageFile == null) {

                //dd($user->setImage('icons8-utilisateur-48.png')) if the field is null, put a default image;
                //next feature : get the previous image of user
                
               $user->setImage('icons8-utilisateur-48.png');
             

            }

            if ($password != null){

                //dd($password);

                //dd($user->getPassword());

                 $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

                //dd($user->setPassword($encodePass)) show this user object and we can show the encode password;

            }

            if ($email != null){

                $user->setEmail($email);

            }
            
            if ($username != null){

                $user->setUsername($username);

            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $email = (new Email())
            ->from('sysadmin@devquiz.fr')
            ->to($user->getEmail())
            ->subject('Your user ID')
            ->html('<p>Here, there is your User Id : </p><p>Email: '.$user->getEmail().'</p><p>Username : ' . $user->getusername().'</p>');

            $mailer->send($email);

            $this->addFlash('success', 'Un mail vous a été envoyer contenant vos identifiants.');

            return $this->redirectToRoute('dev-quiz_account', ['id' => $user->getId()]);
        }

        return $this->render('main/account-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/account/delete/{id}", name="account-delete", requirements={"id"="\d+"})
     */
    public function delete(User $user, Request $request)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash('success', 'Votre compte a bien été supprimé.');

            return $this->redirectToRoute('app_login');
        
    }
     

}
