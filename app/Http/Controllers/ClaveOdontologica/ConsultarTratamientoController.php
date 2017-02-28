<?php

namespace App\Http\Controllers\ClaveOdontologica;

use DB;
use Session;
use Zofe;
use Carbon\Carbon;
use App\Models\AcClaveOdontologica;
use App\Models\AcAfiliado;
use App\Models\AcAseguradora;
use App\Models\AcTipoControl;
use App\Models\AcColectivo;
use App\Models\AcEstatus;
use App\Models\UserType;
use App\Models\AcTratamientoOdontologico;
use App\Models\AcProveedoresExtranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConsultarTratamientoController extends Controller{

    public function getClave(){
       $user = \Auth::user();
        // Analista Proveedor   
        if ($user->type == 3){
           $query = DB::table('ac_clave_odontologica')
               ->where('codigo_proveedor_creador','=',$user->proveedor)
                ->join('ac_tratamiento_odontologico', 'ac_clave_odontologica.id',"=",'ac_tratamiento_odontologico.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_clave_odontologica.cedula_afiliado')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_clave_odontologica.estatus')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_clave_odontologica.codigo_proveedor_creador')  
                ->select('ac_clave_odontologica.id as id',
                         'ac_clave_odontologica.fecha_atencion1 as fecha_atencion',
                         'ac_clave_odontologica.cedula_afiliado',
                         'ac_clave_odontologica.clave as clave',
                         'ac_afiliados.nombre as nombre_afiliado',
                         'ac_estatus.nombre as estatus',
                         'ac_proveedores_extranet.nombre as proveedor',
                         'ac_estatus.nombre as estatus'
                        )
                  ->distinct();
        }elseif ($user->type == 4){ // Analista Aseguradora  
            $query = DB::table('ac_clave_odontologica')
                ->where('codigo_proveedor_creador','=',$user->proveedor)
                ->join('ac_tratamiento_odontologico', 'ac_clave_odontologica.id',"=",'ac_tratamiento_odontologico.id_clave')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_clave_odontologica.cedula_afiliado')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_clave_odontologica.estatus')
                ->join('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_clave_odontologica.codigo_proveedor_creador')
                ->select('ac_clave_odontologica.id as id',
                         'ac_clave_odontologica.fecha_atencion1 as fecha_atencion',
                         'ac_clave_odontologica.cedula_afiliado',
                         'ac_clave_odontologica.clave as clave',
                         'ac_afiliados.nombre as nombre_afiliado',
                         'ac_estatus.nombre as estatus',
                         'ac_proveedores_extranet.nombre as proveedor'
                        )
                     ->distinct();
        }else{        
            //                ->join('ac_tratamiento_odontologico','ac_clave_odontologica.id',"=",'ac_tratamiento_odontologico.id_clave')
            $query = DB::table('ac_clave_odontologica')
                ->join('ac_afiliados'              , 'ac_afiliados.cedula',"=", 'ac_clave_odontologica.cedula_afiliado')
                ->join('ac_estatus'                , 'ac_estatus.id',"=",'ac_clave_odontologica.estatus')
                ->leftjoin('ac_proveedores_extranet'   , 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_clave_odontologica.codigo_proveedor_creador')
                ->select('ac_clave_odontologica.id as id',
                         'ac_clave_odontologica.fecha_atencion1 as fecha_atencion',
                         'ac_clave_odontologica.cedula_afiliado',
                         'ac_clave_odontologica.clave as clave',
                         'ac_afiliados.nombre as nombre_afiliado',
                         'ac_estatus.nombre as estatus',
                         'ac_proveedores_extranet.nombre as proveedor'
                        ) 
                     ->distinct();
        }
        $filter = \DataFilter::source($query);   
        $filter->add('ac_afiliados.nombre','Nombre', 'text'); //validation;        
        $filter->add('ac_clave_odontologica.cedula_afiliado','C.I.','number');//validation;        
        $filter->add('ac_proveedores_extranet.codigo_proveedor','Seleccione una Opción','select')->option('','Seleccione Una Opción')->options(AcProveedoresExtranet::lists('nombre', 'codigo_proveedor')->all()); 
        $filter->add('ac_clave_odontologica.clave','Clave', 'text');
        $filter->add('ac_estatus.id','Seleccione una opcion ','select')->option('','Seleccione Una Opción')->options(AcEstatus::lists('altocentro.ac_estatus.nombre', 'id')->all());         
        $filter->submit('Buscar');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $url = new Zofe\Rapyd\Url();
        $grid->link($url->append('export',1)->get(),"Exportar a Excel", "TR");

        $grid->attributes(array("class"=>"table table-grid"));
        $grid->add('id','ID',false);
        $grid->add('fecha_atencion|strtotime|date[d/m/Y]','Fecha Atención', false);
        $grid->add('clave','Clave', false);   
        $grid->add('cedula_afiliado','Cédula', false);
        $grid->add('nombre_afiliado','Paciente', false);
        $grid->add('estatus','Estatus', false);
        $grid->add('proveedor','Proveedor', false);
        $grid->addActions('/altocentro/public/tratamiento/consultaDetalle', 'Ver','show','id');
     
        if (isset($_GET['export'])){      
            return $grid->buildCSV('clavesOdonto','.Y-m-d.His');
        }else{
            $grid->paginate(10);
            return  view('clavesOdontologicas.tratamientoOdontologico.consultarTratamiento', compact('filter','grid'));
        }
    }
    
    public function consultarDetalle(Request $request)
    {
        $tratamiento = AcTratamientoOdontologico::where('id_clave', '=', $request->input('show'))->get();
        if ($tratamiento->isEmpty()){
            Session::flash('message', 'La clave seleccionada no posee tratamiento cargado, debe procesar un tratamiento!');
            return view('clavesOdontologicas.tratamientoOdontologico.buscar');
        }

        $claveOdontologica = AcClaveOdontologica::where('id','=',$request->input('show'))->get();
        
        foreach ($claveOdontologica as $clave){
            $cedulaAfiliado = $clave['cedula_afiliado'];
        }
        
        $generarController = new GenerarController();
        $beneficiario = $generarController->getBeneficiario($cedulaAfiliado);
        
        $tratamientos = AcTratamientoOdontologico::where('id_clave', '=', $request->input('show'))
            ->Join('ac_procedimientos_medicos', 'ac_procedimientos_medicos.id', '=', 'ac_tratamiento_odontologico.id_procedimiento')
            ->Join('ac_clave_odontologica', 'ac_clave_odontologica.id', '=', 'ac_tratamiento_odontologico.id_clave')
            ->Join('ac_ubicacion_tratamiento', 'ac_ubicacion_tratamiento.id', '=', 'ac_tratamiento_odontologico.id_ubicacion')
            ->Join('ac_estatus_detalle', 'ac_estatus_detalle.id', '=', 'ac_tratamiento_odontologico.estatus')
            ->Join('ac_diente', 'ac_diente.id', '=', 'ac_tratamiento_odontologico.id_diente')
            ->select('ac_tratamiento_odontologico.*','ac_procedimientos_medicos.tipo_examen', 'ac_clave_odontologica.clave', 'ac_diente.descripcion',
                'ac_ubicacion_tratamiento.descripcion as cara', 'ac_estatus_detalle.nombre as estatus', 'ac_clave_odontologica.estatus as estatus_clave')
            ->get();

        return view('clavesOdontologicas.tratamientoOdontologico.consultaDetalle', compact('tratamientos', 'beneficiario')); 

    }
    
}