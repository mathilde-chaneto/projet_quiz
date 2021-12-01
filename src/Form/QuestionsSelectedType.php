<?php

namespace App\Form;

use App\Entity\Questions;
use App\Repository\QuestionsRepository;

use Symfony\Component\Security\Core\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionsSelectedType extends AbstractType
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
                ->add('title', EntityType::class, [
                    "label" => "Titre : ",
                    "class" => Questions::class,
                    "expanded" => true,
                    "multiple" => false,
                    "constraints" => [
                        new NotBlank
                    ],
            
    
                    "query_builder" => function (QuestionsRepository $questionsRepo) use ($userId) {
                        return $questionsRepo
                        ->createQueryBuilder('q')
                        ->join('q.quiz', 'quiz')
                        ->addSelect('quiz')
                        ->where('quiz.user = :userId')
                        ->setParameter('userId', $userId)
                        //->getQuery()
                        //->getResult()
                        ;
                    },
                    "choice_value" => 'id'
                ])
          
            //->add('quiz', QuizSelectedType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
