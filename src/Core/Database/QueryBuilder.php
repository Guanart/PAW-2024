<?php

namespace Paw\Core\Database;

use Paw\Core\Traits\Loggeable;
use PDO;

/**
 * The QueryBuilder class provides methods for building and executing database queries.
 */
class QueryBuilder {
    use Loggeable;
    
    protected $pdo;
    protected $table;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo The PDO instance to use for database connections.
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Set the table to perform queries on.
     *
     * @param string $table The name of the table.
     * @return QueryBuilder The QueryBuilder instance.
     */
    public function table(string $table) {
        $this->table = $table;
        return $this;
    }

    /**
     * Perform a select query on the specified table.
     *
     * @return array The result of the select query.
     */
    public function select(string $filter = null, array $params = [])
    {
        $filterQuery = $filter ? "WHERE $filter" : "";

        $query = "SELECT * FROM {$this->table} {$filterQuery}";
        $sentencia = $this->pdo->prepare($query);

        // Bind parameters to the prepared statement
        foreach ($params as $key => $value) {
            $sentencia->bindValue($key, $value);
        }

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    /**
     * Perform an insert query on the specified table.
     */
    public function insert(array $data)
    {
        $columnas = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn ($key) => ":$key", array_keys($data)));

        $query = "INSERT INTO {$this->table} ({$columnas}) VALUES ({$placeholders})";
        $sentencia = $this->pdo->prepare($query);

        // Bind parameters to the prepared statement
        foreach ($data as $key => $value) {
            $sentencia->bindValue(":$key", $value);
        }

        $sentencia->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Perform an update query on the specified table.
     */
    public function update() {
        // TODO: Implement update method.
    }

    /**
     * Perform a delete query on the specified table.
     */
    public function delete() {
        // TODO: Implement delete method.
    }
}