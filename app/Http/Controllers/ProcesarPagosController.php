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
    
    public function mercadoPago()
    {
        dd("aqui");
    }
}
