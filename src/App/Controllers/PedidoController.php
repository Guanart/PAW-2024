<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Models\PedidoLlevar;
use Paw\App\Models\PedidoDelivery;
use Paw\App\Models\PedidoMesa;

class PedidoController extends Controller
{
    public function pedidos() {
        $title = "Tus pedidos";
        $id_usuario = "123";    // Recuperarlo de la sesión
        $pedidos = json_decode(file_get_contents(__DIR__ . '/../pedidos.json'), true);   // Recuperar de la base de datos
        $pedidos_usuario = array_filter($pedidos, function ($pedido) use ($id_usuario) {
            return $pedido["id_usuario"] === $id_usuario && $pedido["estado"] !== "entregado";
        });

        view('pedido/tus_pedidos', [
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
        view('pedido/hacer_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function armarPedido(){
        $title = "Armar Pedido";
        view('pedido/armar_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function armarPedidoFormulario(Request $request){
        $formularioDatos = $request->post();
        $pedido = [];
        foreach($formularioDatos as $plato => $cantidad) {
            if (is_numeric($cantidad) && $cantidad > 0){
                $pedido[] = [
                    "plato" => $plato,
                    "cantidad" => $cantidad
                ];
            }
        }
        $_SESSION["pedido"] = $pedido;
        $this-> confirmarPedido();
    }

    public function confirmarPedido($mostrarPost = false, string $mensaje =""){
        $title = "Confirmar Pedido";
        view('pedido/confirmar_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function confirmarPedidoFormulario(Request $request){
        $formularioDatos = null;
        $mensaje = "";
        $formularioDatos = $request->post();
        try {
            if ($_SESSION["tipo"]==="mesa") {
                $pedidoMesa = new PedidoMesa();
            } elseif ($_SESSION["tipo"]==="delivery") {
                $pedidoMesa = new PedidoDelivery();
            } elseif ($_SESSION["tipo"]==="llevar") {
                $pedidoMesa = new PedidoLlevar();
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
        view('pedido/elegir_local', [
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
        if ($request->hasBodyParams(["localidad"])) {
            try {
                $mensaje = "";
                $formularioDatos = $request->post();
                $_SESSION["tipo"] = "llevar";
                $_SESSION["localidad"] = $formularioDatos["localidad"];
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido();
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> ingresarDireccion(true, $mensaje);
        }
    }

    public function ingresarDireccion($mostrarPost = false, string $mensaje =""){
        $title = "Ingresar Direccion";
        view('pedido/ingresar_direccion', [
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
            $_SESSION["tipo"] = "delivery";
            $_SESSION["localidad"] = $formularioDatos["localidad"];
            $_SESSION["calle"] = $formularioDatos["calle"];
            $_SESSION["altura"] = $formularioDatos["altura"];
            $this->armarPedido();
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
        view('pedido/mensaje_fin_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
    public function seleccionarMesa($mostrarPost = false, string $mensaje =""){
        $title = "Seleccionar Mesa";
        view('pedido/seleccion_mesa_qr', [
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
                $_SESSION["tipo"] = "mesa";
                $_SESSION["mesa"] = $formularioDatos["mesa"];
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido();
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> seleccionarMesa(true, $mensaje);
        }
    }
}