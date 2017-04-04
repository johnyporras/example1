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
        'estado_id', 
        'afiliado_id',
        'ciudad',  
        'contacto',
        'cobertura',
        'metodo_id',
        'plazo',
    	'doc_cedula',
        'doc_acta',
        'creador',
        'deleted_at'
    ];

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function afiliado()
    {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'afiliado_id');
    }

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function presupuestos()
    {
        return $this->hasMany(\App\Models\FunerarioDetalle::class);
    }

    /**
     * Relación con la tabla ac_estados
     * @return [type] [description]
     */
    public function estado() {
        return $this->belongsTo(\App\Models\AcEstado::class, 'estado_id', 'es_id');
    }

    /**
     * Relación con la tabla metodo_pago
     * @return [type] [description]
     */
    public function pago() {
        return $this->belongsTo(\App\Models\MetodoPago::class, 'metodo_id'); 
    }

    /**
     * Relación con la tabla contratos
     * @return [type] [description]
     */
    public function contratos() {

        return $this->belongsToMany(\App\Models\AcContrato::class, 'contrato_funeraio', 'funerario_id', 'contrato_id');
    }

    /**
     * Relación con la tabla users
     * @return [type] [description]
     */
    public function creador() {
        return $this->belongsTo(\App\User::class, 'creador');
    }
}