<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcTransaccionesProveedor extends Model {

    use SoftDeletes;
    /**
     * Generated
     */

    protected $table = 'ac_transacciones_proveedor';
    protected $fillable = ['id', 'codigo_proveedor', 'status', 'created_at', 'updated_at', 'deleted_at'];

    
    /**
     * Get the Proveedor Extraner for the 
     */
    public function proveedores()
    {
        return $this->hasMany(\app\Models\AcProveedoresExtranet::class,'codigo_proveedor','id');
    }
}