<?php

namespace App\Controllers;

use App\Services\TypeService;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TypeController extends BasicController
{

    private $typeService;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->typeService = new TypeService();
    }

    public function getTypes(Request $request, Response $response)
    {
        $em = $this->container->get('em');
        $result = $this->typeService->getTypes($em);
        return $this->returnJson($response, $result);
    }

}