<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\File\File;
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
    public function account(User $user, UserRepository $userRepo, $id): Response
    {
        
        return $this->render('main/account.html.twig', [
            'user' => $user->getId(),
            'userRepo' => $userRepo->find($id),
        ]);
    }

    /**
     * @Route("/account/edit/{id}", name="account-edit", requirements={"id": "\d+"})
     */
    public function edit(User $user, Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer): Response
    {
    
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setImage(new File($this->getParameter('avatar').'/'.$user->getImage() ));

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());

            $this->getDoctrine()->getManager()->flush();

            $email = (new Email())
            ->from('sysadmin@dev-quiz.fr')
            ->to($user->getEmail())
            ->subject('Your user ID')
            ->html('<p>Here, there is your User Id : </p><p>Email: '.$user->getEmail().'</p><p>Username : ' . $user->getusername().'</p>');

        $mailer->send($email);

            $this->addFlash('success', 'Un mail vous a été envoyer contenant vos identifiants.');

            return $this->redirectToRoute('account');
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
