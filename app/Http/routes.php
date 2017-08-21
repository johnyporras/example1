<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*=====================================================*/
/** Rutas de Login */
Route::auth();

//Envio de correo de prueba
Route::get('/send', 'EmailController@send');

/** Rutas de Inicio */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Generar tarjetas de prueba
Route::get('/generar/tarjetas', [
    'uses' => 'HomeController@generar',
    'as'   => 'page.generar' 
]);
// Mostrar perfil usuario con sus preferencias
Route::get('/my-card/{card}', [
    'uses' => 'HomeController@mycard',
    'as'   => 'page.mycard' 
]);

/** Rutas de Registro  */
/**--------------------------------------------*/

Route::get('/register', [
    'uses' => 'RegisterController@register',
    'as'   => 'register.register' 
]);

Route::post('/check', [
    'uses' => 'RegisterController@check',
    'as'   => 'register.check' 
]);

Route::post('/cuenta', [
    'uses' => 'RegisterController@cuenta',
    'as'   => 'register.cuenta' 
]);

Route::post('/afiliado', [
    'uses' => 'RegisterController@afiliado',
    'as'   => 'register.afiliado' 
]);

Route::post('/registro', [
    'uses' => 'RegisterController@postRegister',
    'as'   => 'register.postRegister' 
]);

Route::post('/pais', [
    'uses' => 'RegisterController@checkTerminos',
    'as'   => 'register.checkTerminos' 
]);

Route::get('/verify/{email}/{confirm_token}', [
    'uses' => 'RegisterController@confirmRegister',
    'as'   => 'register.confirm' 
]);

Route::get('/valido', [
    'uses' => 'RegisterController@valido',
    'as'   => 'register.valido' 
]);

Route::get('/resend/{cuenta}', [
    'uses' => 'RegisterController@resend',
    'as'   => 'register.resend' 
]);

Route::get('/resend/email/{id}', [
    'uses' => 'RegisterController@resendEmail',
    'as'   => 'register.resendEmail' 
]);

/**--------------------------------------------*/

/** Funcion para reloj local */
Route::get('/api/clock', [
        'uses' => 'ClockController@clock',
        'as'   => 'clock.now' 
]);
/**--------------------------------------------*/

/**
* rutas modulo atención al viajero
*/
Route::group(['middleware' => ['auth']], function () {

    // Rutas para la lista de solicitudes
    Route::get('api/solicitudes', 'AviController@solicitudes');
    
    Route::get('avi/lista', [
            'uses' => 'AviController@lista',
            'as'   => 'avi.lista' 
    ]);
    
    Route::get('avi', [
            'uses' => 'AviController@index',
            'as'   => 'avi.index' 
    ]);

    Route::get('avi/create', [
            'uses' => 'AviController@create',
            'as'   => 'avi.create' 
    ]);

    Route::post('avi/store', [
            'uses' => 'AviController@store',
            'as'   => 'avi.store' 
    ]);

    Route::get('avi/{id}/edit', [
            'uses' => 'AviController@edit',
            'as'   => 'avi.edit' 
    ]);

    Route::put('avi/{id}', [
            'uses' => 'AviController@update',
            'as'   => 'avi.update' 
    ]);

    Route::get('avi/{id}', [
            'uses' => 'AviController@show',
            'as'   => 'avi.show' 
    ]);

    Route::get('avi/{id}/destroy', [
            'uses' => 'AviController@destroy',
            'as'   => 'avi.destroy' 
    ]);
    
});
/*=====================================================*/

/*=====================================================*/
/**
 * rutas modulo funerario
 */
Route::group(['middleware' => ['auth']], function () {

    //ruta para descargar archivos modulo funerario
    Route::get('/files/{path}/{file?}', [
        'uses' => 'FunerarioController@files',
        'as'   => 'furnerario.files' 
    ]);

    // Rutas para la lista de solicitudes
    Route::get('api/funerarios', 'FunerarioController@funerarios');

     // rutas para crear las solicitudes
    Route::get('funerario', [
            'uses' => 'FunerarioController@index',
            'as'   => 'funerario.index' 
    ]);

    // rutas para crear las solicitudes
    Route::get('funerario/create', [
            'uses' => 'FunerarioController@create',
            'as'   => 'funerario.create' 
    ]);

    // rutas para eliminar detalle solicitudes
    Route::get('funerario/delete/{id}', [
            'uses' => 'FunerarioController@delete',
            'as'   => 'funerario.delete' 
    ]);

    // rutas para eliminar solicitudes
    Route::get('funerario/{id}/destroy', [
            'uses' => 'FunerarioController@destroy',
            'as'   => 'funerario.destroy' 
    ]);

    Route::get('funerario/lista', [
            'uses' => 'FunerarioController@lista',
            'as'   => 'funerario.lista' 
    ]);

    // Rutas para listar por cada una de la solicitudes
    Route::get('funerario/{id}', [
            'uses' => 'FunerarioController@show',
            'as'   => 'funerario.show' 
    ]);

    //Rutas para editar las solicitudes
    Route::get('funerario/{id}/edit', [
            'uses' => 'FunerarioController@edit',
            'as'   => 'funerario.edit' 
    ]);

    Route::put('funerario/{id}', [
            'uses' => 'FunerarioController@update',
            'as'   => 'funerario.update' 
    ]);

    Route::post('funerario/modify', [
            'uses' => 'FunerarioController@modify',
            'as'   => 'funerario.modify' 
    ]);

    Route::post('funerario/store', [
            'uses' => 'FunerarioController@store',
            'as'   => 'funerario.store' 
    ]);

    Route::post('funerario/store/item', [
            'uses' => 'FunerarioController@save',
            'as'   => 'funerario.save' 
    ]);

});

/**
* rutas modulo Historial Médico
*/
Route::group(['middleware' => ['auth']], function () {

    // Rutas para la lista de solicitudes
    Route::get('api/historiales', 'HistorialMedicoController@historiales');
    
    Route::get('historial/lista', [
            'uses' => 'HistorialMedicoController@lista',
            'as'   => 'historial.lista' 
    ]);
    
    Route::get('historial', [
            'uses' => 'HistorialMedicoController@index',
            'as'   => 'historial.index' 
    ]);

    Route::get('historial/search', [
            'uses' => 'HistorialMedicoController@search',
            'as'   => 'historial.search' 
    ]);

    Route::get('historial/create/{id}', [
            'uses' => 'HistorialMedicoController@create',
            'as'   => 'historial.create' 
    ]);

    Route::post('historial/store', [
            'uses' => 'HistorialMedicoController@store',
            'as'   => 'historial.store' 
    ]);

    Route::get('historial/{id}/edit', [
            'uses' => 'HistorialMedicoController@edit',
            'as'   => 'historial.edit' 
    ]);

    Route::put('historial/{id}', [
            'uses' => 'HistorialMedicoController@update',
            'as'   => 'historial.update' 
    ]);

    Route::get('historial/{id}', [
            'uses' => 'HistorialMedicoController@show',
            'as'   => 'historial.show' 
    ]);

    Route::get('historial/{id}/destroy', [
            'uses' => 'HistorialMedicoController@destroy',
            'as'   => 'historial.destroy' 
    ]);
    
});
/*=====================================================*/
/**
 * rutas para el perfil
 */
Route::group(['middleware' => ['auth']], function () {

    Route::get('calculo', [
        'uses' => 'ProfileController@calculo',
        'as'   => 'perfil.calculo' 
    ]);
    
    Route::get('perfil', [
        'uses' => 'ProfileController@index',
        'as'   => 'perfil.index' 
    ]);

    Route::post('perfil', [
        'uses' => 'ProfileController@editar',
        'as'   => 'perfil.editar' 
    ]);

    Route::post('perfil/image', [
        'uses' => 'ProfileController@image',
        'as'   => 'perfil.image' 
    ]);

    Route::post('perfil/contacto', [
        'uses' => 'ProfileController@contacto',
        'as'   => 'perfil.contacto' 
    ]);

    Route::post('perfil/contacto/edit', [
        'uses' => 'ProfileController@contactoEditar',
        'as'   => 'perfil.contactoEditar' 
    ]);

    Route::get('perfil/contacto/{id}', [
        'uses' => 'ProfileController@contactoDelete',
        'as'   => 'perfil.contactoDelete' 
    ]);

    Route::post('perfil/motivo', [
        'uses' => 'ProfileController@motivo',
        'as'   => 'perfil.motivo' 
    ]);

    Route::post('perfil/motivo/edit', [
        'uses' => 'ProfileController@motivoEditar',
        'as'   => 'perfil.motivoEditar' 
    ]);

    Route::get('perfil/motivo/{id}', [
        'uses' => 'ProfileController@motivoDelete',
        'as'   => 'perfil.motivoDelete' 
    ]);

    Route::post('perfil/medicamento', [
        'uses' => 'ProfileController@medicamento',
        'as'   => 'perfil.medicamento' 
    ]);

    Route::post('perfil/medicamento/edit', [
        'uses' => 'ProfileController@medicamentoEditar',
        'as'   => 'perfil.medicoEditar' 
    ]);

    Route::get('perfil/medicamento/{id}', [
        'uses' => 'ProfileController@medicamentoDelete',
        'as'   => 'perfil.medicoDelete' 
    ]);

    Route::post('perfil/documento', [
        'uses' => 'ProfileController@documento',
        'as'   => 'perfil.documento' 
    ]);

    Route::post('perfil/documento/edit', [
        'uses' => 'ProfileController@documentoEditar',
        'as'   => 'perfil.documentoEditar' 
    ]);

    Route::get('perfil/documento/{id}', [
        'uses' => 'ProfileController@documentoDelete',
        'as'   => 'perfil.documentoDelete' 
    ]);

    //ruta para descargar archivos modulo funerario
    Route::get('file/{file}', [
        'uses' => 'ProfileController@file',
        'as'   => 'profile.file' 
    ]);

    Route::post('perfil/upload', [
        'uses' => 'ProfileController@upload',
        'as'   => 'perfil.upload' 
    ]);

    Route::post('perfil/change', [
        'uses' => 'ProfileController@change',
        'as'   => 'perfil.change' 
    ]);

    Route::post('perfil/codigo', [
        'uses' => 'ProfileController@codigo',
        'as'   => 'perfil.codigo' 
    ]);

});
/*=====================================================*/

Route::group(['middleware' => ['auth']], function () {

    // ++++++++++++++++++++ MENU +++++++++++++++++++++++++++++++++
      
    // USUARIOS
    Route::resource('usuarios', 'UserController');
      
    //CONSULTAR CLAVE ODONTOLOGICA
    Route::get('clavesOdonto/consultar'       , 'ClaveOdontologica\ConsultarController@getFilter');
    Route::get('clavesOdonto/consultarDetalle', 'ClaveOdontologica\ClaveOdontologicaController@show');
    Route::get('clavesOdonto/pdfDetalle'      , 'ClaveOdontologica\ConsultarController@pdfdetalle');
    
    //GENERAR CLAVE DE ATENCION
    Route::get('claves/generar'      , 'ClaveController@generar');
    Route::post('claves/generar'     , 'ClaveController@generar');
    Route::get('claves/generarFinal', 'ClaveController@buscarCobertura');
    Route::get('claves/aceptarClave/{id}/{idprov}', [
            'uses' => 'ClaveController@aceptarClave',
            'as'   => 'claves.aceptar' 
        ]);
    Route::get('claves/rechazarClave/{id}/{idprov}/{tipo}', [
            'uses' => 'ClaveController@rechazarClave',
            'as'   => 'claves.rechazar' 
        ]);
    Route::post('claves/grabarClaveAceptar','ClaveController@aceptarClaveGrabar');
    Route::post('claves/grabarClaveRechazar1','ClaveController@rechazarClaveGrabar1');
    
    Route::post('claves/procesar'    , 'ClaveController@procesarGuardar');
     
    //CONSULTAR CLAVES DE ATENCION
    Route::get('claves/consultar'       , 'ConsultarClaveController@getFilter');
    Route::get('claves/consultarDetalle', 'ConsultarClaveController@show');
    Route::get('claves/pdfDetalle'      , 'ConsultarClaveController@pdfdetalle');
    
    // CONFIRMACION DE CLAVES DE ATENCION
    Route::get('claves/confirmar'          ,'ConfirmarClaveController@getFilter');
    Route::get('claves/verificarClave'     ,'ConfirmarClaveController@show');
    Route::post('claves/procesarConfirmar' ,'ConfirmarClaveController@confirmar');


    // Seguridad
    Route::get('Seguridad/permisos'          ,'PermisosController@index');
    Route::get('Seguridad/leerModulos'       ,'PermisosController@leerModulos');
    Route::get('Seguridad/leerTipoUsuarios'   ,'PermisosController@leerTipoUsuarios');
    Route::get('Seguridad/leerPermisos'   ,'PermisosController@leerPermisos');
    Route::get('Seguridad/incPermiso'   ,'PermisosController@incPermiso');
    Route::get('Seguridad/evalPermiso'   ,'PermisosController@evalPermiso');
    Route::get('Seguridad/nopermiso'   ,'PermisosController@nopermiso');
 
    // CONFIRMACION DE CLAVES DE ATENCION ESPECIAL
    Route::get( 'clavesEspeciales/confirmarEspeciales','ConfirmarClaveEspecialController@getFilter');
    Route::get( 'clavesEspeciales/verificarClave'     ,'ConfirmarClaveEspecialController@show');
    Route::post('clavesEspeciales/procesarConfirmar'  ,'ConfirmarClaveEspecialController@confirmar');
    
    //CONSULTAR CLAVES TEMPORALES
    Route::get('claves/consultarAfiliadosTemporales' , 'ConsultarClaveTemporalController@getFilter');
    Route::get('claves/consultarDetalleClaveTemporal', 'ConsultarClaveTemporalController@show');
    Route::get('claves/pdfDetalleTemporal'           , 'ConsultarClaveTemporalController@pdfdetalle');
    
    //GENERAR CLAVE DE ATENCION ESPECIAL
    Route::get('clavesEspeciales/generar'                       , 'ClaveEspecialesController@generar');
    Route::post('clavesEspeciales/generar'                      , 'ClaveEspecialesController@generar');
    Route::resource('clavesEspeciales/procesarClaveEspeciales'      , 'ClaveEspecialesController@procesarGuardar');
    Route::resource('clavesEspeciales/crearAfiliadosTemporales' , 'AfiliadoTemporalController@crearAfiliadosTemporalesClaveEspecial');
    Route::resource('clavesEspeciales/generarFinalClaveEspeciales'  , 'ClaveEspecialesController@buscarCobertura');


    // AUTORIZACION CLAVE DE ATENCION ESPECIAL
    Route::get('clavesEspeciales/autorizar'    , 'AutorizarClaveEspecialesController@getFilter');
    Route::get('clavesEspeciales/showAfiliados', 'AutorizarClaveEspecialesController@Show');
    Route::post('clavesEspeciales/rechazar'    , 'AutorizarClaveEspecialesController@rechazar');
    Route::get('clavesEspeciales/aprobar'      , 'AutorizarClaveEspecialesController@aprobar');
    
    // AUTORIZACION CLAVE DE ATENCION ESPECIAL TEMPORALES
    Route::get('clavesEspeciales/autorizarTemporales'    , 'AutorizarClaveEspecialesTemporalesController@getFilter');
    Route::get('clavesEspeciales/showAfiliadosTemporales', 'AutorizarClaveEspecialesTemporalesController@Show');
    Route::post('clavesEspeciales/rechazarTemporales'    , 'AutorizarClaveEspecialesTemporalesController@rechazar');
    Route::get('clavesEspeciales/aprobarTemporales'      , 'AutorizarClaveEspecialesTemporalesController@aprobar');
    
    //CONSULTAR CLAVES ESPECIALES
    Route::get('clavesEspeciales/consultar'         , 'ConsultarClaveEspecialesController@getFilter');
    Route::get('clavesEspeciales/consultarDetalle'  , 'ConsultarClaveEspecialesController@show');
    Route::get('clavesEspeciales/consultarDocumento', 'ConsultarClaveEspecialesController@download');
    
    //CONSULTAR CLAVES ESPECIALES TEMPORALES
    Route::get('clavesEspeciales/consultarAfiliadosTemporales'     , 'ConsultarClaveEspecialTemporalController@getFilter');
    Route::get('clavesEspeciales/consultarDetalleEspecialTemporal' , 'ConsultarClaveEspecialTemporalController@show');
    Route::get('clavesEspeciales/consultarDocumentoTemporal'       , 'ConsultarClaveEspecialTemporalController@download');
    
    //AFILIADOS TEMPORALES                                   
    Route::resource('claves/afiliadosTemporales'     , 'AfiliadoTemporalController@generarClave');
    Route::resource('claves/crearAfiliadosTemporales', 'AfiliadoTemporalController@crearAfiliadosTemporales');
   
   //AUTORIZAR AFILIADOS TEMPORALES
    Route::get('claves/autorizarAfiliadosTemporales', 'AutorizarAfiliadosTemporalesController@getFilter');
    Route::get('claves/showAfiliados'               , 'AutorizarAfiliadosTemporalesController@Show');
    Route::post('claves/rechazarAfiliadosTemporales', 'AutorizarAfiliadosTemporalesController@rechazar');
    Route::get('claves/aprobarAfiliadosTemporales'  , 'AutorizarAfiliadosTemporalesController@aprobar');
    
    // PACIENTES ATENDIDOS
//    Route::get('servicios/registrar'           , 'PacienteAtendidoController@registar');
//    Route::post('servicios/buscarServicios'    , 'PacienteAtendidoController@buscarServicios');
//    Route::get('servicios/registrarAtencion'   , 'PacienteAtendidoController@show');
//    Route::post('servicios/registrarAtencion'  , 'PacienteAtendidoController@show');
//    Route::post('servicios/grabar'             , 'PacienteAtendidoController@procesarRegistrar');
    
    // CONSULTAR PACIENTES ATENDIDOS 
//    Route::get('servicios/consultar'         , 'ConsultarPacienteAtendidoController@getFilter');
//    Route::get('servicios/consultarDetalle'  , 'ConsultarPacienteAtendidoController@show');
//    Route::get('servicios/consultarDocumento', 'ConsultarClaveEspecialesController@download');
    
    
    // FACTURACION E INCIDENCIAS
    Route::get('facturacion/registrar'      , 'FacturacionController@gestionar');
    Route::post('facturacion/crear'         , 'FacturacionController@procesar');
    Route::post('facturacion/buscar'        , 'FacturacionController@gestionar');

    // INCIDENCIAS
    Route::get( 'incidencias/consultar'            , 'IncidenciasController@getFilter');
    Route::get( 'incidencias/procesarIncidencias'  , 'IncidenciasController@show');
    Route::post('incidencias/gestionar'           , 'IncidenciasController@gestionar');
    Route::get( 'incidencias/email'                , 'IncidenciasController@emailRechazo');
    
    // AUDITORIA 
    Route::get('auditoria/consultar'              , 'AuditoriaController@getFilter');
    Route::get('auditoria/procesarClavesAtencion' , 'AuditoriaController@show'); 
    Route::get('auditoria/detalleClaveAtencion'   , 'AuditoriaController@detalleClaveAtencion'); 
    Route::get('auditoria/descargarDocumento'     , 'AuditoriaController@download');    
    Route::get('auditoria/aprobar'                , 'AuditoriaController@aprobar');
    Route::get('auditoria/rechazar'                , 'AuditoriaController@rechazar');
    
    // PAGOS
    Route::get('pagos/consultar'            , 'PagosController@getFilter');
    Route::get('pagos/propago'            , 'PagosController@getFilter2');
    Route::get('pagos/actpropago'            , 'ActuaizarProgPagoCotroller@leerProgPago');
    Route::get('pagos/apropago'            , 'AprobarProgPagoCotroller@leerProgPago');
    Route::post('pagos/guardarProg'           , 'PagosController@guardarProg');
    Route::get('pagos/getDetalleProgPago'       , 'ActuaizarProgPagoCotroller@getDetalleProgPago');
    Route::get('pagos/elimDetalleProgPago'       , 'ActuaizarProgPagoCotroller@elimDetalleProgPago');
    Route::get('pagos/getFacturas'       , 'ActuaizarProgPagoCotroller@getFacturas');
    Route::post('pagos/guardarDetProg'       , 'ActuaizarProgPagoCotroller@incDetalleProgPago');
    Route::post('pagos/aprobarProg'       , 'AprobarProgPagoCotroller@aprobarProg');
    Route::post('pagos/aprobarProg'       , 'AprobarProgPagoCotroller@aprobarProg');
    

    // GESTIONAR CLAVE ODONTOLOGICA dontologica\GenerarController@getProveedores');
    Route::get('clavesOdonto/gestionar'            , 'ClaveOdontologica\GenerarController@buscar');
    Route::post('clavesOdonto/buscar'              , 'ClaveOdontologica\GenerarController@buscar');
    Route::post('clavesOdonto/gestionarDos'        , 'ClaveOdontologica\GenerarController@buscarClave');
    Route::resource('clavesOdonto'                 , 'ClaveOdontologica\ClaveOdontologicaController');
    #Route::post('clavesOdonto/gestionarTres'      , 'ClaveOdontologica\GenerarController@gestionarTres');
    Route::post('clavesOdonto/gestionarTres'       , 'ClaveOdontologica\GenerarController@gestionarSecuencia');
    Route::post('clavesOdonto/actualSecuencia'     , 'ClaveOdontologica\GenerarController@actualizarSecuencia');
    Route::get('clavesOdonto/editarSecuencia/{id}' , 'ClaveOdontologica\GenerarController@actualizarFechaAtencion');
    Route::post('clavesOdonto/update'              , 'ClaveOdontologica\GenerarController@updateFechaSecuencia');
    
    // TRATAMIENTO ODONTOLOGICOS   
    Route::get('tratamiento/registrar'                  , 'ClaveOdontologica\TratamientoController@buscar');
    Route::post('tratamiento/buscar'                    , 'ClaveOdontologica\TratamientoController@buscar');
    Route::post('tratamiento/gestionar'                 , 'ClaveOdontologica\TratamientoController@buscarClave');
    Route::post('tratamiento/cargar'                    , 'ClaveOdontologica\TratamientoController@cargarTratamiento');
    Route::post('tratamiento/procesar'                  , 'ClaveOdontologica\TratamientoController@store');
    Route::get('tratamiento/consultar', 'ClaveOdontologica\TratamientoController@buscarPorClave');
    Route::get('tratamiento/editar/{id}/{cedula}'       , 'ClaveOdontologica\TratamientoController@edit');
    Route::post('tratamiento/update/{id}'               , 'ClaveOdontologica\TratamientoController@update');
    Route::post('tratamiento/realizados'                , 'ClaveOdontologica\TratamientoController@getTratamientoSeisMese');  
    Route::get('tratamiento/cerrar', function () {
        return view('clavesOdontologicas.tratamientoOdontologico.cerrar');;
    });
    Route::post('tratamiento/procesarcierre'  , 'ClaveOdontologica\TratamientoController@cerrar');
    
    // CONSULTA DE TRATAMIENTO ODONTOLOGICOS   
    Route::get('tratamiento/consultarTratamiento'       , 'ClaveOdontologica\ConsultarTratamientoController@getClave');
    Route::get('tratamiento/consultaDetalle'            , 'ClaveOdontologica\ConsultarTratamientoController@consultarDetalle');
   
    // CRUDS
    Route::resource('afiliados'  , 'AfiliadoController');
    Route::resource('claves'     , 'ClaveController');
    Route::resource('proveedores', 'ProveedorController');

    // Consultar Ajax
    Route::post('selectColectivos'    , 'Ajax\SelectController@getColectivos');
    Route::post('selectProcedimientos', 'Ajax\SelectController@getProcedimientos');
    Route::post('selectEspecialidades', 'Ajax\SelectController@getEspecialidades');
    Route::post('selectProveedores'   , 'Ajax\SelectController@getProveedores');
    Route::post('getTitular'          , 'Ajax\SelectController@getTitular');
    Route::post('selectHistorico',      'Ajax\SelectController@getHistorico');
    
    Route::get('/server/php/', function () {
        return view('server.php.index.php');
    });

});
//Archivo XML
Route::get('dataXml', 'GenerateXmlController@getData');
Route::get('procesarResponseXml', 'GenerateXmlController@procesarResponseXml');