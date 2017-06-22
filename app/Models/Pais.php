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
    	'code', 'name_es','name_en'
    ];
}
