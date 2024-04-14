<?php

require __DIR__ . "/../src/bootstrap.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Paw\Core\Router;

$path = request()->url();
$log->info("peticcion a: {$path}");
$method = request()->httpMethod();

/*
$router->loadRoutes('not_found', 'ErrorsController@notFound'); //FALTA CREAR
$router->loadRoutes('internalError', 'ErrorsController@notFound'); //FALTA CREAR
try {
    $router->direct($path);
} 
catch (RouteNotFoundException $e) {
    $router->direct('not_found');
    $log->info("Status Code: 404 - Route not Found", ["Path" => $path]);
} catch (Exception $e) {
    $router->direct('internal_error');
    $log->error("Status Code:500 - Internal Server Error", ["Error" => $e]);
}
*/
$router->direct($path,$method);