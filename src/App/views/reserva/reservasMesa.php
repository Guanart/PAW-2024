<?php
// Ruta del archivo JSON
$json_file = __DIR__ . '/../../reservasMesa.json';

// Obtener los parámetros de la URL
$idLocal = $_GET['idLocal'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

// Leer el contenido del archivo JSON
$json_data = file_get_contents($json_file);

if ($json_data === false) {
    echo json_encode(['error' => 'Error al leer el archivo de pedidos']);
    exit;
}

// Convertir el JSON en un array asociativo
$reservas = json_decode($json_data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Error al decodificar el archivo JSON']);
    exit;
}

// Inicializar un array para las mesas reservadas
$mesasReservadas = [];

// Recorrer los locales para encontrar el local correcto
foreach ($reservas['locales'] as $local) {
    if ($local['nombre'] === $idLocal) {
        // Recorrer los pisos del local
        foreach ($local['pisos'] as $piso) {
            // Recorrer las mesas del piso
            foreach ($piso['mesas'] as $mesa) {
                // Recorrer las reservas de la mesa
                foreach ($mesa['reservas'] as $reserva) {
                    // Verificar si la fecha y hora coinciden
                    $horaInicio = new DateTime($reserva['horaInicio']);
                    if ($horaInicio->format('Y-m-d') === $fecha && $horaInicio->format('H:i') === $hora) {
                        $mesasReservadas[] = [
                            'piso' => $piso['nombre'],
                            'mesa' => $mesa['numero']
                        ];
                    }
                }
            }
        }
    }
}

// Devolver el resultado como JSON
echo json_encode(['mesasReservadas' => $mesasReservadas]);