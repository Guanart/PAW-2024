<?php

namespace Paw\App\Controllers;

use Twig\Environment;

class InformacionController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function contactos($procesado = false) {
        $title = "Contactos";
        echo $this->twig->render('informacion/contactos.view.twig', [
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
        echo $this->twig->render('informacion/politicas_privacidad.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function acercaDeNosotros() {
        $title = "Acerca de Nosotros";
        echo $this->twig->render('informacion/informacion.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function defensaDelConsumidor() {
        $title = "Defensa del Consumidor";
        echo $this->twig->render('informacion/defensa_consumidor.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function novedades(){
        $title = "Defensa del Consumidor";
        echo $this->twig->render('informacion/novedades.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

}