<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Tarjeta;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {   
       //if($request->ajax()){
            
         	// Valido si existe la tarjeta
            $tarjeta = Tarjeta::where('codigo_tarjeta', '=', $request->tarjeta)->first();

            if ($tarjeta != null) {
				
				if ($tarjeta->activada == 'N') {
	            	return response()->json($tarjeta);
	            } else {
	            	return response()->json(['error' => 'Tarjeta ya fue activada']);
	            }

            } else {

            	return response()->json(['error' => 'Tarjeta Invalida']);
            }
            
       // }

    }
}