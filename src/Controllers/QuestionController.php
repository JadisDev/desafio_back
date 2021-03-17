<?php

namespace App\Controllers;

use App\Services\QuestionService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;

class QuestionController extends BasicController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->questionService = new QuestionService();
    }

    public function answeredQuestions(Request $request, Response $response)
    {
        $em = $this->container->get('em');
        $result = $this->questionService->answeredQuestions(1, $em);
        return $this->returnJson($response, $result);
    }

    public function unansweredQuestions(Request $request, Response $response)
    {
        $em = $this->container->get('em');
        $result = $this->questionService->unansweredQuestions(1, $em);
        return $this->returnJson($response, $result);
    }
}
