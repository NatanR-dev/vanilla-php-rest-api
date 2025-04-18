<?php

namespace App\Http;

class Response
{
    public function status(int $status): void
    {
        http_response_code($status);
    }

    public function json(array $data = [], int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}