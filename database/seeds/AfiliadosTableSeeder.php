<?php

use Illuminate\Database\Seeder;

class AfiliadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $afiliados = [
            ['cedula' => '1000001', 'nombre' => 'FELIX JOSE', 'apellido' => 'MARCANO ESPONIZA', 'fecha_nacimiento' => '1960-03-13', 'email' => 'marcano@gmail.com', 'sexo' => 'M', 'telefono' => '02123722709', 'cuenta_id' => '1', 'estado_id' => '11', 'ciudad' => 'caracas', 'embarazada' => 'N', 'created_at' => '2016-12-15 15:51:33'],
            ['cedula' => '1000002', 'nombre' => 'PETRA CELESTINA', 'apellido' => 'FERNANDEZ MORENO', 'fecha_nacimiento' => '1975-10-20', 'email' => 'moreno@gmail.com', 'sexo' => 'F', 'telefono' => '02121234569', 'cuenta_id' => '1', 'estado_id' => '6', 'ciudad' => 'petare', 'embarazada' => 'N', 'created_at' => '2016-12-15 15:51:33']
        ];

        DB::table('ac_afiliados')->insert($afiliados);
    }
    
}