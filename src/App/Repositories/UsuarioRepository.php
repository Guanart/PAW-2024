<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Usuario;

class UsuarioRepository extends Repository
{
    public function model(){
        return Usuario::class;
    }
}