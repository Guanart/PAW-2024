<?php

use Paw\Core\Router;

// Instanciar el Router con Twig
$router = new Router($twig);

$router->get('/','PageController@index');
$router->get('/menu','PageController@menu');
$router->get("/menu_page","PageController@menuPage");

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
$router->get('/tus_pedidos','PedidoController@pedidos');
$router->get('/estado_pedido', 'PedidoController@estadoPedido');
$router->post('/estado_pedido', 'PedidoController@actualizarEstadoPedido');
$router->get('/get_pedidos', 'PedidoController@getPedidosId');
$router->get('/estados', 'PedidoController@estadosPedidos');

$router->get('/reservas','ReservaController@reservas');
$router->get('/locales','ReservaController@locales');
$router->get('/fin_reserva','ReservaController@finReserva');
$router->post('/seleccion_mesa','ReservaController@seleccionMesaFormulario');
$router->get('/seleccion_mesa','ReservaController@seleccionMesa');
$router->get('/reservas_mesa','ReservaController@reservasMesa'); //<---

$router->get('/login','UsuarioController@login');
$router->post('/login','UsuarioController@loginFormulario');
$router->get('/logout','UsuarioController@logout');
$router->get('/verify_user','UsuarioController@verifyUser');
$router->get('/register','UsuarioController@register');
$router->post('/register','UsuarioController@registerFormulario');
$router->get('/usuario_registrado','UsuarioController@usuarioRegistrado');
$router->get('/cuenta','UsuarioController@cuenta');
$router->get('/forgot_password','UsuarioController@forgotPassword');
$router->get('/verification_code','UsuarioController@verificationCode');

$router->get('/alta_plato', 'IntranetController@altaPlato');
$router->post('/alta_plato', 'IntranetController@altaPlatoProcesado');
$router->get('/turnero', 'IntranetController@turnero');
$router->get('/gestion_pedidos', 'IntranetController@gestionPedidos');

