<?php

namespace App\Tests\Models;

use App\Entities\Question;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\TypeChallenge;

class QuestionTest extends EntityManagerTest
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
    public function testInsert(EntityManagerInterface $em)
    {
        $typeChallange = $em->getRepository(TypeChallenge::class)->findAll()[0];
        $this->assertInstanceOf(TypeChallenge::class, $typeChallange);

        $question = new Question();
        $question->setDescription('Quanto é 1 + 1?');
        $question->setTypeChallenge($typeChallange);
        $em->persist($question);
        $em->flush();
        $this->assertIsInt($question->getId());
    }
}
