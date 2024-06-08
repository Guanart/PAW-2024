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
use Paw\App\Repositories\ProductoRepository;
use Exception;

class PedidoController extends Controller
{
    private $twig;
    public $validator;
    public PedidoDeliveryRepository $pedidoDeliveryRepository;
    public PedidoLlevarRepository $pedidoLlevarRepository;
    public PedidoMesaRepository $pedidoMesaRepository;
    public ProductoRepository $productoRepository;

    public function __construct(Environment $twig) {
        global $querybuilder;
        parent::__construct(PedidoRepository::class);
        $this->pedidoDeliveryRepository = new PedidoDeliveryRepository($querybuilder);
        $this->pedidoLlevarRepository = new PedidoLlevarRepository($querybuilder);
        $this->pedidoMesaRepository = new PedidoMesaRepository($querybuilder);
        $this->productoRepository = new ProductoRepository($querybuilder);
        $this->twig = $twig;
        $this->validator = new InputValidator();
        
    }

    public function pedidos(Request $request) {
        if (!isset($_SESSION["username"])) {
            $_SESSION["loopback"] = "/tus_pedidos";
            redirect(getenv('APP_URL') . "/login");
            exit();
        }
        $_SESSION["pedido"]["productos"] = $pedido;
        
        //$this->productoRepository-;
        $title = "Tus pedidos";
        $id_usuario = $request->user()->getId();
        $pedidos_usuario = $this->repository->getByIdUsuario($id_usuario);


        echo $this->twig->render('pedido/tus_pedidos.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'pedidos_usuario' => $pedidos_usuario
        ]);
    }

    public function estadoPedido(Request $request) {
        $idPedido = intval($request->get("id"));
        if (!$idPedido) {
            echo json_encode(['error' => 'Debe enviar un ID para consultar el estado del pedido']);
            exit;
        }
        $estado = $this->repository->getEstadoById($idPedido);
        if (!$estado) {
            echo json_encode(['error' => 'No se encontró un pedido con ese ID']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['estado' => $estado]);
    }

    public function actualizarEstadoPedido() {
        $endpoint = __DIR__ . "/../views/pedido/actualizar_estado_pedido.php";
        require $endpoint;
    }

    public function estadosPedidos(Request $request) {
        $tipo = $request->get("tipo");
        if (!$tipo) {
            echo json_encode(['error' => 'Se debe pasar un tipo de pedido']);
            exit;
        }
        header('Content-Type: application/json');
        if ($tipo == "llevar") {
            echo json_encode(PedidoLlevar::getEstados());
        } else if ($tipo == "delivery") {
            echo json_encode(PedidoDelivery::getEstados());
        } else if ($tipo == "mesa"){
            echo json_encode(PedidoMesa::getEstados());
        } else {
            echo json_encode(['error' => 'No es un tipo válido']);
        }
    }
    
    public function getPedidosId(Request $request) {
        header('Content-Type: application/json');
        $idPedido = $request->get('id');
        if ($idPedido === null) {
            $pedidos = $this->repository->getAll();
            
        } else if (is_numeric($idPedido)){
            $pedido = $this->repository->getById($idPedido);
            if ($pedido) {
                $pedidoToArray = $pedido->toArray();
                echo json_encode($pedidoToArray);
            }
        }
        exit;
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
            "mensaje" => $mensaje,
            "productos" => $this->productoRepository->getAll()
        ];

        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }

        echo $this->twig->render('pedido/armar_pedido.view.twig', $variables);
    }

    public function armarPedidoFormulario(Request $request){
        $mensaje = "";
        $formularioDatos = $request->post();
        // dd($formularioDatos);die;
        $pedido = [];
        foreach($formularioDatos as $plato => $cantidad) {
            if (is_numeric($cantidad) && $cantidad > 0) {
                $pedido[] = [
                    "id_producto" => $plato,
                    "cantidad" => intval($cantidad)
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

    public function confirmarPedido(Request $request, string $mensaje = "") {
        if (!isset($_SESSION["pedido"]["productos"])) {
            redirect(getenv('APP_URL'));
            exit();
        }
    
        $productos = $_SESSION["pedido"]["productos"];
    
        $productosPedido = [];
        foreach($productos as $productoCantidad) {
            $modelProducto = $this->productoRepository->getById($productoCantidad["id_producto"]);
            $productosPedido[] = [
                'producto' => $modelProducto,
                'cantidad' => intval($productoCantidad["cantidad"])
            ];
        }
    
        $title = "Confirmar Pedido";
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'mensaje' => $mensaje,
            'productos_pedido' => $productosPedido
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
                "fecha" => date("Y-m-d")
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
            unset($_SESSION["pedido"]);
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