<?php

namespace App\Http;

class HttpResponse
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
        $this->response->json([
            'error' => true,
            'success' => false,
            'message' => 'Method Not Allowed'
        ], 405);
    }

    public function notFound(): void
    {
        $this->response->json([
            'error' => true,
            'success' => false,
            'message' => 'Not Found'
        ], 404);
    }

    public function badRequest(string $message): void
    {
        $this->response->json([
            'error' => true,
            'success' => false,
            'message' => $message
        ], 400);
    }

    public function created(array $data = []): void
    {
        $this->response->json([
            'error' => false,
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function ok(array $data = []): void
    {
        $this->response->json([
            'error' => false,
            'success' => true,
            'data' => $data
        ], 200);
    }
}