<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcClave extends Model {

    use SoftDeletes;
    /**
     * Generated
     */

    protected $table = 'ac_claves';
    protected $fillable = ['id', 'clave', 'cedula_afiliado', 'codigo_contrato', 'fecha_cita', 'motivo', 'observaciones', 'costo_total', 'codigo_proveedor_creador', 'correo', 'examen', 'estatus_clave', 'creador', 'telefono', 'rechazo', 'tipo_afiliado', 'cantidad_servicios', 'hora_autorizado', 'deleted_at','id_factura'];
    protected $dates = ['fecha_cita','deleted_at'];
    
     /**
     * The storage format of the model's date columns.
     * @var string
     */
    protected $dateFormat = 'Y-m-d';
    public function getClave()
    {
    	$this->select("ac_claves.id","ac_claves.clave","ac_claves.codigo_contrato",
    			"ac_claves.clave.fecha_cita","ac_claves.clave.motivo","ac_claves.clave.costo_total"
    			,"ac_claves.clave.telefono","ac_claves_detalle.detalle","ac_servicios_extranet.descripcion",
    			"ac_especialidades_extranet.descripcion","ac_procedimientos_medicos.tipo_examen")
    		->join("ac_claves_detalle","ac_clave.id","=","ac_claves_detalle.id_clave")
    		->join("ac_servicios_extranet","ac_claves_detalle.codigo_servicio","=","ac_servicios_extranet.id")
    		->join("ac_especialidades_extranet","ac_claves_detalle.codigo_especialidad","=","ac_especialidades_extranet.id")
    		->join("ac_procedimientos_medicos","ac_claves_detalle.id_procedimiento","=","ac_procedimientos_medicos.id")
    		->where("ac_claves.id","=",$this->id)
    		->get();
    }
    
    
    function setFechaCitaAttribute($date) {
        $this->attributes['fecha_cita'] = new Carbon($date);
    }
//    public function acAfiliado() {
//        return $this->belongsTo(\App\Models\AcAfiliado::class, 'cedula_afiliado', 'cedula');
//    }

    public function acEstatus() {
        return $this->belongsTo(\App\Models\AcEstatus::class, 'estatus_clave', 'id');
    }
    
    public function users() {
        return $this->belongsTo(\App\User::class, 'creador', 'id');
    }

    public function acClavesDetalles() {
        return $this->hasMany(\App\Models\AcClavesDetalle::class, 'id_clave', 'id');
    }

    public function factura() {
        return $this->belongsTo(\App\User::class, 'id_factura', 'id');
    }

    public function contratos() {
        return $this->belongsTo(\App\User::class, 'codigo_contrato', 'codigo_contrato');
    }
}
