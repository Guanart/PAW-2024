<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePedido extends AbstractMigration
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
        // Migration para la tabla pedidos. Tendremos tres tipos de pedidos: take-away, delivery y en el local.
        // departamento, calle, altura, localidad, descripcion. Mesa. Local
        
        $table = $this->table('pedido');
        $table->addColumn('id_usuario', 'integer')
            ->addColumn('tipo', 'string', ['limit' => 20])
            ->addColumn('fecha', 'date')
            ->addColumn('total', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('estado', 'string', ['limit' => 20])
            ->addColumn('localidad', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('calle', 'string', ['limit' => 60, 'null' => true])
            ->addColumn('altura', 'integer', ['null' => true])
            ->addColumn('departamento', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('descripcion', 'string', ['limit' => 260, 'null' => true])
            ->addColumn('mesa', 'string', ['limit' => 20], ['null' => true])
            ->addColumn('local', 'string', ['limit' => 60, 'null' => true])
            ->addForeignKey('id_usuario', 'usuario', 'id', ['update' => 'NO_ACTION'])
            ->addForeignKey('mesa', 'mesa', 'id', ['update' => 'NO_ACTION', 'delete' => 'SET_NULL'])
            ->addForeignKey('local', 'local', 'id', ['update' => 'NO_ACTION', 'delete' => 'SET_NULL'])
            ->create();
    }
}