<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Routes/main.php";

use App\Http\Request;
use App\Http\Response;
use App\Core\Core;
use App\Http\Route;

$request = new Request(); 
$response = new Response(); 

Core::dispatch(Route::routes(), $request, $response);