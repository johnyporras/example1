<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;



class operadorEspecialidad extends Model
{
    protected $table = 'operador_especialidad';
    
    
    public function operador()
    {
        return $this->belongsTo(\App\Models\Operador::class, 'id_operador', 'id');
    }
    
    public function especialidad()
    {
        return $this->belongsTo(\App\Models\Especialidad::class, 'id_especialidad', 'id');
    }
    
    
    
}

?>