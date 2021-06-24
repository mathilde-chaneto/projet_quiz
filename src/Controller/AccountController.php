<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
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
    public function account(UserRepository $userRepo, $id): Response
    {
        
        return $this->render('main/account.html.twig', [
            'userRepo' => $userRepo->find($id),
        ]);
    }

    /**
     * @Route("/account/edit/{id}", name="account-edit", requirements={"id": "\d+"})
     */
    public function edit(User $user, Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer): Response
    {
        //dd($user->getImage() );
        //$test = 'avatar/'.$user->getImage() ;
        //dd($test);
    
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData(); 
            $pasword =  $form->get('password')->getData(); 
            $email =  $form->get('email')->getData();
            $username =  $form->get('username')->getData();  
            
            if($imageFile == null){

                $user->setImage($user->getImage());  

            }else if ($imageFile != null) {
                
                $newFileName = uniqid() . '.' . $imageFile->guessClientExtension();

          
                $imageFile->move('avatar', $newFileName);
    

                $user->setImage($newFileName);
    
            
            }else if($pasword == null){

                $user->setPassword($user->getPassword());
            
            }else if ($pasword != null){

                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            }else if ($email == null){

                $user->setEmail($user->getEmail());

            }else if ($email != null){

                $user->setEmail($form->get('email')->getData());

            }else if ($username == null){

                $user->setUsername($user->getUsername());

            }else if ($username != null){

                $user->setUsername($form->get('username')->getData());

            }

            
            $this->getDoctrine()->getManager()->flush();

            $email = (new Email())
            ->from('dev.quiz.systeme@gmail.com')
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
