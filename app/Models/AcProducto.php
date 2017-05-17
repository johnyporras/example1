<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcProducto extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_producto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
        'costo',
        'deleted_at',
    ];

    /**
     * Relación can tabla afiliados
     * @return [type] [description]
     */
    public function cuentas()
    {
        return $this->hasMany(\App\Models\AcCuenta::class);
    }
}