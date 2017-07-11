<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicamento extends Model
{
    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'medicamentos'; 

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
    	'id_tipo_medicamento',
    	'id_afiliado',
    	'nombre',
       	'dosis',
       	'frecuencia',
       	'duracion',
        'diagnostico',
       	'recetado',
        'file',
        'fecha_inicio',
        'fecha_fin',
        'hora',
        'mensaje', 
        'deleted_at'
    ];

    /**
     * Get the Motivo.
     */
    public function tipo() {
        return $this->belongsTo(\App\Models\TipoMedicamento::class, 'id_tipo_medicamento', 'id');
    }

    /**
     * Get the Afiliado
     */
    public function afiliado() {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'id_afiliado', 'id');
    }
}
