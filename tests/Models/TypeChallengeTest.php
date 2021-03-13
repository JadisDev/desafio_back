<?php

namespace App\Tests\Models;

use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\TypeChallenge;

class TypeChallengeTest extends EntityManagerTest
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
    public function testLinhaDoTempo(EntityManagerInterface $em)
    {
        $typeChallenge = new TypeChallenge();
        $typeChallenge->setDescription('Teste');
        $em->persist($typeChallenge);
        $em->flush();
        $this->assertIsInt($typeChallenge->getId());
    }
}
