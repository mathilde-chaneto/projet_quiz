<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Play;
use App\Entity\Quiz;
use App\Repository\UserRepository;
use App\Repository\QuizRepository;
use App\Form\SignUpType;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



/**
     * @Route("/", name="dev-quiz_")
     */
class MainController extends AbstractController
{
    /**
     * @Route("", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
    
    /**
     * @Route("/signup", name="sign-up")
     */
    public function sign_up(Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer): Response
    {
        $user = new User();
       
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //upload file $imageFile which match with the 'image' field
            //$imageFile = object of uploadFile class
            $imageFile = $form->get('image')->getData();

            if($imageFile == null) {
                
                $user->setImage('icons8-utilisateur-48.png');

            }else {

            //rename $imageFile
            //guessClientExtension knows the image's extension
            $newFileName = uniqid() . '.' . $imageFile->guessClientExtension();

            //move the file to this way (in public folder)
            $imageFile->move('avatar', $newFileName);

            // this property get now the avatar's image
            $user->setImage($newFileName);

            }

            // Encodage du mot de passe
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            // Assignation du rôle par défaut VIA le nom du rôle et non l'ID
            $user->setRoles(["ROLE_USER"]);
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new Email())
            ->from('dev.quiz.systeme@gmail.com')
            ->to($user->getEmail())
            ->subject('Your user ID')
            ->html('<p>Here, there is your User Id : </p><p>Email: '.$user->getEmail().'</p><p>Username : ' . $user->getusername().'</p>');

            $mailer->send($email);

            $this->addFlash('success', 'Vous êtes enregistré. Vous pouvez maintenant vous connecter. Un mail vous a été envoyer contenant vos identifiants.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('main/sign-up.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
