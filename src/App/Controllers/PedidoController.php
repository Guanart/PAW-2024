<?php

namespace Paw\App\Controllers;

use Paw\Core\Request;
use Twig\Environment;
use Paw\App\Models\PedidoLlevar;
use Paw\App\Models\PedidoDelivery;
use Paw\App\Repositories\PedidoRepository;
use Paw\App\Models\PedidoMesa;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Paw\App\Validators\InputValidator;
use Exception;

class PedidoController extends Controller
{
    private $twig;
    public $validator;
    public $userRepository;

    public function __construct(Environment $twig) {
        parent::__construct(PedidoRepository::class);
        $this->twig = $twig;
        $this->validator = new InputValidator();
    }

    public function pedidos() {
        $title = "Tus pedidos";

        /*
        $id_usuario = "123"; 
        $pedidos = json_decode(file_get_contents(__DIR__ . '/../pedidos.json'), true);   // Recuperar de la base de datos
        $pedidos_usuario = array_filter($pedidos, function ($pedido) use ($id_usuario) {
            return $pedido["id_usuario"] === $id_usuario && $pedido["estado"] !== "entregado";
        });
        */
        if (!isset($_SESSION["username"])) {
            $_SESSION["loopback"] = "/tus_pedidos";
            header("Location: ". getenv('APP_URL') . "/login");
            exit();
        }
        $username = $_SESSION["username"];
        //$usuario = $this->userRepository->getByUsername($username);
        
        

        echo $this->twig->render('pedido/tus_pedidos.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'pedidos_usuario' => $pedidos_usuario
        ]);
    }

    public function estadoPedido() {
        $endpoint = __DIR__ . "/../views/pedido/estado_pedido.php";
        require $endpoint;
    }

    public function actualizarEstadoPedido() {
        $endpoint = __DIR__ . "/../views/pedido/actualizar_estado_pedido.php";
        require $endpoint;
    }
    
    public function getPedidosId() {
        $endpoint = __DIR__ . "/../views/pedido/get_pedidos.php";
        require $endpoint;
    }

    public function hacerPedido() {
        $title = "Hacer Pedido";
        echo $this->twig->render('pedido/hacer_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title
        ]);
    }

    public function armarPedido(Request $request, $mensaje="") {
        $title = "Armar Pedido";
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mensaje" => $mensaje
        ];
        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }
        echo $this->twig->render('pedido/armar_pedido.view.twig', $variables);
    }

    public function armarPedidoFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = $request->post();
        $pedido = [];
        foreach($formularioDatos as $plato => $cantidad) {
            if (is_numeric($cantidad) && $cantidad > 0) {
                $pedido[] = [
                    "plato" => $plato,
                    "cantidad" => $cantidad
                ];
            }
        }
        if (count($pedido) == 0) {
            $mensaje = "No se seleccionó ningún plato!";
            $this->armarPedido($request, $mensaje);
        } else {
            $_SESSION["pedido"]["productos"] = $pedido;
            header("Location: /confirmar_pedido"); 
        }
    }

    public function confirmarPedido(Request $request, string $mensaje =""){
        $title = "Confirmar Pedido";
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mensaje" => $mensaje
        ];
        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }
        echo $this->twig->render('pedido/confirmar_pedido.view.twig', $variables);
    }

    public function confirmarPedidoFormulario(Request $request) {
        if (!isset($_SESSION["username"])) {
            $_SESSION["loopback"] = "/confirmar_pedido";
            header("Location: ". getenv('APP_URL') . "/login");
            exit();
        }
        $formularioDatos = null;
        $mensaje = "";
        $formularioDatos = $request->post();
        try {
            $data = [
                "productos" => $_SESSION["pedido"]["productos"],
                "username" => $_SESSION["username"],
            ];
            if ($_SESSION["pedido"]["tipo"] === "mesa") {

            } elseif ($_SESSION["pedido"]["tipo"]==="delivery") {
                foreach ($_SESSION["pedido"]["direccion"] as $key => $value) {
                    $data[$key] = $value;
                }
                $pedidoMesa = new PedidoDelivery($data);
            } elseif ($_SESSION["pedido"]["tipo"]==="llevar") {
                $data["local"] = $_SESSION["pedido"]["localidad"];
            }
            // Guardar el pedido, que repository usar, porque tenemos 3 tipos de pedido ??????????
            $usuario = $this->repository->create($data);
            header("Location: ". getenv('APP_URL') . "/fin_pedido");
            exit();
        } catch (InvalidValueFormatException $e){
            $mensaje = $e->getMessage();
            $this->confirmarPedido($request, $mensaje);
        }
    }

    public function elegirLocal(Request $request, string $mensaje = "") {
        $title = "Elegir Local";
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mensaje" => $mensaje
        ];
        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }
        echo $this->twig->render('pedido/elegir_local.view.twig', $variables);
    }

    public function elegirLocalFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        if ($request->hasBodyParams(["localidad"])) {
            try {
                $formularioDatos = $request->post();
                $_SESSION["pedido"]["tipo"] = "llevar";
                $_SESSION["pedido"]["localidad"] = $formularioDatos["localidad"];
                header("Location: ". getenv('APP_URL') . "/armar_pedido");
                exit();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> elegirLocal($request, $mensaje);
        }
    }

    public function ingresarDireccion(Request $request, string $mensaje =""){
        $title = "Ingresar Direccion";
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mensaje" => $mensaje
        ];
        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }
        echo $this->twig->render('pedido/ingresar_direccion.view.twig', $variables);
    }

    public function ingresarDireccionFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        $tipo = "pedido";
        if ($request->hasBodyParams(["localidad", "calle", "altura"])) {
            try {
                $formularioDatos = $request->post();
                # Reemplazar luego por foreach
                $_SESSION["pedido"]["tipo"] = "delivery";
                $_SESSION["pedido"]["direccion"]["localidad"] = $this->validator->sanitizeInput($formularioDatos["localidad"]);
                $_SESSION["pedido"]["direccion"]["calle"] = $this->validator->sanitizeInput($formularioDatos["calle"]);
                $_SESSION["pedido"]["direccion"]["altura"] = $this->validator->sanitizeInput($formularioDatos["altura"]);
                $_SESSION["pedido"]["direccion"]["departamento"] = $this->validator->sanitizeInput($formularioDatos["departamento"]);
                $_SESSION["pedido"]["direccion"]["descripcion"] = $this->validator->sanitizeInput($formularioDatos["descripcion"]);
                header("Location: ". getenv('APP_URL') . "/armar_pedido");
                exit();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> ingresarDireccion($request, $mensaje);
        }
    }

    public function finPedido(Array $formularioDatos){
        $title = "Fin de Pedido";
        echo $this->twig->render('pedido/mensaje_fin_pedido.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title
        ]);
    }
    
    public function seleccionarMesa($mostrarPost = false, string $mensaje =""){
        $title = "Seleccionar Mesa";
        echo $this->twig->render('pedido/seleccion_mesa_qr.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            "mostrarPost" => $mostrarPost,
            "mensaje" => $mensaje
        ]);
    }

    public function seleccionarMesaFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = null;
        if ($request->hasBodyParams(["mesa"])) {
            try {
                $mensaje = "";
                $formularioDatos = $request->post();
                $_SESSION["pedido"]["tipo"] = "mesa";
                $_SESSION["pedido"]["mesa"] = $this->validator->sanitizeInput($formularioDatos["mesa"]);
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            $this->armarPedido();
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> seleccionarMesa(true, $mensaje);
        }
    }
}