<?php

namespace Paw\App\Models;

use Paw\App\Models\Pedido;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoMesa extends Pedido {

    public function __construct($values) {
        $this->fields["estados"] = ["aceptado", "preparacion", "finalizado", "retirar", "entregado"];
        $this->fields["tipo"] = "mesa";
        $this->set($values);
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