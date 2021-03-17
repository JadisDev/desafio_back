<?php
namespace App\Repositories;

use App\Entities\Game;
use Doctrine\ORM\EntityRepository;

class QuestionRepository extends EntityRepository
{

    public function unansweredQuestions(int $userId) {
        try {
            return $this->createQueryBuilder('q')
            ->select('q')
            ->innerJoin(Game::class, 'g', 'WITH', 'q.id != g.question')
            ->where('g.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function answeredQuestions(int $userId) {
        try {
            return $this->createQueryBuilder('q')
            ->select('q')
            ->innerJoin(Game::class, 'g', 'WITH', 'q.id = g.question')
            ->where('g.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
        } catch (\Throwable $e) {
            throw $e;
        }
    }

}