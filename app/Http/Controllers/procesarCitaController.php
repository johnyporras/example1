<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Citas;
use App\Models\AcAfiliado;


class procesarCitaController extends Controller
{
    public  function index()
    {
        $oEsp = new Especialidad();
        $oHora = new Horario();
        $Horarios = $oHora->leerHorarios();
        $Especialidades = $oEsp->leerEspecialidad();
        if($Especialidades!==false && $Horarios!==false)
        {
            return view("citas.formcitas",compact('Especialidades','Horarios'));
        }
        else
        {
            return view("citas.formcitas");
        }
            
    }
    
    public function incCita(Request $request)
    {
        $oCita = new Citas();
        $user = \Auth::user();
            if($user->type==5)
            {                 
                $idafiliado=AcAfiliado::findOrFail($user->detalles_usuario_id)->id;
            }
            else 
            {
                $idafiliado=$request->afiliado;
            }
            if($request->id && $request->fecha && $request->hora)
            {
                
                $oCita->id_operador_especialidad=$request->id;
                $oCita->fecha=$request->fecha;
                $oCita->id_afiliado=$idafiliado;
                $oCita->id_bloque=$request->hora;
                $oCita->estatus=1;
                //dd($oCita->incluir());
                if($oCita->incluir()===true)
                {
                    return  view('citasrespuesta');
                }
                elseif($oCita->incluir()=="nodisp")
                {
                    echo  view('citasrespuestanodisp');;
                }
            } 
    }
    
}
