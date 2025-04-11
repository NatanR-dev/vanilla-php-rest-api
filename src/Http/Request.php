<?php

namespace App\Http;

class Request
{
    private $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function method(): string
    {
        return $this->method;
    }
}