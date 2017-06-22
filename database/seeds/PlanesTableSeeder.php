<?php

use Illuminate\Database\Seeder;

class PlanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planes = [
            ["codigo_plan" => "25", "nombre" => "ATENCION MEDICA PRIMARIA", "cobertura" => "ATENCION MEDICA PRIMARIA", "orden" => "0", "created_at" => "2016-04-29 00:00:00"],
			["codigo_plan" => "33", "nombre" => "OFTALMOLOGIA HORIZONTE", "cobertura" => "PLANES OFTALMOLOGICOS", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "34", "nombre" => "SERVICIOS FUNERARIOS", "cobertura" => "SERVICIOS FUNERARIOS", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "32", "nombre" => "DENTAL ESPECIALIZADO HORIZONTE", "cobertura" => "DENTAL ESPECIALIZADO HORIZONTE", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "35", "nombre" => "OPTICA", "cobertura" => "OPTICA", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "36", "nombre" => "AMBULANCIA", "cobertura" => "AMBULANCIA", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "37", "nombre" => "ODONTOLOGIA ESPECIAL INEA", "cobertura" => "ODONTOLOGIA ESPECIAL INEA", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "38", "nombre" => "ODONTOLOGIA ESPECIAL SIDOR", "cobertura" => "ODONTOLOGIA ESPECIAL SIDOR", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "31", "nombre" => "ASISTENCIA DE VIAJEROS", "cobertura" => "ASISTENCIA DE VIAJEROS", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "3", "nombre" => "DENTAL ESPECIALIZADO", "cobertura" => "DENTAL ESPECIALIZADO", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "4", "nombre" => "BLANQUEAMIENTO", "cobertura" => "BLANQUEAMIENTO", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "5", "nombre" => "ORTODONCIA", "cobertura" => "ORTODONCIA", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "6", "nombre" => "IMPLANTOLOGIA", "cobertura" => "IMPLANTOLOGIA", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "18", "nombre" => "BANCARIBE PLAN INDIVIDUAL", "cobertura" => "BANCARIBE PLAN INDIVIDUAL", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "19", "nombre" => "BANCARIBE PLAN FAMILIAR", "cobertura" => "BANCARIBE PLAN FAMILIAR", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "21", "nombre" => "VISION PLUS - ORIENTAL", "cobertura" => "VISION PLUS - ORIENTAL", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "7", "nombre" => "MATERNIDAD", "cobertura" => "MATERNIDAD", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],
			["codigo_plan" => "8", "nombre" => "MASCOTAS", "cobertura" => "MASCOTAS", "orden" => "0", "created_at" => "2016-05-14 00:00:00"],

        ];
        DB::table('ac_planes_extranet')->insert($planes);
    }
}
