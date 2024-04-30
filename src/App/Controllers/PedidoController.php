<?php

namespace Paw\App\Controllers;

class PedidoController extends Controller
{
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

    public function confirmarPedido(){
        $title = "Confirmar Pedido";
        view('pedido/confirmar_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function elegirLocal(){
        $title = "Elegir Local";
        view('pedido/elegir_local', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function ingresarDireccion(){
        $title = "Ingresar Direccion";
        view('pedido/ingresar_direccion', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
    public function finPedido(){
        $title = "Fin de Pedido";
        view('pedido/mensaje_fin_pedido', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
    public function seleccionarMesa(){
        $title = "Seleccionar Mesa";
        view('pedido/seleccion_mesa_qr', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
}