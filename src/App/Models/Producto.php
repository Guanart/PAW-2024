<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Producto extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    public $table = "producto";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public $fields = [
        "nombre" => null,
        "descripcion" => null,
        "precio" => null
    ];

    public function __construct(array $values) {
        $this->set($values);
    }

    /**
     * Set the nombre field of the model.
     *
     * @param string $nombre The nombre value to set.
     * @throws InvalidValueFormatException If the nombre value exceeds 60 characters.
     * @return void
     */
    public function setNombre(string $nombre) {
        if (strlen($nombre) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["nombre"] = $nombre;
    }

    /**
     * Set the descripcion field of the model.
     *
     * @param string $descripcion The descripcion value to set.
     * @throws InvalidValueFormatException If the descripcion value exceeds 60 characters.
     * @return void
     */
    public function setDescripcion(string $descripcion) {
        if (strlen($descripcion) > 60) {
            throw new InvalidValueFormatException("La descripción del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["descripcion"] = $descripcion;
    }

    /**
     * Set the precio field of the model.
     *
     * @param float $precio The precio value to set.
     * @throws InvalidValueFormatException If the precio value is negative.
     * @return void
     */
    public function setPrecio(float $precio) {
        if ($precio < 0.0) {
            throw new InvalidValueFormatException("El precio debe ser un número positivo");
        }
    }

    /**
     * Set multiple fields of the model using an associative array.
     *
     * @param array $values An associative array of field names and their values.
     * @return void
     */
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