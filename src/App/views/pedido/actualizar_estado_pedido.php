<?php
$json_file = __DIR__ . '/../../pedidos.json';

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Método no permitido
    echo json_encode(['error' => 'Método no permitido. Usa POST.']);
    exit;
}

// Obtener los datos del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);
$idPedido = $input['id'] ?? null;
$nuevoEstado = $input['estado'] ?? null;

if ($idPedido === null || $nuevoEstado === null) {
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['error' => 'ID de pedido o nuevo estado no proporcionado']);
    exit;
}

$json_data = file_get_contents($json_file);
if ($json_data === false) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al leer el archivo de pedidos']);
    exit;
}

$pedidos = json_decode($json_data, true);
if ($pedidos === null) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al decodificar el archivo JSON']);
    exit;
}

$pedidoEncontrado = false;
foreach ($pedidos as &$pedido) { // Usar referencia para modificar directamente el array
    if ($pedido['id_pedido'] == $idPedido) {
        $pedido['estado'] = $nuevoEstado;
        $pedidoEncontrado = true;
        break;
    }
}

if (!$pedidoEncontrado) {
    http_response_code(404); // No encontrado
    echo json_encode(['error' => 'Pedido no encontrado']);
    exit;
}

// Guardar el JSON actualizado
if (file_put_contents($json_file, json_encode($pedidos, JSON_PRETTY_PRINT)) === false) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al guardar el archivo de pedidos']);
    exit;
}

// Solicitud exitosa
header('Content-Type: application/json');
echo json_encode(['success' => 'Estado del pedido actualizado']);

?>