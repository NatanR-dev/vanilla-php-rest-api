<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Routes/main.php";

use App\Http\Response;
use App\Core\Core;
use App\Http\Route;

// Crie instâncias de Request e Response
$response = new Response(); // Instância de Response

Core::dispatch(Route::routes(), $response);