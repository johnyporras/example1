<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();

        $modules = [
          ['description'=>'Inicio', 'url'=>'#', 'order' => 1, 'icon'=>'glyphicon glyphicon-dashboard', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Claves de Atenci&oacute;n', 'url'=>'#', 'order' => 2, 'icon'=>'glyphicon glyphicon-lock', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Claves y Autorizaciones Especiales', 'url'=>'#', 'order' => 3, 'icon'=>'glyphicon glyphicon-list-alt', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Facturación e Incidencias', 'url'=>'#', 'order' => 4, 'icon'=>'glyphicon glyphicon-calendar', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Auditor&iacute;a', 'url'=>'#', 'order' => 5, 'icon'=>'glyphicon glyphicon-check', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Claves Odontológicas', 'url'=>'#', 'order' => 6, 'icon'=>'glyphicon glyphicon-list-alt', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Tratamientos Realizados', 'url'=>'#', 'order' => 7, 'icon'=>'glyphicon glyphicon-list', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Pagos', 'url'=>'#', 'order' => 8, 'icon'=>'glyphicon glyphicon-list-alt', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Baremos', 'url'=>'#', 'order' => 9, 'icon'=>'glyphicon glyphicon-list', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Pagos', 'url'=>'#', 'order' => 10, 'icon'=>'glyphicon glyphicon-list', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Soporte en L&iacute;nea', 'url'=>'#', 'order' => 11, 'icon'=>'glyphicon glyphicon-phone', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Administraci&oacute;n de la P&aacute;gina', 'url'=>'#', 'order' => 13, 'icon'=>'glyphicon glyphicon-wrench', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Usuarios Extranet', 'url'=>'#', 'order' => 14, 'icon'=>'glyphicon glyphicon-user', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Planes', 'url'=>'#', 'order' => 20, 'icon'=>'glyphicon glyphicon-list-alt', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Aseguradoras', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-user', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Procedimientos M&eacute;dicos', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-list', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Afiliados', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-user', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Especialidad', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-list-alt', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Contratos', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-user', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Colectivos', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-user', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Proveedores', 'url'=>'#', 'order' => 21, 'icon'=>'glyphicon glyphicon-signal', 'created_at'=>'2017-03-03 14:10:00'],
          ['description'=>'Feriados', 'url'=>'#', 'order' => 22, 'icon'=>'glyphicon glyphicon-calendar', 'created_at'=>'2017-03-03 14:10:00']
        ];

        DB::table('modules')->insert($modules);
    }
}
