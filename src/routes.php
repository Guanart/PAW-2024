<?php

use Paw\Core\Router;

$router = new Router;
$router->get('/','PageController@index');
$router->get('/reservas','PageController@reservas');
$router->get('/contactos','PageController@contactos');
$router->post('/contactos','InformacionController@contactosFormulario');
$router->get('/menu','PageController@menu');
$router->get('/hacer_pedido','PageController@hacerPedido');
$router->get('/locales','PageController@locales');
$router->get('/login','PageController@login');
$router->get('/politicas_privacidad','PageController@politicasPrivacidad');
$router->get('/acerca_de_nosotros','PageController@acercaDeNosotros');
$router->get('/defensa_del_consumidor','PageController@acercaDeNosotros');

$router->get('/not_found','ErrorController@notFound');