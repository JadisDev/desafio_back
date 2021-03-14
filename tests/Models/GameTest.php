<?php

namespace App\Tests\Models;

use App\Entities\Game;
use App\Entities\Question;
use App\Entities\User;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;

class GameTest extends EntityManagerTest
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

        $user = $em->getRepository(User::class)->findAll()[0];
        $this->assertInstanceOf(User::class, $user);

        $game = new Game();
        $game->setUser($user);
        $game->setQuestion($question);

        $em->persist($game);
        $em->flush();

        $this->assertIsInt($game->getId());
    }
}
