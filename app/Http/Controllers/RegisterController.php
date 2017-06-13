<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Http\Requests;

use App\Models\AcAfiliado;
use App\Models\AcCuenta;
use App\Models\AcCuentaplan;
use App\Models\AcEstado;
use App\Models\AcProducto;
use App\Models\AcPlanesExtranet;
use App\Models\Mascota;
use App\Models\Tarjeta;
use App\Models\Tamano;
use App\User;
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
                Session::forget('codigo');
                return response()->json(['error' => 'Tarjeta Invalida']);
            }
            
        }
    }

    public function cuenta(Request $request)
    {
        if ($request->ajax()) {

            // Fecha creado
            $creado = Carbon::now()->format('Y-m-d'); 
     
            if (Session::get('codigo')){

                try{
      
                    //Guardo CuentaPlan
                    $cuenta = AcCuenta::create([
                                    'codigo_cuenta' => Session::get('codigo'),
                                    'fecha' => $creado,
                                    'id_producto' => $request->producto
                                ]);  

                    //Guardo CuentaPlan
                    $cuentaplan = AcCuentaPlan::create([
                                        'id_cuenta' => $cuenta->id,
                                        'id_plan' => $request->plan
                                    ]);

                    if($request->plan == 18){

                        $mascota = Mascota::create([
                                'cuenta_id' => $cuenta->id,
                                'tamano_id' => $request->tamano,
                                'nombre'    => $request->nombre,
                                'raza'      => $request->raza,
                                'color_pelage' => $request->color,
                                'edad'      => $request->edad,
                                'fecha'     => $request->fmascota,
                                'tipo'      => $request->tipo,
                            ]);
                    }

                    if($request->plan == 17){
                        // Guardo session de embarazada
                        Session::set('embarazo', $request->embarazada);
                        Session::set('semanas', $request->semanas );
                    } 
                
                    // Guardo la session cuenta
                    Session::set('cuenta', $cuenta);
                    // borro la session codigo                   
                    Session::forget('codigo');
                    // Retorno mensaje de sastifactorio
                    return response()->json(['success' => 'Cuenta Generada Sastifactorimente']);
                }
                catch(QueryException $e){
                    //return response()->json(['error' => $e]);
                   return response()->json(['error' => '¡Ocurrio un error al generar cuenta!']);
                }

           }else{
                return response()->json(['error' => 'No posee tarjeta valida intente nuevamente']);
           }
        }
    }

    public function afiliado(Request $request)
    {
        //if ($request->ajax()) {

            if (Session::get('cuenta')){

                try{
    
                    $afiliado = AcAfiliado::create([
                                'cedula'    => $request->cedula,
                                'nombre'    => strtoupper($request->nombre),
                                'apellido'  => strtoupper($request->apellido),
                                'fecha_nacimiento' => $request->nacimiento,
                                'email'     => $request->correo,
                                'sexo'      => $request->sexo,
                                'telefono'  => $request->telefono,
                                'id_cuenta' => Session::get('cuenta')->id,
                                'id_estado' => $request->estado,
                                'ciudad'    => $request->ciudad,
                                'embarazada' => Session::get('embararazo'),
                                'tiempo_gestacion' => Session::get('semanas')
                            ]);
                
                    // Guardo la session cuenta
                    Session::set('afiliado', $afiliado);
                    // borro la session cuenta                  
                    Session::forget('cuenta');
                    // Retorno mensaje de sastifactorio
                    return response()->json(['success' => 'Afiliado creado Sastifactorimente']);
                }
                catch(QueryException $e){
                    return response()->json(['error' => $e]);
                   //return response()->json(['error' => '¡Ocurrio un error al generar cuenta!']);
                }

           }else{
                return response()->json(['error' => 'No posee cuenta valida intente nuevamente']);
           }
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
        } else {
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