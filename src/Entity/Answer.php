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
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"detail_info"})
     * 
     */
    private $is_correct;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $questions;

    public function __construct($SuperName) {
        $this->name = $SuperName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   /**
    * 
    *@Groups({"detail_info"})
    *
    */
    public function getSuperName(): ?string
    {
        return $this->name;
    }

    public function setSuperName(string $SuperName): self
    {
        $this->name = $SuperName;

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
