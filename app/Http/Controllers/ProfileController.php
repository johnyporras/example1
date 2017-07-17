<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Models\AcAfiliado;
use App\Models\AcEstado;
use App\Models\Contacto;
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

        $valores = AcEstado::orderBy('estado', 'ASC')->pluck('estado', 'id');

        foreach ($valores as $key => $value) {
            //paso a un array con nuevos indices
            $estados[] = ["value" => $key , "text" => $value];
        }
        // Paso los valores a formato json
        $estados = json_encode($estados);

        //dd($perfil);
        // Retorno vista
        return view('profile.index', compact('usuario', 'perfil', 'estados')); 
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
        //dd($request);

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