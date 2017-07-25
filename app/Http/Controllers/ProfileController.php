<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Models\AcAfiliado;
use App\Models\AcDocumento;
use App\Models\AcEstado;
use App\Models\AcTipoDocumento;
use App\Models\Contacto;
use App\Models\MotivoDetalle;
use App\Models\Medicamento;
use App\Models\TipoMedicamento;
use Auth;
use Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::user()->id;
        // Cargo data del usuario
        $usuario = User::findOrfail($id);
        // Cargo data del perfil
        $perfil = AcAfiliado::findOrFail($usuario->detalles_usuario_id);
        // valores para estados
        $valores = AcEstado::orderBy('estado', 'ASC')->pluck('estado', 'id');
        // Tipo medicamentos
        $tipo = TipoMedicamento::orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
        // Tipo documentos
        $acTipoDoc= AcTipoDocumento::orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
        // Estados formato json
        $estados = User::editableFormat($valores);
        // tipo de Medicamento formato json
        $tipom = User::editableFormat($tipo);
        // Tipo documentos formato json
        $tipoDoc = User::editableFormat($acTipoDoc);
        // Retorno vista
        return view('profile.index', compact('usuario', 'perfil', 'estados', 'acTipoDoc', 'tipoDoc', 'tipo', 'tipom')); 
    }

    public function image(Request $request)
    {
        if ($request->hasFile('image')) 
        {
            // Selecciono usuario logueado
            $id = Auth::user()->id;
            $usuario = User::findOrFail($id);
            //Borro imagen anterior
            Storage::disk('avatar')->delete($usuario->imagen_perfil);
            // guardo en una variable la imagen
            $file = $file = $request->image;
            // Cambio nombre de la imagen
            $filename = 'avatar_'.$usuario->id. time().'.'.$file->getClientOriginalExtension();
            // Guardo la imagen en el directorio 
            Storage::disk('avatar')->put($filename, file_get_contents($file));

            // Guardo el registro en la base de datos
            $usuario->imagen_perfil = $filename;
            $usuario->save();
        }

        toast()->success('Imagen Actualizada correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        if ($request->ajax())
        {
            // Seleccion afiliado y actualizo el valor
            $update = AcAfiliado::findOrFail($request->pk);
            $update->update([$request->name => $request->value]);
            
            if ($update){
                return response()->json(['status'=> true ]);
            } else {
                return response()->json(['status'=> false ]);
            } 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contacto(Request $request)
    {
        // Guardo el nuevo contacto
        $contacto = Contacto::create($request->all());

        toast()->success(' Contacto guardado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactoEditar(Request $request)
    {
        if ($request->ajax())
        {
            // Seleccion afiliado y actualizo el valor
            $update = Contacto::findOrFail($request->pk);
            $update->update([$request->name => $request->value]);
            
            if ($update){
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
    public function contactoDelete($id)
    {
        // Selecciono contacto para eliminar
        $contacto = Contacto::findOrfail($id);
        $contacto->delete();

        toast()->error(' Contacto eliminado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function motivo(Request $request)
    {
        // Guardo el nuevo motivo
        $detalle = MotivoDetalle::create($request->all());

        toast()->success($detalle->motivo->nombre.' Actualizado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * edit resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function motivoEditar(Request $request)
    {
        if ($request->ajax())
        {
            // Seleccion afiliado y actualizo el valor
            $update = MotivoDetalle::findOrFail($request->pk);
            $update->update([$request->name => $request->value]);
            
            if ($update){
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
    public function motivoDelete($id)
    {
        // Selecciono motivo para eliminar
        $detalle = MotivoDetalle::findOrfail($id);
        $detalle->delete();

        toast()->error($detalle->motivo->nombre.' - '.$detalle->tipo.' eliminado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function medicamento(Request $request)
    {
        // Guardo el medicamento
        $medicamento = Medicamento::create($request->all());

        // Guardo Cedula fallecido
        if ($request->hasFile('file')) 
        {
            // guardo en una variable la imagen
            $file = $request->file('file');
            // Cambio nombre de la imagen
            $filename = 'recipe_'.$medicamento->id. time().'.'.$file->getClientOriginalExtension();
            // Guardo la imagen en el directorio 
            Storage::disk('documento')->put($filename, file_get_contents($file));
            // Guardo el registro en la base de datos
            $medicamento->file = $filename;
            $medicamento->save();
        }

        toast()->success($medicamento->nombre.' Cargado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * edit resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function medicamentoEditar(Request $request)
    {
        if ($request->ajax())
        {
            // Seleccion afiliado y actualizo el valor
            $update = Medicamento::findOrFail($request->pk);
            $update->update([$request->name => $request->value]);
            
            if ($update){
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
    public function medicamentoDelete($id)
    {
        // Selecciono medicamento para eliminar
        $detalle = MotivoDetalle::findOrfail($id);
        $detalle->delete();

        toast()->error($detalle->motivo->nombre.' - '.$detalle->tipo.' eliminado correctamente', 'Información:');
        return redirect()->route('perfil.index');
    }

    /**
     * Calculo IMC
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculo(Request $request)
    {
        if ($request->ajax())
        { 
            if ($request->altura != 0 && $request->peso != 0) {
                // Realizo calculo IMC
                $calculo = AcAfiliado::imc($request->altura, $request->peso);
            } else {
                $calculo = 'Peso / Altura debe ser diferente de 0 o Vacio';
            }
            // retorno valor
            return response()->json(['imc' => $calculo]);
         }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function file($file)
    {
        $ruta = $file;
        
        if (Storage::disk('documento')->exists($ruta)) 
        {
            // Obtengo el archivo a mostrar
            $file = Storage::disk('documento')->get($ruta);
            // Obtengo el tipo de archivo 
            $mime = Storage::disk('documento')->mimeType($ruta);
            //retorno el archivo
            return response($file, 200)->header('Content-Type', $mime);
        }
    }

    /**
     * Upload documento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        // Selecciono el medicamento
        $medicamento = Medicamento::findOrFail($request->id);

        // Guardo Cedula fallecido
        if ($request->hasFile('file')) 
        {
            // Elimino archivo anterior
            Storage::disk('documento')->delete($medicamento->file);
            // guardo en una variable la imagen
            $file = $request->file('file');
            // Cambio nombre de la imagen
            $filename = 'recipe_'.$medicamento->id. time().'.'.$file->getClientOriginalExtension();
            // Guardo la imagen en el directorio 
            Storage::disk('documento')->put($filename, file_get_contents($file));
            // Guardo el registro en la base de datos
            $medicamento->file = $filename;
            $medicamento->save();
        }
        toast()->success('Documento cargado correctamente', 'Información:');
        return redirect()->route('perfil.index'); 
    }
    
}