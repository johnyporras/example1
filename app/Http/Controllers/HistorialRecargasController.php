<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcAfiliado;
use App\Models\AcPago;
use App\Models\AcCuenta;
use App\Http\Requests;

class HistorialRecargasController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $oAfiliado =AcAfiliado::findOrFail($user->detalles_usuario_id);
        $oPago= new AcPago();
        $oPago->id_cuenta = $oAfiliado->id_cuenta;
        //dd($codigoCuenta);
        $rsPagos = $oPago->getPagos();
        return view("recarga.historialrecargas",compact('rsPagos'));
    }
}
