<?php

namespace App\Form;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Security\Core\Security;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\OptionsResolver\OptionsResolver;


class SelectCategoryType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $user = $this->security->getUser();
        dump($user);
        dump($user->getId());
        $userId = $user->getId();
      
        $builder
            ->add("nameCategory", EntityType::class, [
                "label" => "Nom de la catégorie :",
                "class" => Category::class,
                "expanded" => true,
                "multiple" => false,
          
               
            
               "query_builder" => function (CategoryRepository $categoryRepo) use ($userId) {
                    return $categoryRepo
                    ->createQueryBuilder('c')
                    ->where('c.user = :userId')
                    ->setParameter('userId', $userId)
                    //->getQuery()
                    //->getResult()
                    ;
                },
                "choice_label" => 'nameCategory',
                "choice_value" => 'id'
              
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
