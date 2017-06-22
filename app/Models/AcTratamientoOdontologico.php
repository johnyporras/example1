<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcTratamientoOdontologico extends Model {

    use SoftDeletes;
    /**
     * Generated
     */
    protected $table = 'ac_tratamientos_odontologicos';

    protected $fillable = ['id', 'clave', 'tratamiento_realizado', 'fecha_tratamiento', 'dientes', 'estatus', 'fecha_creacion', 'fecha_modifico', 'usuario_creador', 'usuario_modifico', 'rechazo', 'doc1', 'doc2', 'deleted_at'];

    protected $dates = ['fecha_tratamiento', 'fecha_creacion', 'fecha_modifico', 'deleted_at'];

    public function acEstatusDetalle() {
        return $this->belongsTo(\App\Models\AcEstatusDetalle::class, 'estatus', 'id');
    }

    public function acClaveOdontologica() {
        return $this->belongsTo(\App\Models\AcClaveOdontologica::class, 'id_clave', 'id');
    }

    public function acProcedimientosMedico() {
        return $this->belongsTo(\App\Models\AcProcedimientosMedico::class, 'id_procedimiento', 'id');
    }

    public function acDiente() {
        return $this->belongsTo(\App\Models\AcDiente::class, 'id_diente', 'id');
    }
    
    public function acUbicacionTratamiento() {
        return $this->belongsTo(\App\Models\AcUbicacionTratamiento::class, 'id_ubicacion', 'id');
    }

}
