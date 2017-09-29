<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model
{
    /**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'tarjetas';

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
        'codigo_tarjeta',
        'activada',
        'deleted_at'
    ];

    public static function cryptCode($codigo)
    {
        // encripto valor 
        $value = hash('sha256',sha1(md5($codigo)));
        // retorno el valor encriptado
        return $value;
    }
}