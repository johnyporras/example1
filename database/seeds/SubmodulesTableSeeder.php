<?php

use Illuminate\Database\Seeder;

class SubmodulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('submodules')->delete();

        $submodules = [
['description'=>'Consultar Afiliados Temporales', 'modules_id' => 3, 'url'=>'clavesEspeciales/consultarAfiliadosTemporales', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Facturación y Cierre de Casos', 'modules_id' => 4, 'url'=>'facturacion/registrar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Autorizar AVAL', 'modules_id' => 3, 'url'=>'clavesEspeciales/autorizar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Incidencias', 'modules_id' => 3, 'url'=>'clavesEspeciales/autorizar', 'order' => 5, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar', 'modules_id' => 8, 'url'=>'pagos/consultar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Confirmar', 'modules_id' => 3, 'url'=>'clavesEspeciales/confirmar', 'order' => 4, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Usuarios del Sistema', 'modules_id' => 14, 'url'=>'usuarios', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Autorizar AVAL Temporales', 'modules_id' => 3, 'url'=>'clavesEspeciales/autorizarTemporales', 'order' => 6, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Confirmar', 'modules_id' => 3, 'url'=>'clavesEspeciales/confirmarEspeciales', 'order' => 7, 'created_at'=>'2017-03-03 00:00:00'],
['description'=>'Confirmar', 'modules_id' => 2, 'url'=>'claves/confirmar', 'order' => 5, 'created_at'=>'2017-03-03 00:00:00'],
['description'=>'Registrar Pacientes Atendidos', 'modules_id' => 4, 'url'=>'servicios/registrar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Registrar', 'modules_id' => 7, 'url'=>'tratamiento/registrar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Baremos', 'modules_id' => 9, 'url'=>'baremos.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar', 'modules_id' => 7, 'url'=>'tratamiento/consultar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Estatus', 'modules_id' => 10, 'url'=>'pagos.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Respuesta de Solicitudes', 'modules_id' => 11, 'url'=>'respuesta-solicitud.php', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Solicitud de Informaci&oacute;n', 'modules_id' => 11, 'url'=>'solicitud-linea.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Responder Solicitudes', 'modules_id' => 11, 'url'=>'solicitud-responder.php', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Directorio de Profesionales', 'modules_id' => 13, 'url'=>'profesionales-afiliados.php', 'order' => 104, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Usuarios Profesionales', 'modules_id' => 14, 'url'=>'user-prof-csv.php', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Perfiles de Usuarios', 'modules_id' => 14, 'url'=>'perfiles.php', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Planes', 'modules_id' => 15, 'url'=>'planes.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Aseguradoras', 'modules_id' => 16, 'url'=>'aseguradoras.php', 'order' => 0, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Examenes', 'modules_id' => 17, 'url'=>'examen.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Afiliados', 'modules_id' => 18, 'url'=>'afiliados.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Especialidad', 'modules_id' => 19, 'url'=>'especialidad.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Contratos', 'modules_id' => 20, 'url'=>'contratos.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Colectivos', 'modules_id' => 21, 'url'=>'colectivos.php', 'order' => 0, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Cerrar Mes', 'modules_id' => 7, 'url'=>'tratamiento/cerrar', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Gestionar', 'modules_id' => 6, 'url'=>'clavesOdonto/gestionar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Actualizar', 'modules_id' => 6, 'url'=>'clavesOdonto/actualizar', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar', 'modules_id' => 6, 'url'=>'clavesOdonto/consultar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Auditoría Claves Odontológicas', 'modules_id' => 5, 'url'=>'auditoria/actualizarOdontologica', 'order' => 4, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Actualizar Pacientes Atendidos', 'modules_id' => 5, 'url'=>'auditoria/actualizar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Auditar Facturación', 'modules_id' => 5, 'url'=>'auditoria/consultar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Autorizar Afiliados Temporales', 'modules_id' => 2, 'url'=>'claves/autorizarAfiliadosTemporales', 'order' => 4, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar', 'modules_id' => 2, 'url'=>'claves/consultar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Generar', 'modules_id' => 2, 'url'=>'claves/generar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar', 'modules_id' => 3,'url'=>'clavesEspeciales/consultar', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Directorio', 'modules_id' => 22,'url'=>'proveedores-directorio.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Consultar Afiliados Temporales', 'modules_id' => 2,'url'=>'claves/consultarAfiliadosTemporales', 'order' => 3, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Feriados', 'modules_id' => 23, 'url'=>'feriados.php', 'order' => 1, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Extranet', 'modules_id' => 22, 'url'=>'proveedores', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11'],
['description'=>'Generar', 'modules_id' => 3, 'url'=>'clavesEspeciales/generar', 'order' => 2, 'created_at'=>'2017-03-03 16:34:11']
		];

		DB::table('submodules')->insert($submodules);
    }
}