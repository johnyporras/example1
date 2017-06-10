<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\AcCuenta;
use App\Models\Tarjeta;
use App\Models\AcProducto;
use App\Models\AcPlanesExtranet;
use App\Models\AcEstado;
use App\Models\Tamano;
use Hash;
use Mail;
use Session;
use Validator;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /**
     * [register description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(Request $request)
    {
        // Cargo los productos
        $productos = AcProducto::orderBy('nombre','ASC')->pluck('nombre', 'id');
        // Cargo los planes
        $planes = AcPlanesExtranet::orderBy('nombre','ASC')->pluck('nombre', 'id');
        // Cargo los estados
        $estados = AcEstado::orderBy('estado','ASC')->pluck('estado', 'id');
        // Cargo los estados
        $tamanos = Tamano::pluck('titulo', 'id');

        return view('auth.register', compact('productos', 'planes','estados', 'tamanos'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {   
        if($request->ajax()){
            // Guardo el valor de l formulario para comparar
            $codigo = $request->tarjeta;

            //realizo un filtro para buscar en la tabla tarjetas
            $tarjeta = Tarjeta::get()->filter(function($record) use($codigo) {

                if (Hash::check($codigo, $record->codigo_tarjeta)) {
                    return $record;
                }else {
                    return null;
                }
                
            })->first();

            if ($tarjeta != null) {
                
                if ($tarjeta->activada == 'N') {
                    // Guardo la session codigo
                    Session::set('codigo', $codigo);
                    return response()->json(['success' => 'Tarjeta Valida']);
                } else {
                    return response()->json(['error' => 'Tarjeta ya fue activada']);
                }

            } else {
                // borro la session codigo                   
                Session::forget('codigo', $codigo);
                return response()->json(['error' => 'Tarjeta Invalida']);
            }
            
        }
    }

    public function cuenta(Request $request){
        //if ($request->ajax()) {

       /* return response()->json(['data' => [
                            'producto' => $request->producto,
                            'plan' => $request->plan,
                            'embarazada' => $request->embarazada,
                            'semanas' => $request->semanas,
                            'nombre' => $request->nombre,
                            'raza' => $request->raza,
                            'color' => $request->color,
                            'tipo' => $request->tipo,
                            'edad' => $request->edad,
                            'fmascota' => $request->fmascota,
                            'tamano' => $request->tamano,
                            'codigo_cuenta' => Session::get('codigo')
                        ]]); */

            // Fecha creado
            $creado = Carbon::now()->format('Y-m-d'); 
     
           // if (Session::get('codigo')){

            $cuenta = AcCuenta::create([
                            'codigo_cuenta' => Session::get('codigo'),
                            'fecha'         => $creado,
                            'id_producto'   => $request->producto
                        ]);

            //$cuenta->plan()->create(['id_plan' => $plan]);
/*
            if($plan == 18){

                $mascota = Mascota::create([
                            'cuenta_id' => $cuenta->id,
                            'tamano_id' => $request->tamano,
                            'nombre'    => $request->nombre,
                            'raza'      => $request->raza,
                            'color_pelaje' => $request->color,
                            'edad'      => $request->edad,
                            'fecha'     => $request->fmascota,
                            'tipo'      => $request->tipo,
                        ]);
            }

            if($plan == 17){
                // Guardo session de embarazada para utilizar luego  
                Session::set('embarazada', [
                                'embarazada' => $request->embarazada,
                                'semanas' => $request->semanas
                                ]);
            } */
            /*
            if($cuenta != null){
                // Guardo la session cuenta
                Session::set('cuenta', $cuenta);
                // borro la session codigo                   
                Session::forget('codigo', $codigo);

                return response()->json(['success' => 'Cuenta Generada Sastifactorimente']);
                
            }else{
                return response()->json(['error' => 'Ocurrio un problema al generar la cuenta']);
            }

           }else{
                return response()->json(['error' => 'No posee tarjeta valida intente nuevamente']);
           }
           */
          
          return response()->json(['success' => 'Cuenta Generada Sastifactorimente']);
            
        //}
    }

    public function postRegister(Request $request){

        dd($request);
    
        $rules = [
            'name' => 'required|min:3|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];

        $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'email.required' => 'El campo es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect("auth/register")->withErrors($validator)->withInput();
        }
        else{
            $user = new User;
            $data['name'] = $user->name = $request->name;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);
            $user->save();

            Mail::send('mails.register', ['data' => $data], function($mail) use($data){
                $mail->subject('Confirma tu cuenta');
                $mail->to($data['email'], $data['name']);
            });

            return redirect("auth/register")->with("message", "Hemos enviado un enlace de confirmación a su cuenta de correo electrónico");
        }
    }
    
    public function confirmRegister($email, $confirm_token){
        $user = new User;
        $the_user = $user->select()->where('email', '=', $email)->where('confirm_token', '=', $confirm_token)->get();

        if (count($the_user) > 0){
            $active = 1;
            $confirm_token = str_random(100);
            $user->where('email', '=', $email)
            ->update(['active' => $active, 'confirm_token' => $confirm_token]);
            return redirect('auth/register')->with('message', 'Enhorabuena ' . $the_user[0]['name'] . ' ya puede iniciar sesión');
        }else{
            return redirect('');
        }
    }


}