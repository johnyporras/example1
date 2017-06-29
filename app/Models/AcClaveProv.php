<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcClaveProv extends Model
{
    
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_clavedetalleprov';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fechacita'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_clave',
        'id_proveedor',
        'aceptado',
        'observacion',
        'preferido',
        'fechacita',
        'rangohoracita'   
    ];

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


    public function getProvSecundario()
    {
        $res = $this->select("ac_proveedores_extranet.id","ac_proveedores_extranet.nombre","ac_proveedores_extranet.email","ac_proveedores_extranet.codigo_proveedor")
                ->join("ac_proveedores_extranet","ac_clavedetalleprov.id_proveedor","=","ac_proveedores_extranet.codigo_proveedor")
                ->where("id_clave","=",$this->idclave)
                ->where("preferido","=",0)->get();

//dd($this->idclave);

          if($res->count()>0)
          {
            return $res[0];
          }    
          else
          {
            return "0";
          }  
    }
}