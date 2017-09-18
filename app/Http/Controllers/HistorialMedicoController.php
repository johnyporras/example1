<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use App\Models\AcAfiliado;
use App\Models\HistorialMedico;
use App\Models\HistorialExamen;
use App\User;
use Carbon\Carbon;
use DB;
use File;
use Storage;
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

        if ($request->has('nombre')) {

            $nombre = strtoupper($request->nombre);
            $apellido = strtoupper($request->apellido);

            $query = AcAfiliado::query();

            $query = $query->where('nombre', 'LIKE', '%'.$nombre.'%');

            if ($request->has('apellido')) {
                $query = $query->orwhere('apellido', 'LIKE', '%'.$apellido.'%');
            }
            if ($request->has('cedula')) {
                $query = $query->orwhere('cedula', 'LIKE', '%'.$request->cedula.'%');
            }
            if ($request->has('fecha')) {
                $query = $query->orwhere('fecha_nacimiento', $request->fecha);
            }

            $afiliados = $query->get();
                
            return view('historial.index',compact('afiliados'));

        }
        
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
        if (Auth::user()->type == 5 || Auth::user()->type == 8 ) {

            $id = Auth::user()->detalles_usuario_id;
            $afiliado = AcAfiliado::findOrFail($id);
            $listado = HistorialMedico::where('id_afiliado', $id)->get();

            return view('historial.historiales', compact('afiliado', 'listado'));
        } else {
            return view('historial.lista');
        }
        
    }

    public function historiales()
    {

        $historiales = HistorialMedico::all();

        return Datatables::of($historiales)
        ->addColumn('action', function ($historial) {
                return '
                <a href="'.route("historial.view",$historial->id).'" title="Ver Detalles" class="btn btn-warning btn-xs"> <i class="fa fa-eye"> </i></a>
                <a href="'.route("historial.edit",$historial->id).'" title="Editar Solicitud" class="btn btn-info btn-xs"> <i class="fa fa-edit"> </i></a>
                <a href="'.route("historial.destroy",$historial->id).'" title="Eliminar Historial" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a>';
            })
        ->editColumn('fecha', function ($historial) {
                return $historial->fecha->format('d/m/Y');
            })
        ->editColumn('created_at', function ($historial) {
                return $historial->created_at->format('d/m/Y');
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $historial = HistorialMedico::all();

        //Retorno la vista
        return view('historial.create', compact('historial', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valida los campos del formulario
        $this->validate($request, [
            'fecha'         => 'required',
            'motivo'        => 'required',
            'especialidad'  => 'required',
            'procedimiento' => 'required',
            'tratamiento'   => 'required',
            'recomendaciones' => 'min:10',
            'observaciones'   => 'min:10'
        ]);

        // Guardo el historial medico
        $historial = HistorialMedico::create([
            'id_user'     => Auth::user()->id,
            'id_afiliado' => $request->id_afiliado,
            'fecha'       => $request->fecha,
            'motivo'      => $request->motivo,
            'especialidad'  => $request->especialidad,
            'tratamiento'   => $request->tratamiento,
            'procedimiento' => $request->procedimiento,
            'observaciones'   => $request->observaciones,
            'recomendaciones' => $request->recomendaciones  
        ]);

        // Guardo Exmenes asociadas al historial medico
        if (count($request->examen) > 0) 
        {
            // Total de examenes para realizar bucle
            $total = count($request->examen);

            // Aqui se guardan todos los presupuestos da la solicitud
            for ($i = 0; $i < $total; $i++) {

                // guardo en una variable el archivo
                $file = $request['examen'][$i];

                // Cambio nombre de la imagen
                $filename = 'examen'.'_'.$request->id_afiliado.$i.time().'.'.$file->getClientOriginalExtension();
                // Guardo la imagen en el directorio 
                Storage::disk('documento')->put($filename, file_get_contents($file));

                // Guardo el exmen seleccionado
                $examen = $historial->examenes()->create([
                    'examen' => $filename,
                ]);
            }

        }

        toast()->info('Historial generado sastifactoriamente', 'Información:');
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
        
        $afiliado = AcAfiliado::findOrFail($id);

        $listado = HistorialMedico::where('id_afiliado', $id)->get();

        // Retorno la vista
        return view('historial.show',compact('afiliado', 'listado'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $historial = HistorialMedico::findOrFail($id);

        // Retorno la vista
        return view('historial.detalle',compact('historial'));
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
        $historial = HistorialMedico::findOrFail($id);

        // Retorno la vista
        return view('historial.editar',compact('historial'));
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
        // valida los campos del formulario
        $this->validate($request, [
            'fecha'         => 'required',
            'motivo'        => 'required',
            'especialidad'  => 'required',
            'procedimiento' => 'required',
            'tratamiento'   => 'required',
            'recomendaciones' => 'min:10',
            'observaciones'   => 'min:10'
        ]);

        $historial = HistorialMedico::findOrFail($id);

        $historial->update([
            'fecha'       => $request->fecha,
            'motivo'      => $request->motivo,
            'especialidad'  => $request->especialidad,
            'tratamiento'   => $request->tratamiento,
            'procedimiento' => $request->procedimiento,
            'observaciones'   => $request->observaciones,
            'recomendaciones' => $request->recomendaciones  
        ]);

        toast()->info('Historial Medico modificado Correctamente', 'Alerta:');
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
        $historial = HistorialMedico::findOrFail($id);

        // Elimino la solicitud y sus relaciones
        $historial->examenes()->delete();
        $historial->delete();

        toast()->error(' Historial Medico Eliminado Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('historial.lista');
    }

    /**
     * Metodo para agregar examenes al historial medico
     */
    public function save(Request $request)
    {
        $historial = HistorialMedico::findOrFail($request->id);

        if ($request->hasFile('examen')) 
        {
            // guardo en una variable la imagen
            $file = $request->file('examen');
            // Cambio nombre de la imagen
            $filename = 'examen'.'_'.$request->id_afiliado.time().'.'.$file->getClientOriginalExtension();
            // Guardo la imagen en el directorio 
            Storage::disk('documento')->put($filename, file_get_contents($file));
        }

        // Guardo el exmen seleccionado
        $examen = $historial->examenes()->create([
            'examen' => $filename,
        ]);
        
        
        toast()->info(' Examen guardado sastifactoriamente', 'Información:');
        return redirect()->route('historial.view', $historial->id);
    }

    public function delete($id)
    {
        //Selecciono el examen   
        $examen = HistorialExamen::findOrFail($id);   

        // dd($examen->historial->id);  
        //Elimino el examen
        $examen->delete();

        toast()->error(' Examen Eliminado Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('historial.view',$examen->historial->id);
    }

}