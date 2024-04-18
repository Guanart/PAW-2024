<?php

require __DIR__ . "/../src/bootstrap.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Paw\Core\Exceptions\RouteNotFoundException;

$path = request()->url();
$log->info("peticcion a: {$path}");
$method = request()->httpMethod();

try {
    $router->direct($path, $method);
} 
catch (RouteNotFoundException $e) {
    $router->direct('/not_found');
    $log->info("Status Code: 404 - Route not Found", ["Path" => $path]);
} catch (Exception $e) {
    $router->direct('internal_error');
    $log->error("Status Code:500 - Internal Server Error", ["Error" => $e]);
}