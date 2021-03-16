<?php

namespace App\Tests\Models;

use App\Entities\User;
use App\Tests\EntityManagerTest;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class UserTest extends EntityManagerTest
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
        $user = new User();
        $user->setName('Jadis');
        $user->setLogin('jsj');
        $user->setPassword('112233');
        $user->setCreatedAn(new DateTime());

        $em->persist($user);
        $em->flush();

        $this->assertIsInt($user->getId());
    }
}
