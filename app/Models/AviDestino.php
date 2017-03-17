<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AviDestino extends Model
{
	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'avi_destino';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_desde', 'fecha_hasta', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'pais_id',	'fecha_desde', 'fecha_hasta', 'deleted_at'
	];

	/**
	 * Relación con la tabla avi
	 * @return [type] [description]
	 */
	public function avi() {
        return $this->belongsTo(\App\Models\Avi::class);
    }

    /**
     * Relación con la tabla paises
     * @return [type] [description]
     */
    public function pais() {
        return $this->belongsTo(\App\Models\Pais::class);
    }
}