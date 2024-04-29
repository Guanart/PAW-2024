<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Producto extends Model {
    public $table = "producto";

    public $fields = [
        "nombre" => null,
        "descripcion" => null,
        "precio" => null
    ];

    public function setNombre(string $nombre) {
        if (strlen($nombre) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["nombre"] = $nombre;
    }

    public function setDescripcion(string $descripcion) {
        if (strlen($descripcion) > 60) {
            throw new InvalidValueFormatException("La descripción del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["descripcion"] = $descripcion;
    }

    public function setPrecio(float $precio) {
        if ($precio < 0.0) {
            throw new InvalidValueFormatException("El precio debe ser un número positivo");
        }
    }

    public function set(array $values) {
        foreach(array_keys($this->fields) as $field) {
            if (!isset($values[$field])) {
                continue;
            }
            $method = "set" . ucfirst($field);
            $this->$method($values[$field]);
        }
    }
}