<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsuarioMigration extends AbstractMigration
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
        $tableUsuario = $this->table("usuario");
        $tableUsuario->addColumn("nombre", "string", ["limit" => 64])
            ->addColumn("apellido", "string", ["limit" => 64])
            ->addColumn("username", "string", ["limit" => 64])
            ->addIndex(["username"],['unique' => true])
            ->addColumn("email", "string", ["limit" => 64])
            ->addIndex(["email"],['unique' => true])
            ->addColumn("password", "string", ["limit" => 100])
            ->addColumn("role", "string", ["limit" => 64])
            ->create();
    }
}
