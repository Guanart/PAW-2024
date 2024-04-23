<?php

require __DIR__ . "/../src/bootstrap.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Paw\Core\Exceptions\RouteNotFoundException;

/*
$path = request()->url();
$method = request()->httpMethod();
$log->info("Petición a: {$method} {$path}");
*/

$router->direct($request);
