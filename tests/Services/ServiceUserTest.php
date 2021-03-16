<?php

namespace App\Tests\Services;

use App\Services\UserService;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiceUserTest extends EntityManagerTest
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
    public function testService(EntityManagerInterface $em)
    {
        $data = [
            "name" => "jadis da silva jale",
            "login" => "jsj",
            "password" => "123"
        ];
        $userService = new UserService();
        $response = $userService->saveUser($data, $em);
        $this->assertIsArray($response);
    }
}
