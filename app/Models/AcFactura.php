<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcFactura extends Model {

    use SoftDeletes;
    /**
     * Generated
     */

    protected $table = 'ac_facturas';
    protected $fillable = ['id', 'numero_factura', 'numero_control', 'fecha_factura', 'monto', 'observaciones', 'fecha_creacion', 'usuario_creador', 
                           'codigo_estatus', 'deleted_at','documento','codigo_proveedor_creador'];
    protected $dates = ['fecha_factura'];
    
    /**
     * The storage format of the model's date columns.
     * @var string
     */
    protected $dateFormat = 'Y-m-d';
    
    function setFechaFacturaAttribute($date) {
        $this->attributes['fecha_factura'] = new Carbon($date);
    }

    public function acEstatus() {
        return $this->belongsTo(\App\Models\AcEstatus::class, 'codigo_estatus', 'id');
    }
    
    public function acProveedor() {
        return $this->belongsTo(\App\Models\AcProveedoresExtranet::class, 'codigo_proveedor_creador', 'codigo_proveedor');
    }
    
    public function actualizar()
    {
    	try
    	{
    		if($this->update())
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
    	catch ( \Exception $e)
    	{
    		echo $e->getMessage();
    		return false;
    	}
    }
    
    public function cambiarestatusFactura()
    {
    		$oFact =$this->findorFail($this->factura);
    		//echo $this->factura;die();
    		$oFact->codigo_estatus=$this->nuevoestatus;
    		if($oFact->actualizar())
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    }
    
    
    public function leerFacturasProv()
    {
    	$res = $this->where('ac_facturas.codigo_estatus','=','3') // Pago aprobado
    	->where('ac_facturas.codigo_proveedor_creador',"=",$this->idprov)
    	->join('ac_proveedores_extranet', 'ac_proveedores_extranet.codigo_proveedor',"=", 'ac_facturas.codigo_proveedor_creador')
    	->join('ac_estatus', 'ac_estatus.id',"=", 'ac_facturas.codigo_estatus')
    	->select('ac_facturas.id as id',
    			'ac_facturas.codigo_proveedor_creador as idProveedor',
    			'ac_facturas.numero_factura as numero_factura',
    			'ac_facturas.numero_control as numero_control',
    			'ac_facturas.fecha_factura  as fecha_factura',
    			'ac_facturas.monto as monto',
    			'ac_proveedores_extranet.nombre as proveedor',
    			'ac_estatus.nombre as nombre_estatus')->get();
    	
    	if($res->count()>0)
    	{
    		return $res;
    	}
    	else
    	{
    		return false;
    	}
    }
}
