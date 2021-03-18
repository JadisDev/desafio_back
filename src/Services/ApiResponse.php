<?php

namespace App\Services;

use Psr\Http\Message\ServerRequestInterface as Request;
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

    public static function checkHeadearsAuthorization(Request $request) 
    {

        if (!isset($request->getHeaders()['Authorization'])) {
            header('HTTP/1.0 400 Bad Request');
            header('Content-Type: application/json');
            $result = ApiResponse::warning('Rota requer autorização', null);
            echo json_encode($result);
            exit;
        }

        if (!preg_match('/Bearer\s(\S+)/', $request->getHeaders()['Authorization'][0], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            header('Content-Type: application/json');
            $result = ApiResponse::warning('Token não encontrado', null);
            echo json_encode($result);
            exit;
        }

    }
}