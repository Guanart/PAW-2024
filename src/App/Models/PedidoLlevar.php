<?php

namespace Paw\App\Models;

use Paw\App\Models\Pedido;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoLlevar extends Pedido {
    public static array $estados = ["aceptado", "preparacion", "finalizado", "retirar", "entregado"];
    
    public function __construct($values) {
        $this->setTipo("llevar");
        $this->set($values);
        $this->fields["estado"] = self::$estados[0];
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

    public function getLocal() {
        return $this->fields["local"];
    }

    public static function getEstados()
    {
        return self::$estados;
    }

}