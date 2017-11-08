<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Citas;
use App\Models\AcAfiliado;
use App\Models\operadorEspecialidad;
use Illuminate\Support\Facades\Mail;


class procesarCitaController extends Controller
{
    public  function index()
    {
        $user = \Auth::user(); 
        $oEsp = new Especialidad();
        $oHora = new Horario();
        $Horarios = $oHora->leerHorarios();
        $Especialidades = $oEsp->leerEspecialidad();
        if($Especialidades!==false && $Horarios!==false)
        {
            if($user->type!=8)
            {
                return view("citas.formcitas",compact('Especialidades','Horarios'));
            }
            elseif($user->type==8)
            {
                return view("citas.formcitas2",compact('Especialidades','Horarios'));
            }
        }
        else
        { 
            if($user->type!=8)
            {
                return view("citas.formcitas");
            }
            elseif($user->type==8)
            {
                return view("citas.formcitas2");
            }
        }   
    }
    
    
    
    public function leerAfiliado(Request $request)
    {
         if($request->cedula!="")
         {
             $oAf = new AcAfiliado();
             $oAf->cedula=$request->cedula;
             $rs = $oAf->leerPorCedula();
             if($rs!="0")
             {
                 $response['success']=true;
                 $response['data']=$rs;
             }
             else 
             {
                 $response['success']=false;
             }
             
         }
         else 
         {
             $response['success']=false;
         }
         return json_encode($response);
    }
    
    
    
    public function incCita(Request $request)
    {
        $oCita = new Citas();
        $user = \Auth::user();
            if($user->type==5)
            {                 
                $rsAfiliado=AcAfiliado::findOrFail($user->detalles_usuario_id);
                $idafiliado=$rsAfiliado->id;
            }
            elseif($user->type==8)
            {
                $idafiliado=$request->afiliado;
                $rsAfiliado=AcAfiliado::findOrFail($idafiliado);
            }
            if($request->id!="" && $request->fecha!="" && $request->hora!="")
            {
                
               // dd(new operadorEspecialidad());
                $rsDet = operadorEspecialidad::findOrFail($request->id);
                $oCita->id_operador_especialidad=$request->id;
                $oCita->fecha=$request->fecha;
                $oCita->id_afiliado=$idafiliado;
                $oCita->id_bloque=$request->hora;
                $oCita->estatus=1;
                //dd($oCita->incluir());
                if($oCita->incluir()===true)
                {
                    
                    $data = [
                        'nombre' =>$rsAfiliado->nombre." ".$rsAfiliado->apellido,
                        'email' => $rsAfiliado->emailafiliado,
                        'fecha'=>$oCita->fecha,
                        'hora'=>$oCita->hora
                    ];
                    
                    // dd($data['datosclave']->clave);
                    // Envio de Correo para confirmar
                    Mail::send('mails.citafiliado', ['data' => $data], function($mail) use($data){
                        $mail->subject('Solicitud de Cita');
                        $mail->to($data['email'], $data['nombre']);
                    });
                    
                    
                    $data = [
                        'nombre' =>$rsDet->operador()->nombre." ".$rsDet->operador()->apellido,
                        'email' => $rsDet->operador()->email,
                        'fecha'=>$oCita->fecha,
                        'hora'=>$oCita->hora
                    ];
                        
                    
                    Mail::send('mails.citaoperador', ['data' => $data], function($mail) use($data){
                        $mail->subject('Solicitud de Cita');
                        $mail->to($data['email'], $data['nombre']);
                    });
                    
                    
                    
                    return  view('citas.citasrespuesta');
                }
                elseif($oCita->incluir()=="nodisp")
                {
                    echo  view('citas.citarespuestanodisp');
                }
            } 
    }
    
}
