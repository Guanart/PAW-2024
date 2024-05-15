<?php
$json_file = __DIR__ . '/../../pedidos.json';

// ID del pedido recibido como parámetro en la URL
$idPedido = $_GET['id'];

// Leer el contenido del archivo JSON
$json_data = file_get_contents($json_file);

if ($json_data === false) {
    echo json_encode(['error' => 'Error al leer el archivo de pedidos']);
    exit;
}

// Decodificar el JSON a un array asociativo
$pedidos = json_decode($json_data, true);

if ($pedidos === null) {
    echo json_encode(['error' => 'Error al decodificar el archivo JSON']);
    exit;
}

// Buscar el pedido con el ID proporcionado
$pedidoEncontrado = false;
$estado_pedido = null;
foreach ($pedidos as $pedido) {
    if ($pedido['id_pedido'] == $idPedido) {
        $estado_pedido = $pedido['estado'];
        $pedidoEncontrado = true;
        break;
    }
}

// Verificar si se encontró el pedido
if (!$pedidoEncontrado) {
    echo json_encode(['error' => 'Pedido no encontrado']);
    exit;
}

header('Content-Type: application/json');
echo json_encode(['estado' => $estado_pedido]);
?>
