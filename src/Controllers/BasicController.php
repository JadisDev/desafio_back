<?php

namespace App\Controllers;

use App\Services\UserService;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;

class BasicController {

    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function returnJson($response, $result)
    {
        $status = $result['status'];
        unset($result['status']);
        $response->getBody()->write(json_encode($result));
        $newResponse = $response->withStatus($status);
        return $newResponse->withHeader('Content-Type', 'application/json');
    }

    public function getData(Request $request)
    {
        if (isset($request->getHeaders()['Authorization'])) {
            preg_match('/Bearer\s(\S+)/', $request->getHeaders()['Authorization'][0], $matches);
            $userService = new UserService();
            $data = $userService->jwtDecode($matches[1]);
            $body = json_decode($request->getBody(), true);
            $body = $body ? $body : [];
            $newArray = array_merge($body, ['userId' => $data['id']]);
            return $newArray;
        }
        return json_decode($request->getBody(), true);
    }
}