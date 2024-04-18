<?php

namespace Paw\App\Controllers;

class InformacionController extends Controller
{
    public function contactosFormulario(){
        $formulario = $_POST;
        $this->contactos(true);
    }
}