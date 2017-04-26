<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac_DetPropaPago extends Model
{
	protected $table = 'ac_detprogpago';
	public function incluir()
	{
		try
		{
			if($this->save())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch ( \Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	
	public function eliminar()
	{
		try
		{
			if($this->delete())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch ( \Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	public function leerDetalles()
	{
		$res = $this->select("ac_detprogpago.id_factura as idfactura","numero_factura","ac_detprogpago.id","montofact","montoimp1")
			->join("ac_facturas","ac_detprogpago.id_factura","=","ac_facturas.id")
			->where("id_progpago","=",$this->idpropago)
			->get();
		if($res->count()>0)
		{
			return $res;
		}
		else
		{
			return false;
		}
	}
}
