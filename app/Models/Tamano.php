<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamano extends Model
{
	
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'tamanos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'titulo',
        'descripcion'
    ];

    /**
     * Get the mascotas.
     */
	public function mascotas()
	{
        return $this->hasMany(\App\Models\Mascota::class);
    }
}