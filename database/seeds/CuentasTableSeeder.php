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
            ['codigo_cuenta' => '1234', 'fecha' => '2017-05-15', 'estatus' => '1', 'id_producto' => '1', 'created_at' => '2017-03-03 10:50:00'],
            ['codigo_cuenta' => '5678', 'fecha' => '2017-04-20', 'estatus' => '1', 'id_producto' => '1', 'created_at' => '2017-03-03 10:50:00'] 
        ];

        $cuentaPlan = [
            ['id_cuenta' => '1', 'id_plan' => '25'],
            ['id_cuenta' => '2', 'id_plan' => '25']
        ];

        DB::table('ac_cuenta')->insert($cuentas);
        DB::table('ac_cuentaplan')->insert($cuentaPlan);
    }
}
