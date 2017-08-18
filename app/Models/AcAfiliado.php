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
        'cedula', 'nombre', 'apellido', 'email', 'fecha_nacimiento',
        'sexo', 'telefono', 'id_cuenta', 'id_estado', 'ciudad', 
        'civil', 'hijos', 'ocupacion', 'idioma', 'altura', 
        'peso', 'grupo_sangre', 'lentes', 'condicion_lentes', 'menstruacion', 
        'abortos', 'partos', 'cesarea', 'perdidas', 'embarazada', 
        'tiempo_gestacion', 'deleted_at'
    ];

    /**
     * Paso a Mayuscula el nombre
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    /**
     * Paso a Mayuscula el Apellido
     */
    public function setApellidoAttribute($value)
    {
        $this->attributes['apellido'] = strtoupper($value);
    }

    /**
     * [getFullName description]
     * @return [type] [description]
     */
    public function getFullNameAttribute() {
        return ucfirst($this->nombre) . ' ' . ucfirst($this->apellido);
    }

    /**
     * Get the detalle del motivo for the Afiliado.
     */
    public static function imc($altura, $peso)
    {
        if ($altura != null && $peso != null) {
            $alto = pow($altura / 100,2);
            $value = number_format($peso / $alto,2);
        } else {
            $value = 'Ingrese valores Peso y Altura ';
        }
        return $value;  
    }

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
     * Get the contactos for the Afiliado.
     */
    public function contactos()
    {
        return $this->hasMany(\App\Models\Contacto::class, 'id_afiliado', 'id');
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
    public function motivoSelect($id)
    {
        return $this->hasMany(\App\Models\MotivoDetalle::class, 'id_afiliado', 'id')
                    ->where('id_motivo', $id);
    }

    /**
     * Get the detalle del motivo for the Afiliado.
     */
    public function medicamentos()
    {
        return $this->hasMany(\App\Models\Medicamento::class, 'id_afiliado', 'id');
    }

    /**
     * Get the Historias medicas for the Afiliado.
     */
    public function historiales()
    {
        return $this->hasMany(\App\Models\HistorialMedico::class, 'id_user', 'id');
    }

}