<?php

namespace App\Tests\Services;

use App\Entities\User;
use App\Services\UserService;
use App\Tests\EntityManagerTest;
use Doctrine\ORM\EntityManager;
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
    public function x(EntityManagerInterface $em)
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

    /**
     * @depends testEntityManager
     * @param EntityManagerInterface $em
     * @throws Throwable
     */
    public function testJwtEncode(EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->findAll()[0];
        $userService = new UserService();
        $token = $userService->jwtEncode($user);
        $this->assertNotNull($token);
        return $token;
    }

    /**
     * @depends testJwtEncode
     * @param EntityManagerInterface $em
     * @throws Throwable
     */
    public function testJwtDecode($token)
    {
        $userService = new UserService();
        $result = $userService->jwtDecode($token);
        $this->assertNotNull($result);
    }

}
