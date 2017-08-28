<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialExamen extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'historial_examenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_historial',
        'examen'
    ];

    /**
     * Relación can tabla usuarios
     * @return [type] [description]
     */
    public function historial()
    {
        return $this->belongsTo(\App\Models\HistorialMedico::class, 'id_historial');
    }

}
