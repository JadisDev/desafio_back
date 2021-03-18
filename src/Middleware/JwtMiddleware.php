<?php

namespace App\Middleware;

class JwtMiddleware {

    public function __invoke($request, $response)
    {
        // dd($ response);
        // $response = $next($request, $response);
        return $response;
    }

}