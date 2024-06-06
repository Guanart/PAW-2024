<?php

namespace Paw\App\Models;

use Paw\App\Models\Pedido;
use Paw\Core\Exceptions\InvalidValueFormatException;

class PedidoDelivery extends Pedido {
    private array $estados = ["aceptado", "preparacion", "finalizado", "despachado", "entregado"];

    public function __construct($values) {
        $this->setTipo("delivery");
        $this->set($values);
        $this->fields["estado"] = $this->estados[0];
    }
    
    public function setLocalidad(string $localidad) {
        if (strlen($localidad) > 80) {
            throw new InvalidValueFormatException("El nombre de la localidad no debe ser mayor a 80 caracteres");
        }
        if (strlen($localidad) < 1) {
            throw new InvalidValueFormatException("El nombre de la localidad no debe ser vacío");
        }
        $this->fields["direccion"]["localidad"] = $localidad;
    }

    public function getLocalidad() {
        return $this->fields["direccion"]["localidad"];
    }

    public function setAltura(int $altura) {
        if ($altura < 0) {
            throw new InvalidValueFormatException("La altura debe ser mayor o igual a 0");
        }
        $this->fields["direccion"]["altura"] = $altura;
    }

    public function getAltura() {
        return $this->fields["direccion"]["altura"];
    }

    public function setDepartamento(string $departamento) {
        if ($departamento > 0) {
            throw new InvalidValueFormatException("El departamento debe ser mayor a 0");
        }

        $this->fields["direccion"]["departamento"] = $departamento;
    }

    public function getDepartamento() {
        return $this->fields["direccion"]["departamento"];
    }

    public function setCalle(string $calle) {
        if (strlen($calle) > 60) {
            throw new InvalidValueFormatException("El nombre del producto no debe ser mayor a 60 caracteres");
        }
        if (strlen($calle) < 1) {
            throw new InvalidValueFormatException("El nombre del producto no debe vacío");
        }
        $this->fields["direccion"]["calle"] = $calle;
    }

    public function getCalle() {
        return $this->fields["direccion"]["calle"];
    }

    public function setDescripcion(string $descripcion) {
        if (strlen($descripcion) > 260) {
            throw new InvalidValueFormatException("La descripcion no debe ser mayor a 260 caracteres");
        }
        $this->fields["direccion"]["descripcion"] = $descripcion;
    }

    public function getDescripcion() {
        return $this->fields["direccion"]["descripcion"];
    }
}