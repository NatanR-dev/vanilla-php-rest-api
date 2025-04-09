<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Routes/main.php";

use App\Core\Core;
use App\Http\Route;

Core::displatch(Route::routes());