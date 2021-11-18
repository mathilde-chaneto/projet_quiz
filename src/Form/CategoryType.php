<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        $builder
            ->add('nameCategory', TextType::class, [
                'constraints' =>
                new NotBlank,
            ])
            ->add('icone', FileType::class, [
                'required' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'maxSize' => '350M',
                    ]),
                ]
                
                ])
            ->add('resume', TextType::class, [
                'required' => false,
            ]);
           ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
