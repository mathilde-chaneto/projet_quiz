<?php

namespace App\Form;

use App\Entity\Questions;

use App\Form\QuizNameType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionsQuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label" => "Titre : ",
                "constraints" => [
                    new NotBlank
                ]
                ])
            ->add('infoplus', TextareaType::class, [
                "label" => "Description : ",
                'attr' => [
                    'rows' => 5,
                    'cols' => 33,
                ],
                "constraints" => [
                    new NotBlank
                ]
                ])
            ->add('quiz', QuizType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
