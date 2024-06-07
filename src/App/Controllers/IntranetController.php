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
                    $data['path_img'] = $this->saveImage($img);
                    $plato = $this->repository->create($data);
                    $mensaje = "Su plato fue procesado y subido con éxito";
                } catch (InvalidImageException $e) {  // Esta seria la exception de la imagen
                    $mensaje = "La imágen no es válida. " .  $e->getMessage();
                } catch (InvalidValueFormatException $e) { // Esta la exception de cada campo
                    $mensaje = $e->getMessage();
                } catch (Exception $e) { // En caso de cualquier otra excepción
                    // Eliminar la imagen si se había subido
                    if (isset($data['path_img']) && file_exists($data['path_img'])) {
                        unlink($data['path_img']);
                    }
                    $mensaje = "Ocurrió un error al procesar su solicitud. " . $e->getMessage();
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

}