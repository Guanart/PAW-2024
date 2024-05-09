<?php

namespace Paw\Core;

use Paw\Core\Traits\Loggeable;

abstract class Model {
    use Loggeable;
    
    static public string $table;
    
    protected array $fields = [];
    
    
    /**
     * Set multiple fields of the model using an associative array.
     *
     * @param array $values An associative array of field names and their values.
     * @return void
     */
    
    public function set(array $values)
    {
        foreach (array_keys($this->fields) as $field) {
            if (!isset($values[$field])) {
                continue;
            }
            $method = "set" . ucfirst($field);
            $this->$method($values[$field]);
        }
    }
    
    public function setPedidos(array &$values)
    {
        foreach (array_keys($this->fields) as $field) {
            if (!isset($values[$field])) {
                continue;
            }
            $method = "set" . ucfirst($field);
            $this->$method($values[$field]);
            unset($values[$field]);
        }
    }
}