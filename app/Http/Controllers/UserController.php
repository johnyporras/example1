<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\UserType;
use App\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::paginate(15);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = UserType::where("afiliado","=",0)->get();
        $perfil = array_pluck($perfiles,'name','id'); 
        return view('usuarios.create',compact('usuario','perfil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($request, cedula, nombre, apellido, fecha_nacimiento, email, sexo,telefono);
        
        //$request->user=$request->email;
        User::create($request->all());
        
        Session::flash('flash_message', 'Afiliado registrado!');
        
        return redirect('usuarios');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $perfiles = UserType::where("afiliado","=",0)->get();
        $perfil = array_pluck($perfiles,'name','id');
        return view('usuarios.edit', compact('usuario','perfil'));
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
        $this->validate($request,  ['name'   => 'required|max:50',
                                    'email'  => 'required|email|max:255',
                                    'type'   => 'required|max:1', 
                                    'active' => 'required|max:1',
                                    ]);

        $usuario = User::findOrFail($id);
        
        $request->password=bcrypt($request->password);
        $usuario->update($request->all());

        Session::flash('flash_message', 'Usuario actualizado!');

        return redirect('usuarios');
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
    
    
    public function buscar(Request $request)
    {
        if($request->palabra!="")
        {
            
            $oUser= new User();
            $oUser->palabra = $request->palabra;
            $usuarios = $oUser->leerPorPalabra();
            return view('usuarios.index', compact('usuarios'));
        }
        else
        {
            $usuarios = User::paginate(15);
            return view('usuarios.index', compact('usuarios'));
        }
    }
    
    
}