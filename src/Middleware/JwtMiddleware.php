<?php

namespace App\Middleware;

use App\Services\ApiResponse;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class JwtMiddleware {

   /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        ApiResponse::checkHeadearsAuthorization($request);
        $response = $handler->handle($request);
        return $response;
    }

}