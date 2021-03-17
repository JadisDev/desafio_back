<?php

use App\Controllers\QuestionController;
use App\Controllers\UserController;


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/** Rotas destinada ao usuário */
$app->post('/users', UserController::class . ':save');
$app->post('/login', UserController::class . ':login');

$app->get('/api/question-unanswered', QuestionController::class . ':unansweredQuestions');
$app->get('/api/question-answered', QuestionController::class . ':answeredQuestions');