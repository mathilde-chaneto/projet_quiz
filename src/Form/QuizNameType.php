<?php

namespace App\Form;


use App\Entity\Quiz;

use App\Repository\QuizRepository;

use App\Form\SelectCategoryType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;


class QuizNameType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                "label" => " Nom du quiz : ",
                "constraints" => [
                    new NotBlank
                ],

            ])

          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
            
        ]);
    }
}
