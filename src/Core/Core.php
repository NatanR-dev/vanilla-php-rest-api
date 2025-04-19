<?php 

namespace App\Core;

use App\Http\Request;
use App\Http\Response;
use App\Http\ErrorResponse;
use App\Http\NormalizeUrl;
use App\Http\UrlHandler;

class Core
{
    public static function dispatch(array $routes, Request $request, Response $response)
    {
        $url = UrlHandler::getUrl();
        $url = NormalizeUrl::normalize($url);

        $prefixController = 'App\\Controllers\\';

        $routerFound = false;

        foreach ($routes as $route) {
            $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) .'$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                if($route['method'] !== $request->method()) {
                    $errorHttp = new ErrorResponse($request, $response);
                    $errorHttp->methodNotAllowed();
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController . $controller;
                $extendController = new $controller();
                $extendController->$action(...$matches);
                return;
            }
        }

        if (!$routerFound) {
            $errorHttp = new ErrorResponse($request, $response);
            $errorHttp->notFound();
        }
    }
}