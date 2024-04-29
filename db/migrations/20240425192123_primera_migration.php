<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PrimeraMigration extends AbstractMigration
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
        $tableProducto = $this->table("Producto");
        $tableProducto->addColumn("nombre", "string", ["limit" => 60])
            ->addColumn("descripcion", "string", ["limit" => 60])
            ->addColumn("precio", "integer")
            ->create();
    }
}
