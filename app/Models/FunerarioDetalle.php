<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FunerarioDetalle extends Model
{
	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'funerario_detalle';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'funerario_id',	'proveedor_id', 'monto', 'deleted_at'
	];

	/**
	 * Relación con la tabla funerario
	 * @return [type] [description]
	 */
	public function funerario() {
        return $this->belongsTo(\App\Models\Funerario::class);
    }

    /**
     * Relación con la tabla proveedor_funerario
     * @return [type] [description]
     */
    public function proveedor() {
        return $this->belongsTo(\App\Models\ProveedorFunerario::class);
    }
}
