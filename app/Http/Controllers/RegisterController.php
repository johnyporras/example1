<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Http\Requests;

use App\Models\AcAfiliado;
use App\Models\AcCuenta;
use App\Models\AcCuentaPlan;
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
use DB;

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
        //Preguntas 
        $preguntas1 = DB::table('preguntas')->take(10)->orderBy('id','asc')->pluck('pregunta', 'pregunta');
        $preguntas2 = DB::table('preguntas')->take(10)->orderBy('id','desc')->pluck('pregunta', 'pregunta');

        return view('auth.register', compact('productos', 'planes','estados', 'tamanos','preguntas1','preguntas2'));
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
                    //Guardo id tarjeta
                    Session::set('tarjeta', $tarjeta->id);

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
                                    'id_producto' => $request->producto,
                                    'estatus' => 2
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
                        Session::set('semanas', $request->semanas);
                    } 
                
                    // Guardo la session cuenta
                    Session::set('cuenta', $cuenta);
                    // borro la session codigo                   
                    Session::forget('codigo');
                    // Retorno mensaje de sastifactorio
                    return response()->json(['success' => 'Cuenta Generada Sastifactorimente']);
                }
                catch(QueryException $e){
                   return response()->json(['error' => '¡Ocurrio un error al generar cuenta!',
                                            'data' => $e
                                                ]);
                }

           }else{
                return response()->json(['error' => 'No posee tarjeta valida intente nuevamente']);
           }
        }
    }

    public function afiliado(Request $request)
    {
        if ($request->ajax()) {

            if (Session::get('cuenta')) {
                
                // valido para no repetir cedula ni emal en afiliado y en user
                $emailAf = AcAfiliado::where('email','=', $request->correo)->first();
                $emailUser = User::where('email','=', $request->correo)->first();
                $cedulaAf = AcAfiliado::where('cedula','=', $request->cedula)->first();
                //Guardo variables para embarazo
                $embarazo = (Session::get('embarazo')) ? Session::get('embarazo') : 'N';

                if ($emailAf != null || $emailUser != null){
                    return response()->json(['error' => 'El Correo que ingreso ya esta en uso']);
                }

                if($cedulaAf != null){
                    return response()->json(['error' => 'La cédula que ingreso ya existe en el sistema']);
                }

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
                                'embarazada' => $embarazo,
                                'tiempo_gestacion' => Session::get('semanas')
                            ]);

                    // Guardo la session cuenta
                    Session::set('afiliado', $afiliado);
                    // borro la session cuenta
                    Session::forget('embarazo');
                    Session::forget('semanas');

                    // Retorno mensaje de sastifactorio
                    return response()->json(['success' => 'Afiliado creado Sastifactorimente']);

                }catch(QueryException $e){
                    return response()->json(['error' => '¡Ocurrio un error al generar Afiliado!',
                                            'data' => $e
                                                ]);
                }

            }else{
                return response()->json(['error' => 'No posee cuenta valida intente nuevamente']);
           }
        }
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'user' => 'required|min:4|max:16|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'pregunta1' => 'required',
            'pregunta2' => 'required',
            'password'  => 'required|min:6|max:16',
        ];

        $messages = [
            'user.required' => 'El campo es requerido',
            'user.min' => 'El mínimo de caracteres permitidos son 6',
            'user.max' => 'El máximo de caracteres permitidos son 16',
            'user.regex' => 'Sólo se aceptan letras',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            //return redirect("auth/register")->withErrors($validator)->withInput();
            return response()->json(['error' => $validator->getMessageBag()->toArray() ]);

        }else{

            if(Session::get('afiliado')){

                $user = User::where('user','=', $request->user)->first();

                if($user == null){
                    // Guardo el nombre del usuario
                    $name = Session::get('afiliado')->nombre.' '.Session::get('afiliado')->apellido;

                    try{
                        //Genero el usuario
                        $usuario = User::create([
                                    'name'  => $name,
                                    'email' => Session::get('afiliado')->email,
                                    'user'  => $request->user,
                                    'password'   => bcrypt($request->password),
                                    'department' => 'cliente',
                                    'type'       => 5,
                                    'active'     => false,
                                    'pregunta_1'  => $request->pregunta1,
                                    'respuesta_1' => bcrypt($request->respuesta1),
                                    'pregunta_2'  => $request->pregunta2,
                                    'respuesta_2' => bcrypt($request->respuesta2),
                                    'remember_token' => str_random(100),
                                    'confirm_token'  => str_random(100)
                                ]);

                       //Guardo data para enviar el correo
                        $data = ['name' => $usuario->name,
                                'email' => $usuario->email,
                                'confirm_token' => $usuario->confirm_token];

                        // Envio de Correo para confirmar 
                        Mail::send('mails.register', ['data' => $data], function($mail) use($data){
                            $mail->subject('Confirma tu cuenta');
                            $mail->to($data['email'], $data['name']);
                        });

                        // borro la session afiliado                 
                        Session::forget('afiliado');

                        // Retorno mensaje de sastifactorio
                        return response()->json(['success' => 'Hemos enviado un enlace de confirmación a su Cuenta de correo electrónico']);

                    }catch(QueryException $e){
                       return response()->json(['error' => '¡Ocurrio un error al generar Usuario!',
                                                'data' => $e
                                                ]);
                    }
                    
                }else{
                    return response()->json(['error' => 'El nombre de usuario ya existe en el sistema']);
                }
            }else{
                return response()->json(['error' => 'Afiliado Invalido intente nuevamente']);
            }
        } 
    }
    
    public function confirmRegister($email, $confirm_token)
    {
        $user = User::where('email','=', $email)->where('confirm_token', '=', $confirm_token)->first();

        if ($user){
            
           if ($user->active == true){
               return view('auth.verify')->with('warning', 'Cuenta de usuario ya se encuentra activa'); 
            }

            // Actualizo usuario activo
            $user->active = true;
            $user->save();
            // Selecciono afiliado para seleccionar cuenta
            $afiliado =  AcAfiliado::where('email','=',$email)->first();
            // Guardo codigo de cuanta para comparar con tarjetas
            $codigo = $afiliado->cuenta->codigo_cuenta;
            // Selecciono tarjeta
            $tarjeta = Tarjeta::get()->filter(function($record) use($codigo) {
                if (Hash::check($codigo, $record->codigo_tarjeta)) {
                    return $record;
                }else {
                    return null;
                }
            })->first();
            // Modifico estatus de tarjeta a usada
            $tarjeta->activada = 'S';
            $tarjeta->save();
            // Actualizo estatus de cuenta
            $cuenta = AcCuenta::where('codigo_cuenta','=',$codigo)->first();
            $cuenta->estatus = 1;
            $cuenta->save();
            //Elimino sessiones de tarjeta y cuenta
            Session::forget('tarjeta');
            Session::forget('cuenta');
            // Retorno msn de felicitaciones
            return view('auth.verify')->with('success', 'Felicitaciones ya puede iniciar sesión');
        }else{
            // retorno msn de error
            return view('auth.verify')->with('error', 'Cuenta de usuario Incorrecta Intente Nuevamente');
        }
    }

}