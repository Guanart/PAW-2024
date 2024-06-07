<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Pedido;

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

    public function getPedidosbyUsername($username) {
        $filter = "username = :username";
        $result = $this->queryBuilder->table($this->table())->select($filter, [':username' => $username]);
        if ($result) {
            return new $this->model($result[0]);
        }
        return null;
    }
}