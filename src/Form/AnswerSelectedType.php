<?php

namespace App\Form;

use App\Entity\Answer;

use App\Repository\AnswerRepository;

use App\Form\QuestionsQuizSelectedType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerSelectedType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        // dump($user);
        // dump($user->getId());
         $userId = $user->getId();

        $builder
           
        ->add("nameAnswer", EntityType::class, [
            "label" => "Nom de la réponse:",
            "class" => Answer::class,
            "expanded" => true,
            "multiple" => false,
      
           
        
           "query_builder" => function (AnswerRepository $answerRepo) use ($userId) {
                return $answerRepo
                        ->createQueryBuilder('a')
                        ->join('a.questions', 'questions')
                        ->addSelect('questions')
                        ->join('questions.quiz', 'quiz')
                        ->addSelect('quiz')
                        ->where('quiz.user = :userId')
                        ->setParameter('userId', $userId)
                        //->getQuery()
                        //->getResult()
                        ;
            },
            "choice_value" => 'id'
          
          ])
          ->add('is_correct', CheckboxType::class, [
            "label" => "Bonne réponse ?",
            "help" => "Cochez si c'est un bonne réponse sinon laissez vide",
            "required" => false
        ])
        ->add('questions', QuestionsQuizSelectedType::class)
    ;
    ;
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
