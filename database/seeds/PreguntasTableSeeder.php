<?php

use Illuminate\Database\Seeder;

class PreguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preguntas = [
            ['pregunta' => 'Nombre Primera Mascota', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Actor Preferido', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Actriz Preferida', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Segundo Apellido Materno', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Segundo Apellido Paterno', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Pelicula Favorita', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Marca Vehiculo Preferido', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Restaurante Preferido', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Mejor Amigo Infancia', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Colegio de Primaria', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre Colegio de Secundaria', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Comida Favorita', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Deporte Preferido', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Serie de Tv Preferida', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Cancion Preferida', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Nombre de Cantante Preferido', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Ciudad Preferida en el Mundo', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Clase Animal Favorito', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Bebida Favorita', 'created_at' => '2017-03-03 10:50:00'],
            ['pregunta' => 'Fruta Preferida', 'created_at' => '2017-03-03 10:50:00']
        ];
        DB::table('preguntas')->insert($preguntas);
    }
}
