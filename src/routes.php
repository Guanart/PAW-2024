<?php

use Paw\Core\Router;

$router = new Router;
$router->get('/','PageController@index');
$router->get('/menu','PageController@menu');

$router->get('/politicas_privacidad','InformacionController@politicasPrivacidad');
$router->get('/acerca_de_nosotros','InformacionController@acercaDeNosotros');
$router->get('/novedades','InformacionController@novedades');
$router->get('/defensa_del_consumidor','InformacionController@acercaDeNosotros');
$router->get('/contactos','InformacionController@contactos');
$router->post('/contactos','InformacionController@contactosFormulario');

$router->get('/hacer_pedido','PedidoController@hacerPedido');
$router->get('/armar_pedido','PedidoController@armarPedido');
$router->post('/armar_pedido','PedidoController@armarPedidoFormulario');
$router->get('/confirmar_pedido','PedidoController@confirmarPedido');
$router->post('/confirmar_pedido','PedidoController@confirmarPedidoFormulario');
$router->get('/elegir_local','PedidoController@elegirLocal');
$router->post('/elegir_local','PedidoController@elegirLocalFormulario');
$router->get('/ingresar_direccion','PedidoController@ingresarDireccion');
$router->post("/ingresar_direccion", "PedidoController@ingresarDireccionFormulario");
$router->get('/fin_pedido','PedidoController@finPedido');
$router->get('/seleccion_mesa_qr','PedidoController@seleccionarMesa');
$router->get('/pedidos','PedidoController@pedidos');

$router->get('/reservas','ReservaController@reservas');
$router->get('/locales','ReservaController@locales');
$router->post('/fin_reserva','ReservaController@finReserva');
$router->post('/seleccion_mesa','ReservaController@seleccionMesa');
$router->get('/local','ReservaController@local');

$router->get('/login','UsuarioController@login');
$router->get('/register','UsuarioController@register');
$router->post('/register','UsuarioController@registerFormulario');
$router->get('/forgot_password','UsuarioController@forgotPassword');
$router->get('/verification_code','UsuarioController@verificationCode');

$router->get('/alta_plato', 'IntranetController@altaPlato');
$router->post('/alta_plato', 'IntranetController@altaPlatoProcesado');
$router->get('/estado_pedido', 'IntranetController@estadoPedido');