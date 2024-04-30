<?php

namespace Paw\App\Repositories;

use Paw\Core\Repository;
use Paw\App\Models\Producto;

class ProductoRepository extends Repository
{
    public function model(){
        return Producto::class;
    }
}