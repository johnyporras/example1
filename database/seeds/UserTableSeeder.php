<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = [
          'name' => 'gContreras',
          'email' => 'germansango@gmail.com',
          'password' => bcrypt('usuario'),
          'department' => 'Sistemas',
          'type' => '0',
          'user' => 'germansango'
        ];

        DB::table('users')->insert($user);
    }
}
