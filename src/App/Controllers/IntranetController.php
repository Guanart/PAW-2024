<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\App\Models\Producto;
use Paw\Core\Request;

class IntranetController extends Controller {       // PlatoController?
    public ?string $modelName = Producto::class;

    public function altaPlato($procesado = false) {
        $title = "Contactos";
        view('intranet/alta_plato', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'procesado' => $procesado,
        ]);
    }

    public function altaPlatoProcesado(Request $request){
        $formulario = $request->input();   // NOOOOOO

        
        $this->altaPlato(true);
    }


}