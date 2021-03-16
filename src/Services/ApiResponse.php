<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ApiResponse
{

    public static function success(string $message, $data): JsonResponse
    {
        return self::response(200, $message, $data);
    }

    public static function warning(string $message, $data): JsonResponse
    {
        return self::response(422, $message, $data, 422);
    }


    public static function info(string $message, $data): JsonResponse
    {
        return self::response(422, $message, $data, 422);
    }

    public static function error( string $message, $data): JsonResponse
    {
        return self::response(500, $message, $data, 500);
    }

    private static function response(int $cod, string $message, $data, $status = 200): JsonResponse
    {
        return new JsonResponse([
            'cod' => $cod,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}