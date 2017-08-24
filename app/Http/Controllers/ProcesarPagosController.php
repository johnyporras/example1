<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcAfiliado;
use App\Models\AcPago;
use App\Models\AcCuenta;
use App\Lib\MP;

class ProcesarPagosController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $oAfiliado =AcAfiliado::findOrFail($user->detalles_usuario_id);
        $oPago= new AcPago();
        $oPago->id_cuenta = $oAfiliado->id_cuenta;
        $oPago->estatuspago = "1";
        $rsPagos = $oPago->getPagos();
        if($rsPagos=="0")
        {
            $oCuenta=AcCuenta::findOrFail($oAfiliado->id_cuenta);
            $oPago->fechacorte =date('Y-m-j',strtotime( '+1 month' , strtotime ( $oCuenta->fecha )));
            $oPago->monto= $oCuenta->producto->costo;
            $oPago->estatuspago= "1";
            $oPago->save();
        }
        return view("recarga.recarga",compact('oPago'));
    }
    
    public function mercadoPago(Request $request1)
    {
       // dd($request1);
        $mp = new MP('TEST-4388033907515043-072820-53369c38e02589311ffe7655e269bc7f__LB_LD__-91609941'); //insira aqui o access token
        
        $payment_data = array(
            "transaction_amount"   => 100, //valor da compra
            "token"                => $request1->token, //token gerado pelo javascript da index.php
            "description"          => "Prueba de pago", //descrição da compra
            "installments"         => 1, //parcelas
            "payment_method_id"    => $request1->paymentMethodId, //forma de pagamento (visa, master, amex...)
            "payer"                => array ("email" => $request1->email), //e-mail do comprador
            "statement_descriptor" => "atiempo" //nome para aparecer na fatura do cartão do cliente
        );
        
        $payment = $mp->post("/v1/payments", $payment_data);
        
        echo "<pre>";
        print_r($payment);
        
    }
}
