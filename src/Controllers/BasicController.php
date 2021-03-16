<?php

namespace App\Controllers;

use Doctrine\ORM\Query\Expr\Func;
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
        return json_decode($request->getBody(), true);
    }
}