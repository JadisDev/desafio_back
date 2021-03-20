<?php
namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class GameRepository extends EntityRepository
{

    public function getGameByUserAndQuestion(int $userId, int $questionId)
    {
        try {
            return $this->findOneBy(['user' => $userId, 'question' => $questionId]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function getGameByUser(int $userId)
    {
        try {
            return $this->findBy(['user' => $userId]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}