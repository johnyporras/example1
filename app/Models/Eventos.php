<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Eventos
 * @package App\Models
 * @version September 13, 2017, 8:33 pm VET
 *
 * @property string titulo
 * @property string descripcion
 * @property dateTime fechainicio
 * @property dateTime fechafin
 * @property string hora
 * @property integer user_id
 */
class Eventos extends Model
{
    //use SoftDeletes;

    public $table = 'ac_eventos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'descripcion',
        'fechainicio',
        'fechafin',
        'hora',
        'id_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'descripcion' => 'string',
        'fechainicio' => 'string',
        'fechafin' => 'string',
        'hora' => 'string',
        'id_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'hora' => 'required'
    ];

    public function leerEventos()
    {
        $res = $this->where("id_user","=",$this->user)
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
}
