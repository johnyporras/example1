<?php

use Illuminate\Database\Seeder;

class TipoMedicamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tipo_medicamentos')->delete();

		$tipos = [
			['descripcion' => 'Comprimido', 'created_at'=>'2017-03-03 10:50:00'],
			['descripcion' => 'Tabletas', 'created_at'=>'2017-03-03 10:50:00'],
			['descripcion' => 'Indovenosa', 'created_at'=>'2017-03-03 10:50:00'],
			['descripcion' => 'Introvenosa', 'created_at'=>'2017-03-03 10:50:00']
		];

		DB::table('tipo_medicamentos')->insert($tipos);
    }
}
