<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['estado' => 'Amazonas', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Anzoategui', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Apure', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Aragua', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Barinas', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Miranda', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Bolivar', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Carabobo', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Cojedes', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Delta Amacuro', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Distrito Capital', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Falcon', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Guarico', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Lara', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Merida', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Monagas', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Nueva Esparta', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Portuguesa', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Sucre', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Tachira', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Trujillo', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Vargas', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Yaracuy', 'created_at' => '2016-05-14 00:00:00'],
            ['estado' => 'Zulia', 'created_at' => '2016-05-14 00:00:00'] 
        ];

        DB::table('ac_estados')->insert($estados);
    }
}
