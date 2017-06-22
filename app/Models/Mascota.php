<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascota extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'mascotas';

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
        'cuenta_id',
        'tamano_id',
    	'nombre',
        'raza',
        'color_pelage',
        'edad',
        'fecha',
        'tipo',
        'deleted_at'
    ];

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class);
    }

    /**
     * Relación can tabla de funerario_detalle
     * @return [type] [description]
     */
    public function tamano()
    {
        return $this->belongsTo(\App\Models\Tamano::class);
    }
}