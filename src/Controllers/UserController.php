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

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->httpResponse->badRequest("Invalid JSON format.");
        }

        $userService = UserService::create($body);

        if (isset($userService['error']) && $userService['error']) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->created($userService);
    }

    public function login(Request $request, Response $response)
    {
        $body = Request::body();

        $userService = UserService::auth($body);

        if (isset($userService['error']) && $userService['error']) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->ok(['access_token' => $userService]); 

    }

    public function fetch()
    {
        $authorization = Request::authorization();

        $userService = UserService::fetch($authorization);

        if (isset($userService['error']) && $userService['error']) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->ok(['access_token' => $userService]);
    }

    public function update()
    {
        $authorization = Request::authorization();

        $body = Request::body();

        $userService = UserService::update($authorization, $body);

        if (isset($userService['error']) && $userService['error']) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->ok(['access_token' => $userService]);
    }

    public function remove(Request $request, Response $response, string|int $id)
    {
        $authorization = Request::authorization();

        $userService = UserService::delete($authorization, $id);

        if (isset($userService['error']) && $userService['error']) {
            return $this->httpResponse->badRequest($userService['message']);
        }

        $this->httpResponse->ok(['access_token' => $userService]);
    }
}