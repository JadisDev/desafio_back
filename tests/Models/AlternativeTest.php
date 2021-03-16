<?php

namespace App\Tests\Models;

use App\Entities\Alternative;
use App\Entities\Question;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;

class AlternativeTest extends EntityManagerTest
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
        $question = $em->getRepository(Question::class)->findAll()[0];
        $this->assertInstanceOf(Question::class, $question);

        $alternative1 = new Alternative();
        $alternative1->setDescription('Resposta é 3');
        $alternative1->setQuestion($question);
        $alternative1->setIsRight(false);

        $alternative2 = new Alternative();
        $alternative2->setDescription('Resposta é 2');
        $alternative2->setQuestion($question);
        $alternative2->setIsRight(true);

        $em->persist($alternative1);
        $em->persist($alternative2);
        $em->flush();

        $this->assertIsInt($alternative1->getId());
        $this->assertIsInt($alternative2->getId());
    }
}
