<?php 

namespace App\Http;

use App\Http\Response;

class ErrorResponse
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;        
    }

    public function methodNotAllowed()
    {
        $this->response->json([
            'error' => 'Method Not Allowed'
        ], 405);
        exit;
    }

    public function notFound()
    {
        $this->response->json([
            'error' => 'Not Found'
        ], 404);
        exit;
    }
}
