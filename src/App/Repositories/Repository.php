<?php

namespace Paw\App\Repositories;

use Paw\Core\Database\QueryBuilder;
use Paw\Core\Model;

/**
 * The Repository class provides a base implementation for repositories.
 */
abstract class Repository
{
    protected $model;
    protected QueryBuilder $queryBuilder;

    
    /**
     * Create a new Repository instance.
     *
     * @param QueryBuilder $queryBuilder The query builder instance.
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Get the model associated with the repository.
     *
     * @return Model The model instance.
     */
    abstract public function model();

    /**
     * Set the model instance for the repository.
     *
     * @return void
     */
    public function setModel()
    {
        $this->model = $this->model();
    }

    /**
     * Get the table name associated with the model.
     *
     * @return string The table name.
     */
    private function table()
    {
        return $this->model::$table;
    }

    /* QUERIES */

    /**
     * Get a record by its ID.
     *
     * @param int $id The ID of the record.
     * @return mixed The query result.
     */
    public function getById($id)
    {
        $filter = "id = :id";
        return $this->queryBuilder->table($this->table())->select($filter, params: [':id' => $id])[0];
    }

    /**
     * Get all records.
     *
     * @return mixed The query result.
     */
    public function getAll()
    {
        return $this->queryBuilder->table($this->table())->select();
    }

    /**
     * Create a new record.
     *
     * @param array $data The data to be inserted.
     * @return mixed The query result.
     */
    public function create(array $data)
    {
        // TODO: validar parametros, por ejemplo, usando el Model
        $model = new $this->model($data);
        if ($model) {
            $id = $this->queryBuilder->table($this->table())->insert($model->toArray());
        }
        if ($id){
            $data = $this->getById($id);
            $model = new $this->model($data);
            return $model;
        }
    }

    /**
     * Delete records.
     *
     * @return mixed The query result.
     */
    public function delete()
    {
        return $this->queryBuilder->table($this->table())->delete();
    }

    /**
     * Update records.
     *
     * @param array $data The data to be updated.
     * @return mixed The query result.
     */
    public function update(array $data)
    {
        return $this->queryBuilder->table($this->table())->update($data);
    }
}
