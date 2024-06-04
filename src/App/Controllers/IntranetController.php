<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\ProductoRepository;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Paw\Core\Exceptions\InvalidImageException;
use Paw\App\Validators\ImageValidator;
use Twig\Environment;

class IntranetController extends Controller {
    
    public $repository;
    private $twig;

    public function __construct(Environment $twig) {
        parent::__construct(ProductoRepository::class);
        $this->twig = $twig;
    }

    public function altaPlato($post = false, string $mensaje = "") {
        $productos = $this->repository->getAll();
        $producto_1 = $this->repository->getById(1);

        $title = "Alta plato";
        echo $this->twig->render('intranet/alta_plato.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'post' => $post,
            'mensaje' => $mensaje
        ]);
    }
    
    public function altaPlatoProcesado(Request $request) {
        $data = $request->post();
        $img = $_FILES["imagen"];   // Esto se puede hacer mas lindo después
        
        if ($img["error"] === 0) {
            if ($request->hasBodyParams(["nombre", "descripcion", "precio"])
            && isset($img) && is_uploaded_file($img['tmp_name'])) {
                try {
                    // DUDA: cómo hago que sea una operación atómica? O sea, que si falla algo, no se haga nada
                    $data['path_img'] = $this->saveImage($img);
                    unset($data['path_img']);    // TODO: DECIDIR COMO VAMOS A PERSISTIR LAS IMAGENES
                    $plato = $this->repository->create($data);
                    // var_dump($plato);die;
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
        echo $this->twig->render('intranet/turnero.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title
        ]);
    }

    public function gestionPedidos() {
        $title = "Administrador de pedidos";
        echo $this->twig->render('intranet/gestion_pedidos.view.twig', [
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