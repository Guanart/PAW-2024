<?php

namespace Paw\App\Controllers;

class PageController extends Controller
{
    public function index() {
        require $this->viewsDir . 'index.view.php';
    }

    public function reservas() {
        $main = "Reservas";
        require $this->viewsDir . 'reserva/reservas.php';
    }

    public function contactos($procesado = false) {
        $main = "Contactos";

        require $this->viewsDir . 'informacion/contactos.php';
    }

    public function contactosFormulario(){
        $formulario = $_POST;
        $this->contactos(true);
    }


    
}