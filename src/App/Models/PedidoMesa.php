<?php

namespace Paw\App\Models;

use Paw\App\Models\Pedido;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoMesa extends Pedido {
    public static array $estados = ["aceptado", "preparacion", "finalizado", "retirar", "entregado"];

    public function __construct($values) {
        $this->setTipo("mesa");
        $this->set($values);
        $this->fields["estado"] = self::$estados[0];
    }

    public function setMesa(string $mesa) {
        if (strlen($mesa) > 20) {
            throw new InvalidValueFormatException("El id de mesa debe ser menor de 20 caracteres");
        }
        if (strlen($mesa) < 5) {
            throw new InvalidValueFormatException("El id de mesa debe contener al menos 5 caracteres");
        }
        $this->fields["mesa"] = $mesa;
    }
}