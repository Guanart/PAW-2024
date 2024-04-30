<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Pedido extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public $table = "pedido";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public $fields = [];

    public $direccion = [];

    public $productos = [];

    public function __construct(array $values, array $directions, array $products) {
        $this->direccion = [
            "Localidad" => null,
            "altura" => null,
            "departamento" => null,
            "calle" => null,
            "descripcion" => null
        ];
        $this->fields = [
            "local" => null,
            "mesa" => null,
        ];
        $this->productos = $products;
        $this->set($directions);
        $this->set($values);
    }

    /**
     * Set the nombre field of the model.
     *
     * @param string $nombre The nombre value to set.
     * @throws InvalidValueFormatException If the nombre value exceeds 60 characters.
     * @return void
     */
    public function setLocalidad(string $localidad) {
        if (strlen($localidad) > 80) {
            throw new InvalidValueFormatException("El nombre de la localidad no debe ser mayor a 80 caracteres");
        }
        $this->direccion["localidad"] = $localidad;
    }
    public function setAltura(int $altura) {
        if ($altura < 0) {
            throw new InvalidValueFormatException("La altura debe ser mayor o igual a 0");
        }
        $this->direccion["altura"] = $altura;
    }
    public function setDepartamento(int $departamento) {
        if ($departamento > 0) {
            throw new InvalidValueFormatException("El departamento debe ser mayor a 0");
        }
        $this->direccion["departamento"] = $departamento;
    }
    public function setDescripcion(string $descripcion) {
        if (strlen($descripcion) > 260) {
            throw new InvalidValueFormatException("La descripcion no debe ser mayor a 260 caracteres");
        }
        $this->direccion["descripcion"] = $descripcion;
    }
    public function setDireccion(array $direccionArr) {
        if ($direccionArr > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["direccion"] = $direccionArr;
    }
    public function setCalle(string $calle) {
        if (strlen($calle) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->direccion["calle"] = $calle;
    }
    public function setLocal(string $local) {
        // if (strlen($local) > 60) {
        //     throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        // }
        $this->fields["local"] = $local;
    }
    public function setMesa(string $mesa) {
        if (strlen($mesa) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["mesa"] = $mesa;
    }
}