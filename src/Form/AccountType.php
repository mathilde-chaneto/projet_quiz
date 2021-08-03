<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmez le mot de passe'],
                'constraints' => [
                    new NotBlank ([
                        'message' => 'le mot de passe ne peut pas être vide.'
                    ]),
                     //new Regex('/^\S{8, 16}$/', 'Le mot de passe ne doit pas contenir d\'espaces, et doit etre constitué de 8 à 16 caractères'),
                     new Length ([
                        'min' => 8,
                        'max' => 16,
                        'minMessage' => 'Mot de passe trop court, {{ limit }} caractères minimum',
                        'maxMessage' => 'Mot de passe trop long, {{ limit }} caractères maximum',
                    ]),
                
                        ]
                    ])

            ->add('image', FileType::class, [
                'required' => false,
                'data_class' => null,
                'label' => 'Avatar',
                'constraints' => [
                    new File([
                        'maxSize' => '350M',
                    ]),
                ]
            ])

            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Pseudo',
                'constraints' => [                    
                    new Length ([
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Pseudo trop court, {{ limit }} caractères minimum',
                        'maxMessage' => 'Pseudo trop long, {{ limit }} caractères maximum',
                    ]),

                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
             'constraints'     => [
                new UniqueEntity([
                    'fields' => ['email'],
                    'message' => 'Cette adresse email existe déjà.'
                    ])
            ],
        ]);
    }
}