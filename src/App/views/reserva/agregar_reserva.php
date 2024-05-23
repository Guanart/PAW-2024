<?php
$json_file = __DIR__ . '/../../reservasMesa.json';

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Método no permitido
    echo json_encode(['error' => 'Método no permitido. Usa POST.']);
    exit;
}

// Obtener los datos del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);
$idMesa = $input['id'] ?? null;
$fechaHora = $input['fechaHora'] ?? null;
$idLocal = $input['idLocal'] ?? null;
//$nuevoEstado = $input['estado'] ?? null;

if ($idMesa === null || $fechaHora === null || $idLocal === null) {
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['error' => 'ID de mesa u hora de reserva no proporcionados']);
    exit;
}

$json_data = file_get_contents($json_file);
if ($json_data === false) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al leer el archivo de pedidos']);
    exit;
}