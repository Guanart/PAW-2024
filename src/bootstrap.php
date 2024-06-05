<?php
require __DIR__ . "/../vendor/autoload.php";
require 'helpers.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Paw\Core\Config;
use Paw\Core\Request;
use Paw\Core\Database\ConnectionBuilder;
use Paw\Core\Database\QueryBuilder;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$config = new Config;

$log = new Logger('mvc-app');
$handler = new StreamHandler($config->get("LOG_PATH"));
$handler->setLevel($config->get("LOG_LEVEL"));
$log->pushHandler($handler);

$connectionBuilder = new ConnectionBuilder;
$connectionBuilder->setLogger($log);
$connection = $connectionBuilder->make($config);

$querybuilder = new QueryBuilder($connection);
$querybuilder->setLogger($log);

$request = new Request;

// TWIG
$loader = new FilesystemLoader(__DIR__ . '/App/views');
$twig = new Environment($loader);
$isLoggedIn = new \Twig\TwigFunction('isLoggedIn', function () {
    return isset($_SESSION['username']);
});
$twig->addFunction($isLoggedIn);
$session = new \Twig\TwigFunction('session', function ($key) {
    return $_SESSION[$key];
});
$twig->addFunction($session);
$request_twig = new \Twig\TwigFunction('request', function () {
    global $request;
    return $request;
});
$twig->addFunction($request_twig);

// $role_twig = new \Twig\TwigFunction('role', function () {
//     return $request->user()->getRole();
// });
// $twig->addFunction($role_twig);

require "routes.php";
$router->setLogger($log);

