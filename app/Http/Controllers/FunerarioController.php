<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Auth;
use File;
use Storage;
use Session;
use Carbon\Carbon;
use App\User;
use App\Models\Funerario;
use App\Models\FunerarioDetalle;
use App\Models\AcEstado;
use App\Models\AcAfiliado;
use App\Models\MetodoPago;
use App\Models\ProveedorFunerario;
use Yajra\Datatables\Datatables;

class FunerarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function index(Request $request){
       
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
                    
                    return view('funerario.index', compact('contratos'));

                }else{
                    toast()->warning( '¡No tiene contrato vigente!', 'Mensaje:');
                    return back()->with('respuesta', '¡No tiene contrato vigente!');
                }
            }
        }else{
            return view('funerario.index');
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

        /* Seleciono todos los beneficiaros */
        $afiliados = AcAfiliado::where('cedula_titular', '=', $servicio['cedula_afiliado'])
                    ->orderBy('tipo_afiliado')
                    ->orderBy('fecha_nacimiento')
                    ->get();

        return view('funerario.selected', compact('servicio', 'afiliados'));
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

        return view('funerario.generate', compact('servicio', 'afiliado', 'paises'));
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
        $funerario = Funerario::create([
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

            $funerario->destinos()->create([
                'pais_id' => $request['destino'][$i], 
                'fecha_desde'  => $request['desde'][$i], 
                'fecha_hasta'  => $request['hasta'][$i]
            ]);
        }

        toast()->info(' Solicitud generada sastifactoriamente', 'Información:');
        return redirect()->route('funerario.lista');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {

        return view('funerario.lista');
    }

    public function funerarios(){


        $solicitudes = Funerario::with('pago')
                                ->with('estado')
                                ->with('afiliado')
                                ->select('funerario.*');

        return Datatables::of($solicitudes)
        ->addColumn('action', function ($solicitud) {
                return '
                <a href="/funerario/'.$solicitud->id.'" class="btn btn-warning btn-sm"> <i class="fa fa-eye"> </i></a>
                <a href="/funerario/'.$solicitud->id.'/edit" class="btn btn-info btn-sm"> <i class="fa fa-edit"> </i></a>
                <a href="/funerario/'.$solicitud->id.'" class="btn btn-danger btn-sm sweet-danger"> <i class="fa fa-trash"> </i></a>';
            })
        
        ->editColumn('created_at', function ($solicitud) {
                return $solicitud->created_at->format('d/m/Y');
            })
        ->make(true);
    }

    public function create()
    {
        //Creo array de dias
        $dias = [];
        // leno el arra de dias
        for ($i = 1; $i <= 30 ; $i++) {
            $dias[$i] = $i;
        }

        // Cargo los estados
        $estados = AcEstado::orderBy('es_desc', 'ASC')
                        ->pluck('es_desc', 'es_id');
        //cargo los metodos de pago
        $metodos = MetodoPago::orderBy('metodo', 'ASC')
                        ->pluck('metodo', 'id');
        //cargo los proveedores funerarios
        $proveedores = ProveedorFunerario::orderBy('razon_social', 'ASC')
                        ->pluck('razon_social', 'id');
        
        //retorno la vista para el formulario
        return view('funerario.create',compact('estados','metodos','dias','proveedores'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        // valida los campos del formulario
        $this->validate($request, [
            'estado_id' => 'required',
            'contacto'  => 'required',
            'ciudad'    => 'required',
            'metodo_id' => 'required'
        ]);

        // Genero codigo unico
        $codigo = 'fn'.substr(uniqid(),7,13);
        //Inicio valor de cobertura
        $cobertura = 0;

        $plazo = ($request->plazo != '') ? $request->plazo : NULL;

         // crea nueva solicitud
        $funerario = Funerario::create([
            'codigo_solicitud' => $codigo,
            'estado_id'        => $request->estado_id,
            'afiliado_id'      => $request->afiliado_id,
            'ciudad'           => $request->ciudad,
            'contacto'         => $request->contacto,  
            'metodo_id'        => $request->metodo_id,  
            'plazo'            => $plazo,     
            'creador'          => Auth::user()->id
        ]);

        // Guardo Cedula fallecido
        if ($request->hasFile('cedula')) 
        {
            // guardo en una variable la imagen
            $file = $request->file('cedula');
            // Cambio nombre de la imagen
            $filename = 'dni'.'_'.$codigo.'.'.$file->getClientOriginalExtension();
            //Directorio
            //$cedula = $codigo.'/'.$filename;
            $cedula = $codigo.'/'.$filename;
            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($cedula, file_get_contents($file));
            // Guardo el registro en la base de datos
            $funerario->doc_cedula = $cedula;
            $funerario->save();
        }
 
        // Guardo carta de defuncion
        if ($request->hasFile('acta')) 
        {
            // guardo en una variable la imagen
            $file = $request->file('acta');
            // Cambio nombre de la imagen
            $filename = 'acta'.'_'.$codigo.'.'.$file->getClientOriginalExtension();
            //Directorio
            $acta = $codigo.'/'.$filename;
            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($acta, file_get_contents($file));
            // Guardo el registro en la base de datos
            $funerario->doc_acta = $acta;
            $funerario->save();
        }

        // Total de facturas para realizar bucle
        $total = count($request->factura);

        // Aqui se guardan todos los presupuestos da la solicitud
        for ($i = 0; $i < $total; $i++) {

            $presupuesto = $funerario->presupuestos()->create([
                'proveedor_id' => $request['proveedor'][$i],
                'factura'      => $request['factura'][$i],
                'fecha'        => $request['fsolicitud'][$i], 
                'monto'        => $request['monto'][$i],
                'detalles'     => $request['detalle'][$i],
            ]);

            //Suma de la cobertura
            $cobertura += $request['monto'][$i];

            // Guardo carta de defuncion
            if ($request->hasFile('envoice')) 
            {
                // guardo en una variable la imagen
                $file = $file = $request['envoice'][$i];
                // Cambio nombre de la imagen
                $filename = 'fact'.'_'.$codigo.'_'.$i.'.'.$file->getClientOriginalExtension();
                //Directorio
                $acta = $codigo.'/'.$filename;
                // Guardo la imagen en el directorio 
                Storage::disk('funerario')->put($acta, file_get_contents($file));
                // Guardo el registro en la base de datos
                $presupuesto->doc_factura = $acta;
                $presupuesto->save();

            }

        }
        // Guardo Total de lcfirst(str)a cobertura 
        $funerario->cobertura = $cobertura;
        $funerario->save();

        toast()->info(' Solicitud generada sastifactoriamente', 'Información:');
        return redirect()->route('funerario.lista');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Funerario::findOrFail($id);

        return view('funerario.show',compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = Funerario::findOrFail($id);

        $afiliado = AcAfiliado::where('cedula', '=', $solicitud->cedula_afiliado)->first();

        $paises = DB::table('paises')
                        ->orderBy('name_es', 'ASC')
                        ->pluck('name_es', 'id');

       // dd($afiliado);

        return view('funerario.editar', compact('solicitud', 'paises', 'afiliado'));
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
        
            $solicitud = funerario::findOrFail($id);

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
            return redirect()->route('funerario.lista');

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
        $solicitud = funerario::findOrFail($id);

        // Elimino la solicitud y sus relaciones
        $solicitud->destinos()->delete();
        $solicitud->delete();

        toast()->error(' Solicitud: '.$solicitud->codigo_solicitud.' Eliminada Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('funerario.lista');
    }
}