<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\App\Models\Producto;
use Paw\Core\Request;
use Paw\App\Validators\ImageValidator;

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
        $data = $request->post();
        // var_dump($data['imagen']);
        // var_dump($_FILES);
        // Validar que el campo imagen sea una imagen
        if (isset($data['imagen']) && is_uploaded_file($data['imagen']['tmp_name'])) {
            $imagen = $data['imagen'];
            if (ImageValidator::validateImage($imagen)) {
                $path = 'img/' . uniqid() . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
                move_uploaded_file($imagen['tmp_name'], $path);
                $data['path_img'] = $path;
            } else {
                $this->altaPlato(false);
                return;
            }
        }
        $plato = new Producto();
        $plato->set($data);
        $this->altaPlato(true);
    }
}