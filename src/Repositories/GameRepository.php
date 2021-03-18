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
}