<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenesWeb extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ordenes_web';

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
        'id_orden',
        'nombre',
        'apellido',
        'email',
        'producto',
        'codigo',
        'fecha',
        'status',
        'pais',
        'moneda',
        'metodo_pago',
        'deleted_at'
    ];

}
