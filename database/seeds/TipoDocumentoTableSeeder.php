<?php

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('ac_tipo_documentos')->delete();

		$tipos = [
			['descripcion' => 'Examenes de Laboratorios', 'created_at'=>'2017-03-03 10:50:00'],
			['descripcion' => 'Estudios', 'created_at'=>'2017-03-03 10:50:00']
		];

		DB::table('ac_tipo_documentos')->insert($tipos);
    }
}