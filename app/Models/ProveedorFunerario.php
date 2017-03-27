<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProveedorFunerario extends Model
{
	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'proveedor_funerario';

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
    	'codigo',
        'razon_social', 
        'gif', 
        'direccion',
        'telefono',
        'movil',
        'deleted_at'
    ];

    /**
     * Relación can tabla funerario
     * @return [type] [description]
     */
    public function funerarios()
    {
        return $this->hasMany(\App\Models\Funeraio::class);
    }
}
