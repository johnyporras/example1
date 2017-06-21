<?php namespace app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcProveedoresExtranet extends Model {

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
    protected $fillable = ['id', 'codigo_proveedor', 'cedula', 'nombre', 'codigo_especialidad', 'direccion', 'telefono', 'email', 'tipo_cuenta', 'numero_cuenta', 'estado_id', 'ciudad', 'deleted_at'];

    
    /**
     * Get the Baremos for Proveedores.
     */
    public function leerProv()
    {
    	$res = $this->select("nombre","direccion","telefono","email")
    				->where("codigo_proveedor","=",$this->codigo_proveedor)
    				->get();
    	if($res->count()>0)
    	{
    		return $res[0];
    	}
    	else 
    	{
    		return 0;
    	}
    }
    
    public function acBaremos()
    {
        return $this->hasMany(\app\Models\AcBaremo::class,'id_proveedor','codigo_proveedor');
    }

    /**
     * Get the claves Detalle for Proveedores.
     */
    public function acClavesDetalles()
    {
        return $this->hasMany(\App\Models\AcClavesDetalle::class,'codigo_proveedor','codigo_proveedor');
    }
    
    /**
     * Get the users for Proveedores.
     */
    public function acUsers()
    {
        return $this->hasMany(\App\Models\AcClavesDetalle::class,'proveedor','codigo_proveedor');
    }

    /**
     * Get the users for Proveedores.
     */
    public function acCartaAvalDetalles()
    {
        return $this->hasMany(\App\Models\AcClavesDetalle::class,'codigo_proveedor','codigo_proveedor');
    }

    /**
     * Relación con la tabla ac_estados
     * @return [type] [description]
     */
    public function estado() {
        return $this->belongsTo(\App\Models\AcEstado::class);
    }
    
}