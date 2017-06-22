<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcUbicacionTratamiento extends Model 
{
    /**
     * Generated
     */
    protected $table = 'ac_ubicacion_tratamiento';

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'descripcion', 'deleted_at'];

}