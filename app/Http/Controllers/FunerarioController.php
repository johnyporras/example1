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
    public function index(Request $request)
    {
        return 'Por realizar';
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

    public function funerarios()
    {
        //Listo las solicitudes para la tabla
        $solicitudes = Funerario::with('pago')
                                ->with('estado')
                                ->with('afiliado')
                                ->select('funerario.*');

        return Datatables::of($solicitudes)
        ->addColumn('action', function ($solicitud) {
                return '
                <a href="/funerario/'.$solicitud->id.'" title="Ver Detalles" class="btn btn-warning btn-xs"> <i class="fa fa-eye"> </i></a>
                <a href="/funerario/'.$solicitud->id.'/edit" title="Editar Solicitud" class="btn btn-info btn-xs"> <i class="fa fa-edit"> </i></a>
                <a href="/funerario/'.$solicitud->id.'" title="Eliminar Solicitud" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a>';
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
        return view('funerario.create', compact('estados','metodos','dias','proveedores'));
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
        //Verifico si tiene plazo o no
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
            $cedula = $codigo.'/'.$filename;
            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($cedula, file_get_contents($file));
            // Guardo el registro en la base de datos
            $funerario->doc_cedula = $filename;
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
            $funerario->doc_acta = $filename;
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

            // Guardo facturas asociadas
            if ($request->hasFile('envoice')) 
            {
                // guardo en una variable la imagen
                $file = $file = $request['envoice'][$i];
                // Cambio nombre de la imagen
                $filename = 'fact'.'_'.$codigo.'_'.$i.'.'.$file->getClientOriginalExtension();
                //Directorio
                $documento = $codigo.'/'.$filename;
                // Guardo la imagen en el directorio 
                Storage::disk('funerario')->put($documento, file_get_contents($file));
                // Guardo el registro en la base de datos
                $presupuesto->doc_factura = $filename;
                $presupuesto->save();
            }

        }
        // Guardo Total de lcfirst(str)a cobertura 
        $funerario->cobertura = $cobertura;
        $funerario->save();

        toast()->success(' Solicitud generada sastifactoriamente', 'Información:');
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

         // Cargo los proveedores
        $data = ProveedorFunerario::orderBy('razon_social', 'ASC')
                        ->pluck('razon_social', 'id');

        foreach ($data as $key => $value) {
            //paso a un array con nuevos indices
            $valores[] = ["value" => $key , "text" => $value];
        }
        // Paso los valores a formato json
        $valores = json_encode($valores);

        //cargo los proveedores funerarios
        $proveedores = ProveedorFunerario::orderBy('razon_social', 'ASC')
                        ->pluck('razon_social', 'id');

        // Retorno la vista con la solicitud y los proveedores
        return view('funerario.show',compact('solicitud', 'valores','proveedores'));
    }

    public function save(Request $request)
    {
        $funerario = Funerario::findOrFail($request->id);
        $cobertura = 0;
        $codigo = $funerario->codigo_solicitud;

        $presupuesto = $funerario->presupuestos()->create([
                'proveedor_id' => $request->proveedor,
                'factura'      => $request->factura,
                'fecha'        => $request->fsolicitud, 
                'monto'        => $request->monto,
                'detalles'     => $request->detalle,
            ]);

        // Guardo facturas asociadas
        if ($request->hasFile('envoice')) 
        {
            // guardo en una variable la imagen
            $file = $file = $request->envoice;
            // Cambio nombre de la imagen
            $filename = 'fact'.'_'.$codigo.'_'.$presupuesto->id.'.'.$file->getClientOriginalExtension();
            //Directorio
            $documento = $codigo.'/'.$filename;
            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($documento, file_get_contents($file));
            // Guardo el registro en la base de datos
            $presupuesto->doc_factura = $filename;
            $presupuesto->save();
        }

        // Actualizo monto de cobertura de la solicitud
        foreach ($funerario->presupuestos as $value) {
            $cobertura += $value->monto;
        }

        //actualizo cobertura
        $funerario->cobertura = $cobertura;
        $funerario->save();

        toast()->success(' Presupuesto generado sastifactoriamente', 'Información:');
        return redirect()->route('funerario.show',$funerario->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($path,$file)
    {
        $ruta = $path.'/'.$file;
        
        if (Storage::disk('funerario')->exists($ruta)) 
        {
            // Obtengo el archivo a mostrar
            $file = Storage::disk('funerario')->get($ruta);
            // Obtengo el tipo de archivo 
            $mime = Storage::disk('funerario')->mimeType($ruta);
            
            //retorno el archivo
            return response($file, 200)->header('Content-Type', $mime);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Creo array de dias
        $dias = [];
        // leno el arra de dias
        for ($i = 1; $i <= 30 ; $i++) {
            $dias[$i] = $i;
        }

        // mando los datos de la solicitud
        $solicitud = Funerario::findOrFail($id);

        // Cargo los estados
        $estados = AcEstado::orderBy('es_desc', 'ASC')
                        ->pluck('es_desc', 'es_id');
        //cargo los metodos de pago
        $metodos = MetodoPago::orderBy('metodo', 'ASC')
                        ->pluck('metodo', 'id');
        
        //retorno la vista para el formulario
        return view('funerario.editar', compact('solicitud','estados','metodos','dias'));
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
            'estado_id' => 'required',
            'contacto'  => 'required',
            'ciudad'    => 'required',
            'metodo_id' => 'required'
        ]);

        //Verifico si tiene plazo o no
        $plazo = ($request->plazo != '') ? $request->plazo : NULL;
        
        // Selecciono la solicitud 
        $solicitud = funerario::findOrFail($id);

        // Guardo el codigo de la solicitud en una variable
        $codigo = $solicitud->codigo_solicitud;
        
        //actualizo la solicitud
        $solicitud->update([
            'estado_id'        => $request->estado_id,
            'ciudad'           => $request->ciudad,
            'contacto'         => $request->contacto,  
            'metodo_id'        => $request->metodo_id,  
            'plazo'            => $plazo
        ]);

        // Valido y Guardo Cedula fallecido
        if ($request->hasFile('cedula')) 
        {
            //borro archivo para subirlo otra vez
            Storage::disk('funerario')->delete($codigo.'/'.$solicitud->doc_cedula);

            // guardo en una variable la imagen
            $file = $request->file('cedula');
            // Cambio nombre de la imagen
            $filename = 'dni'.'_'.$codigo.'.'.$file->getClientOriginalExtension();
            //Directorio
            $cedula = $codigo.'/'.$filename;

            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($cedula, file_get_contents($file));

            // Guardo el registro en la base de datos
            $solicitud->doc_cedula = $filename;
            $solicitud->save();
        }
 
        // valido y Guardo carta de defunción
        if ($request->hasFile('acta')) 
        {
            //borro archivo para subirlo otra vez
            Storage::disk('funerario')->delete($codigo.'/'.$solicitud->doc_acta);

            // guardo en una variable la imagen
            $file = $request->file('acta');
            // Cambio nombre de la imagen
            $filename = 'acta'.'_'.$codigo.'.'.$file->getClientOriginalExtension();
            //Directorio
            $acta = $codigo.'/'.$filename;

            // Guardo la imagen en el directorio 
            Storage::disk('funerario')->put($acta, file_get_contents($file));
            // Guardo el registro en la base de datos
            $solicitud->doc_acta = $filename;
            $solicitud->save();
        }

        //genero mensaje de alerta
        toast()->info(' Solicitud: '.$solicitud->codigo_solicitud.' modificada Correctamente', 'Alerta:');
        // redireccionao a la lista de solicitudes
        return redirect()->route('funerario.lista');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modify(Request $request)
    {
        if ($request->ajax())
        {

            $edit = FunerarioDetalle::findOrFail($request->pk)
                            ->update([
                                $request->name => $request->value
                            ]);

            if ($edit){
                return response()->json(['status'=> true ]);
            } else {
                return response()->json(['status'=> false ]);
            } 
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
        $solicitud->presupuestos()->delete();
        $solicitud->delete();

        toast()->error(' Solicitud: '.$solicitud->codigo_solicitud.' Eliminada Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('funerario.lista');
    }

    public function delete($id)
    {
        //Selecciono el presupuesto   
        $presupuesto = FunerarioDetalle::findOrFail($id);

        // Actualizo el monto de la cobertura
        $cobertura = $presupuesto->funerario->cobertura - $presupuesto->monto;

        // Actualizo el monto de la cobertura
        $presupuesto->funerario()->update([
                'cobertura' => $cobertura
            ]);
        
        //Elimino el presupuesto
        $presupuesto->delete();

        toast()->error(' Presupuesto Eliminado Correctamente', 'Alerta:');
        // Retorno a la lista de solicitudes
        return redirect()->route('funerario.show',$presupuesto->funerario->id);
    }
}