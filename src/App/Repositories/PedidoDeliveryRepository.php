<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\PedidoRepository;
use Paw\App\Models\PedidoDelivery;

class PedidoDeliveryRepository extends PedidoRepository
{
    public function model(){
        return PedidoDelivery::class;
    }
}