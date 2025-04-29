<?php

namespace App\Http;

use App\Utils\ServiceResponse;

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

    public static function authorization()
    {
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);

        if (!isset($headers['authorization'])) {
            return ServiceResponse::error('Sorry, no authorization header provided.');
        }

        $authorizationPartials = explode(' ', $headers['authorization']);

        if (count($authorizationPartials) !== 2) {
            return ServiceResponse::error('Please, provide a valid authorization header.');
        }

        return $authorizationPartials[1] ?? ''; 
    }
}