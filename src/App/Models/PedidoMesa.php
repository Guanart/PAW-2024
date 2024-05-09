<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoMesa extends Model {
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
    public array $fields = [];

    public array $productos = [];

    public function __construct(array $values) {
        $this->fields = [
            "mesa" => null,
        ];
        $this->extras = [
            "input_nombre" => null,
            "input_info_adicional" => null,
        ];
        $this->setPedidos($values);
        $this->productos = $values;
    }

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

    public function setMesa(string $mesa) {
        if (strlen($mesa) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        $this->fields["mesa"] = $mesa;
    }
    public function setProductos(Array $productos) {
        if (count($productos) < 1) {
            throw new InvalidValueFormatException("No hay productos");
        }
        $this->productos = $productos;
    }
}