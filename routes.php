<?php

declare(strict_types=1);

use App\Controllers\QuestionController;
use App\Controllers\UserController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface;

$app->get('/', function (Request $request, ResponseInterface $response) use ($app) {
    $en = $this->get('em');
    var_dump($en);
    $response->getBody()->write("Hello Jadis, tudo dando errado como esperado");
    return $response;
});

/** Rotas destinada ao usuário */
$app->post('/users', UserController::class . ':save');
$app->post('/login', UserController::class . ':login');

// $app->group('/api', function () use ($app) {
    $app->get('/question-unanswered', QuestionController::class . ':unansweredQuestions');
    $app->get('/question-answered', QuestionController::class . ':answeredQuestions');
// });