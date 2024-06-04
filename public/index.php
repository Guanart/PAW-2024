<?php

require __DIR__ . "/../src/bootstrap.php";

/*
$path = request()->url();
$method = request()->httpMethod();
$log->info("Petición a: {$method} {$path}");
*/
session_start();
$router->direct($request);
