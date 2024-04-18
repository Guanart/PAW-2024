<?php

namespace Paw\App\Controllers;

class PageController extends Controller
{
    public function index() {
        $main = "Paw Power";
        require $this->viewsDir . 'index.view.php';
    }

    public function reservas() {
        $main = "Reservas";
        require $this->viewsDir . 'reserva/reservas.php';
    }

    public function contactos($procesado = false) {
        $main = "Contactos";
        require $this->viewsDir . 'informacion/contactos.view.php';
    }

    public function menu() {
        $main = "Menu";
        require $this->viewsDir . 'menu.view.php';
    }

    public function hacerPedido() {
        $main = "Hacer Pedido";
        require $this->viewsDir . 'pedido/hacer_pedido.view.php';
    }

    public function locales() {
        $main = "Locales";
        require $this->viewsDir . 'reserva/reservas.php';
    }

    public function login() {
        $main = "Login";
        require $this->viewsDir . 'usuario/login.view.php';
    }

    public function politicasPrivacidad() {
        $main = "Politicas de Privacidad";
        require $this->viewsDir . 'informacion/politicas_privacidad.view.php';
    }

    public function acercaDeNosotros() {
        $main = "Acerca de Nosotros";
        require $this->viewsDir . 'informacion/informacion.view.php';
    }

    public function defensaDelConsumidor() {
        $main = "Defensa del Consumidor";
        require $this->viewsDir . 'informacion/defensa_consumidor.view.php';
    }
    

    public function armar_pedido(){
        $main = "Armar Pedido";
        require $this->viewsDir . 'pedido/armar_pedido.view.php';
    }

    public function confirmar_pedido(){
        $main = "Confirmar Pedido";
        require $this->viewsDir . 'pedido/confirmar_pedido.view.php';
    }
    
}