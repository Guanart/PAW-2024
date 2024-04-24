<?php

namespace Paw\App\Controllers;

class InformacionController extends Controller
{
    public function contactos($procesado = false) {
        $title = "Contactos";
        view('informacion/contactos', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'procesado' => $procesado,
        ]);
    }

    public function contactosFormulario(){
        $formulario = $_POST;
        $this->contactos(true);
    }

    public function politicasPrivacidad() {
        $title = "Politicas de Privacidad";
        view('informacion/politicas_privacidad', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function acercaDeNosotros() {
        $title = "Acerca de Nosotros";
        view('informacion/informacion', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function defensaDelConsumidor() {
        $title = "Defensa del Consumidor";
        view('informacion/defensa_consumidor', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function novedades(){
        $title = "Defensa del Consumidor";
        view('informacion/novedades', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

}