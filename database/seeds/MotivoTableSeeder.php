<?php

use Illuminate\Database\Seeder;

class MotivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('motivos')->delete();

		$motivos = [
			['nombre' => 'Drogas', 'descripcion' => 'drogas que usualmente consume el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Actividad Física', 'descripcion' => 'Actividad que usualmente realiza el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Pasatiempos', 'descripcion' => 'Pasatiempos que usualmente realiza el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Alimentación', 'descripcion' => 'Alimentos que usualmente consume el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Alergias', 'descripcion' => 'Alergias que sufre usualmente el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Vacunas', 'descripcion' => 'Vacunas que ha recibido el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Discapacidades', 'descripcion' => 'Discapacidades que posee el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Hospitalizaciones', 'descripcion' => 'Hospitalizaciones sufridas por el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Operaciones', 'descripcion' => 'Operaciones sufridas por el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Enfermedades Cronicas', 'descripcion' => 'Enfermedades Cronicas que ha sufrido el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00']
		];

		DB::table('motivos')->insert($motivos);
    }
}
