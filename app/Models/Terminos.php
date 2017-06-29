<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Terminos extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'terminos';

    /**
     * [$timestamps description]
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'pais_id', 'terminos'
    ];

    /**
	 * Relación con la tabla pais
	 */
	public function pais() {
        return $this->belongsTo(\App\Models\Pais::class);
    }
}
