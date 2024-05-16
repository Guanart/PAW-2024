<?php
$json_file = __DIR__ . '/../../pedidos.json';

$idPedido = isset($_GET['id']) ? $_GET['id'] : null;
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

header('Content-Type: application/json');
if ($idPedido === null) {
    echo json_encode($pedidos);
    exit;
} else {
    $pedidosFiltradosPorId = array_filter($pedidos, function($pedido) use ($idPedido) {
        return $pedido['id_pedido'] > $idPedido;
    });
    // Eliminar las claves numéricas
    $pedidosFiltradosPorId = array_values($pedidosFiltradosPorId);
    echo json_encode($pedidosFiltradosPorId);
    exit;
}
?>
