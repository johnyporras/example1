<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ac_PropaPago;
use App\Models\AcFactura;
use App\Models\Ac_DetPropaPago;
use App\Http\Requests;

class ActuaizarProgPagoCotroller extends Controller
{
	public function leerProgPago(Request $request)
	{
		
		$oProg = new Ac_PropaPago();
		$oProg->estatus ="1";
		$res = $oProg->leerProgPagos();
		return  view('pagos.actprogpago',compact('res'));
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
	
	
	public function getFacturas(Request $request)
	{
		
		if($request->idprove!="")
		{
			$oFact = new AcFactura();
			$oFact->idprov=$request->idprove;
			$res = $oFact->leerFacturasProv();
			if($res!="0")
			{
				$detalles = array();
				foreach ($res as $item)
				{
					$detalle["numfact"] = $item->numero_factura;
					$detalle["id"] = $item->id;
					$detalle["montofact"] = $item->monto;
					$detalle["proveedor"] = $item->proveedor;
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
	
	
	public function elimDetalleProgPago(Request $request)
	{
		if($request->idpro!="")
		{
			$oProg = Ac_DetPropaPago::findOrFail($request->idpro);
			$res = $oProg->eliminar();
			if($res!="0")
			{
				$oFact = new AcFactura();
				$oFact->factura=$oProg->id_factura;
				$oFact->nuevoestatus="3";
				$res = $oFact->cambiarestatusFactura();
				if($res!="")
				{
					$response["success"]=true;
				}
				else 
				{
					$response["success"]=false;
				}
			}
			else
			{
				$response["success"]=false;
			}
			
			return json_encode($response);
		}
	}
	
	
	public function incDetalleProgPago(Request $request)
	{
		if($request->idfact!="" && $request->idprog!="")
		{
			$oFact=AcFactura::findOrFail($request->idfact);
			$monpor = ($oFact->monto*2)/100;
			$monto =$oFact->monto-$monpor;
			$oProg = new  Ac_DetPropaPago();
			$oProg->id_factura=$request->idfact;
			$oProg->montofact=$monto;
			$oProg->montoimp1=$monpor;
			$oProg->id_progpago=$request->idprog;
			$res = $oProg->incluir();
			if($res!="0")
			{
				$oFact = new AcFactura();
				$oFact->factura=$oProg->id_factura;
				$oFact->nuevoestatus="3";
				$res = $oFact->cambiarestatusFactura();
				if($res==true)
				{
					$response["success"]=true;
				}
				else
				{
					$response["success"]=false;
				}
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
			$oProg->estatus="2";
			$res = $oProg->actualizar();
			if($res!="0")
			{
				if($res==true)
				{
					$response["success"]=true;
				}
				else
				{
					$response["success"]=false;
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
