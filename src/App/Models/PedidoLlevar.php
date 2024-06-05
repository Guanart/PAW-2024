<?php

namespace Paw\App\Models;

use Paw\App\Models\Pedido;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoLlevar extends Pedido {

    public function __construct($values) {
        $this->fields["estados"] = ["aceptado", "preparacion", "finalizado", "retirar", "entregado"];
        $this->fields["tipo"] = "llevar";
        $this->set($values);
    }

    public function setLocal(string $local) {
        if (strlen($local) > 60) {
            throw new InvalidValueFormatException("El id de local debe ser menor de 60 caracteres");
        }
        if (strlen($local) < 1) {
            throw new InvalidValueFormatException("El id de local no puede estar vacio");
        }
        $this->fields["local"] = $local;
    }

    public function getLocal(string $local) {
        return $this->fields["local"];
    }
}