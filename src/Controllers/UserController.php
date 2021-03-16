<?php

namespace App\Controllers;

use App\Services\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserController extends BasicController
{

    public function save(Request $request, Response $response)
    {
        $data = $this->getData($request);
        $em = $this->container->get('em');
        $userService = new UserService();
        $result = $userService->saveUser($data, $em);
        return $this->returnJson($response, $result);
    }
}
