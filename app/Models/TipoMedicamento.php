<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMedicamento extends Model
{
    
    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'tipo_medicamentos'; 

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
        'descripcion', 
        'deleted_at'
    ];

    /**
     * Get the Medicamentos.
     */
    public function medicamentos()
    {
        return $this->hasMany(\App\Models\Medicamento::class,'id_tipo_medicamento', 'id');
    }
}
