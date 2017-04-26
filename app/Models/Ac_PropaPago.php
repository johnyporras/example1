<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac_PropaPago extends Model
{
	protected $table = 'ac_progpago';
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
	
	public function actualizar()
	{
		try
		{
			if($this->update())
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
	
	public function leerProgPagos()
	{
		$res = $this->select("ac_progpago.id","proveedor_id","ac_progpago.created_at as fecha"
				,"ac_proveedores_extranet.nombre as nomprov")
					->selectRaw("(select count(*) from ac_detprogpago where id_progpago=ac_progpago.id) as cantfacturas")
					->selectRaw("(select sum(montofact) from ac_detprogpago  where id_progpago=ac_progpago.id) as montfacturas")
					->selectRaw("(select sum(montoimp1) from ac_detprogpago  where id_progpago=ac_progpago.id) as montimpfacturas")
					->join("ac_proveedores_extranet","ac_progpago.proveedor_id","=","ac_proveedores_extranet.codigo_proveedor")
			->where("estatus","=",$this->estatus)->get();
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
