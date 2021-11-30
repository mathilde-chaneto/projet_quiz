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


class QuizSelectedType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        $userId = $user->getId();

        $builder
            ->add('name', EntityType::class, [
                "label" => " Nom du quiz : ",
                "class" => Quiz::class,
                "expanded" => true,
                "multiple" => false,
                "constraints" => [
                    new NotBlank
                ],

                "query_builder" => function (QuizRepository $quizRepo) use ($userId) {
                    return $quizRepo
                    ->createQueryBuilder('q')
                    ->where('q.user = :userId')
                    ->setParameter('userId', $userId)
                    //->getQuery()
                    //->getResult()
                    ;
                },
                "choice_value" => 'id'
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
