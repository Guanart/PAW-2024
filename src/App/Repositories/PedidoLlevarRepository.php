<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\PedidoRepository;
use Paw\App\Models\PedidoLlevar;

class PedidoLlevarRepository extends PedidoRepository
{
    public function model(){
        return PedidoLlevar::class;
    }
}