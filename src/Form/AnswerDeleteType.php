<?php

namespace App\Form;

use App\Entity\Answer;

use App\Form\QuestionsDeleteType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerDeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('nameAnswer',TextareaType::class, [
                "label" => "Nom de la réponse : ",
                "attr" => [
                    "rows" => 5,
                    "col" => 30,
                   
                ],
                "constraints" => [
                    new NotBlank
                ],
                
            
           ])
            ->add('is_correct', CheckboxType::class, [
                "label" => "Bonne réponse ?",
                "help" => "Cochez si c'est un bonne réponse sinon laissez vide",
                "required" => false
            ])
            ->add('questions', QuestionsDeleteType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
