<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class MesasSeeder extends AbstractSeed
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
            ['id' => 'mesa-162'],
            ['id' => 'mesa-161'],
            ['id' => 'mesa-144'],
            ['id' => 'mesa-143'],
            ['id' => 'mesa-142'],
            ['id' => 'mesa-141'],
            ['id' => 'mesa-126'],
            ['id' => 'mesa-125'],
            ['id' => 'mesa-124'],
            ['id' => 'mesa-123'],
            ['id' => 'mesa-122'],
            ['id' => 'mesa-121'],
            ['id' => 'mesa-342'],
            ['id' => 'mesa-341'],
            ['id' => 'mesa-322'],
            ['id' => 'mesa-321'],
            ['id' => 'mesa-262'],
            ['id' => 'mesa-261'],
            ['id' => 'mesa-241'],
            ['id' => 'mesa-223'],
            ['id' => 'mesa-222'],
            ['id' => 'mesa-221'],
            ['id' => 'barra-321'],
            ['id' => 'barra-322'],
            ['id' => 'barra-323'],
        ];
        $this->table('mesa')->insert($data)->saveData();
    }
}
