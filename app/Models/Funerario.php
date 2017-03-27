<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funerario extends Model
{
	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'funerario';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_solicitud','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo_solicitud',
        'fecha_solicitud', 
        'estado_id', 
        'ciudad',
        'nombre_fallecido',  
        'cedula_fallecido',  
        'telefono_titular',
        'cobertura',
        'excedente',
        'metodo_id',
        'plazo',
    	'aseguradora_id',
        'colectivo_id',
        'creador',
        'deleted_at'
    ];

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function detalles()
    {
        return $this->hasMany(\App\Models\FuneraioDetalle::class);
    }

    /**
     * Relación con la tabla ac_estados
     * @return [type] [description]
     */
    public function estado() {
        return $this->belongsTo(\App\Models\AcEstado::class);
    }

    /**
     * Relación con la tabla metodo_pago
     * @return [type] [description]
     */
    public function metodoPago() {
        return $this->belongsTo(\App\Models\MetodoPago::class);
    }

    /**
     * Relación con la tabla ac_aseguradora
     * @return [type] [description]
     */
    public function aseguradora() {
        return $this->belongsTo(\App\Models\AcAseguradora::class);
    }

    /**
     * Relación con la tabla ac_colectivo
     * @return [type] [description]
     */
    public function colectivo() {
        return $this->belongsTo(\App\Models\AcColectivo::class);
    }

    /**
     * Relación con la tabla users
     * @return [type] [description]
     */
    public function creador() {
        return $this->belongsTo(\App\Models\Avi::class);
    }
}