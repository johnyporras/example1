<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use App\Models\AcClave;
use App\Models\AcCuenta;
use App\Models\AcClavesDetalle;
use App\Models\AcClaveProv;
use App\Models\AcAfiliado;
use App\Models\AcAfiliadoTemporal;
use App\Models\AcProveedoresExtranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\ConsultarClaveController;
use App\Http\Controllers\ConsultarClaveTemporalController;
use App\Http\Controllers\ValidarFechaController;
use Illuminate\Support\Facades\Mail;

class ClaveController extends Controller{

    function RandomClave($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE){
        $source = 'abcdefghijklmnopqrstuvwxyz';
        if($uc==1){ $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';}
        if($n ==1){ $source .= '1234567890';}
        if($sc==1){ $source .= '|@#~$%()=^*+[]{}-_';}
        if($length>0){
            $rstr = "";
            $source = str_split($source,1);
            for($i=1; $i<=$length; $i++){
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];
            }

        }
        return $rstr;
    }
    /**
     * Procesar Guardado de Claves
     *
     * @return Response
     */
    public function procesarGuardar(Request $request){
        $monto_total = 0;
        $costo       = 0;
        $monto       = array();
        $ValidarFecha = new ValidarFechaController();
        if (!($ValidarFecha->validarFecha($request)) ){
           Session::flash('result', 'No se encuentra dentro del las Fecha Autorizada.');
                      // return redirect('home')->with('message', );
           return redirect::to('claves/generarFinal')->with('result', 'Debe agregar al menu un procedimiento');
           //return redirect()->to($this->getRedirectUrl())->withInput();

        }


//       if (isset($request->max) &&($request->max == 0)){
//           Session::flash('result', 'Debe agregar al menos un prpcedimiento');
//           return false;
//          //
//       }
      /**
       * Se Obtiene el id del Usuario y el codigo del Proveedor  de la Session
       */
        $user = \Auth::user();
        if($user->type == 3){//TIPO PROVEEDOR
            $request = array_add($request, 'codigo_proveedor_creador', $user->proveedor);
        }
        $request = array_add($request, 'creador', $user->id);
        /**
        * Creacion de la Clave
        */
        $clave   = $this->RandomClave($length=8,$uc=TRUE,$n=TRUE,$sc=FALSE);
        $request = array_add($request, 'clave', $clave);
        /**
        * Validacion del codigo_contrato = 0, estatus = 5 => Pendiente, sino estatus = 3 => Aprobado
        */
        $estatus_clave = 10;
        $request = array_add($request, 'estatus_clave', $estatus_clave);
       //            $request = array_add($request, 'estatus_clave', $estatus_clave);

//        if (( isset($request->codigo_contrato)) && ($request->codigo_contrato == 0)){
//            $estatus_clave = 5;
//            $request = array_add($request, 'estatus_clave', $estatus_clave);
//        } elseif (isset($request->codigo_contrato)){
//             $estatus_clave = 3;
//              $request = array_add($request, 'estatus_clave', $estatus_clave);
//        }
        for($i = 0; $i < $request->max; $i++):
            if($request->exists(['id_tratamiento'.$i])){
                $baremos['id_procedimiento'] = $request->input(['id_tratamiento'.$i]);
                $baremos['id_proveedor']     = $request->input(['id_proveedor'.$i]);
                $baremo = DB::table('ac_baremos')
                            ->where([['id_procedimiento', '=', $baremos['id_procedimiento']], ['id_proveedor','=',$baremos['id_proveedor']]])
                            ->select('monto' )
                            ->get();
                foreach($baremo as $data){
                    $monto[$i]    =   $data->monto;
                    $monto_total = $monto_total + $data->monto;
                }
            }
        endfor;
        $request = array_add($request, 'costo_total', $monto_total);
        $request = array_add($request, 'cantidad_servicios', count($monto_total));
        $claves = $this->store($request);
        if(isset($claves)){
            for($i = 0; $i < $request->max; $i++):
                $clavesDetalle = new AcClavesDetalle;
                $clavesDetalle->id_clave             = $claves->id;
                $clavesDetalle->codigo_servicio      = $request->input(['id_servicio'.$i]);
                $clavesDetalle->codigo_especialidad  = $request->input(['id_especialidad'.$i]);
                $clavesDetalle->id_procedimiento     = $request->input(['id_tratamiento'.$i]);
                $clavesDetalle->costo                = $monto[$i];
                $clavesDetalle->codigo_proveedor     = $request->input(['id_proveedor'.$i]);
                $clavesDetalle->detalle              = $request->detalle_servicio;
                $proveedor1 = $request->input(['id_proveedor'.$i]);
                $proveedor2 = $request->input(['id_proveedor2'.$i]);
                $clavesDetalle->estatus              = 1 /* Pendiente de Atencion*/;
                $clavesDetalle->save();
            endfor;
            
            
			$oProv1 = new AcProveedoresExtranet();      
			$oProv1->codigo_proveedor=$proveedor1;
			$rsProv1 =$oProv1->leerProv();
			$oClave = new AcClave();
      $oClave->id=$claves->id;
			$rsClave=$oClave->getClave();
            $oDetalleP= new AcClaveProv();
            $oDetalleP->id_clave=$claves->id;
            $oDetalleP->id_proveedor=$proveedor1;
            $oDetalleP->preferido=1;
            $oDetalleP->aceptado=0;
            $oDetalleP->incluir();
            
            $data = [
            		'nombre' =>$rsProv1->nombre,
            		'email' => $rsProv1->email,
            		'nombreafiliado'=>$rsClave->nombre,
                'apafiliado'=>$rsClave->apellido,
                'cedula'=>$rsClave->cedula_afiliado,
                'fecha_cita'=>$rsClave->fecha_cita,
                'telefono'=>$rsClave->telefono,
                'obser'=>$rsClave->observaciones,
                'motivo'=>$rsClave->observaciones,
                'servicio'=>$rsClave->servicio,
                'especialidad'=>$rsClave->especialidad,
                'procedimiento'=>$rsClave->procedimiento,
                'idclave'=>$rsClave->id,
                'idclaveprov'=>$proveedor1,
                'tipo'=>1

        		];
            

           // dd($data['datosclave']->clave);
            // Envio de Correo para confirmar
            Mail::send('mails.claveprove1', ['data' => $data], function($mail) use($data){
            	$mail->subject('Nueva solicitud de Servicios');
            	$mail->to($data['email'], $data['nombre']);
            });
            

            	$oDetalleP= new AcClaveProv();
            	$oDetalleP->id_clave=$claves->id;
            	$oDetalleP->id_proveedor=$proveedor2;
            	$oDetalleP->preferido=0;
                $oDetalleP->aceptado=0;
            	$oDetalleP->incluir();
          /*  	
            	$data = [
            			'nombre' =>$rsProv2->nombre,
            			'email' => $rsProv2->email,
            			'datosclave' =>$rsClave
            	];
            	
            	// Envio de Correo para confirmar
            	Mail::send('mails.claveprove1', ['data' => $data], function($mail) use($data){
            		$mail->subject('Nueva solicitud de Servicios');
            		$mail->to($data['email'], $data['nombre']);
            	});
            	*/
            
            
            
            
            
            
            
              if($user->type == 3){//TIPO PROVEEDOR
                   Session::flash('status', 'Su clave  ha sido generada!');
              }else{
                      Session::flash('status', 'Su clave '.$clave.' ha sido generada!');
                   }
            $request = array_add($request, 'show', $claves->id);
            if (( isset($request->codigo_contrato)) && ($request->codigo_contrato == 0)){
                $consultarClaveTemporal = new ConsultarClaveTemporalController();
                return($consultarClaveTemporal->show($request, $claves->id));
            } elseif (isset($request->codigo_contrato)){
                $consultarClave = new ConsultarClaveController();
                return($consultarClave->show($request,$claves->id));
            }
        }else{
            Session::flash('respuesta', 'Ocurrió un error al generar la Clave. ');
            return view('claves.generar');
        }
    }
    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */

    public function aceptarClaveGrabar(Request $request)
    {
        
        if($request->id!="" && $request->idclaveprov!="")
        {
          AcClaveProv::where("id_clave","=",$request->id)
                      ->where("id_proveedor","=",$request->idclaveprov)
                      ->update(["fechacita"=>$request->fechacita,"horacita"=>$request->horacita
                              ,"direccion"=>$request->direccion,"observacion"=>$request->observac,
                              "aceptado"=>'1']);

          AcClave::where("id","=",$request->id)
                ->update(["codigo_proveedor_creador"=>$request->idclaveprov]);

                $oClave = new AcClave();
                $oClave->id=$request->id;
                $rsClave=$oClave->getClave();
                $rsProvC=AcProveedoresExtranet::where("codigo_proveedor","=",$request->idclaveprov);
                $rsProv1=$rsProvC[0];
                $data = [
                'nombre' =>$rsProv1->nombre,
                'email' => $rsClave->emailafiliado,
                'fecha_cita'=>$request->fechacita,
                'fecha_cita'=>$request->fechacita,
                'clave'=>$rsClave->clave,
                'direccion'=>$request->direccion,
                'observacion'=>$request->observac,
                'telefono'=>$rsClave->telefono,
                'motivo'=>$rsClave->motivo,
                'servicio'=>$rsClave->servicio,
                'especialidad'=>$rsClave->especialidad,
                'procedimiento'=>$rsClave->procedimiento,
                'idclave'=>$rsClave->id,
                'idclaveprov'=>$rsProv1->id
            ];
            
           // dd($data['datosclave']->clave);
            // Envio de Correo para confirmar
            Mail::send('mails.claveafil1', ['data' => $data], function($mail) use($data){
              $mail->subject('Confirmación de aceptacion de Servicios');
              $mail->to($data['email'], $data['nombre']);
            });

             return view("claves.confirmaAceptarClave");
             
        }        
    }





    public function rechazarClaveGrabar1(Request $request)
    {
    //    dd($request->id);
        if($request->id!="" && $request->idclaveprov!="")
        {
          AcClaveProv::where("id_clave","=",$request->id)
                      ->where("id_proveedor","=",$request->idclaveprov)
                      ->update(["observacion"=>$request->observac,
                              "aceptado"=>'0']);


            
          

                $oClave = new AcClave();
                $oClave->id=$request->id;
                $rsClave=$oClave->getClave();

//dd($request->tipo);
                if($request->tipo==1)
                {

                   // dd($request->id);
                    $oProv = new AcClaveProv();
                    $oProv->idclave =$request->id; 
                    $rsProv2=$oProv->getProvSecundario();

                  $data = [
                    'nombre' =>$rsProv2->nombre,
                    'email' => $rsProv2->email,
                    'nombreafiliado'=>$rsClave->nombre,
                    'apafiliado'=>$rsClave->apellido,
                    'cedula'=>$rsClave->cedula_afiliado,
                    'fecha_cita'=>$rsClave->fecha_cita,
                    'telefono'=>$rsClave->telefono,
                    'obser'=>$rsClave->observaciones,
                    'motivo'=>$rsClave->observaciones,
                    'servicio'=>$rsClave->servicio,
                    'especialidad'=>$rsClave->especialidad,
                    'procedimiento'=>$rsClave->procedimiento,
                    'idclave'=>$rsClave->id,
                    'idclaveprov'=>$rsProv2->id,
                    'tipo'=>2
                    ];
                

               // dd($data['datosclave']->clave);
                // Envio de Correo para confirmar
                Mail::send('mails.claveprove1', ['data' => $data], function($mail) use($data){
                    $mail->subject('Nueva solicitud de Servicios');
                    $mail->to($data['email'], $data['nombre']);
                });
          
            }
            else
            {
                 $data = [
                'nombre' =>$rsClave->nombre." ".$rsClave->apellido,
                'email' => $rsClave->emailafiliado,
                'fecha_cita'=>$rsClave->fecha_cita,
                'telefono'=>$rsClave->telefono,
                'motivo'=>$rsClave->motivo,
                'servicio'=>$rsClave->servicio,
                'especialidad'=>$rsClave->especialidad,
                'procedimiento'=>$rsClave->procedimiento,
                'idclave'=>$rsClave->id
            ];
            
           // dd($data['datosclave']->clave);
            // Envio de Correo para confirmar
            Mail::send('mails.claveafil2', ['data' => $data], function($mail) use($data){
              $mail->subject('Confirmación de aceptacion de Servicios');
              $mail->to($data['email'], $data['nombre']);
            });

            }
             return view("claves.confirmaRechazaClave");
             
        }        
    }



    public function aceptarClave($id,$idclaveprov)
    {
      if($id!="" && $idclaveprov!="")
      {
              return view("claves.aceptarClave",compact('id','idclaveprov'));
      }
    }


    public function rechazarClave($id,$idclaveprov,$tipo)
    {
      if($id!="" && $idclaveprov!="")
      {
              return view("claves.rechazarClave1",compact('id','idclaveprov','tipo'));
      }
    }


    public function generar(Request $request){

        $ValidarFecha = new ValidarFechaController();
        if  (!($ValidarFecha->validarHorario()) and false){
            return redirect('home')->with('message', 'No se encuentra dentro del Horario Autorizado.');
        }
        if(isset($request->cedula)){
            if(empty($request->cedula)){
                return redirect()->back()->withInput()->with('message', 'El campo cédula es obligatorio.');
            }else{
                try{
                    $this->validate($request,['cedula' => 'required|numeric|']);
                    $afiliadoIni = AcAfiliado::where('cedula', '=', $request->cedula)->firstOrFail();
                }catch(ModelNotFoundException $e){  // catch(Exception $e) catch any exception
                	//$afiliadoIni=new \stdClass();
                	$afiliadoIni=new \stdClass();
                	$afiliadoIni->cedula=0;
                    //dd(get_class_methods($e)); // lists all available methods for exception object
                    $tipoAfiliado = \App\Models\AcTipoAfiliado::pluck('nombre', 'id')->toArray();
                    $estado = \App\Models\AcEstado::pluck('es_desc', 'es_id')->toArray();
                    $aseguradora = \App\Models\AcAseguradora::pluck('nombre', 'codigo_aseguradora')->toArray();
                }
                $contratos = DB::table('ac_cuenta')
                            ->where([['cedula', '=', $afiliadoIni->cedula],['fecha','<=',date('Y-m-d').' 00:00:00']])
                            ->where('ac_cuenta.estatus',"=",1)
                            ->join('ac_afiliados', 'ac_cuenta.id',"=", 'ac_afiliados.id_cuenta')
                            ->join('ac_cuentaplan','ac_cuenta.id',"=",'ac_cuentaplan.id_cuenta')
                            ->join('ac_planes_extranet', 'ac_planes_extranet.codigo_plan',"=", 'ac_cuentaplan.id_plan')
                            ->select('codigo_cuenta','cedula as cedula_afiliado','cedula','ac_afiliados.nombre as nombre_afiliado','ac_afiliados.apellido as apellido_afiliado',
                                    'ac_planes_extranet.nombre as plan')
                            ->get();
                if(!empty($contratos)){
                	//die("aqui");
                    return view('claves.generar', compact('contratos'));
                }else{
                	//die("por aqui");
                    Session::flash('flash_message', 'No tiene una cuenta vigente');
                    return view('claves.generar', compact('contratos'));
                }
            }
        }else{
            return view('claves.generar');
        }
    }
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return Response
     */
    public function buscarCobertura(Request $request)
    {
    	


       // $id = $request->input('icedula');
       // dd($id);
    	$user = \Auth::user();
    //	dd($user->detalles_usuario_id);
      //$user->detalles_usuario_id=30005;
    	//if($user->type==5)
    	if(true)
    	{
    		
    		$objAfiliado= new AcAfiliado();
        //dd($user->detalles_usuario_id);
    		$obCuenta = new AcCuenta();
    		$rsAf =$objAfiliado->findOrFail($user->detalles_usuario_id);
    		$rsCu=$obCuenta->findOrFail($rsAf->id_cuenta);	
    		$beneficiario['contrato'] = $rsCu->codigo_cuenta;
    		$beneficiario['cedula_afiliado'] = $rsAf->cedula;
    		$beneficiario['nombre_afiliado'] = $rsAf->nombre. " ".$rsAf->apellido;
	        //$beneficiario['plan'] = $request->input('plan'.$id);
	        $beneficiario['plan'] = 25;
	       /* $beneficiario['colectivo'] = $request->input('colectivo'.$id);
	        $beneficiario['aseguradora'] = $request->input('aseguradora'.$id);
	        $beneficiario['tipo_afiliado'] = $request->input('tipo_afiliado'.$id);*/
	       
	        //echo $user->type;die();
	        
	///echo $beneficiario['contrato']."<br>";

	            $coberturas = DB::table('ac_cuenta')
	                ->where([['codigo_cuenta', '=', $beneficiario['contrato']]])
	                ->join('ac_cuentaplan', 'ac_cuentaplan.id_cuenta',"=", 'ac_cuenta.id')
	                ->join('ac_planes_extranet', 'ac_planes_extranet.codigo_plan',"=", 'ac_cuentaplan.id_plan')
	                ->join('ac_cobertura_extranet', 'ac_cobertura_extranet.id_plan',"=", 'ac_planes_extranet.codigo_plan')
	                ->join('ac_procedimientos_medicos', function($join){
	                        $join->on('ac_procedimientos_medicos.codigo_examen',"=", 'ac_cobertura_extranet.id_procedimiento')
	                             ->on('ac_procedimientos_medicos.codigo_especialidad',"=", 'ac_cobertura_extranet.id_especialidad')
	                             ->on('ac_procedimientos_medicos.codigo_servicio',"=", 'ac_cobertura_extranet.id_servicio');
	                })
	                ->join('ac_servicios_extranet', 'ac_servicios_extranet.codigo_servicio',"=", 'ac_procedimientos_medicos.codigo_servicio')
	                ->join('ac_especialidades_extranet', 'ac_especialidades_extranet.codigo_especialidad',"=", 'ac_procedimientos_medicos.codigo_especialidad')
	                ->select('id_servicio','ac_servicios_extranet.descripcion as servicio',
	                        'id_especialidad','ac_especialidades_extranet.descripcion as especialidad')
	                ->distinct()->get();
	                
	               
	    
	        $especialidades_cobertura = array_pluck($coberturas,'especialidad','id_especialidad'); // ++++++++++++++++ ARRAY
	        
          $servicios = array_pluck($coberturas,'servicio','id_servicio');
	        return view('claves.generarFinal', compact('beneficiario','especialidades_cobertura','servicios','proveedor'));
    	}
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $claves = AcClave::paginate(15);
        return view('claves.index', compact('claves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('claves.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request){
//        $this->validate($request,  ['cedula_afiliado' => 'required|max:10',
//                                    'codigo_contrato' => 'required',
//                                    'fecha_cita'      => 'required|date',
//                                    'telefono'        => 'required'
//                        ]);
        $ValidarFecha = new ValidarFechaController();
        /*if(!($ValidarFecha->validarFecha($request))){
            return redirect('home')->with('message', 'Clave se encuentra fuera de rango de fechas  autorizado.');
        }*/
        $acClave = AcClave::create($request->all());
        return $acClave;
        //return true;
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
        $clave = AcClave::findOrFail($id);

        return view('claves.show', compact('clave'));
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
        $clave = AcClave::findOrFail($id);

        return view('claves.edit', compact('clave'));
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
        $this->validate($request, clave,cedula_afiliado,codigo_proveedor,codigo_contrato,codigo_especialidad,codigo_servicio,codigo_tipo_examen,estatus,estatus_clave,creador,tipo_afiliado);

        $clafe = AcClave::findOrFail($id);
        $clafe->update($request->all());

        Session::flash('flash_message', 'Clave actualizada!');

        return redirect('claves');
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
        AcClave::destroy($id);

        Session::flash('flash_message', 'Clave eliminada!');

        return redirect('claves');
    }

}
