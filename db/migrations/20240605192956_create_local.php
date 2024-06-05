<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLocal extends AbstractMigration
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
        // Crear tabla "local". Tendrán localidad, dirección, teléfono, altura
        $table = $this->table('local', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'string', ['limit' => 20])
            ->addColumn('direccion', 'string', ['limit' => 100])
            ->addColumn('telefono', 'string', ['limit' => 100])
            ->addColumn('altura', 'integer')
            ->create();
    }
}
