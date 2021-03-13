<?php

declare(strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface;
use App\Util\Response;

$app->get('/', function (Request $request, ResponseInterface $response) use ($app) {
    $en = $this->get('em');
    var_dump($en);
    $response->getBody()->write("Hello Jadis, tudo dando errado como esperado");
    return $response;
});
