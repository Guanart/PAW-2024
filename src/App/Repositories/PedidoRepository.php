<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Pedido;

class PedidoRepository extends Repository
{
    public function model(){
        return Pedido::class;
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