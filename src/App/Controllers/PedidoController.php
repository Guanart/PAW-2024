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
use Paw\App\Repositories\PedidoDeliveryRepository;
use Paw\App\Repositories\PedidoLlevarRepository;
use Paw\App\Repositories\PedidoMesaRepository;
use Exception;

class PedidoController extends Controller
{
    private $twig;
    public $validator;
    public PedidoDeliveryRepository $pedidoDeliveryRepository;
    public PedidoLlevarRepository $pedidoLlevarRepository;
    public PedidoMesaRepository $pedidoMesaRepository;

    public function __construct(Environment $twig) {
        global $querybuilder;
        parent::__construct(PedidoRepository::class);
        $this->pedidoDeliveryRepository = new PedidoDeliveryRepository($querybuilder);
        $this->pedidoLlevarRepository = new PedidoLlevarRepository($querybuilder);
        $this->pedidoMesaRepository = new PedidoMesaRepository($querybuilder);
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
            redirect(getenv('APP_URL') . "/login");
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
                    "id_producto" => $plato,
                    "cantidad" => $cantidad
                ];
            }
        }
        if (count($pedido) == 0) {
            $mensaje = "No se seleccionó ningún plato!";
            $this->armarPedido($request, $mensaje);
        } else {
            $_SESSION["pedido"]["productos"] = $pedido;
            redirect("/confirmar_pedido"); 
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
            redirect(getenv('APP_URL') . "/login");
            exit();
        }
        
        $mensaje = "";
        try {
            $data = [
                "productos" => $_SESSION["pedido"]["productos"],
                "id_usuario" => $request->user()->getId(),
            ];
            switch ($_SESSION["pedido"]["tipo"]) {
                case 'mesa':
                    $pedido = $this->pedidoMesaRepository->create($data);
                    break;
                case 'delivery':
                    foreach ($_SESSION["pedido"]["direccion"] as $key => $value) {
                        $data[$key] = $value;
                    }
                    unset($data["direccion"]);
                    $pedido = $this->pedidoDeliveryRepository->create($data);
                    break;
                case 'llevar':
                    $data["localidad"] = $_SESSION["pedido"]["localidad"];
                    $pedido = $this->pedidoLlevarRepository->create($data);
                    break;
                default:
                    throw new InvalidValueFormatException("No se pudo determinar el tipo de pedido");
            }
            // if ($_SESSION["pedido"]["tipo"] === "mesa") {
            //     $pedido = $this->pedidoMesaRepository->create($data);
            // } elseif ($_SESSION["pedido"]["tipo"]==="delivery") {
            //     foreach ($_SESSION["pedido"]["direccion"] as $key => $value) {
            //         $data[$key] = $value;
            //     }
            //     $pedido = $this->pedidoDeliveryRepository->create($data);
            // } elseif ($_SESSION["pedido"]["tipo"]==="llevar") {
            //     $data["localidad"] = $_SESSION["pedido"]["localidad"];
            //     $pedido = $this->pedidoLlevarRepository->create($data);
            // }
            // redirect(getenv('APP_URL') . "/fin_pedido");
            // exit();
            redirect(getenv('APP_URL') . "/fin_pedido");
            exit();
        } catch (InvalidValueFormatException $e){
            // dd($e);die;
            $mensaje = $e->getMessage();
            $this->confirmarPedido($request, $mensaje);
        } catch (Exception $e) {
            // dd($e);die;
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
                redirect(getenv('APP_URL') . "/armar_pedido");
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
                redirect(getenv('APP_URL') . "/armar_pedido");
                exit();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> ingresarDireccion($request, $mensaje);
        }
    }

    public function finPedido(Request $request) {
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
            //this->armarPedido();
        } else {
            $mensaje = "No se encontraron los parámetros necesarios";
            $this-> seleccionarMesa(true, $mensaje);
        }
    }
}