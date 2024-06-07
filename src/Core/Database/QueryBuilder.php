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
        // $params es necesario para hacer el bind de los valores en el $filter
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

    public function selectPaginado(string $filter = null, array $params = [], int $limit = null, int $offset = null)
    {
        // $params es necesario para hacer el bind de los valores en el $filter
        $filterQuery = $filter ? "WHERE $filter" : "";

        $limitQuery = $limit ? "LIMIT $limit" : "";
        $offsetQuery = $offset ? "OFFSET $offset" : "";

        $query = "SELECT * FROM {$this->table} {$filterQuery}  {$limitQuery} {$offsetQuery}";
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
        // Si está seteado $id, lo elimino para que no se inserte en la BD porque será NULL
        if (is_null($data['id'])) {
            unset($data['id']);
        }

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
    public function update(array $data, string $filter, array $params)
    {
        $setStr = implode(", ", array_map(fn ($key) => "$key = :$key", array_keys($data)));
        $query = "UPDATE {$this->table} SET {$setStr} WHERE $filter";
        $sentencia = $this->pdo->prepare($query);

        // Bind parameters to the prepared statement
        foreach ($data as $key => $value) { 
            $sentencia->bindValue(":$key", $value);     // bindea los valores para la parte SET
        }

        foreach ($params as $key => $value) {
            $sentencia->bindValue($key, $value);        // bindea los valores para la parte WHERE
        }

        return $sentencia->execute();
    }

    /**
     * Perform a delete query on the specified table.
     */
    public function delete(string $filter, array $params)
    {
        $query = "DELETE FROM {$this->table} WHERE $filter";
        $sentencia = $this->pdo->prepare($query);

        // Bind parameters to the prepared statement
        foreach ($params as $key => $value) {
            $sentencia->bindValue($key, $value);
        }

        return $sentencia->execute();
    }

}