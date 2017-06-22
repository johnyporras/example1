<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcEstatusDetalle extends Model {

    use SoftDeletes;
    /**
     * Generated
     */
    protected $table = 'ac_estatus_detalle';

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
    protected $fillable = ['id', 'nombre', 'deleted_at'];

}
