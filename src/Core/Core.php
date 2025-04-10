<?php 

namespace App\Core;

use App\Http\Request;
use App\Http\ErrorResponse;

class Core
{
    public static function displatch(array $routes)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $prefixController = 'App\\Controllers\\';

        $routerFound = false;

        foreach ($routes as $route) {
            $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) .'$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                if($route['method'] !== Request::method()) {
                    $errorHttp = new ErrorResponse();
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
            $errorHttp = new ErrorResponse();
            $errorHttp->notFound();
        }
    }
}