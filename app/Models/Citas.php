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
    
    public function leerCitas()
    {
        $resp = $this->select("citas.id","fecha","bloquehorario.hora","especialidad.nombre as especialidad")
                    ->selectRaw("operador.nombre ||' '|| operador.apellido as medico")
                    ->selectRaw("ac_afiliados.nombre ||' '|| ac_afiliados.apellido as afiliado")
                    ->join("bloquehorario","citas.id_bloque","=","bloquehorario.id")
                    ->join("ac_afiliados","citas.id_afiliado","=","ac_afiliados.id")
                    ->join("operador_especialidad","citas.id_operador_especialidad","=","operador_especialidad.id")
                    ->join("especialidad","operador_especialidad.id_especialidad","=","especialidad.id")
                    ->join("operador","operador_especialidad.id_operador","=","operador.id");
        
        if(isset($this->operador) && $this->operador!="")
        {
            $resp = $resp->where("id_operador","=",$this->operador); 
        }
               
        
        if(isset($this->afiliado) && $this->afiliado!="")
        {
            $resp = $resp->where("id_afiliado","=",$this->afiliado);
        }
        
        
        if(isset($this->fecha) && $this->fecha!="")
        {
            $resp = $resp->where("fecha","=",$this->fecha);
        }
        
        $resp = $resp->get();
        
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

?>