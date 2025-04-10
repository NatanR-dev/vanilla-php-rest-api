<?php 

namespace App\Http;

use App\Http\Response;

class ErrorResponse
{
    public function methodNotAllowed()
    {
        Response::json([
            'error' => 'Method Not Allowed'
        ], 405);
    }

    public function notFound()
    {
        Response::json([
            'error' => 'Not Found'
        ], 404);
    }
}
