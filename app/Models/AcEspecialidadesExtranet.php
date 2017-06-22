<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcEspecialidadesExtranet extends Model {
    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_especialidades_extranet';

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
    protected $fillable = ['id', 'codigo_especialidad', 'rama', 'descripcion', 'deleted_at'];

    /**
     * Get the Procedimientos For Especialidades.
     */
    public function procedimientos()
    {
        return $this->hasMany(\App\Models\AcCoberturaExtranet::class,'codigo_especialidad','codigo_especialidad');
    }
    
    /**
     * Get the Claves Detalle for Especialidades.
     */
    public function acClavesDetalles() {
        return $this->hasMany(\App\Models\AcClavesDetalle::class, 'codigo_especialidad', 'codigo_especialidad');
    }

}
