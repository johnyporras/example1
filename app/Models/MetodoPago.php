<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'metodo_pago';

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
    protected $fillable = ['metodo'];
 
}