<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Session;
use Carbon\Carbon;
use App\User;
use App\Models\AcAfiliado;
use App\Models\Avi;
use App\Models\AviDestino;

class AviController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function index(Request $request){
       
        if(isset($request->cedula)){
            if(empty($request->cedula)){
                return redirect()->back()->withInput()->with('message', 'El campo cédula es obligatorio.');
            }else{
                try{

                    $this->validate($request,['cedula' => 'required|numeric|']);                    
                    $afiliadoIni = AcAfiliado::where('cedula', '=', $request->cedula)->firstOrFail();
                
                }catch(ModelNotFoundException $e){  // catch(Exception $e) catch any exception
                    
                    toast()->error( 'No existe el Afiliado!!!', 'Alerta:');
                    return back()->with('respuesta', 'No existe el Afiliado ');
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
                    
                    return view('avi.index', compact('contratos'));

                }else{
                    toast()->warning( 'No tiene contrato vigente!!!', 'Mensaje:');
                    return back()->with('mensaje', 'No tiene contrato vigente');
                }
            }
        }else{
            return view('avi.index');
        }
    }

    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return Response
     */
    public function select(Request $request){
        
        if(empty($request->icedula)){
            return back()->with('message', 'Debe seleccionar un beneficiario.');
        }

        $id = $request->input('icedula');
        $servicio['contrato'] = $request->input(['contrato'.$id]);
        $servicio['cedula_afiliado'] = $request->input('cedula_afiliado'.$id);
        $servicio['nombre_afiliado'] = $request->input('nombre_afiliado'.$id);
        $servicio['plan'] = $request->input('plan'.$id);
        $servicio['colectivo'] = $request->input('colectivo'.$id);
        $servicio['aseguradora'] = $request->input('aseguradora'.$id);
        $servicio['tipo_afiliado'] = $request->input('tipo_afiliado'.$id);


        /* Seleciono todos los beneficiaros */
        $afiliados = AcAfiliado::where('cedula_titular', '=', $servicio['cedula_afiliado'])
                    ->orderBy('tipo_afiliado')
                    ->orderBy('fecha_nacimiento')
                    ->get();

        return view('avi.selected', compact('servicio', 'afiliados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $servicio = $request->servicio;

        $afiliado = AcAfiliado::findOrFail($request->id);

        $paises = DB::table('countries')
                        ->orderBy('name_es', 'ASC')
                        ->pluck('name_es', 'id'); 

        return view('avi.generate', compact('servicio', 'afiliado', 'paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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