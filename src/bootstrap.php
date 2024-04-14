<?php
require __DIR__ . "/../vendor/autoload.php";
require 'helpers.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require "routes.php";

$log = new Logger('mvc-app');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));

//$whoops = new \Whoops\Run;
//$whoops->pushHandler(new \Whoops\Handler\PrettyHandler);
//$whoops->register();
