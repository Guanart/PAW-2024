<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\Controller;
use Paw\Core\Request;
use Paw\App\Repositories\UsuarioRepository;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Twig\Environment;
use Paw\App\Models\Usuario;
use PDOException;

class UsuarioController extends Controller
{
    //public ?string $repositoryName = UsuarioRepository::class;
    public $repository;
    private $twig;

    public function __construct(Environment $twig) {
        parent::__construct(UsuarioRepository::class);
        $this->twig = $twig;
    }

    public function login($post = false, $mensaje = '') {
        $title = "Login";
        echo $this->twig->render('usuario/login.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'mensaje' => $mensaje,
            'post' => $post,
        ]);
    }

    public function cuenta() {
        $title = "Tu perfil";
        echo $this->twig->render('usuario/pagina_usuario.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            setcookie(session_name(), '', time() - 10000);
            session_destroy();
        }
        header("Location: ". getenv('APP_URL'));
        exit();
    }

    public function loginFormulario(Request $request) {
        $mensaje = "";
        if (!$request->hasBodyParams(["email", "password"])) {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this->login(true, $mensaje);
            return;
        }
        $values = $request->post();
        $password = trim($values["password"]);
        $email = trim($values["email"]);
        // $hash = password_hash($password, PASSWORD_DEFAULT);
        $hash = hash('sha256', $password);
        $usuario = $this->repository->getByEmail($email);
        if (!$usuario) {
            $mensaje = "No se encontro un usuario con ese mail";
            $this->login(true, $mensaje);
            return;
        }
        $passwordUser = $usuario->getPassword();
        if ($passwordUser !== $hash) {
            $mensaje = "La contraseña es incorrecta";
            $this->login(true, $mensaje);
            return;
        }
        $_SESSION["username"] = $usuario->getUsername();
        header("Location: ". getenv('APP_URL'));
        exit();
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
        if ($request->hasBodyParams(["nombre", "apellido", "email" ,"username","password","repeatPassword"])) {
            $values = $request->post();
            $pass1 = trim($values["password"]);
            $pass2 = trim($values["repeatPassword"]);
            if (strlen($pass1) < 8) {
                $mensaje = "La contraseña debe tener 8 caracteres como mínimo";
            } else if ($pass1 !== $pass2) {
                $mensaje = "Las contraseñas no coinciden";
            }
            else {
                try {
                    //$hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $hash = hash('sha256', $pass1);
                    $data = array(
                        "nombre" => $values["nombre"],
                        "apellido" => $values["apellido"],
                        "username" => $values["username"],
                        "email" => $values["email"],
                        "role" => "user",
                        "password" => $hash,
                    );
                    $usuario = $this->repository->create($data);
                    $mensaje = "Su usuario fue procesado y subido con éxito";
                    $this->usuarioRegistrado();
                    return;
                } catch (InvalidValueFormatException $e) {
                    $mensaje = $e->getMessage();  // Hay que manejar una exception específica nuestra
                } catch (PDOException $e) {
                    if ($e->getCode() == '23505') { // Código de error para violación de restricción única
                        $errorInfo = $e->errorInfo;
                        $detailMessage = $errorInfo[2]; // Detalle del error
                        if (strpos($detailMessage, 'usuario_username') !== false) {
                            $mensaje = "El nombre de usuario ya está en uso";
                        } else {
                            $mensaje = "El correo electrónico ya está en uso";
                        }
                    }
                }
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

    public function usuarioRegistrado() {
        $title = "Usuario Registrado";
        echo $this->twig->render('usuario/usuario_registrado.view.twig', [
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