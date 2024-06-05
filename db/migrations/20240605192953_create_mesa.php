<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMesa extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // La PK de mesa no será un id numérico secuencial. Usaremos un string único para identificar la mesa. Ej: mesa-100 hasta mesa-999
        $table = $this->table('mesa', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'string', ['limit' => 10])
            ->create();
    }
}
