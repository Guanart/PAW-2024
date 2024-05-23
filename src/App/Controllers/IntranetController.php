<?php

namespace Paw\App\Controllers;

use Exception;
use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\ProductoRepository;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Paw\Core\Exceptions\InvalidImageException;
use Paw\App\Validators\ImageValidator;

class IntranetController extends Controller {
    
    public ?string $repositoryName = ProductoRepository::class;
    public $repository;
    

    //public ?string $modelName = Producto::class;

    public function altaPlato($post = false, string $mensaje = "") {
        $title = "Alta plato";
        view('intranet/alta_plato', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'post' => $post,
            'mensaje' => $mensaje
        ]);
    }
    /* ESTO ME DIO: le damos formato antes?, asi se lee bien
    array(6) {
        ["name"]=> string(12) "estrella.png"
        ["full_path"]=> string(12) "estrella.png"
        ["type"]=> string(9) "image/png"
        ["tmp_name"]=> string(49) "C:\Users\FRANCISCO\AppData\Local\Temp\phpE875.tmp"
        ["error"]=> int(0)
        ["size"]=> int(449)
    }
    */
    
    public function altaPlatoProcesado(Request $request) {
        $data = $request->post();
        $img = $_FILES["imagen"];   // Esto se puede hacer mas lindo después
        
        if ($img["error"] === 0) {
            if ($request->hasBodyParams(["nombre", "descripcion", "precio"])
            && isset($img) && is_uploaded_file($img['tmp_name'])) {
                try {
                    // DUDA: cómo hago que sea una operación atómica? O sea, que si falla algo, no se haga nada
                    $data['path_img'] = $this->saveImage($img);
                    $plato = $this->repository->create($data);
                    $mensaje = "Su plato fue procesado y subido con éxito";
                } catch (InvalidImageException $e) {  // Esta seria la exception de la imagen
                    $mensaje = "La imágen no es válida. " .  $e->getMessage();
                } catch (InvalidValueFormatException $e) { // Esta la exception de cada campo
                    $mensaje = $e->getMessage();
                }
            } else {
                $mensaje = "Complete todos los campos";
            }
        } else {
            $mensaje = "Error al subir la imagen";
        }
        $this->altaPlato(true, $mensaje);
    }  

    private function saveImage(array $img): string
    {
        ImageValidator::validateImage($img);
        $path = $this->imagesDir . 'images/productos/' . uniqid() . '.' . pathinfo($img['name'], PATHINFO_EXTENSION);
        move_uploaded_file($img['tmp_name'], $path);
        return $path;
    }

    public function turnero() {
        $title = "Turnero";
        view('intranet/turnero', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title
        ]);
    }

    public function gestionPedidos() {
        $title = "Administrador de pedidos";
        view('intranet/gestion_pedidos', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title
        ]);
    }

    public function estadosPedidos() {
        $endpoint = __DIR__ . "/../views/intranet/get_estados.php";
        require $endpoint;
    }

}