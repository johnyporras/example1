<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcCuentaPlan extends Model
{
    
	/**
	 * [$timestamps description]
	 * @var boolean
	 */
    public $timestamps = false;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_cuentaplan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_cuenta',
        'id_plan',
        'costo',
    ];

    /**
     * Get the Plan Extranet for the Cuenta.
     */
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class, 'id_cuenta', 'id');
    }

    /**
     * Get the Plan Extranet for the Cuenta.
     */
    public function plan()
    {
        return $this->belongsTo(\App\Models\AcPlanesExtranet::class, 'id_plan', 'codigo_plan');
    }
}
