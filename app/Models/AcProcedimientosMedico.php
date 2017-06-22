<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcProcedimientosMedico extends Model 
{
    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_procedimientos_medicos';

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
    protected $fillable = ['id', 'codigo_examen', 'codigo_especialidad', 'codigo_servicio', 'tipo_examen', 'orden', 'deleted_at'];


    public function acEspecialidadesExtranet() {
        return $this->belongsTo(\App\Models\AcEspecialidadesExtranet::class, 'codigo_especialidad', 'codigo_especialidad');
    }

    public function acServiciosExtranet() {
        return $this->belongsTo(\App\Models\AcServiciosExtranet::class, 'codigo_servicio', 'codigo_servicio');
    }

    /**
     * Get the Coberturas for Procedimiento.
     */
    public function coberturas()
    {
        return $this->hasMany(\App\Models\AcCoberturaExtranet::class,'id_procedimiento','id');
    }
    
    /**
     * Get the Baremos for Procedimiento.
     */
    public function baremos()
    {
        return $this->hasMany(\App\Models\AcBaremo::class,'id_procedimiento','id');
    }
    
    /**
     * Get the Claves Detalle for Especialidades.
     */
    public function acClavesDetalles() {
        return $this->hasMany(\App\Models\AcClavesDetalle::class, 'id_procedimiento', 'id');
    }
}
