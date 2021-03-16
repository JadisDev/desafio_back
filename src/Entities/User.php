<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repositories\UserRepository")
 */
class User
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", name="created_an")
     */
    private $createdAn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setPassword(string $password): void
    {
        $this->password = md5($password);
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setCreatedAn(DateTime $createdAn): void
    {
        $this->createdAn = $createdAn;
    }

    public function getCreatedAn(): ?DateTime
    {
        return $this->createdAn;
    }
}