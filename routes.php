<?php

use App\Controllers\QuestionController;
use App\Controllers\UserController;
use App\Middleware\JwtMiddleware;
use Slim\Routing\RouteCollectorProxy;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

/** Rotas destinada ao usuário */
$app->post('/users', UserController::class . ':save');
$app->post('/login', UserController::class . ':login');

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('/question-unanswered', QuestionController::class . ':unansweredQuestions');
    $group->get('/question-answered', QuestionController::class . ':answeredQuestions');
})->add(new JwtMiddleware());


$app->run();