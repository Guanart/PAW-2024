<?php

use Paw\App\Controllers\PageController;
use Paw\Core\Router;

$router = new Router;
$router->get('/','PageController@index');
$router->get('/reservas','PageController@reservas');
$router->get('/contactos','PageController@contactos');
$router->post('/contactos','PageController@contactosFormulario');