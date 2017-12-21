<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AcAfiliado;
use App\Models\AcPago;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Lib\functions;
use Session;

class AfiliadoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $afiliados = AcAfiliado::paginate(15);
        return view('afiliados.index', compact('afiliados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    
    public function pagos($id)
    {
        $oAfi = AcAfiliado::findOrFail($id);
        if($oAfi->id_cuenta!="")
        {
            $oPago= new AcPago();
            $oPago->id_cuenta=$oAfi->id_cuenta;
            $pagos =$oPago->getPagos();
            if($pagos!="0")
            {
                return view('afiliados.pagos', compact('pagos'));
            }
            else 
            {
                $pagos="nopagos";
                return view('afiliados.pagos', compact('pagos'));
            }
        }
        else 
        {
            $pagos = "nopagos";
            return view('afiliados.pagos', compact('pagos'));
        }
    }
    
    public function create()
    {
        return view('afiliados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, cedula, nombre, apellido, fecha_nacimiento, email, sexo,telefono);

        AcAfiliado::create($request->all());

        Session::flash('flash_message', 'Afiliado registrado!');

        return redirect('afiliados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
       /* $afiliado = AcAfiliado::findOrFail($id);
        return view('afiliados.show', compact('afiliado'));*/
        
        $oAfiliado= new AcAfiliado();
        $oAfiliado->id=$id;
        $res = $oAfiliado->leerDetalle();
        // dd($res);
        foreach ($res as $item)
        {
            $oAfiliado->id=$item->id;
            $oAfiliado->nombre=$item->nombre;
            $oAfiliado->apellido=$item->apellido;
            $oAfiliado->cedula=$item->cedula;
            $oAfiliado->fecha_nacimiento=$item->fecha_nacimiento;
            $oAfiliado->codigo_cuenta=$item->codigo_cuenta;
            $oAfiliado->fecha=functions::uf_convertirfecmostrar($item->fecha);
            $oAfiliado->nombreprod=$item->nombreprod;
        }
        $afiliado=$oAfiliado;
        return view('afiliados.show', compact('afiliado'));
       // dd($afiliado);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $oAfiliado= new AcAfiliado();
        $oAfiliado->id=$id;
        $res = $oAfiliado->leerDetalle();
       // dd($res);
        foreach ($res as $item)
        {
            $oAfiliado->id=$item->id;
            $oAfiliado->nombre=$item->nombre;
            $oAfiliado->apellido=$item->apellido;
            $oAfiliado->cedula=$item->cedula;
            $oAfiliado->fecha_nacimiento=$item->fecha_nacimiento;
            $oAfiliado->codigo_cuenta=$item->codigo_cuenta;
            $oAfiliado->fecha=functions::uf_convertirfecmostrar($item->fecha);
            $oAfiliado->nombreprod=$item->nombreprod;
        }
        $afiliado=$oAfiliado;
      //  dd($afiliado);
        //dd($res->count());
        return view('afiliados.edit', compact('afiliado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, cedula, nombre, apellido, fecha_nacimiento, email, sexo,telefono);

        $afiliado = AcAfiliado::findOrFail($id);
        $afiliado->update($request->all());

        Session::flash('flash_message', 'Afiliado actualizado!');

        return redirect('afiliados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        AcAfiliado::destroy($id);

        Session::flash('flash_message', 'Afiliado eliminado!');

        return redirect('afiliados');
    }
    
    public function buscar(Request $request)
    {
        if($request->palabra!="")
        {
            
            $oAfliado= new AcAfiliado();
            $oAfliado->palabra = $request->palabra;
            $afiliados = $oAfliado->leerPorPalabra();
            return view('afiliados.index', compact('afiliados'));
        }
        else 
        {
            $afiliados = AcAfiliado::paginate(15);
            return view('afiliados.index', compact('afiliados'));
        }
    }

}
