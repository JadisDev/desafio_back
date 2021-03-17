<?php

namespace App\Tests\Services;

use App\Entities\Question;
use App\Entities\User;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;

class QuestionQueryTest extends EntityManagerTest
{

     /**
     * @throws Throwable
     */
    public function testEntityManager()
    {
        $em = $this->getEntityManager();
        $this->assertInstanceOf(EntityManagerInterface::class, $em);
        return $em;
    }

    /**
     * @depends testEntityManager
     * @param EntityManagerInterface $em
     * @throws Throwable
     */
    public function testAnsweredQuestions(EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->findAll()[0];
        $result = $em->getRepository(Question::class)->answeredQuestions($user->getId());
        $this->assertIsArray($result);
    }

    /**
     * @depends testEntityManager
     * @param EntityManagerInterface $em
     * @throws Throwable
     */
    public function testUnansweredQuestions(EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->findAll()[0];
        $result = $em->getRepository(Question::class)->unansweredQuestions($user->getId());
        $this->assertIsArray($result);
        dd($result);
    }

}