<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcBaremo extends Model {

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_baremos';
   
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
        'id', 'id_procedimiento', 'id_proveedor', 'monto', 'observaciones', 'deleted_at'
    ];
    
    /**
     * Get the cuenta for the AcProveedoresExtranet.
     */
    public function acProveedoresExtranet() {
        return $this->belongsTo(\App\Models\AcProveedoresExtranet::class, 'id_proveedor', 'codigo_proveedor');
    }

    /**
     * Get the estado for the AcProcedimientosMedico
     */
    public function acProcedimientosMedico() {
        return $this->belongsTo(\App\Models\AcProcedimientosMedico::class, 'id_procedimiento', 'id');
    }

}