<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcPago extends Model
{
    protected $table = 'ac_pagos';
    public function cuenta()
    {
        return $this->belongsTo(\App\Models\AcCuenta::class);
    }
    
    public function getPagos()
    {
        
        
        $res = $this->select("id","estatuspago","monto")
        ->selectRaw("to_char(ac_pagos.fechacorte, 'dd/MM/YYYY') as fechacorte")
        ->selectRaw("to_char(ac_pagos.fechapago, 'dd/MM/YYYY') as fechapago")
        ->where("id_cuenta","=",$this->id_cuenta);
        
        if($this->estatuspago!="")
        {
            $res=$res->where("estatuspago","=",1);
            
        }
        $res = $res->get();
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
