<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Question
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
     * @var TypeChallenge
     *
     * @ORM\OneToOne(targetEntity="App\Entities\TypeChallenge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_challenge_id", referencedColumnName="id")
     * })
     */
    private $typeChallenge;

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

    public function setTypeChallenge(TypeChallenge $typeChallenge): void
    {
        $this->typeChallenge = $typeChallenge;
    }

    public function getTypeChallenge(): ?TypeChallenge
    {
        return $this->typeChallenge;
    }
}