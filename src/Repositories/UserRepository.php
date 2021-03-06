<?php
namespace App\Repositories;

use App\Entities\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    public function getUserByLogin(string $login) : ?User
    {
        return $this->findOneBy(['login' => $login]);
    }

    public function login(string $login, string $password) : ?User
    {
        return $this->findOneBy(['login' => $login, 'password' => $password]);
    }

}