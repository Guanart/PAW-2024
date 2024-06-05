<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ProductosSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'User',
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ],
            [
                'username' => 'Admin',
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ]
        ];

        $table = $this->table('usuario');
        $table->insert($data)->saveData();
    }
}
