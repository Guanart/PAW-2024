<?php

namespace Paw\App\Controllers;

use Paw\Core\Request;

class ReservaController extends Controller
{
    public function reservas() {
        $title = "Reservas";
        view('reserva/reservas', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function locales() {
        $title = "Locales";
        view('reserva/reservas', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function finReserva(){
        $title = "Fin de la Reserva";
        view('reserva/fin_reserva', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function seleccionMesa(){
        $title = "Seleccion de Mesa";
        view('reserva/seleccion_mesa', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function local(Request $request) {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = $local;
        // Mostrar horarios disponibles en funcion del local
        // require $this->viewsDir . 'reserva/local.view.php';
        view('reserva/local', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'local' => $local,
            'title' => $local,
        ]);
    }
}