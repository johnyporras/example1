<?php

use Illuminate\Database\Seeder;

class TypesProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_profile')->delete();

		$profiles = [

        ['id_type' => 3, 'id_module' => 5, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 20, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 1, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 2, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 17, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 21, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 1, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 2, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 3, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 4, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 10, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 11, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 12, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 20, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 21, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 4, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 31, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 31, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 31, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 10, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 3, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 2, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 11, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 1, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 3, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 12, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 13, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 14, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 10, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 11, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 12, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 14, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 14, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 16, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 150, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 72, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 40, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 40, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 15, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 15, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 15, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 26, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 27, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 28, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 29, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 1, 'id_module' => 30, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 25, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 26, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 27, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 28, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 29, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 2, 'id_module' => 30, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 26, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 27, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 28, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 29, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 30, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 21, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 39, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 3, 'id_module' => 40, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 5, 'id_module' => 1, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 5, 'id_module' => 2, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 5, 'id_module' => 3, 'created_at'=>'2017-03-03 10:50:00'],
		['id_type' => 5, 'id_module' => 4, 'created_at'=>'2017-03-03 10:50:00']
	];

	DB::table('user_types')->insert($profiles);
    }
}
