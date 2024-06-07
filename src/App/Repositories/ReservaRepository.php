<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Reserva;

class ReservaRepository extends Repository
{
    public function model(){
        return Reserva::class;
    }
}