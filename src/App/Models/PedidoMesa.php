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
    static public $table = "pedido";

    /**
     * The fields of the model and their initial values.
     *
     * @var array
     */
    public $fields = [];

    public $productos = [];

    public function __construct(array $values) {
        $this->fields = [
            "mesa" => null,
        ];
        $this->setPedidos($values);
        $this->productos = $values;
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