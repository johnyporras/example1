<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'paises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name_es','name_en', 'codigo_contrato'
    ];
}
