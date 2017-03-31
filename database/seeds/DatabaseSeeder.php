<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModulesTableSeeder::class);
        $this->call(SubmodulesTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(TypesProfileTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TipoAfiliadoTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(MetodoPagoTableSeeder::class);
    }
}