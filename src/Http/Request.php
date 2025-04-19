<?php

namespace App\Http;

class Request
{
    private static $method;

    public function __construct()
    {
        self::$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public static function method(): string
    {
        return self::$method;
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match(self::method()) {
            'GET' => $_GET, 
            'POST', 'PUT', 'DELETE' => $json,
        };

        return $data;
    }
}