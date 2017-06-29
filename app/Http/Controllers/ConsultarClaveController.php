<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\AcClave;
use App\Models\AcAfiliado;
use App\Models\AcProveedoresExtranet;
use App\Models\AcEstatus;
use App\Models\AcAseguradora;
use App\Models\AcColectivo;
use App\Models\AcEspecialidadesExtranet;
use App\Models\AcContrato;
use App\Models\UserType;
use App\Lib\functions;
use DB;
use Zofe;

class ConsultarClaveController extends Controller
{

 public function getFilter(Request $request)
 {

   $user = \Auth::user();
   // Analista Proveedor
   if ($user->type == 3){
      /*  $query = DB::table('ac_claves')
                ->where([['users.id','=',$user->id], ['ac_claves.estatus_clave', '!=', 5],
                     ['ac_contratos.fecha','<=',date('Y-m-d').' 00:00:00']])
                ->join('ac_claves_detalle'         , 'ac_claves.id',"=",'ac_claves_detalle.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                ->join('ac_contratos'              , 'ac_afiliados.cedula',"=", 'ac_cuenta.cedula_titular')
                ->join('ac_planes_extranet'        , 'ac_planes_extranet.codigo_plan',"=", 'ac_cuenta.id_plan')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_claves.estatus_clave')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                ->join('users'                     , 'users.proveedor' ,'=','ac_proveedores_extranet.codigo_proveedor')
                ->join('user_types'                , 'users.type','=','user_types.id')
                ->select('ac_claves.id as id',
                         'ac_claves.fecha_cita as fecha_citas',
                         'ac_claves.cedula_afiliado',
                         'ac_claves.clave as clave',
                         'ac_afiliados.nombre as nombre_afiliado',
                         'ac_planes_extranet.nombre as plan',
                         'ac_estatus.nombre as estatus',
                         'ac_especialidades_extranet.descripcion as especialidad',
                         'ac_proveedores_extranet.nombre as proveedor',
                         'ac_estatus.nombre as estatus' )cccfdfdf
               ->distinct();*/

			   	$query = DB::table('ac_claves')
			   	->where([['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00'], ['ac_claves.estatus_clave', '!=', 5]])
                ->where("ac_proveedores_extranet.codigo_proveedor","=",$user->detalles_usuario_id)
			   	->join('ac_claves_detalle'         , 'ac_claves.id',"=",'ac_claves_detalle.id_clave')
			   	->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
			   	->join('ac_cuenta'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuenta.id')
                ->join('ac_cuentaplan'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuentaplan.id_cuenta')
			   	->join('ac_planes_extranet'        , 'ac_cuentaplan.id_plan',"=", 'ac_planes_extranet.codigo_plan')
			   	->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_claves.estatus_clave')
			   	->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
			   	->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
			   	->select('ac_claves.id as id',
			   			'ac_claves.fecha_cita as fecha_citas',
			   			'ac_claves.cedula_afiliado',
			   			'ac_claves.clave as clave',
			   			'ac_afiliados.nombre as nombre_afiliado',
			   			'ac_planes_extranet.nombre as plan',
			   			'ac_estatus.nombre as estatus',
			   			'ac_especialidades_extranet.descripcion as especialidad',
			   			'ac_proveedores_extranet.nombre as proveedor',
			   			'ac_estatus.nombre as estatus'
			   			)
			   			->distinct();

   }elseif ($user->type == 4) // Analista Aseguradora
     {
        $query = DB::table('ac_claves')
                ->where([['users.detalles_usuario_id','=',$user->id], ['ac_contratos.fecha_inicio','<=',date('Y-m-d').' 00:00:00'],['ac_contratos.fecha_fin','>=',date('Y-m-d').' 00:00:00'] ])
                ->join('ac_claves_detalle'         , 'ac_claves.id',"=",'ac_claves_detalle.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                ->join('ac_cuenta'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuenta.id')
                ->join('ac_cuentaplan'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuentaplan.id_cuenta')
                ->join('ac_planes_extranet'        , 'ac_cuentaplan.id_plan',"=", 'ac_planes_extranet.codigo_plan')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_claves.estatus_clave')
                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                ->select('ac_claves.id as id',
                        'ac_claves.fecha_cita as fecha_citas',
                        'ac_claves.cedula_afiliado',
                        'ac_claves.clave as clave',
                        'ac_afiliados.nombre as nombre_afiliado',
                        'ac_planes_extranet.nombre as plan',
                        'ac_estatus.nombre as estatus',
                        'ac_especialidades_extranet.descripcion as especialidad',
                        'ac_proveedores_extranet.nombre as proveedor',
                        'ac_estatus.nombre as estatus'
                        )
                ->distinct();

   }elseif ($user->type == 5) // afiñoado
     {


        $query = DB::table('ac_claves')
                ->where([['users.detalles_usuario_id','=',$user->detalles_usuario_id], ['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00']])
                ->join('ac_claves_detalle'         , 'ac_claves.id',"=",'ac_claves_detalle.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                ->join('ac_cuenta'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuenta.id')
                ->join('ac_cuentaplan'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuentaplan.id_cuenta')
                ->join('ac_planes_extranet'        , 'ac_cuentaplan.id_plan',"=", 'ac_planes_extranet.codigo_plan')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_claves.estatus_clave')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                    ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                ->join('users' ,'ac_afiliados.id','=','users.detalles_usuario_id')
                ->select('ac_claves.id as id',
                        'ac_claves.fecha_cita as fecha_citas',
                        'ac_claves.cedula_afiliado',
                        'ac_claves.clave as clave',
                        'ac_afiliados.nombre as nombre_afiliado',
                        'ac_planes_extranet.nombre as plan',
                        'ac_estatus.nombre as estatus',
                        'ac_especialidades_extranet.descripcion as especialidad',
                        'ac_proveedores_extranet.nombre as proveedor',
                        'ac_estatus.nombre as estatus'
                        )
                ->distinct();





     }else{
         $query = DB::table('ac_claves')
                ->where([['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00']])
                ->join('ac_claves_detalle'         , 'ac_claves.id',"=",'ac_claves_detalle.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                ->join('ac_cuenta'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuenta.id')
                ->join('ac_cuentaplan'              , 'ac_afiliados.id_cuenta',"=", 'ac_cuentaplan.id_cuenta')
                ->join('ac_planes_extranet'        , 'ac_cuentaplan.id_plan',"=", 'ac_planes_extranet.codigo_plan')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_claves.estatus_clave')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                ->select('ac_claves.id as id',
                         'ac_claves.fecha_cita as fecha_citas',
                         'ac_claves.cedula_afiliado',
                         'ac_claves.clave as clave',
                         'ac_afiliados.nombre as nombre_afiliado',
                         'ac_planes_extranet.nombre as plan',
                         'ac_estatus.nombre as estatus',
                         'ac_especialidades_extranet.descripcion as especialidad',
                         'ac_proveedores_extranet.nombre as proveedor',
                         'ac_estatus.nombre as estatus'
                        )
                 ->distinct();
        }




        $prov=AcProveedoresExtranet::lists('ac_proveedores_extranet.nombre','ac_proveedores_extranet.codigo_proveedor as id')->all();
        $estatus=AcEstatus::lists('ac_estatus.nombre','id')->all();
        if($request->nombre!="")
        {
                $query=$query->whereRaw("upper(ac_afiliados.nombre) like upper('%".$request->nombre."%')");
        }


        if($user->type==5)
        {
             $query=$query->whereRaw("ac_estatus.id in(1,3,4,5)");
        }


        if($request->cedula_afiliado!="")
        {
                $query=$query->where("ac_afiliados.cedula","like",'%'.$request->cedula_afiliado.'%');
        }


//echo
        if($request->codestatus!="")
        {
                $query=$query->where("estatus_clave","=",$request->codestatus);
        }

        if($request->proveedor!="")
        {
                $query=$query->where("ac_claves_detalle.codigo_proveedor","=",$request->proveedor);
        }

        if($request->clave!="")
        {
                $query=$query->where("ac_claves.clave","=",$request->clave);
        }



        if($request->fechadesde!="" && $request->fechahasta!="")
        {
                $request->fechahasta = functions::uf_convertirdatetobd($request->fechahasta);
                $request->fechadesde = functions::uf_convertirdatetobd($request->fechadesde);
                $query=$query->whereRaw("fecha_cita between '{$request->fechadesde}' and '{$request->fechahasta}'");
        }

       /* $filter = \DataFilter::source($query);
        $filter->add('ac_claves.fecha_cita','Fecha Cita','daterange');
        $filter->add('ac_afiliados.nombre','Nombre', 'text'); //validation;
        $filter->add('ac_claves.cedula_afiliado','C.I.','number');//validation;
        $filter->add('ac_claves.clave','Clave', 'text');
        $filter->add('ac_estatus.id','Seleccione una opcion ','select')->option('','Seleccione Una Opción')->options(AcEstatus::lists('ac_estatus.nombre', 'id')->all());
        $filter->add('user_types.id','Seleccione una opcion ','select')->option('','Seleccione Una Opción')->options(UserType::lists('user_types.name', 'id')->all());
        $filter->add('ac_proveedores_extranet.id','Seleccione una opcion ','select')->option('','Seleccione Una Opción')->options(AcProveedoresExtranet::lists('ac_proveedores_extranet.nombre', 'id')->all());
        $filter->submit('Buscar');
        $filter->reset('reset');
        $filter->build();*/
       $query=$query->get();

       $grid = \DataGrid::source($query);
       $url = new Zofe\Rapyd\Url();
       $grid->link($url->append('export',1)->get(),"Exportar a Excel", "TR");

       $grid->attributes(array("class"=>"table table-grid"));
       $grid->add('id','ID',false);
       $grid->add('fecha_citas|strtotime|date[d/m/Y]','Fecha Cita', false);



    /*if($user->type!=3 || $user->type!=5)
    {
        $grid->add('clave','Clave', false);
    }
    else
    {*/
        $grid->add('clave','Clave')->cell( function( $value,$row){
           // dd($user->type);
            if($row->estatus==5 || $row->estatus==1)
                return "Por Asignar";
            else
              return $value;
          //  return ($value != '') ? "rev.{$value}" : "no revisions for art. {$row->id}";
        });
    //}


       $grid->add('cedula_afiliado','Cédula', false);
       $grid->add('nombre_afiliado','Paciente', false);
       $grid->add('especialidad','Especialidad', false);
       // $grid->add('AcProcedimientosMedico.tipo_examen','Procedimiento', true);
       $grid->add('estatus','Estatus', false);
       $grid->add('proveedor','Proveedor', false);
       $grid->addActions(url('/claves/consultarDetalle'), 'Ver','show','id');

       if (isset($_GET['export'])){
            return $grid->buildCSV('clavesAtencion','.Y-m-d.His');
        }else{
            $grid->paginate(10);
            $claves = array();
            $claves = compact($grid);
            $clavesOtorgadas = $this->clavesOtorgadas($claves); // Otorgadas
            foreach ($clavesOtorgadas as $clave) {
                   $claves['otorgadas'] = $clave->cuantos;
            }
            $clavesAprobadas = $this->clavesEstatus(3);// Aprobadas
            foreach ($clavesAprobadas as $clave) {
                   $claves['aprobadas'] = $clave->cuantos;
            }
            $clavesAprobadas = $this->clavesEstatus(4);// Rechazado
            foreach ($clavesAprobadas as $clave) {
                   $claves['rechazadas'] = $clave->cuantos;
            }
            $servicio = $this->clavesDetalleEstatus(1);// Comsulta
            foreach ($servicio  as $servicios) {
                   $claves['consultas'] = $servicios->cuantos;
            }
            $servicio = $this->clavesDetalleEstatus(2);// Laboratorio
            foreach ($servicio  as $servicios) {
                   $claves['laboratorios'] = $servicios->cuantos;
            }
            $servicio = $this->clavesDetalleEstatus(3);// Estudio
            foreach ($servicio  as $servicios) {
                   $claves['estudios'] = $servicios->cuantos;
            }
           // print_r($claves);
            return  view('claves.consultarClave', compact('filter','grid','claves','estatus','prov'));
        }
    }

  public function show(Request $request, $id_clave='')
    {
    if (empty($clave)){
       $id['clave'] = $request->input('show');
    }else{
        $id['clave'] = $id_clave;
    }
      if (isset($id['clave'])){
            $clave  = DB::table('ac_claves')
                    ->where([['ac_claves.id', '=', $id['clave']]])
                     ->join('ac_afiliados'     , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                     //->join('ac_tipo_afiliado' , 'ac_afiliados.tipo_afiliado',"=", 'ac_tipo_afiliado.id')
                     ->leftJoin('ac_cuenta'     , 'ac_cuenta.id',"=",'ac_afiliados.id_cuenta')
                     ->join('ac_estatus'       , 'ac_estatus.id',"=", 'ac_claves.estatus_clave')
                    ->select('ac_claves.cedula_afiliado as cedula_afiliado',
                             'ac_claves.id as id_clave',
                             //'ac_tipo_afiliado.nombre as tipo_afiliado',
                             'ac_afiliados.nombre as nombre' ,
                             'ac_afiliados.apellido as apellido',
                             'ac_afiliados.fecha_nacimiento as fecha_nacimiento',
                             'ac_afiliados.email as email',
                             'ac_afiliados.sexo as sexo',
                             'ac_claves.telefono as telefono',

                             'ac_afiliados.nombre as nombre_titular' ,


                             'ac_claves.clave as clave',
                             'ac_claves.codigo_contrato as contrato',
                             'ac_claves.fecha_cita as fecha_cita',
                             'ac_claves.motivo as motivo',
                             'ac_claves.observaciones as observaciones',
                             'ac_estatus.nombre as estatus'
                            )
                    ->get(); // +++++++ array(StdClass)

            $clave_detalle  = DB::table('ac_claves')
                    ->where([['ac_claves.id', '=', $id['clave']]])
                     ->join('ac_claves_detalle', 'ac_claves_detalle.id_clave',"=", 'ac_claves.id')
                     ->join('ac_servicios_extranet', 'ac_servicios_extranet.codigo_servicio',"=", 'ac_claves_detalle.codigo_servicio')
                     ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                     ->join('ac_procedimientos_medicos', 'ac_procedimientos_medicos.id',"=", 'ac_claves_detalle.id_procedimiento')
                     ->join('ac_proveedores_extranet', 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                    ->select('ac_servicios_extranet.descripcion as servicio',
                             'ac_especialidades_extranet.descripcion as especialidad',
                             'ac_procedimientos_medicos.tipo_examen as procedimiento',
                             'ac_proveedores_extranet.nombre as proveedor',
                             'ac_claves_detalle.costo as costo',
                             'ac_claves_detalle.detalle as detalle'
                            )
                    ->get(); // +++++++ array(StdClass)
            return view('claves.consultarDetalle', compact('clave','clave_detalle'));
         }
     }

  public function pdfdetalle(Request $request)
    {
      $id['clave'] = $request->id_clave;
      if (isset($id['clave'])){
            $clave  = DB::table('ac_claves')
                    ->where([['ac_claves.id', '=', $id['clave']]])
                     ->join('ac_afiliados'     , 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                    // ->join('ac_tipo_afiliado' , 'ac_afiliados.tipo_afiliado',"=", 'ac_tipo_afiliado.id')
                     ->leftJoin('ac_cuenta'     , 'ac_cuenta.id',"=",'ac_afiliados.id_cuenta')
                     //->join('ac_colectivos'    , 'ac_colectivos.codigo_colectivo',"=", 'ac_contratos.codigo_colectivo')
                     //->join('ac_aseguradora'   , 'ac_aseguradora.codigo_aseguradora',"=", 'ac_colectivos.codigo_aseguradora')
                     ->join('ac_estatus'       , 'ac_estatus.id',"=", 'ac_claves.estatus_clave')
                    ->select('ac_claves.cedula_afiliado as cedula_afiliado',
                             'ac_claves.id as id_clave',
                            // 'ac_tipo_afiliado.nombre as tipo_afiliado',
                             'ac_afiliados.nombre as nombre' ,
                             'ac_afiliados.apellido as apellido',
                             'ac_afiliados.fecha_nacimiento as fecha_nacimiento',
                             'ac_afiliados.email as email',
                             'ac_afiliados.sexo as sexo',
                             'ac_claves.telefono as telefono',

                             'ac_afiliados.nombre as nombre_titular' ,
                            // 'ac_aseguradora.nombre as aseguradora',

                             'ac_claves.clave as clave',
                             'ac_claves.codigo_contrato as contrato',
                             'ac_claves.fecha_cita as fecha_cita',
                             'ac_claves.motivo as motivo',
                             'ac_claves.observaciones as observaciones',
                             'ac_estatus.nombre as estatus'
                            )
                    ->get(); // +++++++ array(StdClass)

            $clave_detalle  = DB::table('ac_claves')
                    ->where([['ac_claves.id', '=', $id['clave']]])
                     ->join('ac_claves_detalle', 'ac_claves_detalle.id_clave',"=", 'ac_claves.id')
                     ->join('ac_servicios_extranet', 'ac_servicios_extranet.codigo_servicio',"=", 'ac_claves_detalle.codigo_servicio')
                     ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_claves_detalle.codigo_especialidad')
                     ->join('ac_procedimientos_medicos', 'ac_procedimientos_medicos.id',"=", 'ac_claves_detalle.id_procedimiento')
                     ->join('ac_proveedores_extranet', 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_claves_detalle.codigo_proveedor')
                    ->select('ac_servicios_extranet.descripcion as servicio',
                             'ac_especialidades_extranet.descripcion as especialidad',
                             'ac_procedimientos_medicos.tipo_examen as procedimiento',
                             'ac_proveedores_extranet.nombre as proveedor',
                             'ac_claves_detalle.costo as costo',
                             'ac_claves_detalle.detalle as detalle'
                            )
                    ->get(); // +++++++ array(StdClass)

            $view =  \View('claves.pdf.consultarDetalle', compact('clave','clave_detalle'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            if ($request->accion == 'imprimir'){
                return $pdf->stream('consultarDetalle');
            }elseif ($request->accion == 'descargar'){
               return $pdf->download('consultarDetalle');
            }
         }
     }

 public function clavesOtorgadas($arreglo)
 {
    //print('entre a claves ootorgadas');
    //print_r($arreglo);
   $user = \Auth::user();
   if ($user->type == 3){
       $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle,'
               . '                               ac_proveedores_extranet,'
               . '                               users,'
               . '                               user_types'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave '
               . '                      AND ac_proveedores_extranet.codigo_proveedor = ac_claves_detalle.codigo_proveedor '
               . '                      AND users.detalles_usuario_id = ac_proveedores_extranet.codigo_proveedor '
               . '                      AND users.type  = user_types.id'
               . '                      AND users.id    = :usuario)', array('usuario' => $user->id));
   }elseif ($user->type == 4) // Analista Aseguradora
     {
              $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle,'
               . '                               ac_aseguradora.codigo_aseguradora,'
               . '                               users,'
               . '                               user_types'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave '
               . '                      AND ac_aseguradora.codigo_aseguradora = ac_claves_detalle.codigo_aseguradora'
               . '                      AND users.detalles_usuario_id = ac_aseguradora.codigo_aseguradora '
               . '                      AND users.type  = user_types.id'
               . '                      AND users.id    = :usuario)', array('usuario' => $user->id));
   }else{
          $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave )' );
       }
           return $query;
  }

  public function clavesEstatus($estatus)
 {
   $user = \Auth::user();
   if ($user->type == 3){
       $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE ac_claves.estatus_clave = :estatus'
               . '                      AND EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle,'
               . '                               ac_proveedores_extranet,'
               . '                               users,'
               . '                               user_types'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave '
               . '                      AND ac_proveedores_extranet.codigo_proveedor = ac_claves_detalle.codigo_proveedor '
               . '                      AND users.detalles_usuario_id =  ac_proveedores_extranet.codigo_proveedor '
               . '                      AND users.type  = user_types.id'
               . '                      AND users.id    = :usuario)', array('usuario' => $user->id, 'estatus'=> $estatus));
   }elseif ($user->type == 4) // Analista Aseguradora
     {
       $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE ac_claves.estatus_clave = :estatus'
               . '                      AND EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle,'
               . '                               ac_aseguradora,'
               . '                               users,'
               . '                               user_types'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave '
               . '                      AND ac_aseguradora.codigo_aseguradora = ac_claves_detalle.codigo_aseguradora '
               . '                      AND users.detalles_usuario_id =   ac_aseguradora.codigo_aseguradora '
               . '                      AND users.type  = user_types.id'
               . '                      AND users.id    = :usuario)', array('usuario' => $user->id, 'estatus'=> $estatus));
   }else{
        $query = DB::select('SELECT count(*) as cuantos FROM '
               . '                      ac_claves '
               . '                    WHERE ac_claves.estatus_clave = :estatus'
               . '                      AND EXISTS (SELECT 1'
               . '                          FROM ac_claves_detalle'
               . '                    WHERE ac_claves.id = ac_claves_detalle.id_clave)', array('estatus'=> $estatus));
        }
      return $query;
    }

  public function clavesDetalleEstatus($servicio)
 {
   $user = \Auth::user();
   if ($user->type == 3){
       $query = DB::select('SELECT count(*) as cuantos'
               . '            FROM ac_claves_detalle,'
               . '                 ac_proveedores_extranet,'
               . '                 users,'
               . '                 user_types'
               . '           WHERE ac_proveedores_extranet.codigo_proveedor = ac_claves_detalle.codigo_proveedor '
               .'              AND ac_claves_detalle.codigo_servicio = :servicio'
               . '             AND users.detalles_usuario_id = ac_proveedores_extranet.codigo_proveedor '
               . '             AND users.type  = user_types.id'
               . '             AND users.id    = :usuario', array('usuario' => $user->id, 'servicio'=> $servicio));
   }elseif ($user->type == 4) // Analista Aseguradora
     {
              $query = DB::select('SELECT count(*) as cuantos'
               . '            FROM ac_claves_detalle,'
               . '                 ac_aseguradora,'
               . '                 users,'
               . '                 user_types'
               . '           WHERE ac_aseguradora.codigo_aseguradora = ac_claves_detalle.codigo_aseguradora '
               .'              AND ac_claves_detalle.codigo_servicio = :servicio'
               . '             AND users.detalles_usuario_id = ac_aseguradora.codigo_aseguradora '
               . '             AND users.type  = user_types.id'
               . '             AND users.id    = :usuario', array('usuario' => $user->id, 'servicio'=> $servicio));

   }else{
              $query = DB::select('SELECT count(*) as cuantos'
               . '            FROM ac_claves_detalle'
               . '           WHERE ac_claves_detalle.codigo_servicio = :servicio', array('servicio'=> $servicio));
        }
      return $query;
    }

}
