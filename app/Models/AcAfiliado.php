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
        'id_cuenta',
        'id_estado',
        'ciudad', 
        'embarazada', 
        'tiempo_gestacion', 
        'deleted_at'
    ];

    /**
     * Get the cuenta for the Afiliado.
     */
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class, 'id_cuenta', 'id');
    }

    /**
     * Get the estado for the Afiliado.
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\AcEstado::class, 'id_estado', 'id');
    }

    /**
     * Get the tipo for the Afiliado.
     */  
    public function acTipoAfiliado() 
    {
        return $this->belongsTo(\App\Models\AcTipoAfiliado::class, 'tipo_afiliado', 'id');
    } 

    /**
     * Get the contratos for the Afiliado.
     */
    public function contratos()
    {
        return $this->hasMany(\App\Models\AcContrato::class, 'cedula_afiliado', 'cedula');
    }

    /**
     * Get the documentos for the Afiliado.
     */
    public function documentos()
    {
        return $this->hasMany(\App\Models\AcDocumento::class, 'id_afiliado', 'id');
    }

    /**
     * Get the detalle del motivo for the Afiliado.
     */
    public function motivos()
    {
        return $this->hasMany(\App\Models\MotivoDetalle::class, 'id_afiliado', 'id');
    }

    /**
     * Get the detalle del motivo for the Afiliado.
     */
    public function medicamentos()
    {
        return $this->hasMany(\App\Models\Medicamento::class, 'id_afiliado', 'id');
    }

}