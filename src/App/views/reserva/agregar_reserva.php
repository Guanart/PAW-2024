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
$idMesa = $input['idMesa'] ?? null;
$fecha = $input['fecha'] ?? null;
$hora = $input['hora'] ?? null;
$idLocal = strtolower($input['idLocal']) ?? null;

if ($idMesa === null || $fecha === null || $hora === null || $idLocal === null) {
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['error' => 'ID de mesa, local, fecha u hora no proporcionados']);
    exit;
}

try {
    $dateTimeString = $fecha . 'T' . $hora . ':00';
    $fechaHora = new DateTime($dateTimeString);
    $horaInicio = $fechaHora->format('Y-m-d\TH:i:s'); // Formato ISO 8601
    // Calcular la hora de fin según tu lógica. Aquí se asume una duración de 1.5 horas.
    $fechaHora->modify('+1 hour 30 minutes');
    $horaFin = $fechaHora->format('Y-m-d\TH:i:s');
} catch (Exception $e) {
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['error' => 'Formato de fecha y hora inválido']);
    exit;
}

// Leer el archivo JSON
$json_data = file_get_contents($json_file);
if ($json_data === false) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al leer el archivo de reservas']);
    exit;
}

$data = json_decode($json_data, true);
if ($data === null) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al decodificar el archivo de reservas']);
    exit;
}

// Buscar el local y la mesa correspondientes
$localEncontrado = false;
$mesaEncontrada = false;

foreach ($data['locales'] as &$local) {
    if (strtolower($local['nombre']) === $idLocal) {
        $localEncontrado = true;
        foreach ($local['pisos'] as &$piso) {
            foreach ($piso['mesas'] as &$mesa) {
                if ($mesa['numero'] === $idMesa) {
                    $mesaEncontrada = true;
                    // Agregar la reserva
                    $mesa['reservas'][] = [
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin
                    ];
                    break 3; // Salir de los tres bucles
                }
            }
        }
    }
}

if (!$localEncontrado) {
    http_response_code(404); // No encontrado
    echo json_encode(['error' => 'Local no encontrado']);
    exit;
}

if (!$mesaEncontrada) {
    http_response_code(404); // No encontrado
    echo json_encode(['error' => 'Mesa no encontrada']);
    exit;
}

// Guardar el archivo JSON actualizado
$new_json_data = json_encode($data, JSON_PRETTY_PRINT);
if (file_put_contents($json_file, $new_json_data) === false) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al guardar el archivo de reservas']);
    exit;
}

http_response_code(200); // Éxito
echo json_encode(['message' => 'Reserva agregada exitosamente']);
?>
