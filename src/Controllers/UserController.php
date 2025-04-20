<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Http\HttpResponse;
use App\Services\UserService;

class UserController
{
    private $httpResponse;

    public function __construct(Request $request, Response $response)
    {
        $this->httpResponse = new HttpResponse($request, $response);
    }

    public function store(Request $request, Response $response)
    {
        $body = Request::body();

        $userService = UserService::create($body);

        if (isset($userService['error']) && $userService['error'] === true) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->created($userService);
    }

    public function login(Request $request, Response $response)
    {
        
    }

    public function fetch(Request $request, Response $response)
    {
        
    }

    public function update(Request $request, Response $response)
    {
        
    }

    public function remove(Request $request, Response $response, array $id)
    {
        
    }
}