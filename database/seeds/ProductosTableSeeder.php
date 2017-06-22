<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            ['nombre' => 'A-CARD', 'costo' => '50000', 'created_at' => '2017-05-14 00:00:00'],
            ['nombre' => 'A-HORA', 'costo' => '84000', 'created_at' => '2017-05-14 00:00:00'],
            ['nombre' => 'A-MEMBER', 'costo' => '45000', 'created_at' => '2017-05-14 00:00:00']
        ];
        DB::table('ac_producto')->insert($productos);
    }
}
