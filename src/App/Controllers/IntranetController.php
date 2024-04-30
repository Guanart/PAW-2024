<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\ProductoRepository;
use Paw\Core\Exceptions\InvalidValueFormatException;

class IntranetController extends Controller {
    
    public ?string $repositoryName = ProductoRepository::class;
    public $repository;
    

    //public ?string $modelName = Producto::class;

    public function altaPlato($post = false, string $mensaje = "") {
        $title = "Contactos";
        view('intranet/alta_plato', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'post' => $post,
            'mensaje' => $mensaje
        ]);
    }

    public function altaPlatoProcesado(Request $request) {
        $mensaje = "";
        if ($request->hasBodyParams(["nombre", "descripcion", "precio"])) {
            try {
                $plato = $this->repository->create($request->post());
                $mensaje = "Su plato fue procesado y subido con éxito";
                //$plato = new Producto($request->post());
            } catch (InvalidValueFormatException $e) {
                $mensaje = $e->getMessage();  // Hay que manejar una exception específica nuestra
            }
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
        }
        $this->altaPlato(true, $mensaje);
    }
}