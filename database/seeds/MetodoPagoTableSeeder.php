<?php

use Illuminate\Database\Seeder;

class MetodoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodos = [
            ['metodo' => 'Pago Directo'],
            ['metodo' => 'Carta Compromiso']
         ];

        DB::table('metodo_pago')->insert($metodos);
    }
}