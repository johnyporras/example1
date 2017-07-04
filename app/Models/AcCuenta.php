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
    protected $dates = ['fecha', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo_cuenta',
        'fecha',
        'estatus',
        'id_producto',
        'acepto_terminos',
        'deleted_at'
    ];

    /**
     * Get the Producto for the Cuenta.
     */
    public function status()
    {
        return $this->belongsTo(\App\Models\EstatusCuenta::class, 'estatus'); 
    }

    /**
     * Get the Producto for the Cuenta.
     */
    public function producto()
    {
        return $this->belongsTo(\App\Models\AcProducto::class); 
    }

    /**
     * Relación con tabla afiliados
     * @return [type] [description]
     */
    public function afiliados()
    {
        return $this->hasMany(\App\Models\AcAfiliado::class, 'id_cuenta', 'id');
    }

    /**
     * Get the Plan Extranet for the Cuenta.
     */
    public function cuentaPlan()
    {
        return $this->hasMany(\App\Models\AcCuentaplan::class, 'id_cuenta', 'id');
    }

    /**
     * Relación con tabla Pago
     * @return [type] [description]
     */
    public function pagos()
    {
        return $this->hasMany(\App\Models\Pago::class);
    }
 
}