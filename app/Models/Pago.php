<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'pagos';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_pago', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo_confirmacion',
        'monto',
        'fecha_pago',
        'estatus',
        'deleted_at'
    ];

    /**
     * Get the cuenta for the pago.
     */
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class);
    }
}