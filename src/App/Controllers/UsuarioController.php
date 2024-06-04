<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\UsuarioRepository;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Twig\Environment;

class UsuarioController extends Controller
{
    public ?string $repositoryName = UsuarioRepository::class;
    public $repository;
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function login() {
        $title = "Login";
        echo $this->twig->render('usuario/login.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function register($post = false, $mensaje = '') {
        $title = "Register";
        echo $this->twig->render('usuario/register.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'post' => $post,
            'mensaje' => $mensaje,
        ]);
    }

    public function registerFormulario(Request $request) {
        $mensaje = "";
        if ($request->hasBodyParams(["nombre", "apellido", "username","password","repeatPassword"])) {
            try {
                $usuario = $this->repository->create($request->post());
                $mensaje = "Su usuario fue procesado y subido con éxito";
                //$plato = new Producto($request->post());
            } catch (InvalidValueFormatException $e) {
                $mensaje = $e->getMessage();  // Hay que manejar una exception específica nuestra
            }
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
        }
        $this->register(true, $mensaje);
    }

    public function forgotPassword() {
        $title = "forgotPassword";
        echo $this->twig->render('usuario/forgot-password.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function verificationCode(){
        $title = "verificationCode";
        echo $this->twig->render('usuario/verification-code.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
}