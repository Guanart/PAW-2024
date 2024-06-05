<?php

namespace Paw\App\Repositories;

use Paw\App\Repositories\Repository;
use Paw\App\Models\Usuario;

class UsuarioRepository extends Repository
{
    public function model(){
        return Usuario::class;
    }

    public function getByEmail($email)
    {
        $filter = "email = :email";
        $result = $this->queryBuilder->table($this->table())->select($filter, [':email' => $email]);
        if ($result) {
            return new $this->model($result[0]);
        }
        return null;
    }

    public function getByUsername($username)
    {
        $filter = "username = :username";
        $result = $this->queryBuilder->table($this->table())->select($filter, [':username' => $username]);
        if ($result) {
            return new $this->model($result[0]);
        }
        return null;
    }
}