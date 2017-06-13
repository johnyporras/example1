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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('avi.lista');
    }

    public function solicitudes()
    {

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
                $plan = $afiliado->cuenta->cuentaPlan()->first();

                // Cargo los paises
                $paises = DB::table('paises')->orderBy('name_es', 'ASC')
                                ->pluck('name_es', 'id'); 

                return view('avi.create', compact('afiliado', 'paises', 'cuenta', 'plan'));

            } else {
                return back()->with('respuesta', '¡No tiene una cuenta vigente!');
            }
            
        } else {
            return back()->with('respuesta', '¡No existe el Afiliado!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**valida los campos del formulario **/
        $this->validate($request, [
            'hasta'         => 'required',
            'destino'       => 'required',
            'cronograma'    => 'required',
            'observaciones' => 'min:10'
        ]);

        // Genero codigo unico
        $codigo = 'av'.substr(uniqid(),7,13);

        // crea nueva solicitud
        $avi = Avi::create([
            'afiliado_id'    => $request->afiliado,
            'codigo_solicitud' => $codigo,
            'codigo_contrato'  => '555',
            'cobertura_monto'  => 0,
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

        toast()->info('Solicitud generada sastifactoriamente', 'Información:');
        return redirect()->route('avi.lista');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // selecciono solicitud
        $solicitud = Avi::findOrFail($id);
        // selecciono afiliado
        $afiliado = AcAfiliado::findOrFail($solicitud->afiliado_id);

        // Guardo en variable la cuenta
        $cuenta = $afiliado->cuenta;
        // Guardo en variable el plan
        $plan = $afiliado->cuenta->cuentaPlan()->first();

        return view('avi.show',compact('solicitud', 'cuenta', 'plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // selecciono solicitud
        $solicitud = Avi::findOrFail($id);
        // selecciono afiliado
        $afiliado = AcAfiliado::findOrFail($solicitud->afiliado_id);

        // Guardo en variable la cuenta
        $cuenta = $afiliado->cuenta;
        // Guardo en variable el plan
        $plan = $afiliado->cuenta->cuentaPlan()->first();

        $paises = DB::table('paises')->orderBy('name_es', 'ASC')
                        ->pluck('name_es', 'id');

        return view('avi.editar', compact('solicitud', 'paises', 'afiliado', 'cuenta', 'plan'));
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
            toast()->error('Solicitud debe poseer al menos un destino', 'Alerta:');
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