<?php

use Illuminate\Database\Seeder;

class TipoAfiliadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ac_tipo_afiliado')->delete();

		$types = [ 
			[ "nombre" => "Titular","orden" => "a1", "created_at" => "2017-03-10 15:59:14"],
			[ "nombre" => "Conyuge","orden" => "a2", "created_at" => "2017-03-10 16:02:48"],
			[ "nombre" => "Hija","orden" => "a3", "created_at" => "2017-03-10 16:03:56"],
			[ "nombre" => "Hijo","orden" => "a4", "created_at" => "2017-03-10 16:04:07"]
		];

		DB::table('ac_tipo_afiliado')->insert($types);

    }
}
