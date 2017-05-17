<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcCuenta extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_cuenta';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_registro','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo_cuenta',
        'fecha_registro',
        'estatus',
        'deleted_at',
    ];

    /**
     * Relación con tabla afiliados
     * @return [type] [description]
     */
    public function afiliados()
    {
        return $this->hasMany(\App\Models\AcAfiliado::class);
    }

    /**
     * Relación con tabla Pago
     * @return [type] [description]
     */
    public function pagos()
    {
        return $this->hasMany(\App\Models\Pago::class);
    }

    /**
     * Get the Producto for the Cuenta.
     */
    public function producto()
    {
        return $this->belongsTo(\App\Models\AcProducto::class);
    }

    /**
     * Get the Plan Extranet for the Cuenta.
     */
    public function plan()
    {
        return $this->belongsTo(\App\Models\AcPlanesExtranet::class);
    }
}