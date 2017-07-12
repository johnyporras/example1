<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable{

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['ultimo_acceso', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'name',
        'email',
        'user',
        'password',
        'clave',
        'department',
        'detalles_usuario_id',
        'imagen_perfil',
        'type',
        'active',
        'pregunta_1',
        'respuesta_1',
        'pregunta_2',
        'respuesta_2',
        'ultimo_acceso',
        'remember_token',
        'confirm_token',
        'deleted_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'clave_telefono', 'respuesta_1', 'respuesta_2', 'remember_token', 'confirm_token'
    ];

    public static $login_validation_rules = [
        'user' => 'required|exists:users',
        'password' => 'required'
    ];

    public static $create_validation_rules = [
        'name' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'department' => 'required',
        'type' => 'required',
        'user' => 'required|unique:users'
    ];
    
    /**
     * Get the Type User.
     */
    public function userType() {
        return $this->belongsTo(\App\Models\UserType::class, 'type', 'id');
    }
    
    /**
     * Get Proveedor.
     */
    public function acProveedor() {
        return $this->belongsTo(\App\Models\AcProveedoresExtranet::class, 'proveedor', 'codigo_proveedor');
    }

    /**
     * Get Afiliado.
     */
    public function afiliado() {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'detalles_usuario_id');
    }
    
    /**
     * Get Claves.
     */
    public function claves() {
        return $this->hasMany(\App\Models\AcProveedoresExtranet::class, 'id', 'creador');
    }
}