<?php
namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class AlternativeRepository extends EntityRepository
{

    public function getByQuestion(int $questionId)
    {
        return $this->findBy(['question' => $questionId]);
    }

}