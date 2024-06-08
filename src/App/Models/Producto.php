<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Producto extends Model
{
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public string $table = "producto";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public array $fields = [
        "nombre" => null,
        "precio" => null,
        "descripcion" => null,
        "path_img" => null,
    ];

    public function __construct(array $values)
    {
        $this->set($values);
    }

    /**
     * Set the path_img field of the model.
     *
     * @param string $path_img The path_img value to set.
     * @return void
     */
    public function setPath_img(string $path_img)
    {
        $this->fields["path_img"] = $path_img;
    }

    /**
     * Get the path_img field of the model.
     *
     * @return string|null
     */
    public function getPath_img(): ?string
    {
        return $this->fields["path_img"];
    }

    /**
     * Set the nombre field of the model.
     *
     * @param string $nombre The nombre value to set.
     * @throws InvalidValueFormatException If the nombre value exceeds 60 characters.
     * @return void
     */
    public function setNombre(string $nombre)
    {
        if (strlen($nombre) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["nombre"] = $nombre;
    }

    /**
     * Get the nombre field of the model.
     *
     * @return string|null
     */
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
    public function setDescripcion(string $descripcion)
    {
        if (strlen($descripcion) > 256) {
            throw new InvalidValueFormatException("La descripción del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["descripcion"] = $descripcion;
    }

    /**
     * Get the descripcion field of the model.
     *
     * @return string|null
     */
    public function getDescripcion(): ?string
    {
        return $this->fields["descripcion"];
    }

    /**
     * Set the precio field of the model.
     *
     * @param float $precio The precio value to set.
     * @throws InvalidValueFormatException If the precio value is negative.
     * @return void
     */
    public function setPrecio(float $precio)
    {
        if ($precio < 0.0) {
            throw new InvalidValueFormatException("El precio debe ser un número positivo");
        }
        $this->fields["precio"] = $precio;
    }

    /**
     * Get the precio field of the model.
     *
     * @return float|null
     */
    public function getPrecio(): ?float
    {
        return $this->fields["precio"];
    }
}
