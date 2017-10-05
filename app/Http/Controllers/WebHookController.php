<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\AcAfiliado;
use App\Models\AcCuenta;
use App\Models\AcCuentaPlan;
use App\Models\AcProducto;
use App\Models\AcPlanesExtranet;
use App\Models\Pais;
use App\Models\Tarjeta;
use App\User;
use Hash;
use Mail;
use Session;
use Validator;
use Carbon\Carbon;
use DB;

class WebHookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Variables momentaneas hasta obtener valor del webhook de woocomerce
        $var =  ['codigoProducto' => '40',
        		'email' => 'rabricenog@gmail.com',
        		'name' => 'Roger Briceno'];
        // convierto en json para emular el archivo  que trae el webhook
        $valor = json_encode($var);
        // decodifico el json enviado por el webhook
        $decode = json_decode($valor);



        //realizo un filtro para buscar en la tabla tarjetas
        /*$tarjeta = Tarjeta::get()->filter(function($record) use($codigo) {
            // Chequea si cel codigo coincide con alguna tarjeta registrada
            if (Hash::check($codigo, $record->codigo_tarjeta)) {
                return $record;
            }else {
                return null;
            }
        })->first();*/
        $codigo = $decode->codigoProducto; 
        if ($codigo !== null) {

        	// Codigo separado de 4 en 4
        	//$code = chunk_split($decode->codigoProducto,4);

        	// tipo de plan dependiendo de codigo
            $plan = $decode->codigoProducto;

            // Selecciono producto dependiendo del codigo
            if ($plan == 90 || $plan == 40) {
                // Producto a-card / a-member
                $tplan = ($plan == 90)?'A-CARD':'A-MEMBER';
                // Genero la tarjeta

                $val = 0;
                $count = 0;
                $tarjeta = 1;
                //Generando una nueva tarjeta que no exista en la base datos
                while($tarjeta !== null){
                  $value1 = rand(11111,55555);
                  $value2 = rand(66666,99999);
                  if($plan == 40){
                    echo $codigo = '4005803001'.$value1.$value2;
                  }else{
                    $codigo = '9005803001'.$value1.$value2;
                  }

                  //encripto tarjeta generada
                  echo $crypt = Tarjeta::cryptCode($codigo);
                  //valido en la base de datos que no exista
                  $tarjeta = Tarjeta::where('codigo_tarjeta',$crypt)->first();
                  if($tarjeta === null){
                    $val = 1;
                    //Guardo tarjeta generada en la base de date_default_timezone_set
                    $Tarjeta = Tarjeta::create([
                                      'codigo_tarjeta' => $crypt,
                                      'activada'         => 'N'
                                  ]);
                  }else{
                    $val = 0;
                  }
                  echo $count++;
                }





            } else {
                // producto a-doctor
                $tplan = 'A-DOCTOR';
            }
            // Verifica si la tarjeta fue activada o no
            //if ($tarjeta->activada == 'N') {

            	//Guardo data para enviar el correo
                $data = ['name'  => $decode->name,
                        'email'  => $decode->email,
                        'codigo' => $codigo,
                    	'plan'   => $tplan];


            	// Envio de Correo para confirmar
               	Mail::send('mails.activate', ['data' => $data], function($mail) use($data){
                    $mail->subject('Gracias por su Compra');
                    $mail->to($data['email'], $data['name']);
                });
          //  }
            // Success Response
			return response()->json('success '.$count, 200);
        }
    }
}
