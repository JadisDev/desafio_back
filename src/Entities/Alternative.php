<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alternatives")
 * @ORM\Entity(repositoryClass="App\Repositories\AlternativeRepository")
 */
class Alternative
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", name="is_right")
     */
    private $isRight;

    /**
     * @var Question
     *
     * @ORM\OneToOne(targetEntity="App\Entities\Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setIsRight(bool $isRight): void
    {
        $this->isRight = $isRight;
    }

    public function isRight(): ?bool
    {
        return $this->isRight;
    }
}