<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Pedido;

class PedidoRepository extends Repository
{
    public function model(){
        return Pedido::class;
    }

    public function create(array $data)
    {
        $pedido = parent::create($data);
        if ($pedido) {
            $filter = "id = :id";
            $result = $this->queryBuilder->table($this->table())->select($filter, [':id' => $id]);
            if ($result) {
                // $result tiene un "tipo" que indica si es un PedidoDelivery o PedidoRetiro. isntanciar un model segun el tipo
                $class = $this->model() . ($result[0]["tipo"]);
                $model = new $class($result[0]);
                return $model;
                return new $this->model($result[0]);
            }
            return null;
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

    public function create2(array $data)
    {
        // TODO: validar parametros, por ejemplo, usando el Model
        $class = $this->model() . ucfirst($data["tipo"]);
        $model = new $class();
        if ($model) {
            $id = $this->queryBuilder->table($this->table())->insert($model->toArray());
        }
        if ($id) {
            $model = $this->getById($id);
            return $model;
        }
    }
}