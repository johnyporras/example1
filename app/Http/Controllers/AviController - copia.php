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
use App\Models\Avi;
use App\Models\AviDestino;
use App\Models\AcAfiliado;
use Yajra\Datatables\Datatables;
use Auth; 

class AviController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('avi.index');
    }

    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function index1(Request $request){
       
        if(isset($request->cedula)){
            if(empty($request->cedula)){
                return back()->with('message', 'El campo cédula es obligatorio.');
            }else{
                try{

                    $this->validate($request,['cedula' => 'required|numeric']);                    
                    $afiliadoIni = AcAfiliado::where('cedula', '=', $request->cedula)->firstOrFail();
                
                }catch(ModelNotFoundException $e){  // catch(Exception $e) catch any exception
                    
                    toast()->error( 'No existe el Afiliado!!!', 'Alerta:');
                    return back()->with('respuesta', '¡No existe el Afiliado!');
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
                    toast()->warning( '¡No tiene contrato vigente!', 'Mensaje:');
                    return back()->with('respuesta', '¡No tiene contrato vigente!');
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
            return back()->with('message', '¡Debe seleccionar un beneficiario.!');
        }

        $id = $request->input('icedula');
        $servicio['contrato'] = $request->input(['contrato'.$id]);
        $servicio['cedula_afiliado'] = $request->input('cedula_afiliado'.$id);
        $servicio['nombre_afiliado'] = $request->input('nombre_afiliado'.$id);
        $servicio['plan'] = $request->input('plan'.$id);
        $servicio['colectivo'] = $request->input('colectivo'.$id);
        $servicio['aseguradora'] = $request->input('aseguradora'.$id);
        $servicio['tipo_afiliado'] = $request->input('tipo_afiliado'.$id);

        // Seleciono todos los beneficiaros 
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

        $paises = DB::table('paises')
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
        /**valida los campos del formulario **/
        $this->validate($request, [
            'hasta'         => 'required',
            'destino'       => 'required',
            'cronograma'    => 'required',
            'observaciones' => 'min:10'
        ]);

        // Genero codigo unico
        $codigo =  'av'.substr(uniqid(),7,13);

        // crea nueva solicitud
        $avi = Avi::create([
            'codigo_solicitud' => $codigo,
            'cedula_afiliado'  => $request->cedula,
            'codigo_contrato'  => $request->contrato,
            'cobertura_monto'  => 0,
            'edad_afiliado'    => $request->edad,  
            'nro_cronograma'   => $request->cronograma,  
            'observaciones'    => $request->observaciones,     
            'creador'          => Auth::user()->id
        ]);

        // Total de destinos para realizar bucle
        $total = count($request->desde);

        // Aqui se guardan todos los destinos da la solicitud
        for ($i = 0; $i < $total; $i++) {

            $avi->destinos()->create([
                'pais_id' => $request['destino'][$i], 
                'fecha_desde'  => $request['desde'][$i], 
                'fecha_hasta'  => $request['hasta'][$i]
            ]);
        }

        toast()->info(' Solicitud generada sastifactoriamente', 'Información:');
        return redirect()->route('avi.lista');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('avi.lista');
    }


    public function solicitudes(){

        $solicitudes = Avi::all();

        return Datatables::of($solicitudes)
        ->addColumn('action', function ($solicitud) {
                return '
                <a href="/avi/'.$solicitud->id.'" title="Ver Detalles" class="btn btn-warning btn-xs"> <i class="fa fa-eye"> </i></a>
                <a href="/avi/'.$solicitud->id.'/edit" title="Editar Solicitud" class="btn btn-info btn-xs"> <i class="fa fa-edit"> </i></a>
                <a href="/avi/'.$solicitud->id.'" title="Eliminar Solicitud" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a>';
            })
        ->editColumn('created_at', function ($solicitud) {
                return $solicitud->created_at->format('d/m/Y');
            })
        ->make(true);
    }

    public function create(Request $request)
    {
        // valida los campos del formulario
        $this->validate($request, [
            'cedula' => 'required'
        ]);

        // Selecciono el Afiliado
        $afiliado = AcAfiliado::where('cedula', '=', $request->cedula)->first();

        // valido si existe el afiliado
        if ($afiliado) {

            // Selecciona dias de registro
            $fechaCuenta = $afiliado->cuenta->fecha->diffInDays();
            // selecciono el estatus cuenta
            $estatusCuenta = $afiliado->cuenta->estatus;

            // Verifico que la cuenta sea mayor de 30 dias y que tenga estatus activo
            if ($fechaCuenta >= 30 && $estatusCuenta == 'Activo') {
                
                // Guardo en variable la cuenta
                $cuenta = $afiliado->cuenta;
                // Guardo en variable el plan
                $plan = $afiliado->cuenta->plan()->first();

                //Creo array de dias
                $dias = [];
                // leno el arra de dias
                for ($i = 1; $i <= 30 ; $i++) {
                    $dias[$i] = $i;
                }

                // Cargo los estados
                $estados = AcEstado::orderBy('estado', 'ASC')
                                ->pluck('estado', 'id');
                //cargo los metodos de pago
                $metodos = MetodoPago::orderBy('metodo', 'ASC')
                                ->pluck('metodo', 'id');
                //cargo los proveedores funerarios
                $proveedores = ProveedorFunerario::orderBy('razon_social', 'ASC')
                                ->pluck('razon_social', 'id');
                
                //retorno la vista para el formulario
                return view('funerario.create', compact('estados','metodos','dias','proveedores', 'cuenta','afiliado', 'plan'));
            } else {

                return back()->with('respuesta', '¡No tiene una cuenta vigente!');
            }
            
        } else {
            return back()->with('respuesta', '¡No existe el Afiliado!');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Avi::findOrFail($id);

        return view('avi.show',compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = Avi::findOrFail($id);

        $afiliado = AcAfiliado::where('cedula', '=', $solicitud->cedula_afiliado)->first();

        $paises = DB::table('paises')
                        ->orderBy('name_es', 'ASC')
                        ->pluck('name_es', 'id');

       // dd($afiliado);

        return view('avi.editar', compact('solicitud', 'paises', 'afiliado'));
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
        // Se vailida que posee al menos un destino ya que no puede estar vacio...
        if ($request->destino) {
        
            $solicitud = Avi::findOrFail($id);

            $solicitud->update([
                'nro_cronograma' => $request->cronograma,
                'observaciones' => $request->observaciones,
                ]);

            // Forzo el borrado para poder actualizar
            $solicitud->destinos()->forceDelete();
            $solicitud->save();

            // Total de destinos para realizar bucle
            $total = count($request->desde);

            // Aqui se guardan todos los destinos da la solicitud
            for ($i = 0; $i < $total; $i++) {

                $solicitud->destinos()->create([
                    'pais_id' => $request['destino'][$i], 
                    'fecha_desde'  => $request['desde'][$i], 
                    'fecha_hasta'  => $request['hasta'][$i]
                ]);
            }

            toast()->info(' Solicitud: '.$solicitud->codigo_solicitud.' modificada Correctamente', 'Alerta:');
            return redirect()->route('avi.lista');

        } else {
            toast()->error(' Solicitud debe poseer al menos un destino', 'Alerta:');
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitud = Avi::findOrFail($id);

        // Elimino la solicitud y sus relaciones
        $solicitud->destinos()->delete();
        $solicitud->delete();

        toast()->error(' Solicitud: '.$solicitud->codigo_solicitud.' Eliminada Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('avi.lista');
    }
}