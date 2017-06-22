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
        'preferido'
        'fechacita'
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
}