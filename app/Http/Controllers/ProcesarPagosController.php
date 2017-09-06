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
        $oCuenta=AcCuenta::findOrFail($oAfiliado->id_cuenta);
        $codigoCuenta = substr($oCuenta->codigo_cuenta, 2,3);
        //dd($codigoCuenta);
        $rsPagos = $oPago->getPagos();
        if($rsPagos=="0")
        {
            $oPago->fechacorte =date('Y-m-j',strtotime( '+1 month' , strtotime ( $oCuenta->fecha )));
            $oPago->monto= $oCuenta->producto->costo;
            $oPago->estatuspago= "1";
            $oPago->save();
        }
        else 
        {
            $oPago->estatuspago = "1";
            $rsPagos = $oPago->getPagos();
        }
        
        
        if($codigoCuenta=="058")
        {
            return view("recarga.recarga",compact('rsPagos'));
        }
        else 
        {
            return view("recarga.recargapaypalform",compact('rsPagos'));
        }
        
        //return view("recarga.recargapaypalform",compact('rsPagos'));
    }
    
   
    public function mercadoPago(Request $request1)
    {
      // dd($request1->paymentMethodId);
       // $mp = new MP('TEST-4388033907515043-072820-53369c38e02589311ffe7655e269bc7f__LB_LD__-91609941'); 
        $mp = new MP('TEST-4268578252492942-082417-17db3f4279462eb42cfae6f00f2398da__LC_LB__-265132865');
        //dd($request1->paymentMethodId);
        $payment_data = array(
            "transaction_amount"   => intval($request1->monto), //valor da compra
            "token"                => $request1->token, //token gerado pelo javascript da index.php
            "description"          => "Pago de Servicios a tiempo", //descrição da compra
            "installments"         => 1, //parcelas
            "payment_method_id"    =>"visa", //forma de pagamento (visa, master, amex...)
            "payer"                => array ("email" => $request1->email), //e-mail do comprador
            "statement_descriptor" => "sistema on line atiempo" //nome para aparecer na fatura do cartão do cliente
        );
        
         $payment = $mp->post("/v1/payments", $payment_data);
         $estatus = $payment["status"];
         if($estatus==201 || $estatus==200)
        {
            $pagos = explode("|",$request1->idpago);
            $cantPagos=count($pagos);
            for($i=1;$i<$cantPagos;$i++)
            {
                $oPago= AcPago::findOrFail($pagos[$i]);
                $oPago->estatuspago = "2";
                $oPago->observacion = "Pago realizado con exito";
                $oPago->fechapago = \date("Y-m-d");
                $oPago->hora= \date('H:i');
                $res = $oPago->save();
            } 
            if($res)
            {
                $response["pagoexitoso"]= true;    
            }
            else 
            {
                $response["pagoexitoso"]= false;    
            }
         }
        
        return view("recarga.respuestapago",compact('response'));
    }
}
