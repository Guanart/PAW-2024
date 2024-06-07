<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Reserva;

class ReservaRepository extends Repository
{
    public function model(){
        return Reserva::class;
    }

    public function getByFechaMesaLocal($fecha, $mesa, $local)
    {
        $filter = "fecha = :fecha and mesa = :mesa and local = :local";
        $result = $this->queryBuilder->table($this->table())->select($filter, [':fecha' => $fecha ,':mesa' => $mesa , ':local' => $local]);
        
        if (count($result) > 0) {
            return $model = new $this->model($result[0]);
        } else {
            return null;
        }
    }

    public function getByFechaLocal($fecha, $local)
    {
        $filter = "fecha = :fecha and local = :local";
        
        $results = $this->queryBuilder->table($this->table())->select($filter, [':fecha' => $fecha , ':local' => $local]);
        $models = [];
        foreach ($results as $result) {
            $models[] = new $this->model($result);
        }
        return $models;
    }
}