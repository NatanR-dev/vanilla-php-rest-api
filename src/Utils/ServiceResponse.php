<?php

namespace App\Utils;

class ServiceResponse
{
    public static function success(string $message = '', array $data = []): array
    {
        return [
            'error' => false,
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function error(string $message): array
    {
        return [
            'error' => true,
            'success' => false,
            'message' => $message
        ];
    }
}
