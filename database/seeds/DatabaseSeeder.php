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
        $this->call(CountriesTableSeeder::class);
        $this->call(MetodoPagoTableSeeder::class);
        $this->call(TamanoTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(PlanesTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(EstatusCuentaTableSeeder::class);
        $this->call(CuentasTableSeeder::class);
        $this->call(AfiliadosTableSeeder::class);
    }
}