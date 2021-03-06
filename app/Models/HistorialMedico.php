<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialMedico extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'historial_medico';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_afiliado',
    	'fecha', 
        'motivo', 
        'especialidad', 
        'tratamiento',
        'medico',  
        'procedimiento',
        'diagnostico',    
        'observaciones',
        'recomendaciones',
        'deleted_at'
    ];

    /**
     * Relación can tabla afiliado
     * @return [type] [description]
     */
    public function afiliado()
    {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'id_afiliado');
    }

    /**
     * Relación can tabla usuarios
     * @return [type] [description]
     */
    public function usuario()
    {
        return $this->belongsTo(\App\User::class, 'id_user');
    }

    /**
     * Relación can tabla de destinos
     * @return [type] [description]
     */
    public function examenes()
    {
        return $this->hasMany(\App\Models\HistorialExamen::class, 'id_historial');
    }
}
