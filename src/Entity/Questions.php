<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"detail_info"})
     * 
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"detail_info"})
     * )
     */
    private $title;


    /**
     * @ORM\ManyToOne(targetEntity=Quiz::class, inversedBy="questions", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $quiz;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="questions", orphanRemoval=true)
     */
    private $answers;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"detail_info"})
     * 
     */
    private $infoplus;

   

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestions($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestions() === $this) {
                $answer->setQuestions(null);
            }
        }

        return $this;
    }

    public function getInfoplus(): ?string
    {
        return $this->infoplus;
    }

    public function setInfoplus(?string $infoplus): self
    {
        $this->infoplus = $infoplus;

        return $this;
    }

    /**
     * @Groups({"detail_info"})
     * 
     */
    public function getAnswerId() {
        $answersArray = [];
      
        foreach($this->answers as $answerId){

            if ($answerId instanceof Answer){

               $answersArray[] = $answerId;
           
            } 
        
        }
        return $answersArray;
    }

    public function __toString() {
        return $this->title;
    }

}
