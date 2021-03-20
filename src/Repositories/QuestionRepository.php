<?php

namespace App\Repositories;

use App\Entities\Game;
use Doctrine\ORM\EntityRepository;

class QuestionRepository extends EntityRepository
{

    public function unansweredQuestions(int $userId)
    {
        try {
            $sql = "SELECT q.* from questions q where q.id not in
            (SELECT g2.question_id from games g2 where g2.user_id = :userId)";
            $conn = $this->getEntityManager()->getConnection();
            $stmt = $conn->prepare($sql);
            $prepare = ['userId' => $userId];
            $stmt->execute($prepare);
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function answeredQuestions(int $userId)
    {
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
