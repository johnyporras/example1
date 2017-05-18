<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcAfiliado extends Model {

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_afiliados';
   
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_nacimiento','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
        'email', 
        'sexo', 
        'telefono', 
        'ciudad', 
        'embarazada', 
        'tiempo_gestacion', 
        'deleted_at'
    ];
    

     /**
     * The storage format of the model's date columns.
     * @var string
     */
   /* protected $dateFormat = 'Y-m-d';
    
    function setFechaNacimientoAttribute($date) {
        $this->attributes['fecha_nacimiento'] = new Carbon($date);
    } 
        */
    
    /**
     * Get the tipo for the Afiliado.
     */  
    public function acTipoAfiliado() 
    {
        return $this->belongsTo(\App\Models\AcTipoAfiliado::class, 'tipo_afiliado', 'id');
    }

    
    /**
     * Get the cuenta for the Afiliado.
     */
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class);
    }

    /**
     * Get the estado for the Afiliado.
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\AcEstado::class);
    }

    /**
     * Get the contratos for the Afiliado.
     */
    public function contratos()
    {
        return $this->hasMany(\App\Models\AcContrato::class,'cedula_afiliado','cedula');
    }
    
}