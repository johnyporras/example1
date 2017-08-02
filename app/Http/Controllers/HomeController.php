<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\AcAfiliado;
use App\Models\Preferencia;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['generar', 'mycard']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generar()
    {
        for ($i=0; $i < 10; $i++) { 
            $value1 = rand(66666666,99999999);
            $value2 = rand(4444444,7777777);
            $valor = '9'.$value1.$value2;
            $vcript = bcrypt($valor);
            $result[] = $valor;
            $encript[] = '"'.$vcript.'"';
        }

        for ($i=0; $i < 10; $i++) { 
            $value1 = rand(33333333,55555555);
            $value2 = rand(1111111,7777777);
            $valor = '4'.$value1.$value2;
            $vcript = bcrypt($valor);
            $result1[] = $valor;
            $encript1[] = '"'.$vcript.'"';
        }

        return view('generar', compact('result','encript','result1','encript1'));
    }

    // Vista de preferencias del Afiliado
    public function mycard($card)
    {
        // Selecciono las Preferencias del perfil
        $preferencia = Preferencia::where('codigo', '=', $card)->first();

        if ($preferencia != null) {
            // Retorno json o valor null
            $preferencias =  json_decode($preferencia->datos);
            // Selecciono valores del afiliado
            $perfil = AcAfiliado::findOrFail($preferencias->id_afiliado);

            return view('mycard', compact('preferencias', 'perfil'));
        } else {
            // Retorno vista con error
            return view('mycard')->whith('error', 'Cuenta op tarjeta invalida');
        }
        
    }
}
