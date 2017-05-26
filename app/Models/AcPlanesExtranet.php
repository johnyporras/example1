<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcPlanesExtranet extends Model {

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_planes_extranet';

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
    protected $fillable = [
        'codigo_plan',
        'nombre',
        'cobertura',
        'orden',
        'deleted_at'
    ];

    /**
     * Get the Plan Extranet for the Cuenta.
     */
    public function cuenta()
    {
        return $this->belongsToMany(\App\Models\AcCuenta::class,'ac_cuentaplan', 'id_plan', 'id_cuenta'); 
    }

    /**
     * Get the Coberturas for Planes.
     */
    public function coberturas()
    {
        return $this->hasMany(\App\Models\AcCoberturaExtranet::class,'id_plan','codigo_plan');
    }

    /**
     * Get the Contratos for Planes.
     */
    public function contratos()
    {
        return $this->hasMany(\App\Models\AcContrato::class,'codigo_plan','codigo_plan');
    }
}
