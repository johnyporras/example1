<?php namespace app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcProveedores extends Model {

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_proveedores_extranet';

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
        'codigo_proveedor',
        'cedula', 
        'nombre', 
        'codigo_especialidad',
        'direccion',  
        'telefono',  
        'email',     
        'tipo_cuenta',
        'numero_cuenta',
        'ciudad',
        'deleted_at'
    ];

    /**
     * Relación con los modulos
     * @return [type] [description]
     */
    public function estado() {
        return $this->belongsTo(\App\Models\AcEstado::class);
    }    
}