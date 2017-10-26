<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    
    public function leerEspecialidad()
    {
        $resp = $this->select("especialidad.id as idesp",
                                "operador_especialidad.id",
                                "especialidad.horario",
                               "especialidad.nombre as nomesp")
                     ->join("operador_especialidad","especialidad.id","=","operador_especialidad.id_especialidad")
                    ->get();
        if($resp->count()>0)
        {
            return $resp;
        }
        else 
        {
            return false;
        }
                     
    }
}
