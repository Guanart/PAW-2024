<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\ProductoRepository;

use Exception;

class IntranetController extends Controller {
    public ?string $repositoryName = ProductoRepository::class;
    public $repository;

    public function altaPlato($procesado = false) {
        $title = "Contactos";
        view('intranet/alta_plato', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'procesado' => $procesado,
        ]);
    }

    public function altaPlatoProcesado(Request $request) {
        if ($request->hasBodyParams(["nombre", "descripcion", "precio"])) {
            try {
                $plato = $this->repository->create($request->post());
                $this->altaPlato(true);
            } catch (Exception $e) {
                // Mensaje a la vista
            }
        } else {
            // Mensaje a la vista
        }
    }
}