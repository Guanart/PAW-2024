<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Pedido;
use Paw\App\Models\Producto;

class PedidoRepository extends Repository
{
    public function model(){
        return Pedido::class;
    }

    public function create(array $data) {
        // 1.1. Crear un pedido
        $pedido = new $this->model($data);
        if ($pedido) {
            $total = 0;
            foreach ($data['productos'] as $producto) {
                $producto_db = $this->queryBuilder->table('producto')->select("id = :id", [':id' => $producto['id_producto']])[0];
                $total += $producto_db['precio'] * intval($producto['cantidad']);
            }
            $pedido->setTotal($total);
            $id = $this->queryBuilder->table($this->table())->insert($pedido->toArray());
        }
        if ($id) {
            $pedido = $this->getById($id);
        }

        // // 1.2. Recuperar de la BD los detalle_pedido y crear el Model Pedido - ESTO NO SE USA, pero será útil para recuperar un pedido
        // $detalle_pedido = $this->queryBuilder->table('detalle_pedido')->select("id_pedido = :id_pedido", [':id_pedido' => $id]);
        
        // 2. Crear los detalle_pedido asociados al pedido - [id_pedido, id_producto, cantidad]
        $detalle_pedido = [];
        if ($pedido) {
            foreach ($data['productos'] as $producto) {
                $producto['id_pedido'] = $id;
                $id_detalle_pedido = $this->queryBuilder->table('detalle_pedido')->insert($producto);
                if ($id_detalle_pedido) {
                    $detalle_pedido[] = $this->queryBuilder->table('detalle_pedido')->select("id = :id", [':id' => $id_detalle_pedido]);
                }
            }
        }
    }

    public function getByIdUsuario($id_usuario) {
        // 1. Obtener todos los pedidos del usuario
        $pedidos = $this->queryBuilder->table($this->table())->select("id_usuario = :id_usuario", [':id_usuario' => $id_usuario]);
        
        // 2. Para cada pedido, obtener los detalles y los productos
        $result = [];
        foreach ($pedidos as $pedido) {
            $id_pedido = $pedido['id'];
            
            // Obtener detalles del pedido
            $detalles_pedido = $this->queryBuilder->table('detalle_pedido')->select("id_pedido = :id_pedido", [':id_pedido' => $id_pedido]);
            $productos = [];
            // Obtener los productos y agregar la información al detalle del pedido
            foreach ($detalles_pedido as &$detalle) {
                $prodResult = $this->queryBuilder->table('producto')->select("id = :id", [':id' => $detalle['id_producto']]);
                //$detalle['producto'] = $producto;
                $producto["producto"] =  new Producto($prodResult[0]);
                $producto["cantidad"] =  &$detalle["cantidad"];
                $productos[] = $producto;
            }
            
            // Agregar los detalles al pedido
            $pedido['productos'] = $productos;
            
            // Convertir el array del pedido a un objeto del modelo correspondiente
            $result[] = new $this->model($pedido);
        }
        
        return $result;
    }

    public function getEstadoById($id)
    {
        $filter = "id = :id";
        $result = $this->queryBuilder->table($this->table())->select($filter, [':id' => $id]);
        if ($result) {
            return $result[0]["estado"];
        }
        return null;
    }
}