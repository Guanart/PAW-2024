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
    static public string $table = "usuario";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public array $fields = [
        "id" => null,
        "nombre" => null,
        "apellido" => null,
        "username" => null,
        "email" => null,
        "password" => null,
        "role" => null,
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
        $nombreTrim = trim($nombre);
        if (strlen($nombreTrim) > 60) {
            throw new InvalidValueFormatException("El nombre del usuario no debe ser mayor a 60 caracteres");
        }
        if (strlen($nombreTrim) < 1 ) {
            throw new InvalidValueFormatException("El nombre del usuario no debe estar vacío");
        }
        $this->fields["nombre"] = $nombreTrim;
    }
    public function getNombre(): ?string
    {
        return $this->fields["nombre"];
    }
    
    /**
     * Set the descripcion field of the model.
     *
     * @param string $descripcion The descripcion value to set.
     * @throws InvalidValueFormatException If the descripcion value exceeds 60 characters.
     * @return void
     */
    public function setApellido(string $apellido) {
        $apellidoTrim = trim($apellido);
        if (strlen($apellido) > 60) {
            throw new InvalidValueFormatException("El apellido del usuario no debe ser mayor a 60 caracteres");
        }
        if (strlen($apellidoTrim) < 1 ) {
            throw new InvalidValueFormatException("El apellido del usuario no debe estar vacío");
        }
        $this->fields["apellido"] = $apellidoTrim;
    }
    public function getApellido(): ?string
    {
        return $this->fields["apellido"];
    }
    
    /**
     * Set the precio field of the model.
     *
     * @param float $precio The precio value to set.
     * @throws InvalidValueFormatException If the precio value is negative.
     * @return void
     */
    public function setUsername(string $username) {
        $usernameTrim = trim($username);
        if (strlen($usernameTrim) > 60) {
            throw new InvalidValueFormatException("El nombre visible de usuario no debe ser mayor a 60 caracteres");
        }
        if (strlen($usernameTrim) < 1 ) {
            throw new InvalidValueFormatException("El nombre de usuario no debe estar vacío");
        }
        $this->fields["username"] = $usernameTrim;
    }
    public function getUsername(): ?string
    {
        return $this->fields["username"];
    }

    public function setEmail(string $email) {
        $emailTrim = trim($email);
        if (!filter_var($emailTrim, FILTER_VALIDATE_EMAIL)) {   // Esto se debe hacer en el modelo?
            throw new InvalidValueFormatException("El email no es válido");
        }
        if (strlen($emailTrim) > 30) {
            throw new InvalidValueFormatException("El email no debe ser mayor a 30 caracteres");
        }
        if (strlen($emailTrim) < 1 ) {
            throw new InvalidValueFormatException("El email no debe estar vacío");
        }
        $this->fields["email"] = $emailTrim;
    }
    public function getEmail(): ?string
    {
        return $this->fields["email"];
    }

    public function setPassword(string $password) {
        $passwordTrim = trim($password);
        /*
        if (strlen($passwordTrim) < 8) {
            throw new InvalidValueFormatException("La contraseña debe tener al menos 8 caracteres");
        }
        else if (strlen($passwordTrim) > 100) {
            throw new InvalidValueFormatException("La contraseña no debe ser mayor a 100 caracteres");
        }
        */ 
        $this->fields["password"] = $passwordTrim;
    }
    public function getPassword(): ?string
    {
        return $this->fields["password"];
    }

    public function setId(int $id) {
        $this->fields["id"] = $id;
    }
    public function getId(): ?int
    {
        return $this->fields["id"];
    }

    public function setRole(string $role) {
        $this->fields["role"] = $role;
    }
    public function getRole(): ?string
    {
        return $this->fields["role"];
    }
}