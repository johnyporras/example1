<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class customResetPass extends Controller
{
    public function __construct()
    {
        
        $this->middleware('guest');
    }
    
    
    public function validarEmail(Request $request)
    {
        if($request->email!="")
        {
            $user = User::where('email',$request->email)->first();
            if($user==null)
            {
                return back()->withErrors(['email' => ['Disculpe, el email '.$request->email.' no est&aacute; registrado en nuestro sistema']]);
            }
            else 
            {
                return view('auth.passwords.preguntas',compact('user'));
            }
        }
    }
    public function validarResp(Request $request)
    {
        if($request->respuesta1!="" && $request->respuesta2!="")
        {
            $ouser= new User();
            $ouser->respuesta1=$request->respuesta1;
            $ouser->respuesta2=$request->respuesta2;
            $ouser->id=$request->id;
            $user = User::findOrFail($request->id);
            if(!$ouser->validaRespuestas())
            {
                return view('auth.passwords.preguntas',compact('user'));
            }
            else
            {
                
                $password_broker = app(PasswordBroker::class); //so we can have dependency injection
                $token = $password_broker->createToken($user); //create reset password token
                
                $data = [
                    'token' =>$token,
                    'nombre' => $user->nombre,
                    'apellido' =>$user->apellido,
                    'email' =>$user->email
                ];
                
                
                // Envio de Correo para confirmar
                Mail::send('mails.resetclave', ['data' => $data], function($mail) use($user){
                    $mail->subject('Reestablecer Clave');
                    $mail->to($user->email, $user->nombre);
                });
                    
                //return view('auth.passwords.preguntas',compact('user'));
            }
        }
    }
    
    
    public function resetPassword1()
    {
        dd("<asdsd");
    /*    $user = User::where('email', 'afiliado@corporacionatiempo.com' )->first();
        $password_broker = app(PasswordBroker::class); //so we can have dependency injection
        $token = $password_broker->createToken($user); //create reset password token
        dd($token);
        $password_broker->emailResetLink($user, $token, function () {
            // $message->subject('Custom Email title');
            
            echo "aqui111";die();
        });//send email.*/
    }
}
