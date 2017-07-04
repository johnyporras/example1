<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstatusCuenta extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'estatus_cuenta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'descripcion'
    ];

    /**
	 * Relación con la tabla AcCuenta
	 */
	public function cuentas() {
        return $this->hasMany(\App\Models\AcCuenta::class);
    }
}
