<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;
use DateTime;

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
        "hora" => null,
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
        // Capaz esto no funciona, para el input date del HTML creo que sí, para lo que viene de la BD no se
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha)) {
            throw new InvalidValueFormatException("Ingrese una fecha valida");
        }
        $this->fields["fecha"] = $fecha;
    }

    public function getHora(): ?string {
        return $this->fields["hora"];
    }

    public function setHora(string $hora) {
        dd(DateTime::createFromFormat('H:i:s', $hora . ":00"));
        $hora = DateTime::createFromFormat('H:i:s', $hora . ":00")->format('H:i:s');
        if (!in_array($hora, ["09:00:00", "10:30:00", "12:00:00", "13:30:00", "15:00:00", "16:30:00", "18:00:00", "19:30:00", "21:00:00", "22:30:00"])) {
            throw new InvalidValueFormatException("Ingrese una hora valida");
        }
        $this->fields["hora"] = $hora;
    }
    
    public function getHoraFinal(): ?string {
        return $this->fields["horaFinal"];
    }

    public function setHoraFinal(string $hora) {
        $this->fields["horaFinal"] = $hora;
    }
}