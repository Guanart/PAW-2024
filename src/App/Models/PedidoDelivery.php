<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoDelivery extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public string $table = "pedido";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public array $direccion = [];

    public array $productos = [];
    private static array $estados = ["aceptado", "preparacion", "finalizado", "despachado", "entregado"];

    public function __construct() {
        $this->direccion = [
            "Localidad" => null,
            "altura" => null,
            "departamento" => null,
            "calle" => null,
            "descripcion" => null
        ];
        $this->setPedidos($_SESSION);
        $this->productos = $_SESSION["pedido"];
    }

    /**
     * Set the nombre field of the model.
     *
     * @param string $nombre The nombre value to set.
     * @throws InvalidValueFormatException If the nombre value exceeds 60 characters.
     * @return void
     */

    public function setInput_nombre(string $input_nombre){
        if (strlen($input_nombre) > 100) {
            throw new InvalidValueFormatException("El nombre debe ser inferior a 100 caracteres.");
        }
        $this->fields["input_nombre"] = $input_nombre;
    }

    public function setInput_info_adicional(string $input_info_adicional){
        if (strlen($input_info_adicional) > 260) {
            throw new InvalidValueFormatException("La descripcion debe ser menor a 260 caracteres.");
        }
        $this->fields["input_info_adicional"] = $input_info_adicional;
    }
    
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
    public function setProductos(Array $productos) {
        if (count($productos) < 1) {
            throw new InvalidValueFormatException("No hay productos");
        }
        $this->productos = $productos;
    }

    public static function getEstados() {
        return self::$estados;
    }
}