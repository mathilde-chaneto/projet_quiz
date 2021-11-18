<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"detail_info"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * 
     */
    private $nameAnswer;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"detail_info"})
     * 
     */
    private $is_correct;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $questions;


    public function getId(): ?int
    {
        return $this->id;
    }

   /**
    * 
    *@Groups({"detail_info"})
    *
    */
    public function getNameAnswer(): ?string
    {
        return $this->nameAnswer;
    }

    public function setNameAnswer(string $NameAnswer): self
    {
        $this->name = $nameAnswer;

        return $this;
    }

    public function getIsCorrect(): ?bool
    {
        return $this->is_correct;
    }

    public function setIsCorrect(bool $is_correct): self
    {
        $this->is_correct = $is_correct;

        return $this;
    }

    public function getQuestions(): ?Questions
    {
        return $this->questions;
    }

    public function setQuestions(?Questions $questions): self
    {
        $this->questions = $questions;

        return $this;
    }


}
