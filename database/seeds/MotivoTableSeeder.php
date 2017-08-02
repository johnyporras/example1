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
			['nombre' => 'Habito', 'slug' => 'habito', 'descripcion' => 'Estilo de vida, habitos, y drogas que usualmente consume el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Actividad Física', 'slug' => 'actividad_fisica', 'descripcion' => 'Actividad que usualmente realiza el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Pasatiempo', 'slug' => 'pasatiempo', 'descripcion' => 'Pasatiempos que usualmente realiza el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Alimentación', 'slug' => '', 'descripcion' => 'Alimentos que usualmente consume el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Alergia', 'slug' => 'alergia', 'descripcion' => 'Alergias que sufre usualmente el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Vacuna', 'slug' => 'vacuna', 'descripcion' => 'Vacunas que ha recibido el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Discapacidad', 'slug' => 'discapacidad', 'descripcion' => 'Discapacidades que posee el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Hospitalizacion', 'slug' => 'hospitalizacion', 'descripcion' => 'Hospitalizaciones sufridas por el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Operacion', 'slug' => 'operacion', 'descripcion' => 'Operaciones sufridas por el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00'],
			['nombre' => 'Enfermedad Cronica', 'slug' => 'enfermedad_cronica', 'descripcion' => 'Enfermedades Cronicas que ha sufrido el paciente o afiliado', 'created_at'=>'2017-03-03 10:50:00']
		];

		DB::table('motivos')->insert($motivos);
    }
}
