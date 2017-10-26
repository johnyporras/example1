<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Citas;
use App\Models\AcAfiliado;
use app\models\operadorEspecialidad;
use Illuminate\Support\Facades\Mail;


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
                $rsAfiliado=AcAfiliado::findOrFail($user->detalles_usuario_id);
                $idafiliado=$rsAfiliado->id;
            }
            else 
            {
                $idafiliado=$request->afiliado;
            }
            if($request->id!="" && $request->fecha!="" && $request->hora!="")
            {
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
                    
                    
                    
                    return  view('citasrespuesta');
                }
                elseif($oCita->incluir()=="nodisp")
                {
                    echo  view('citasrespuestanodisp');;
                }
            } 
    }
    
}
