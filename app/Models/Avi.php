<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avi extends Model
{

	/**
	 * Para usar borrado suave en la base de datos*
	 */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'avi';

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
    	'id', 'name', 'modules', 'active', 'deleted_at'
    ];

    public function destinos()
    {
        return $this->hasMany(\App\Models\AviDestino::class,'avi_id','id');
    }


    public function module() {
        return $this->belongsTo(\App\Models\Avi::class, 'modules_id', 'id');
    }
}
