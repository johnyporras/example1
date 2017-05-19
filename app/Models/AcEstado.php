<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcEstado extends Model 
{
	/**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes; 

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_estados';

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
    protected $fillable = ['id', 'estados', 'deleted_at'];
}