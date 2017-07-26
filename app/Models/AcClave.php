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

    protected $fillable = ['id', 'clave', 'cedula_afiliado', 'fecha_cita', 'motivo', 'observaciones', 'costo_total', 'codigo_proveedor_creador', 'correo', 'examen', 'estatus_clave', 'creador', 'telefono', 'rechazo', 'tipo_afiliado', 'cantidad_servicios', 'hora_autorizado', 'deleted_at','id_factura', 'codigo_contrato'];

    protected $dates = ['deleted_at'];
    
     /**
     * The storage format of the model's date columns.
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

    public function getClave()
    {
    	$res = $this->select("ac_claves.id","ac_claves.clave","ac_claves.observaciones","ac_claves.codigo_contrato","ac_afiliados.nombre",
            "ac_afiliados.apellido","cedula_afiliado","ac_afiliados.email as emailafiliado",
    			"ac_claves.motivo","ac_claves.costo_total"
    			,"ac_claves.telefono","ac_claves_detalle.detalle","ac_servicios_extranet.descripcion as servicio",
    			"ac_especialidades_extranet.descripcion as especialidad","ac_procedimientos_medicos.tipo_examen as procedimiento")
    		      ->selectRaw("to_char(ac_claves.fecha_cita, 'dd/MM/YYYY') as fecha_cita")
            ->join("ac_claves_detalle","ac_claves.id","=","ac_claves_detalle.id_clave")
            ->join("ac_afiliados","ac_claves.cedula_afiliado","=","ac_afiliados.cedula")
    		->join("ac_servicios_extranet","ac_claves_detalle.codigo_servicio","=","ac_servicios_extranet.id")
    		->join("ac_especialidades_extranet","ac_claves_detalle.codigo_especialidad","=","ac_especialidades_extranet.codigo_especialidad")
    		->join("ac_procedimientos_medicos","ac_claves_detalle.id_procedimiento","=","ac_procedimientos_medicos.id")
    		->where("ac_claves.id","=",$this->id)
    		->get();
            if($res->count()>0)
            {
                return $res[0];
            }
            else
            {
                return "0";
            }
    }
    
    
    public function getHistoricoCitas()
    {
        $res = $this->select("ac_claves.id","ac_claves.clave","ac_claves.observaciones","ac_claves.codigo_contrato","ac_afiliados.nombre",
            "ac_afiliados.apellido","cedula_afiliado","ac_afiliados.email as emailafiliado",
            "ac_claves.motivo","ac_claves.costo_total","ac_proveedores_extranet.codigo_proveedor","ac_proveedores_extranet.nombre as proveedor"
            ,"ac_claves.telefono","ac_claves_detalle.detalle","ac_servicios_extranet.descripcion as servicio",
            "ac_especialidades_extranet.descripcion as especialidad","ac_especialidades_extranet.codigo_especialidad","ac_procedimientos_medicos.tipo_examen as procedimiento")
            ->selectRaw("to_char(ac_claves.fecha_cita, 'dd/MM/YYYY') as fecha_cita")
            ->join("ac_claves_detalle","ac_claves.id","=","ac_claves_detalle.id_clave")
            ->join("ac_afiliados","ac_claves.cedula_afiliado","=","ac_afiliados.cedula")
            ->join("ac_servicios_extranet","ac_claves_detalle.codigo_servicio","=","ac_servicios_extranet.id")
            ->join("ac_especialidades_extranet","ac_claves_detalle.codigo_especialidad","=","ac_especialidades_extranet.codigo_especialidad")
            ->join("ac_procedimientos_medicos","ac_claves_detalle.id_procedimiento","=","ac_procedimientos_medicos.id")
            ->join("ac_proveedores_extranet","ac_claves_detalle.codigo_proveedor","=","ac_proveedores_extranet.codigo_proveedor")
            ->where("ac_claves.cedula_afiliado","=",$this->afiliado)
            ->where("ac_claves.fecha_cita",">",$this->fecha)
            //->where("ac_claves.estatus_clave","=",7)
            ->where("ac_claves_detalle.detalle","=","1")
            ->orderBy("ac_claves.fecha_cita","desc")
            ->get();
            if($res->count()>0)
            {
                return $res;
            }
            else
            {
                return "0";
            }
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
