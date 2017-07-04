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
          'name' => 'Administrador',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('1234'),
          'department' => 'Sistemas',
          'type' => '1',
          'user' => 'admin@gmail.com'
        ];

        DB::table('users')->insert($user);
    }
}
