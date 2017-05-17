<?php

use Illuminate\Database\Seeder;

class TamanoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tamanos = [
            ['titulo' => 'Pequeño', 'descripcion' => '0 a 10kG'],
            ['titulo' => 'Mediano', 'descripcion' => '10.1 a 20KG'],
            ['titulo' => 'Grande', 'descripcion' => '20.1 a 30KG'],
            ['titulo' => 'Gigante', 'descripcion' => '30.1 KG o más'],
        ];

        DB::table('tamanos')->insert($tamanos);
    }
}
