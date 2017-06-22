<?php

use Illuminate\Database\Seeder;

class EstatusCuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = [
            ['descripcion' => 'Activo', 'created_at' => '2017-03-03 10:50:00'],
            ['descripcion' => 'Pendiente', 'created_at' => '2017-03-03 10:50:00'],
            ['descripcion' => 'Suspendido', 'created_at' => '2017-03-03 10:50:00'],
            ['descripcion' => 'Anulado', 'created_at' => '2017-03-03 10:50:00']
        ];
        DB::table('estatus_cuenta')->insert($estatus);
    }
}
