<?php

namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Pedido extends Model {
    /**
     * The name of the database table associated with the model.
     *
     * @var string
     */
    static public string $table = "pedido";
    
    public array $productos = [];
    public static array $estados = [];
    
    public array $fields = [
        "id" => null,
        "id_usuario" => null,
        "tipo" => null,
        "fecha" => null,
        "estado" => null,
        "localidad" => null,
        "calle" => null,
        "altura" => null,
        "departamento" => null,
        "total" => null,
        "descripcion" => null,
        "mesa" => null,
        "local" => null,
        ];
        
    public function __construct($values) {
        $this->set($values);
        $this->productos = $values['productos'];      // Este campo no se encuentra en la BD (es una FK a detalle_pedido)
    }

    public static function getEstados()
    {
        return self::$estados;
    }

    public function setProductos(Array $productos) {
        if (count($productos) < 1) {
            throw new InvalidValueFormatException("No hay productos");
        }
        $this->fields["productos"] = $productos;
    }

    public function getProductos() {
        return $this->fields["productos"];
    }

    public function setUsername(string $username) {
        $this->fields["username"] = $username;
    }
    public function getUsername() {
        return $this->fields["username"];
    }

    public function getTipo() {
        return $this->fields["tipo"];
    }

    public function setTipo(string $tipo) {
        $this->fields["tipo"] = $tipo;
    }

    public function getFecha()
    {
        return $this->fields["fecha"];
    }

    public function setFecha(string $fecha)
    {
        $this->fields["fecha"] = $fecha;
    }

    public function getTotal()
    {
        return $this->fields["total"];
    }

    public function setTotal(float $total)
    {
        $this->fields["total"] = $total;
    }

    public function getEstado()
    {
        return $this->fields["estado"];
    }

    public function setEstado(string $estado)
    {
        $this->fields["estado"] = $estado;
    }

    public function getLocalidad()
    {
        return $this->fields["localidad"];
    }

    public function setLocalidad(string $localidad)
    {
        $this->fields["localidad"] = $localidad;
    }

    public function getCalle()
    {
        return $this->fields["calle"];
    }

    public function setCalle(string $calle)
    {
        $this->fields["calle"] = $calle;
    }

    public function getAltura()
    {
        return $this->fields["altura"];
    }

    public function setAltura(int $altura)
    {
        $this->fields["altura"] = $altura;
    }

    public function getDepartamento()
    {
        return $this->fields["departamento"];
    }

    public function setDepartamento(string $departamento)
    {
        $this->fields["departamento"] = $departamento;
    }

    public function getDescripcion()
    {
        return $this->fields["descripcion"];
    }

    public function setDescripcion(string $descripcion)
    {
        $this->fields["descripcion"] = $descripcion;
    }

    public function getMesa()
    {
        return $this->fields["mesa"];
    }

    public function setMesa(string $mesa)
    {
        $this->fields["mesa"] = $mesa;
    }

    public function getLocal()
    {
        return $this->fields["local"];
    }

    public function setLocal(string $local)
    {
        $this->fields["local"] = $local;
    }

    public function getId()
    {
        return $this->fields["id"];
    }

    public function setId(int $id)
    {
        $this->fields["id"] = $id;
    }

    public function getId_usuario()
    {
        return $this->fields["id_usuario"];
    }

    public function setId_usuario(int $id_usuario)
    {
        $this->fields["id_usuario"] = $id_usuario;
    }

}