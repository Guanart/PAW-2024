<?php

namespace Paw\Core\Database;

use PDO;
use Paw\Core\Traits\Loggeable;

class QueryBuilder {
    use Loggeable;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function select($table) {
        $query = "select * from {$table}";
        $sentencia = $this->pdo->prepare($query);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }
}