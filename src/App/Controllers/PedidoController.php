<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Models\PedidoLlevar;
use Paw\App\Models\PedidoDelivery;
use Paw\App\Models\PedidoMesa;
use Twig\Environment;

class PedidoController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function pedidos() {
        $title = "Tus pedidos";
        $id_usuario = "123";    // Recuperarlo de la sesión
        $pedidos = json_decode(file_get_contents(__DIR__ . '/../pedidos.json'), true);   // Recuperar de la base de datos
        $pedidos_usuario = array_filter($pedidos, function ($pedido) use ($id_usuario) {
            return $pedido["id_usuario"] === $id_usuario && $pedido["estado"] !== "entregado";
        });

        echo $this->twig->render('pedido/tus_pedidos.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'pedidos_usuario' => $pedidos_usuario,
        ]);
    }

    public function estadoPedido() {
        $endpoint = __DIR__ . "/../views/pedido/estado_pedido.php";
        require $endpoint;
    }

    public function actualizarEstadoPedido() {
        $endpoint = __DIR__ . "/../views/pedido/actualizar_estado_pedido.php";
        require $endpoint;
    }
    
    public function getPedidosId() {
        $endpoint = __DIR__ . "/../views/pedido/get_pedidos.php";
        require $endpoint;
    }

    public function hacerPedido() {
        $title = "Hacer Pedido";
        echo $this->twig->render('pedido/hacer_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function armarPedido(String $tipo = "", Array $formularioDatos = []){
        $title = "Armar Pedido";
        echo $this->twig->render('pedido/armar_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "tipo" => $tipo,
            "formularioDatos" => $formularioDatos
        ]);
    }

    public function armarPedidoFormulario(Request $request){
        $formularioDatos = $request->post();
        $tipo = "pedido";
        $this-> confirmarPedido(false, "",$formularioDatos);
    }

    public function confirmarPedido($mostrarPost = false, string $mensaje ="",Array $formularioDatos = []){
        $title = "Confirmar Pedido";
        echo $this->twig->render('pedido/confirmar_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "formularioDatos" => $formularioDatos,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function confirmarPedidoFormulario(Request $request){
        $formularioDatos = null;
        $mensaje = "";
        $formularioDatos = $request->post();
        try {
            if ($formularioDatos["tipo"]==="mesa") {
                $pedidoMesa = new PedidoMesa($formularioDatos);
            } elseif ($formularioDatos["tipo"]==="pedido") {
                $pedidoMesa = new PedidoDelivery($formularioDatos);
            } elseif ($formularioDatos["tipo"]==="llevar") {
                $pedidoMesa = new PedidoLlevar($formularioDatos);
            }
            // Agregar al JSON un nuevo Pedido

            $this->finPedido($formularioDatos);
        } catch (InvalidValueFormatException $e){
            $mensaje = $e->getMessage();
            this->confirmarPedido(true, $mensaje, $formularioDatos);
        }
    }

    public function elegirLocal($mostrarPost = false, string $mensaje =""){
        $title = "Elegir Local";
        echo $this->twig->render('pedido/elegir_local.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function elegirLocalFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        $tipo = "llevar";
        if ($request->hasBodyParams(["localidad"])) {
            try {
                $mensaje = "";
                $formularioDatos = $request->post();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido($tipo, $formularioDatos);
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> ingresarDireccion(true, $mensaje);
        }
    }

    public function ingresarDireccion($mostrarPost = false, string $mensaje =""){
        $title = "Ingresar Direccion";
        echo $this->twig->render('pedido/ingresar_direccion.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function ingresarDireccionFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        $tipo = "pedido";
        if ($request->hasBodyParams(["localidad", "calle", "altura"])) {
            try {
                $mensaje = "";
                $formularioDatos = $request->post();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido($tipo, $formularioDatos);
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> ingresarDireccion(true, $mensaje);
        }
    }

    public function finPedido(Array $formularioDatos){
        // if ($formularioDatos["tipo"]==="mesa") {
        //     $pedidoMesa = new PedidoMesa();
        // } elseif ($formularioDatos["tipo"]==="pedido") {
        //     $pedidoMesa = new PedidoDelivery();
        // } elseif ($formularioDatos["tipo"]==="llevar") {
        //     $pedidoMesa = new PedidoLlevar();
        // }

        $title = "Fin de Pedido";
        echo $this->twig->render('pedido/mensaje_fin_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
    public function seleccionarMesa($mostrarPost = false, string $mensaje =""){
        $title = "Seleccionar Mesa";
        echo $this->twig->render('pedido/seleccion_mesa_qr.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function seleccionarMesaFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        if ($request->hasBodyParams(["mesa"])) {
            try {
                $mensaje = "";
                $formularioDatos = $request->post();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido("mesa", $formularioDatos);
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> seleccionarMesa(true, $mensaje);
        }
    }
}