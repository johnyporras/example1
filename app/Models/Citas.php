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
        return true;
    }
}

?>