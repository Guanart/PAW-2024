<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\PedidoRepository;
use Paw\App\Models\PedidoMesa;

class PedidoMesaRepository extends PedidoRepository
{
    public function model(){
        return PedidoMesa::class;
    }
}