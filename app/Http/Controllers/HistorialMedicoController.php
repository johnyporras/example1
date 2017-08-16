<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use App\User;
use App\Models\HistorialMedico;
use Carbon\Carbon;
use DB;
use Session;
use Yajra\Datatables\Datatables;


class HistorialMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('historial.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('historial.lista');
    }


    public function historiales()
    {

        $historiales = HistorialMedico::all();

        return Datatables::of($historiales)
        ->addColumn('action', function ($historial) {
                return '
                <a href="/historial/'.$historial->id.'" title="Ver Detalles" class="btn btn-warning btn-xs"> <i class="fa fa-eye"> </i></a>
                <a href="/historial/'.$historial->id.'/edit" title="Editar Solicitud" class="btn btn-info btn-xs"> <i class="fa fa-edit"> </i></a>
                <a href="/historial/'.$historial->id.'" title="Eliminar Solicitud" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a>';
            })
        ->editColumn('created_at', function ($solicitud) {
                return $historial->created_at->format('d/m/Y');
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $historial = HistorialMedico::all();

        //Retorno la vista
        return view('historial.create', compact('historial'));
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

        $avi = HistorialMedico::create([
            'afiliado_id'    => $request->afiliado,
            'codigo_solicitud' => $codigo,
            'codigo_contrato'  => '555',
            'cobertura_monto'  => 0,
            'nro_cronograma'   => $request->cronograma,  
            'observaciones'    => $request->observaciones,     
            'creador'          => Auth::user()->id
        ]);

        toast()->info('Solicitud generada sastifactoriamente', 'Información:');
        return redirect()->route('historial.lista');
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
        $solicitud = HistorialMedico::findOrFail($id);

        // Retorno la vista
        return view('historial.show',compact('solicitud'));
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
        $solicitud = HistorialMedico::findOrFail($id);

        // Retorno la vista
        return view('historial.edit',compact('solicitud'));
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
        /**valida los campos del formulario **/
        $this->validate($request, [
            'hasta'         => 'required',
            'destino'       => 'required',
            'cronograma'    => 'required',
            'observaciones' => 'min:10'
        ]);

        $solicitud->update([
            'nro_cronograma' => $request->cronograma,
            'observaciones' => $request->observaciones,
        ]);

        toast()->info(' Solicitud: '.$solicitud->codigo_solicitud.' modificada Correctamente', 'Alerta:');
        return redirect()->route('historial.lista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitud = HistorialMedico::findOrFail($id);

        // Elimino la solicitud y sus relaciones
        //$solicitud->destinos()->delete();
        $solicitud->delete();

        toast()->error(' Solicitud: '.$solicitud->codigo_solicitud.' Eliminada Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('solicitud.lista');
    }
}
