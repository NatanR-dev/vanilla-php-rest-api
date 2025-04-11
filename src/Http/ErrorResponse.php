<?php

namespace App\Http;

class ErrorResponse
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function methodNotAllowed(): void
    {
        $this->response->status(405);

    }

    public function notFound(): void
    {
        $this->response->status(404);
    }
}