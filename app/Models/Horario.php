<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'bloquehorario';
    
    public function leerHorarios()
    {
        $resp = $this->select("id","hora")
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
