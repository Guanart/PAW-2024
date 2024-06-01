<?php

namespace Paw\App\Controllers;

use Paw\Core\Request;
use Twig\Environment;

class ReservaController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function seleccionMesa(Request $request){
        $input = $request->get('local');
        $local = ucwords($input);
        $title = "Seleccion de Mesa";
        echo $this->twig->render('reserva/seleccion_mesa.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'local' => $local,
        ]);
    }

    public function reservasMesa() {
        echo $this->twig->render('reserva/reservasMesa.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }

    public function agregarReserva() {
        echo $this->twig->render('reserva/agregar_reserva.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }

    public function reservas() {
        $title = "Reservas";
        echo $this->twig->render('reserva/reservas.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function locales() {
        $title = "Locales";
        echo $this->twig->render('reserva/reservas.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function finReserva(){
        $title = "Fin de la Reserva";
        echo $this->twig->render('reserva/fin_reserva.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function local(Request $request) {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = $local;
        echo $this->twig->render('reserva/local.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'local' => $local,
            'title' => $local,
        ]);
    }

    public function local2(Request $request) {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = $local;
        echo $this->twig->render('reserva/local2.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'local' => $local,
            'title' => $local,
        ]);
    }
}