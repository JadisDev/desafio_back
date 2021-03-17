<?php

namespace App\Controllers;

use App\Services\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;

class UserController extends BasicController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->userService = new UserService();
    }

    public function login(Request $request, Response $response)
    {
        $data = $this->getData($request);
        $em = $this->container->get('em');
        $result = $this->userService->login($data, $em);
        return $this->returnJson($response, $result);
    }

    public function save(Request $request, Response $response)
    {
        $data = $this->getData($request);
        $em = $this->container->get('em');
        $result = $this->userService->saveUser($data, $em);
        return $this->returnJson($response, $result);
    }
}
