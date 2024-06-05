<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Producto;

class ProductoRepository extends Repository
{
    public function model(){
        return Producto::class;
    }

    public function getAll() {
        $results = $this->queryBuilder->table($this->table())->select();
        if ($results) {
            $result_models = [];
            foreach ($results as $result){
                $result_models[] = new $this->model($result);
            }
            return $result_models;
        }
        return null;
    }

    public function getPage(int $itemsPerPage, int $page){
        $offset = $itemsPerPage * $page;
        $results = $this->queryBuilder->table($this->table())->selectPage(null, [], $itemsPerPage, $offset);
        if ($results) {
            $result_models = [];
            foreach ($results as $result){
                $result_models[] = new $this->model($result);
            }
            return $result_models;
        }
        return null;
    }
}