<?php

namespace App\Controllers;

use App\Services\GameService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;

class GameController extends BasicController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->gameService = new GameService();
    }

    public function save(Request $request, Response $response)
    {
        $data = $this->getData($request);
        $data['userId'] = 1;
        $em = $this->container->get('em');
        $result = $this->gameService->saveGame($data, $em);
        return $this->returnJson($response, $result);
    }
}
