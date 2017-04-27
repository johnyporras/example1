<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ac_PropaPago;
use App\Models\AcFactura;
use App\Models\Ac_DetPropaPago;
use App\Http\Requests;

class AprobarProgPagoCotroller extends Controller
{
	public function leerProgPago(Request $request)
	{
		
		$oProg = new Ac_PropaPago();
		$oProg->estatus ="2";
		$res = $oProg->leerProgPagos();
		return  view('pagos.aprogpago',compact('res'));
	}
	
	public function getDetalleProgPago(Request $request)
	{
		
		if($request->idpro!="")
		{
			$oProg = new Ac_DetPropaPago();
			$oProg->idpropago=$request->idpro;
			$res = $oProg->leerDetalles();
			if($res!="0")
			{
				$detalles = array();
				foreach ($res as $item)
				{
					$detalle["numfact"] = $item->numero_factura;
					$detalle["id"] = $item->id;
					$detalle["montofact"] = $item->montofact;
					$detalle["montoimp1"] = $item->montoimp1;
					array_push($detalles,$detalle);
				}
				
				//var_dump($detalles);die();
				$response["success"]=true;
				$response["datos"]=$detalles;
			}
			else 
			{
				$response["success"]=false;
			}
			return json_encode($response);
		}
	}
	
	
	
	
		
	public function aprobarProg(Request $request)
	{
		if($request->idprog)
		{
			$oProg=Ac_PropaPago::findOrFail($request->idprog);
			$oProg->estatus="3";
			$res = $oProg->incluir();
			if($res!=false)
			{
				$oDetallesProg = new Ac_DetPropaPago();
				$oDetallesProg->idpropago= $request->idprog;
				$resDet =$oDetallesProg->leerDetalles();
				foreach ($resDet as $item)
				{
					$oFact = new AcFactura();
					$oFact->factura=$item->idfactura;
					$oFact->nuevoestatus="11";
					$res1 = $oFact->cambiarestatusFactura();
					if($res1==true)
					{
						$response["success"]=true;
					}
					else
					{
						$response["success"]=false;
						break;
					}
				}
			}
			else
			{
				$response["success"]=false;
			}
			
			return json_encode($response);
		}
	}
}
