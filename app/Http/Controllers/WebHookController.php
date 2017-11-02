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
use App\Models\OrdenesWeb;
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
        //get request data
        $valores = json_decode($request->getContent(),true);
        $action = $request->header('x-wc-webhook-topic');

        if($action === "order.created"){
          //create new order in BD
          foreach($valores['line_items'] as $prod){
            for($i=0;$i<$prod['quantity'];$i++){
          $order = OrdenesWeb::create([
                            'id_orden' => $valores['number'],
                            'nombre'   => $valores['billing']['first_name'],
                            'apellido' => $valores['billing']['last_name'],
                            'email'    => $valores['billing']['email'],
                            'producto' => $prod['sku'],
                            'codigo'   => '0',
                            'fecha'    => $valores['date_created'],
                            'status'   => $valores['status'],
                            'pais'     => $valores['billing']['country'],
                            'moneda'   => $valores['currency'],
                            'metodo_pago' => $valores['payment_method_title'],
                        ]);
                      }//end for
                      }//end foreach
            if($order){
              return response()->json('success', 200);
            }else{
              return response()->json('success', 220);
            }//end order validation

        }else if($action === "action.woocommerce_order_status_completed"){
          //Payment completed - update order and send code
          if($request['action'] ==="woocommerce_order_status_completed"){
            //Get order products
            $order = OrdenesWeb::where('id_orden',$request['arg'])->get();
            foreach($order as $prod){
              // get product by code
              if($prod->status === "pending"){
              if ($prod->producto == "AT-90" || $prod->producto == "AT-40" || $prod->producto == "AT-20") {
                  // Product a-card / a-member / a-doctor
                  if($prod->producto == "AT-90"){
                    $tplan = 'A-CARD';
                  }else if($prod->producto == "AT-40"){
                      $tplan = 'A-MEMBER';
                  }else{
                      $tplan = 'A-DOCTOR';
                  }

                  // Genrate card code

                  $val = 0;
                  $count = 0;
                  $tarjeta = 1;
                  $pais = Pais::where('code',$order->pais);

                  //creating new code
                  while($tarjeta !== null){
                    $value1 = rand(11111,55555);
                    $value2 = rand(66666,99999);
                    if($prod->producto == "AT-40"){
                      //validar pais***
                      $codigo = '40'.$pais->codigo.'03001'.$value1.$value2;
                    }else if($prod->producto == "AT-90"){
                      //validar pais***
                      $codigo = '90'.$pais->codigo.'03001'.$value1.$value2;
                    }else{
                        $codigo = '20'.$pais->codigo.'03001'.$value1.$value2;
                    }
                    //encript generated code
                    $crypt = Tarjeta::cryptCode($codigo);
                    //validate it does't exist in DB
                    $tarjeta = Tarjeta::where('codigo_tarjeta',$crypt)->first();
                    if($tarjeta === null){
                      $val = 1;
                      //store code in db
                      $Tarjeta = Tarjeta::create([
                                        'codigo_tarjeta' => $crypt,
                                        'activada'         => 'N'
                                    ]);
                        $prod->codigo = $codigo;
                        $prod->status = "completed";
                        $prod->save();

                        //Guardo data para enviar el correo
                        $data = ['name'  => $prod->nombre." ".$prod->apellido,
                                 'email'  => $prod->email,
                                 'codigo' => $codigo,
                                	'plan'   => $tplan];


                        // Envio de Correo para confirmar
                        Mail::send('mails.activate', ['data' => $data], function($mail) use($data){
                                                    $mail->subject('Gracias por su Compra');
                                                    $mail->to($data['email'], $data['name']);
                                                });
                    }else{
                      $val = 0;
                    }
                    $count++;


                  }//end while
                    // Success Response
                  return response()->json('success '.$count, 200);
              }else {
                  //product without code
                  return response()->json('success', 200);
              }
            }else{
              return response()->json('success', 200);
            }//end if validate status product
            }

          }
        }else{
          //Response
          return response()->json('success', 200);

        }//end if/else action

    }//end index
    }//end controller
