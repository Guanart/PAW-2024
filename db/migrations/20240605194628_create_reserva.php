<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateReserva extends AbstractMigration
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
        $tableReserva = $this->table("reserva");
        $tableReserva ->addColumn('mesa', 'string', ['limit' => 20])
        ->addColumn('local', 'string', ['limit' => 20])
        ->addColumn('fecha', 'datetime')
        ->addColumn('id_usuario', 'integer')
        ->addForeignKey('id_usuario', 'usuario', 'id', ['update' => 'NO_ACTION'])
        ->addForeignKey('local', 'local', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
        ->addForeignKey('mesa', 'mesa', 'id', ['update' => 'NO_ACTION'])
        ->create();
    }
}
