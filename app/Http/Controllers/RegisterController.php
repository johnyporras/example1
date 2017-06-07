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
            
            $producto = $request->producto;

            $plan = $request->plan;

            return response()
                    ->json(['data' => [
                        'producto' => $producto, 
                        'plan' => $plan]
                    ]);
        //}
    }
}