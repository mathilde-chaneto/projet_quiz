<?php

namespace App\Form;

use App\Entity\Category;
use App\Repository\CategoryRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SelectCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
        $builder
            ->add("nameCategory",  EntityType::class, [
                "class" => Category::class,
                "query_builder" => function (CategoryRepository $categoryRepo) use ($user) {
                    return $categoryRepo->findBy(["user" => $user ]);
                },
                "choice_label" => 'nameCategory'
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Category::class,
        ]);
    }
}
