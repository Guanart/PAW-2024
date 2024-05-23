<?php
$json_file = __DIR__ . '/../../pedidos.json';

$idPedido = $_GET['id'];
$json_data = file_get_contents($json_file);
if ($json_data === false) {
    echo json_encode(['error' => 'Error al leer el archivo de pedidos']);
    exit;
}

$pedidos = json_decode($json_data, true);
if ($pedidos === null) {
    echo json_encode(['error' => 'Error al decodificar el archivo JSON']);
    exit;
}

$pedidoEncontrado = false;
$estado_pedido = null;
foreach ($pedidos as $pedido) {
    if ($pedido['id_pedido'] == $idPedido) {
        $estado_pedido = $pedido['estado'];
        $pedidoEncontrado = true;
        break;
    }
}
if (!$pedidoEncontrado) {
    echo json_encode(['error' => 'Pedido no encontrado']);
    exit;
}

header('Content-Type: application/json');
echo json_encode(['estado' => $estado_pedido]);
?>
