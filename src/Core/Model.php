<?php

namespace Paw\Core;

use Paw\Core\Database\QueryBuilder;
use Paw\Core\Traits\Loggeable;

class Model {
    use Loggeable;

    public function setQueryBuilder(QueryBuilder $qb) {
        $this->queryBuilder = $qb;
    }
}