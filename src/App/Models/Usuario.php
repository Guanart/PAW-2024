<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Usuario extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public $table = "usuario";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public $fields = [
        "nombre" => null,
        "apellido" => null,
        "username" => null,
        "email" => null,
        "password" => null,
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
            throw new InvalidValueFormatException("El nombre del usuario no debe ser mayor a 60 caracteres");
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
    public function setApellido(string $apellido) {
        if (strlen($apellido) > 60) {
            throw new InvalidValueFormatException("El apellido del usuario no debe ser mayor a 60 caracteres");
        }
        $this->fields["descripcion"] = $apellido;
    }

    /**
     * Set the precio field of the model.
     *
     * @param float $precio The precio value to set.
     * @throws InvalidValueFormatException If the precio value is negative.
     * @return void
     */
    public function setUsername(string $username) {
        if (strlen($username) > 60) {
            throw new InvalidValueFormatException("El nombre visible de usuario no debe ser mayor a 60 caracteres");
        }
    }

    public function setPassword(string $password) {
        if (strlen($password) < 8) {
            throw new InvalidValueFormatException("La contraseña debe tener al menos 8 caracteres");
        }
        else if (strlen($password) > 60) {
            throw new InvalidValueFormatException("La contraseña no debe ser mayor a 60 caracteres");
        }
    }
}