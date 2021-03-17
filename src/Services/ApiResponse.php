<?php

namespace App\Services;

abstract class ApiResponse
{

    public static function success(string $message, $data): array
    {
        return self::response(200, $message, $data);
    }

    public static function warning(string $message, $data): array
    {
        return self::response(422, $message, $data, 422);
    }


    public static function info(string $message, $data): array
    {
        return self::response(422, $message, $data, 422);
    }

    public static function error( string $message, $data): array
    {
        return self::response(500, $message, $data, 500);
    }

    public static function unauthorized( string $message, $data): array
    {
        return self::response(401, $message, $data, 401);
    }

    private static function response(int $cod, string $message, $data, $status = 200): array
    {
        return [
            'cod' => $cod,
            'message' => $message,
            'data' => $data,
            'status' => $status
        ];
    }
}