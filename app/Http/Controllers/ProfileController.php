<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Models\AcAfiliado;
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

        //dd($perfil);
        // Retorno vista
        return view('profile.index', compact('usuario', 'perfil')); 
    }

    public function image(Request $request)
    {
       // dd($request);

        // Guardo facturas asociadas
        if ($request->hasFile('image')) 
        {
            // Selecciono usuario logueado
            $id = Auth::user()->id;
            $usuario = User::findOrFail($id);
            // guardo en una variable la imagen
            $file = $file = $request->image;
            // Cambio nombre de la imagen
            $filename = 'avatar_'.$usuario->id.'.'.$file->getClientOriginalExtension();
            // Guardo la imagen en el directorio 
            Storage::disk('avatar')->put($filename, file_get_contents($file));

            // Guardo el registro en la base de datos
            $usuario->imagen_perfil = $filename;
            $usuario->save();
        }

        toast()->success(' Imagen Actualizada correctamente', 'Información:');
        return redirect()->route('perfil.index');
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
