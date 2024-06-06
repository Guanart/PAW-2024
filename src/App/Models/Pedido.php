<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

abstract class Pedido extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public string $table = "pedido";

    public function __construct($values) {
        $this->set($values);
    }
    
    public function setProductos(Array $productos) {
        if (count($productos) < 1) {
            throw new InvalidValueFormatException("No hay productos");
        }
        $this->fields["productos"] = $productos;
    }
    
    public static function getProductos() {
        return $this->$fields["productos"];
    }

    public function setUsername(string $username) {
        $this->$fields["username"] = $username;
    }
    public function getUsername(string $username) {
        return $this->$fields["username"];
    }

    public static function getEstados() {
        return $this->$fields["estados"];
    }
}