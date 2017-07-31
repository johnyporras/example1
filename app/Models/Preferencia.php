<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferencia extends Model
{
    /**
     *  Name of database
     * @var string
     */
    protected $table = 'preferencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'codigo', 'datos'];
    
}