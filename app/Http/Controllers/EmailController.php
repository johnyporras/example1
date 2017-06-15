<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class EmailController extends Controller
{
    public function send(Request $request){

    	//Guardo data para enviar el correo
        $data = ['name' => 'Roger Briceño',
                'email' => 'rabriceno@brizerconsulting.com',
            ];

        // Envio de Correo para confirmar 
        Mail::send('mails.prueba', ['data' => $data], function($mail) use($data){
            $mail->subject('Correo de Prueba');
            $mail->to($data['email'], $data['name']);
        });

        return response()->json(['message' => 'Mensaje Enviado Correctamente']);
	}
}