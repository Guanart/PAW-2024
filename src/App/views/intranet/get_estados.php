<?php

use Paw\App\Models\PedidoLlevar;
use Paw\App\Models\PedidoDelivery;
use Paw\App\Models\PedidoMesa;

if (!isset($_GET['tipo'])) {
    echo json_encode(['error' => 'Se debe pasar un tipo de pedido']);
    exit;
}

$tipo = $_GET['tipo'];

if (!in_array($tipo, ["llevar", "delivery", "local"])) {
    echo json_encode(['error' => 'No es un tipo válido']);
    exit;
}

header('Content-Type: application/json');
if ($tipo === "llevar") {
    // echo json_encode(PedidoLlevar::getEstados());
    echo json_encode(["aceptado", "preparacion", "finalizado", "retirar", "entregado"]);
} else if ($tipo === "delivery") {
    // echo json_encode(PedidoDelivery::getEstados());
    echo json_encode(["aceptado", "preparacion", "finalizado", "despachado", "entregado"]);
} else {
    // echo json_encode(PedidoMesa::getEstados());
    echo json_encode(["aceptado", "preparacion", "finalizado", "retirar", "entregado"]);
}
?>
