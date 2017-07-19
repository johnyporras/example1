<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MotivoDetalle extends Model
{
     /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'motivo_detalles'; 

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
        'id_motivo',
        'id_afiliado',
        'tipo',
        'cantidad',
        'frecuencia',
        'causa',
        'fecha',
        'tratamiento',
        'profecional',
        'comentarios',
        'deleted_at'
    ];

    /**
     * Get the Motivo.
     */
    public function motivo() {
        return $this->belongsTo(\App\Models\Motivo::class, 'id_motivo', 'id');
    }

    /**
     * Get the Afiliado
     */
    public function afiliado() {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'id_afiliado', 'id');
    }

}