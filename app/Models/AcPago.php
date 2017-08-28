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
        $res = $this->select("id","created_at as fechapago","estatuspago","monto","fechacorte")
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
