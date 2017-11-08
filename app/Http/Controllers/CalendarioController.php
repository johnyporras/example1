<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcClave;
use App\Models\Eventos;
use App\Models\Citas;
use App\Models\AcAfiliado;

use App\Http\Requests;

class CalendarioController extends Controller
{
    public function index()
    {
        return view("calendario.mostrarcalendar");
    }
    
    public function citasvideo()
    {
        return view("calendario.mostrarcalendarcitas");
    }
    
    public  function leerCitas()
    {
        $user = \Auth::user();
        $idafiliado =$user->detalles_usuario_id;
        if($idafiliado!="")
        {
            $afiliado= AcAfiliado::findOrFail($idafiliado);
            
            $oCitas = new AcClave();
            $oCitas->afiliado=$afiliado->cedula;
            $oCitas->fecha=date("Y-m-d");
            $oCitas->estatus=3;
            $res = $oCitas->getHistoricoCitas();
            $result= array();
            if($res!="0")
            {
                foreach ($res as $item)
                {
                    $cita=array("id"=>$item->id,"title"=>$item->observaciones,"start"=>$item->fecha,'url'=>'/atiempo/public/claves/consultarDetalle?show='.$item->id);
                    array_push($result, $cita);    
                }
            }
            
            $oEvento = new Eventos();
            $oEvento->user=$user->id;
            $rsEventos = $oEvento->leerEventos();
            if($rsEventos!="0")
            {
                foreach ($rsEventos as $item)
                {
                    $cita=array("id"=>$item->id,"title"=>$item->titulo,"start"=>$item->fechainicio,"end"=>$item->fechafin,'url'=>'/atiempo/public/eventos/'.$item->id);
                    array_push($result, $cita);
                }
            }
        }
        return json_encode($result);
    }
    
    
    public  function leerCitas2()
    {
        $user = \Auth::user();
        if($user->type==8)
        {
            $oCitas = new Citas();
            $oCitas->operador=$user->detalles_usuario_id;
            if(isset($request->fecha) && $request->fecha!="")
            {
                $oCitas->fecha=$request->fecha;
            }
            
            $res = $oCitas->leerCitas();
            $result= array();
            if($res!="0")
            {
                foreach ($res as $item)
                {
                    $cita=array("id"=>$item->id,"title"=>$item->observaciones,"start"=>$item->fecha,'url'=>'/atiempo/public/calendario/getcitastabla?fecha='.$item->fecha);
                    array_push($result, $cita);
                }
            }  
        }
        return json_encode($result);
    }
    
    
    public  function leerCitasTabla(Request $request)
    {
       // dd($request->fecha);
        $user = \Auth::user();
        if($user->type==8)
        {
            $oCitas = new Citas();
            $oCitas->operador=$user->detalles_usuario_id;
            if(isset($request->fecha) && $request->fecha!="")
            {
                $oCitas->fecha=$request->fecha;
            }
            
            $res = $oCitas->leerCitas();
            $result= array();
            if($res!="0")
            {
                foreach ($res as $item)
                {
                    $cita=array("id"=>$item->id,"hora"=>$item->hora,"afiliado"=>$item->afiliado,"title"=>$item->observaciones,"fecha"=>$item->fecha,'url'=>'/atiempo/public/calendario/getcitas2?fecha='.$item->fecha);
                    array_push($result, $cita);
                }
            }
        }
        return view("citas.listadocitas",compact("result"));
    }
    
    
}
