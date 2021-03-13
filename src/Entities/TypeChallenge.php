<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="type_challenges")
 */
class TypeChallenge
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
    private $descripton;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDescription(string $descripton): void
    {
        $this->descripton = $descripton;
    }

    public function getDescription() : ?string
    {
        return $this->descripton;
    }
}