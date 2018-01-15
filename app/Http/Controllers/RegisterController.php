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
use App\Models\Pais;
use App\Models\Tarjeta;
use App\Models\Terminos;
use App\Models\Tamano;
use App\User;
use App\Models\Pago;
use App\Models\AcPago;
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
        $planes = AcPlanesExtranet::orderBy('nombre','ASC')->pluck('nombre', 'codigo_plan');
        // Cargo los estados
        $estados = AcEstado::orderBy('estado','ASC')->pluck('estado', 'id');
        // Cargo los tamaños
        $tamanos = Tamano::pluck('titulo', 'id');
        //Preguntas
        $preguntas1 = DB::table('preguntas')->take(10)->orderBy('id','asc')->pluck('pregunta', 'pregunta');
        $preguntas2 = DB::table('preguntas')->take(10)->orderBy('id','desc')->pluck('pregunta', 'pregunta');
         // Cargo los paises
        $paises = Pais::orderBy('name_es','ASC')->pluck('name_es', 'codigo');

        // Retorno la vista
        return view('auth.register', compact('productos', 'planes','estados', 'tamanos','preguntas1','preguntas2','paises'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        if($request->ajax()){

            // Guardo el valor del formulario
            $codigo = $request->tarjeta;
            // Guardo el valor del formulario encriptado para comparar
            $crypt = Tarjeta::cryptCode($codigo);
          //  $crypt= "646fd3916bbbe879723ea7553da1409f56ef5edad70c62ef7b5a470446a409a1";
           
            //Verifico con la bd
            $tarjeta = Tarjeta::where('codigo_tarjeta',$crypt)->first();
             
           // dd($tarjeta);
            // valido si la tarjeta existe en la bd
            if ($tarjeta !== null) {
                // Verifica si la tarjeta fue activada o no
                if ($tarjeta->activada == 'N') {
                    // verifico si existe Escodigo de Cuenta
                    $cuenta = AcCuenta::where('codigo_cuenta', '=', $codigo)->first();
                    // verifico si existe alguna cuanta con ese codigo...
                    if ($cuenta !== null) {
                        // valido el estatus de la cuenta
                        // verifico estatus 5 (En Proceso)
                        if ($cuenta->estatus == 5 ) {
                            // Verifico que tenga algun afiliado
                            if ($cuenta->afiliado !== null) {
                                // Elimino usuario si tiene un usuario generado
                                $user = User::where('detalles_usuario_id', '=', $cuenta->afiliado->id)->first();
                                // valido si hay coincidencia
                                if ($user != null) {
                                    $user->forcedelete();
                                }
                                // Elimino el afiliado
                                $cuenta->afiliado()->forcedelete();
                            }
                            // Elimino la cuenta y planes asociados
                            $cuenta->cuentaPlan()->delete();
                            $cuenta->forcedelete();
                            // Guardo la session codigo
                            Session::set('codigo', $codigo);
                            //Guardo id tarjeta
                            Session::set('tarjeta', $tarjeta->id);
                            // Guardo el valor del formulario para comparar
                            $code = substr(Session::get('codigo'), 2, 3);
                            // tipo de plan dependiendo de codigo
                            $plan = substr(Session::get('codigo'), 0, 2);

                            // Selecciono producto dependiendo del codigo
                            if ($plan == 90 || $plan == 40) {
                                // Producto a-card / a-member
                                $tplan = ($plan == 90)?'A-CARD':'A-MEMBER';
                            } else {
                                // producto a-doctor
                                $tplan = 'A-DOCTOR';
                            }

                            //realizo un filtro para buscar en la tabla terminos
                            $terminos = Terminos::where('codigo','=', $code)->first();
                            //Guardo session terminos
                            Session::set('terminos', [
                                            'code' => $terminos->codigo,
                                            'terminos' => $terminos->terminos]);
                            //session con valor del plan
                            Session::set('plan', $tplan);

                            // retorno respuesta
                            return response()->json(['success' => 'Tarjeta Valida']);
                        }
                        if ( $cuenta->estatus == 2 ) {
                            // retorno respuesta redirect
                            return response()->json(['id' => $cuenta->afiliado->id]);
                        }
                    }else{
                        // Guardo la session codigo
                        Session::set('codigo', $codigo);
                        //Guardo id tarjeta
                        Session::set('tarjeta', $tarjeta->id);
                        // Guardo el valor del formulario para comparar
                        $code = substr(Session::get('codigo'), 2, 3);
                        // tipo de plan dependiendo de codigo
                        $plan = substr(Session::get('codigo'), 0, 2);

                            // Selecciono producto dependiendo del codigo
                            if ($plan == 90 || $plan == 40) {
                                // Producto a-card / a-member
                                $tplan = ($plan == 90)?'A-CARD':'A-MEMBER';
                            } else {
                                // producto a-doctor
                                $tplan = 'A-DOCTOR';
                            }

                            //realizo un filtro para buscar en la tabla terminos
                            $terminos = Terminos::where('codigo','=', $code)->first();
                            //Guardo session terminos
                            Session::set('terminos', [
                                            'code' => $terminos->codigo,
                                            'terminos' => $terminos->terminos]);
                            //session con valor del plan
                            Session::set('plan', $tplan);
                        // retorno respuesta
                        return response()->json(['success' => 'Tarjeta Valida']);
                    }
                } else {
                    // Envio mensaje de tarjeta ya utilizada
                    return response()->json(['error' => 'Tarjeta ya fue activada']);
                }
            } else {
                // borro la session codigo
                Session::forget('codigo');
                return response()->json(['error' => 'Tarjeta Invalida']);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkTerminos(Request $request)
    {
        if($request->ajax()){
            // Envio codigo de tarjeta seleccionada
            $codigo = chunk_split(Session::get('codigo'),4);
            // Retorno los terminos..
            return response()->json(['codigo' => $codigo, 'plan' => Session::get('plan')]);
        }
    }

    public function cuenta(Request $request)
    {
        if ($request->ajax()) {

            if (Session::get('codigo')){
                // 4 sera el producto a-member y el 9 sera el producto a-card
                $code = substr(Session::get('codigo'), 0, 2);
                // Selecciono producto dependiendo del codigo
                if ($code == 90 || $code == 40) {
                    // Producto a-card / a-member
                    $producto = ($code == 90)?1:3;
                } else {
                    // producto a-doctor
                    $producto = 2;
                }

                try{
                    //Guardo CuentaPlan
                    $cuenta = AcCuenta::create([
                                    'codigo_cuenta' => Session::get('codigo'),
                                    'fecha'         => Carbon::now(),
                                    'id_producto'   => $producto,
                                    'estatus'       => 5,
                                    'acepto_terminos' => Carbon::now()
                                ]);
                    //Guardo CuentaPlan
                    $cuentaplan = AcCuentaPlan::create([
                                        'id_cuenta' => $cuenta->id,
                                        'id_plan'   => $request->plan
                                    ]);

                    if($request->plan == 8){

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

                    if($request->plan == 7){
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
                                            'data' => $e ]);
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
                                'nombre'    => $request->nombre,
                                'apellido'  => $request->apellido,
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
                                            'data' => $e ]);
                }

            }else{
                return response()->json(['error' => 'No posee cuenta valida intente nuevamente']);
           }
        }
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'pregunta1'  => 'required',
            'pregunta2'  => 'required',
            'respuesta1' => 'required',
            'respuesta2' => 'required',
            'password'   => 'required|min:6|max:16',
            'clave'      => 'required|min:4|max:6',
        ];

        $messages = [
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los claves introducidas no coinciden',
            'clave.min' => 'El mínimo de caracteres permitidos son 4',
            'clave.max' => 'El máximo de caracteres permitidos son 6',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return response()->json(['error' => $validator->getMessageBag()->toArray() ]);
        }else{

            if(Session::get('afiliado')){
                
                // Selecciono el lusuario
                $user = User::where('user','=', Session::get('afiliado')->email )->first();
                // Selecciono tipo de usuario dependiento del producto de la cuenta
                $typeUser = (Session::get('cuenta')->id_producto == 1)?5:8;

                if($user == null){
                    // Guardo el nombre del usuario
                    $name = Session::get('afiliado')->nombre.' '.Session::get('afiliado')->apellido;

                    try{
                        //Genero el usuario
                        $usuario = User::create([
                                    'name'  => $name,
                                    'email' => Session::get('afiliado')->email,
                                    'user'  => Session::get('afiliado')->email,
                                    'password' => bcrypt($request->password),
                                    'clave'    => bcrypt($request->clave),
                                    'department' => 'cliente',
                                    'type'       => $typeUser,
                                    'active'     => false,
                                    'pregunta_1'  => $request->pregunta1,
                                    'respuesta_1' => bcrypt($request->respuesta1),
                                    'pregunta_2'  => $request->pregunta2,
                                    'respuesta_2' => bcrypt($request->respuesta2),
                                    'remember_token' => str_random(100),
                                    'confirm_token'  => str_random(100),
                                    'detalles_usuario_id' => Session::get('afiliado')->id,
                                ]);
                        // Cambio estatus a pendiente de la cuenta a la espera de confirmación de correo
                        $afiliado = AcAfiliado::find(Session::get('afiliado')->id);
                        $afiliado->cuenta()->update(['estatus' => 2]);
                        
                        //dd($afiliado->id_cuenta);
                        $oPago = new AcPago();
                        $oPago->id_cuenta=$afiliado->id_cuenta;
                        $oPago->fechacorte=date("Y-m-d");
                        $oPago->monto=1;
                        $oPago->fechapago=date("Y-m-d");
                        $oPago->codtransaccion="00";
                        $oPago->modpago="";
                        $oPago->estatuspago=1;
                        $oPago->observacion="Primer pago";
                        $oPago->save();
                        
                        
                        

                        //Guardo data para enviar el correo
                        $data = [
                                'name' => $usuario->name,
                                'email' => $usuario->email,
                                'confirm_token' => $usuario->confirm_token
                            
                        ];

                        // Envio de Correo para confirmar
                      

                        // borro las sessiones afiliado, tarjeta, cuenta, terminos
                        Session::forget('afiliado');
                        Session::forget('tarjeta');
                        Session::forget('cuenta');
                        Session::forget('terminos');

                        // Retorno mensaje de sastifactorio
                        return response()->json(['success' => 'valido']);

                    }catch(QueryException $e){
                       return response()->json(['error' => '¡Ocurrio un error al generar Usuario!',
                                                'data' => $e ]);
                    }
                } else {
                    return response()->json(['error' => 'El usuario ya existe en el sistema']);
                }
            } else {
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
            
            // Guardo el valor del formulario encriptado para comparar
            $crypt = Tarjeta::cryptCode($codigo);

            //Verifico con la bd
            $tarjeta = Tarjeta::where('codigo_tarjeta',$crypt)->first();
            
            // Modifico estatus de tarjeta a usada
            $tarjeta->activada = 'S';
            $tarjeta->save();
            // Actualizo estatus de cuenta
            $cuenta = AcCuenta::where('codigo_cuenta','=',$codigo)->first();
            $cuenta->estatus = 1;
            $cuenta->save();
            // Retorno msn de felicitaciones
            return view('auth.verify')->with('success', 'Felicitaciones ya puede iniciar sesión');
        }else{
            // retorno msn de error
            return view('auth.verify')->with('error', 'Cuenta de usuario Incorrecta Intente Nuevamente');
        }
    }

    public function valido()
    {
        return view('auth.valido');
    }

    public function resend($id)
    {
        //Selecciono El usuario generado de una vez
        $usuario = User::where('detalles_usuario_id','=', $id)->first();
        // Retorno la vista
        return view('auth.resend', compact('usuario'));
    }

    public function resendEmail($id)
    {
        //Selecciono El usuario generado de una vez
        $usuario = User::find($id);

        if($usuario !== null){
            //Guardo data para enviar el correo
            $data = ['name' => $usuario->name,
                     'email' => $usuario->email,
                     'confirm_token' => $usuario->confirm_token];

            // Envio de Correo para confirmar
            Mail::send('mails.register', ['data' => $data], function($mail) use($data){
                $mail->subject('Confirma tu cuenta');
                $mail->to($data['email'], $data['name']);
            });

            // Retorno mensaje de sastifactorio
           return back()->with('success', 'Hemos enviado un enlace de confirmación a su Cuenta de correo electrónico');
        }else{
            return back()->with('error', 'Algo va mal... Usuario O Cuenta invalidos por favor comuniquese con el administrador');
        }

    }

}
