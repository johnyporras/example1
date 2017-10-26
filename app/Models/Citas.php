<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;



class Citas extends Model
{
    protected $table = 'citas';
    public function incluir()
    {
        try
        {
            if($this->validarDiponibilidadHorario())
            {    
                if($this->save())
                {
                    return true;
                }
                else
                {
                     
                    return false;
                }
            }
            else
            {
                return 'nodisp';
            }
        }
        catch ( \Exception $e)
        {
            //echo $e->getMessage();
            return false;
        }
    }
    
    public function validarDiponibilidadHorario()
    {
        $resp = $this->select("id")
                     ->where("id_bloque","=",$this->id_bloque)
                     ->where("id_operador_especialidad","=",$this->id_operador_especialidad)
                     ->where("fecha","=",$this->fecha)
                     ->get();
        
        if($resp->count()>0)
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
}

?>