<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avi extends Model 
{
	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'avi';

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
    	'codigo_solicitud', 
        'codigo_contrato', 
        'cobertura_monto', 
        'nro_cronograma',  
        'observaciones',     
        'creador',
        'deleted_at'
    ];

    /**
     * Relación can tabla de destinos
     * @return [type] [description]
     */
    public function destinos()
    {
        return $this->hasMany(\App\Models\AviDestino::class);
    }
}