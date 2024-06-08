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
    private $imagesProductosDir = 'productos/';
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
        $img = $request->file("imagen");
        
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
        $dir = $this->imagesDir . $this->imagesProductosDir;
        $fullDir = __DIR__ . '/../../../' . $dir;
        $realDir = realpath($fullDir);

        if (!$fullDir && !is_dir($realDir) && !mkdir($realDir)) {
            die("Error creating folder {$realDir}");
        }
        
        // El filename es "hamburguesa-S.png", donde S es el tamaño. Puede ser S, M o L. por lo tanto, guarda 3 veces la imagen, con distintos tamaños (3 archivos agregando -S, -M y -L al final del nombre del archivo)
        $filename = uniqid();
        $absolutePath = $realDir .'/'. $filename;
        
        $ok = move_uploaded_file($img['tmp_name'], $absolutePath);
        if ($ok) {
            for ($i = 0; $i < 3; $i++) {
                copy($absolutePath, $absolutePath . '-' . ['S', 'M', 'L'][$i] . '.' . pathinfo($img['name'], PATHINFO_EXTENSION));
            }
        }

        if ($ok) {
            return $filename;
        } else {
            throw new InvalidImageException("Error al subir la imagen");
        }
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