<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'contactos';

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
        'id_afiliado',
    	'nombre', 
        'telefono', 
        'parentesco', 
        'deleted_at'
    ];

    /**
     * Paso a Mayuscula el nombre
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function afiliado()
    {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'id_afiliado');
    }
}