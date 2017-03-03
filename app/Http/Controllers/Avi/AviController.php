<?php

namespace App\Http\Controllers\Avi;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Session;
use Carbon\Carbon;
use App\User;
use App\Models\AcAfiliado;


class AviController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function generar(Request $request){

        if(isset($request->cedula)){
            if(empty($request->cedula)){
                return redirect()->back()->withInput()->with('message', 'El campo cédula es obligatorio.');
            }else{
                try{
                    $this->validate($request,['cedula' => 'required|numeric|']);                    
                    $afiliadoIni = AcAfiliado::where('cedula', '=', $request->cedula)->firstOrFail();
                }catch(ModelNotFoundException $e){  // catch(Exception $e) catch any exception
                    //dd(get_class_methods($e)); // lists all available methods for exception object
                    $tipoAfiliado = \App\Models\AcTipoAfiliado::pluck('nombre', 'id')->toArray();
                    $estado = \App\Models\AcEstado::pluck('es_desc', 'es_id')->toArray();
                    $aseguradora = \App\Models\AcAseguradora::pluck('nombre', 'codigo_aseguradora')->toArray();    
                    try{
                        $afiliadosTemporale = AcAfiliadoTemporal::where('cedula', '=', $request->cedula)->firstOrFail();
                        $colectivo = \App\Models\AcColectivo::pluck('nombre', 'codigo_colectivo')->toArray();
                        return view('afiliadosTemporales.edit', compact('afiliadosTemporale','tipoAfiliado','aseguradora','estado','colectivo'));
                    }catch(ModelNotFoundException $e){
                        return redirect()->back()->withInput()->with('respuesta', 'No existe el Afiliado. Presione si desea ');
                        //return view('afiliadosTemporales.create', compact('tipoAfiliado','aseguradora','estado'));
                    }
                }
                $contratos = DB::table('ac_contratos')
                            ->where([['cedula_titular', '=', $afiliadoIni->cedula_titular],['fecha_inicio','<=',date('Y-m-d').' 00:00:00'],['fecha_fin','>=',date('Y-m-d').' 00:00:00']])
                            ->join('ac_afiliados', 'ac_afiliados.cedula',"=", 'ac_contratos.cedula_afiliado')
                            ->join('ac_tipo_afiliado', 'ac_afiliados.tipo_afiliado',"=", 'ac_tipo_afiliado.id')
                            ->join('ac_planes_extranet', 'ac_planes_extranet.codigo_plan',"=", 'ac_contratos.codigo_plan')
                            ->join('ac_colectivos', 'ac_colectivos.codigo_colectivo',"=", 'ac_contratos.codigo_colectivo')
                            ->join('ac_aseguradora', 'ac_colectivos.codigo_aseguradora',"=", 'ac_aseguradora.codigo_aseguradora')
                            ->select('codigo_contrato','cedula_afiliado','ac_afiliados.nombre as nombre_afiliado','ac_afiliados.apellido as apellido_afiliado',
                                    'ac_planes_extranet.nombre as plan','ac_colectivos.nombre as colectivo','ac_aseguradora.nombre as aseguradora','ac_tipo_afiliado.nombre as tipo_afiliado')
                            ->get();
                if(!empty($contratos)){
                    return view('claves.generar', compact('contratos'));
                }else{
                    Session::flash('flash_message', 'No tiene contrato vigente');
                    return view('avi.generar', compact('contratos'));
                }
            }
        }else{
            return view('avi.generar');
        }
    }
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return Response
     */
    public function buscarCobertura(Request $request){
        if(empty($request->icedula)){
            return redirect()->back()->withInput()->with('message', 'Debe seleccionar un beneficiario.');
        }
        $id = $request->input('icedula');
        $beneficiario['contrato'] = $request->input(['contrato'.$id]);
        $beneficiario['cedula_afiliado'] = $request->input('cedula_afiliado'.$id);
        $beneficiario['nombre_afiliado'] = $request->input('nombre_afiliado'.$id);
        $beneficiario['plan'] = $request->input('plan'.$id);
        $beneficiario['colectivo'] = $request->input('colectivo'.$id);
        $beneficiario['aseguradora'] = $request->input('aseguradora'.$id);
        $beneficiario['tipo_afiliado'] = $request->input('tipo_afiliado'.$id);
        $user = \Auth::user();
        if($user->type == 3){ // PROVEEDOR
            $coberturas = DB::table('ac_contratos')
                ->where([['codigo_contrato', '=', $beneficiario['contrato']]])
                ->join('ac_planes_extranet', 'ac_planes_extranet.codigo_plan',"=", 'ac_contratos.codigo_plan')
                ->join('ac_cobertura_extranet', 'ac_cobertura_extranet.id_plan',"=", 'ac_planes_extranet.codigo_plan')
                ->join('ac_colectivos', 'ac_colectivos.codigo_colectivo',"=", 'ac_contratos.codigo_colectivo')
                ->join('ac_aseguradora', 'ac_aseguradora.codigo_aseguradora',"=", 'ac_colectivos.codigo_aseguradora')
                ->join('ac_procedimientos_medicos', function($join){
                        $join->on('ac_procedimientos_medicos.codigo_examen',"=", 'ac_cobertura_extranet.id_procedimiento')
                             ->on('ac_procedimientos_medicos.codigo_especialidad',"=", 'ac_cobertura_extranet.id_especialidad')
                             ->on('ac_procedimientos_medicos.codigo_servicio',"=", 'ac_cobertura_extranet.id_servicio');
                })
                ->join('ac_servicios_extranet', 'ac_servicios_extranet.codigo_servicio',"=", 'ac_procedimientos_medicos.codigo_servicio')
                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_procedimientos_medicos.codigo_especialidad')
                ->join('ac_baremos', 'ac_procedimientos_medicos.id',"=", 'ac_baremos.id_procedimiento')
                ->join('ac_proveedores_extranet', function($join){
                    $user = \Auth::user();
                    $join->on('ac_proveedores_extranet.codigo_proveedor',"=", 'ac_baremos.id_proveedor')
                         ->where('ac_proveedores_extranet.codigo_proveedor',"=", $user->proveedor);
                })
                ->select('id_servicio','ac_servicios_extranet.descripcion as servicio',
                        'id_especialidad','ac_especialidades_extranet.descripcion as especialidad')
                ->get(); // +++++++ array(StdClass)
            $proveedor = AcProveedoresExtranet::where('codigo_proveedor',"=", $user->proveedor)->firstOrFail();
        }else{
            $coberturas = DB::table('ac_contratos')
                ->where([['codigo_contrato', '=', $beneficiario['contrato']]])
                ->join('ac_planes_extranet', 'ac_planes_extranet.codigo_plan',"=", 'ac_contratos.codigo_plan')
                ->join('ac_cobertura_extranet', 'ac_cobertura_extranet.id_plan',"=", 'ac_planes_extranet.codigo_plan')
                ->join('ac_colectivos', 'ac_colectivos.codigo_colectivo',"=", 'ac_contratos.codigo_colectivo')
                ->join('ac_aseguradora', 'ac_aseguradora.codigo_aseguradora',"=", 'ac_colectivos.codigo_aseguradora')
                ->join('ac_procedimientos_medicos', function($join){
                        $join->on('ac_procedimientos_medicos.codigo_examen',"=", 'ac_cobertura_extranet.id_procedimiento')
                             ->on('ac_procedimientos_medicos.codigo_especialidad',"=", 'ac_cobertura_extranet.id_especialidad')
                             ->on('ac_procedimientos_medicos.codigo_servicio',"=", 'ac_cobertura_extranet.id_servicio');
                })
                ->join('ac_servicios_extranet', 'ac_servicios_extranet.codigo_servicio',"=", 'ac_procedimientos_medicos.codigo_servicio')
                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_procedimientos_medicos.codigo_especialidad')
                ->select('id_servicio','ac_servicios_extranet.descripcion as servicio',
                        'id_especialidad','ac_especialidades_extranet.descripcion as especialidad')
                ->distinct()->get();
        }
        $especialidades_cobertura = array_pluck($coberturas,'especialidad','id_especialidad'); // ++++++++++++++++ ARRAY
        $servicios = array_pluck($coberturas,'servicio','id_servicio');
        return view('claves.generarFinal', compact('beneficiario','especialidades_cobertura','servicios','proveedor'));
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('avi.index')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
