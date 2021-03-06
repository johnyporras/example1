<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\AcClave;
use App\Models\AcAfiliado;
use App\Models\AcProveedoresExtranet;
use App\Models\AcAseguradora;
use App\Models\UserType;
use App\Lib\functions;

use DB;
use Session;

class ConfirmarClaveController extends Controller
{

 public function getFilter(Request $request)
 {
   $user = \Auth::user();
   // Analista Proveedor

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
                         'ac_estatus.nombre as estatus' )
               ->distinct();*/

          $query = DB::table('ac_claves')
          ->where([['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00'], ['ac_claves.estatus_clave', '=', 5]])
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
                ->where([['users.detalles_usuario_id','=',$user->id], ['ac_contratos.fecha_inicio','<=',date('Y-m-d').' 00:00:00'],['ac_contratos.fecha_fin','>=',date('Y-m-d').' 00:00:00'], ['ac_claves.estatus_clave', '=', 5]])
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
                ->where([['users.detalles_usuario_id','=',$user->detalles_usuario_id], ['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00'],['ac_claves.estatus_clave', '=', 5]])
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
                ->where([['ac_cuenta.fecha','<=',date('Y-m-d').' 00:00:00'],['ac_claves.estatus_clave', '=', 5]])
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






         if($request->nombre!="")
        {
                $query=$query->whereRaw("upper(ac_afiliados.nombre) like upper('%".$request->nombre."%')");
        }

        if($request->cedula_afiliado!="")
        {
                $query=$query->where("ac_afiliados.cedula","like",'%'.$request->cedula_afiliado.'%');
        }


        if($request->fechadesde!="" && $request->fechahasta!="")
        {
                $request->fechahasta = functions::uf_convertirdatetobd($request->fechahasta);
                $request->fechadesde = functions::uf_convertirdatetobd($request->fechadesde);
                $query=$query->whereRaw("fecha_cita between '{$request->fechadesde}' and '{$request->fechahasta}'");
        }





       /* $filter = \DataFilter::source($query);
        $filter->add('ac_claves.fecha_cita','Fecha Cita','daterange');
        $filter->add('ac_claves.cedula_afiliado','C.I.','number');//validation;
        $filter->add('ac_afiliados.nombre','Nombre', 'text'); //validation;
        $filter->add('ac_aseguradora.codigo_aseguradora','Seleccione una Opción','select')->option('','Seleccione Una Opción')->options(AcAseguradora::lists('nombre', 'codigo_aseguradora')->all());
        $filter->submit('Buscar');
        $filter->reset('reset');
        $filter->build();*/





        $filter=$query->get();
       $grid = \DataGrid::source($filter);
       $grid->attributes(array("class"=>"table table-grid"));
       $grid->add('id','ID',false);
       $grid->add('fecha_citas|strtotime|date[d/m/Y]','Fecha Cita', false);
       $grid->add('cedula_afiliado','Cédula', false);
       $grid->add('nombre_afiliado','Nombre Afiliado', false);
       $grid->addActions(url('/claves/verificarClave'), 'Confirmar','show','id');
       $grid->paginate(10);
       return  view('claves.confirmarClave', compact('filter','grid'));
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
                     ->join('ac_afiliados', 'ac_afiliados.cedula',"=", 'ac_claves.cedula_afiliado')
                    ->select('ac_claves.cedula_afiliado as cedula_afiliado',
                             'ac_claves.id as id_clave',
                             'ac_afiliados.nombre as nombre' ,
                             'ac_afiliados.apellido as apellido'
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
            return view('claves.procesarConfirmar', compact('clave','clave_detalle'));
         }
     }
    public function confirmar(Request $request){
        try {
            $clave = DB::table('ac_claves')
            ->where('clave', $request->clave)
            ->update(['estatus_clave' => 3]);
            if ($clave == 0){
               Session::flash('message', 'Clave No Encontrada !');
            }else{
                   Session::flash('message', 'Clave ´Aprobada !');
            }
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            Session::flash('message', 'Clave No Encontrada !');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('message', 'Clave No Encontrada !');
        }catch (Exception $e) {
            Session::flash('message', 'Clave No Encontrada !');
        }
        return redirect('claves/confirmar');
    }
}
