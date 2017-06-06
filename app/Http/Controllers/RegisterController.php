<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Tarjeta;
use App\Models\AcProducto;
use App\Models\AcPlanesExtranet;
use Session;
use Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {   
        if($request->ajax()){
            // Guardo el valor de l formulario para comparar
            $value = $request->tarjeta;

            //realizo un filtro para buscar en la tabla tarjetas
            $tarjeta = Tarjeta::get()->filter(function($record) use($value) {

                if (Hash::check($value, $record->codigo_tarjeta)) {
                    return $record;
                }else {
                    return null;
                }

            })->first();

            if ($tarjeta != null) {
				
				if ($tarjeta->activada == 'N') {

                    Session::set('tarjeta', $tarjeta);
                    Session::set('codigo', $value);

	            	return response()->json(['success' => 'Tarjeta Valida']);
	            } else {
	            	return response()->json(['error' => 'Tarjeta ya fue activada']);
	            }

            } else {

                Session::forget('tarjeta', $tarjeta);
                Session::forget('codigo', $value);
               
            	return response()->json(['error' => 'Tarjeta Invalida']);
            }
            
        }
    }

    public function productos (Request $request){
        //if ($request->ajax()) {
            //cargo los metodos de pago
            $productos = AcProducto::orderBy('nombre', 'ASC')
                                ->pluck('nombre', 'id');
            
            return response()->json(['data' => $productos]);
        //}
    }
}