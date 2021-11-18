<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\EmailValidator;

//use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;



  /**
     * @Route("/", name="dev-quiz_")
     */
class ContactController extends AbstractController
{
    /**
     * @Route("contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        $defaultData = ['contact' => 'contact form'];
        $form = $this->createFormBuilder($defaultData)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            //var_dump($data);
            //var_dump($form->get('email')->getData());

           // $address = "mathilde.chaneto@gmail.com";

            //send email 
            $email = (new Email())
            ->from($form->get('email')->getData())
            ->to('mathilde.chaneto@gmail.com')
            ->subject('Formulaire de contact GEEK-TAKU')
            ->html('<ul><li>' .$form->get('lastname')->getData() .'</li>
            <li>' .$form->get('firstname')->getData() . '</li>
            <li>' . $form->get('email')->getData(). '</li>
            <li>' . $form->get('message')->getData(). '</li></ul>');

             $mailer->send($email);
             
             $this->addFlash('success', 'Votre message a bien été envoyer !');

             return $this->redirectToRoute('geek-taku_main');

             }
            
            // $response = new RedirectResponse('');

        // ... render the form
         return $this->render('maincontact-folder/contact.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('lastname', TextType::class, [
            'required' => true,
            'constraints' => [                    
                new Length ([
                    'min' => 3,
                    'max' => 30,
                    'minMessage' => 'Nom trop court, {{ limit }} caractères minimum.',
                    'maxMessage' => 'Nom trop long, {{ limit }} caractères maximum.',
                ]),
                new NotBlank ([
                    'message' => 'Le nom ne peut pas être vide.'
                ]),

            ]

        ])
        ->add('firstname', TextType::class, [
            'required' => true,
            'constraints' => [                    
                new Length ([
                    'min' => 3,
                    'max' => 30,
                    'minMessage' => 'Prénom trop court, {{ limit }} caractères minimum.',
                    'maxMessage' => 'Prénom trop long, {{ limit }} caractères maximum.',
                ]),
                new NotBlank ([
                    'message' => 'Le prénom ne peut pas être vide.'
                ]),

            ]

        ])
        ->add('email', EmailType::class, [
            'required' => true,
            'constraints' => [
                new Email ([
                    'message' => 'Adresse email "{{ value }}" invalide. ',
                    'message' => 'Adresse email "{{ label }}" invalide.',
                ]),
                new NotBlank,
            ]
        ])
        ->add('message', TextareaType::class, [
            'required' => true,
            'constraints' => [                    
                new Length ([
                    'min' => 3,
                    'max' => 30,
                    'minMessage' => 'Message trop court, {{ limit }} caractères minimum.',
                    'maxMessage' => 'Message trop long, {{ limit }} caractères maximum.',
                ]),
                new NotBlank ([
                    'message' => 'Le message ne peut pas être vide.'
                ]),

            ]

        ])
    ;
}
}
