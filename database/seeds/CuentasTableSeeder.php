<?php

use Illuminate\Database\Seeder;

class CuentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuentas = [
            ['codigo_cuenta' => '1234', 'fecha' => '2017-05-15', 'estatus' => 'Activo', 'producto_id' => '1', 'created_at' => '2017-03-03 10:50:00'],
            ['codigo_cuenta' => '5678', 'fecha' => '2017-04-20', 'estatus' => 'Activo', 'producto_id' => '1', 'created_at' => '2017-03-03 10:50:00']
        ];

        DB::table('ac_cuenta')->insert($cuentas);
    }
}
