<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class LocalSeeder extends AbstractSeed
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
        // id (son los nombres, Chivilcoy, Lujan, Rodriguez, Moreno), direccion, telefono y altura
        $data = [
            ['id' => 'Chivilcoy', 'direccion' => 'Av. Sarmiento 1000', 'telefono' => '02346-42-0000', 'altura' => 1000],
            ['id' => 'Lujan', 'direccion' => 'Av. Rivadavia 1000', 'telefono' => '02323-42-0000', 'altura' => 1000],
            ['id' => 'Rodriguez', 'direccion' => 'Av. Rivadavia 1000', 'telefono' => '02323-42-0000', 'altura' => 1000],
            ['id' => 'Moreno', 'direccion' => 'Av. Rivadavia 1000', 'telefono' => '02323-42-0000', 'altura' => 1000],
        ];

        

        $this->table('local')->insert($data)->saveData();
    }
}
