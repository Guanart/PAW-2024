<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;
use DateTime;
use DateTimeZone;

class Reserva extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public string $table = "reserva";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public array $fields = [
        "id" => null,
        "id_usuario" => null,
        "local" => null,
        "mesa" => null,
        "fecha" => null,
    ];

    public function __construct(array $values) {
        $this->set($values);
    }

    public function setId_usuario(int $id) {
        $this->fields["id_usuario"] = $id;
    }
    public function getId_usuario() {
        return $this->fields["id_usuario"];
    }

    public function setId(int $id) {
        $this->fields["id"] = $id;
    }
    public function getId() {
        return $this->fields["id"];
    }
    
    public function setLocal(string $local) {
        if (strlen($local) > 20) {
            throw new InvalidValueFormatException("El nombre del local no debe ser mayor a 20 caracteres");
        }
        if (strlen($local) < 1) {
            throw new InvalidValueFormatException("El nombre del local no debe ser vacío");
        }
        $this->fields["local"] = $local;
    }

    public function getLocal(): ?string {
        return $this->fields["local"];
    } 
    

    public function setMesa(string $mesa_id) {
        if (!$mesa_id) {
            throw new InvalidValueFormatException("Debe seleccionar una mesa");
        }
        $this->fields["mesa"] = $mesa_id;
    }
    public function getMesa(): ?string {
        return $this->fields["mesa"];
    }

    public function getFecha(): ?string {
        return $this->fields["fecha"];
    }

    public function setFecha(string $fecha) {

        $timezoneArgentina = new DateTimeZone('America/Argentina/Buenos_Aires');
        $dateTimeNow = new DateTime('now', $timezoneArgentina);

        if ($fecha < $dateTimeNow->format('Y-m-d H:i:s')) {
            throw new InvalidValueFormatException("La fecha y hora proporcionada es anterior a la actual.");
        }

        $dateTime = new DateTime("{$fecha}");
        $hora = $dateTime->format('H:i');
        $validHours = ['09:00', '10:30', '12:00', '13:30', '15:00', '16:30', '18:00', '19:30', '21:00', '22:30'];
        if (!in_array($hora, $validHours)) {
            throw new InvalidValueFormatException("Ese horario no está disponible, seleccione un horario válido.");
        } 
        
        $this->fields["fecha"] = $fecha;
    }
}