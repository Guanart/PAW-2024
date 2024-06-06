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
                'nombre' => 'Hamburguesa Clásica',
                'descripcion' => 'Hamburguesa con carne de res, lechuga, tomate y queso',
                'precio' => 500,
            ],
            [
                'nombre' => 'Hamburguesa BBQ',
                'descripcion' => 'Hamburguesa con carne de res, salsa BBQ, cebolla frita y queso cheddar',
                'precio' => 600,
            ],
            [
                'nombre' => 'Hamburguesa de Pollo',
                'descripcion' => 'Hamburguesa con pechuga de pollo, lechuga, tomate y mayonesa',
                'precio' => 550,
            ],
            // Bebidas
            [
                'nombre' => 'Coca Cola',
                'descripcion' => 'Refresco de cola',
                'precio' => 50,
            ],
            [
                'nombre' => 'Pepsi',
                'descripcion' => 'Refresco de cola',
                'precio' => 50,
            ],
            [
                'nombre' => 'Sprite',
                'descripcion' => 'Refresco de limón',
                'precio' => 50,
            ],
        ];

        $table = $this->table('producto');
        $table->insert($data)->saveData();
    }
}
