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
                'required' => false,
                'constraints' => [
                    new Email ([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                        'message' => 'The email "{{ label }}" is not a valid email.',
                    ]),
                    new NotBlank,
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'constraints' => [
                     //new Regex('/^\S{8, 16}$/', 'Le mot de passe ne doit pas contenir d\'espaces, et doit etre constitué de 8 à 16 caractères'),
                     new Length ([
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Your username must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your username cannot be longer than {{ limit }} characters',
                    ]),
                
                        ]

            ])
            ->add('image', FileType::class, [
                'data_class' => null,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '350M',
                    ]),
                ]
            ])

            ->add('username', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank,
                    
                    new Length ([
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Your username must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your username cannot be longer than {{ limit }} characters',
                    ]),

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
