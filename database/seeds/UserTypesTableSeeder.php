<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->delete();

	$types = [
            ['name'=>'Administrador', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
        	['name'=>'Analista', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
        	['name'=>'Aseguradora', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
        	['name'=>'Proveedor', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
        	['name'=>'Afiliado A-card', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
            ['name'=>'Planificador de Pagos', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
            ['name'=>'Ejecutor de Pagos', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
            ['name'=>'Afiliado A-Member', 'modules' => 26, 'active' => 1, 'created_at'=>'2017-03-03 10:20:00'],
        ];

        DB::table('user_types')->insert($types);
    }
}
