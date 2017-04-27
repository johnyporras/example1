<?php namespace App\Http\Controllers;

//use Carbon\Carbon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AcFactura;
use App\Models\AcClave;
use App\Lib\functions;

use Session;
use Input;
use Illuminate\Http\RedirectResponse;
    public function store(Request $request)
    {
        $user = \Auth::user();
        
        $proveedor = $user->proveedor;
        $request = array_add($request, 'codigo_proveedor_creador', $proveedor);
        $request->fecha_factura = functions::uf_convertirdatetobd($request->fecha_factura);
       // dd($request->fecha_factura);
        $oFactura = new AcFactura();
        $oFactura->numero_factura=$request->numero_factura;
        $oFactura->numero_control=$request->numero_control;
        $oFactura->fecha_factura=$request->fecha_factura;
        $oFactura->monto=$request->monto;
        $oFactura->observaciones=$request->observaciones;
        $oFactura->codigo_estatus=$request->codigo_estatus;
        $oFactura->codigo_proveedor_creador=$request->codigo_proveedor_creador;
        $res =$oFactura->save();
        //echo "1121";die();
        return $oFactura;
        $factura = AcFactura::create($request->all());
        
        return $factura;
    }
    
 public function procesar(Request $request)
 {   
    //dd($request->fileid);
     /* Validacion de Archivos, que sean menor o igual a 5, y de tipo jpg,pdf,png,doc */
     if ($request->hasFile('file1')){
        if (true){   
     if (count($request->fileid) > 0) {
        if (($this->validarArchivos($request->fileid, $request ))){   
            $request = array_add($request, 'codigo_estatus', 5) /* Pendiente por Aprobacion */; 
            //$request = array_add($request, 'documento', $request->fileid[0]) /* Pendiente por Aprobacion */; 
            //echo "this is";die();
            $insertFactura = $this->store($request);

             $imageName = $insertFactura->id .'.'.$request->file('file1')->getClientOriginalExtension();
            //if ($this->subirArchivo($insertFactura->id, $request->codigo_proveedor_creador,$request->fileid[0])) {

            if ($request->file('file1')->move(base_path().'/public/archivo/', $imageName)){               
            $request = array_add($request, 'documento', $request->fileid[0]) /* Pendiente por Aprobacion */; 
            $insertFactura = $this->store($request);         
            if ($this->subirArchivo($insertFactura->id, $request->codigo_proveedor_creador,$request->fileid[0])) {               
                if($insertFactura){
                    if(is_array(Input::get('id_clave')) || is_array(Input::get('id_aval'))){
                        if(!empty(Input::get('id_clave'))){
                            foreach(Input::get('id_clave') as $id){
                                $acClave = AcClave::findOrFail($id);
                                $acClave->id_factura        = $insertFactura->id;       
                                $acClave->estatus_clave     = 6; /* Conciliada*/
                                $acClave->save(); 
                            }
                        }
                        if(!empty(Input::get('id_aval'))){
                            foreach($claves as $id){
                                $acAval = AcAval::findOrFail($id);
                                $acAval->id_factura  = $insertFactura->id;      
                                $acAval->estatus     = 6; /* conciliada */; 
                                $acAval->save(); 
                            }
                        }
                    }else{
                        if(!empty(Input::get('id_clave'))){
                            $acClave = AcClave::findOrFail(Input::get('id_clave'));
                            $acClave->id_factura        = $insertFactura->id;                          
                            $acClave->estatus_clave     = 6; /* Conciliada*/
                            $acClave->save(); 
                        }
                        if(!empty(Input::get('id_aval'))){
                            $acAval = AcAval::findOrFail(Input::get('id_clave'));
                            $acAval->id_factura        = $insertFactura->id;                          
                            $acAval->estatus     = 6; /* conciliada */; 
                            $acAval->save(); 
                        }
                    }
                    Session::flash('status', 'Factura Nro '.$insertFactura->numero_factura.' cargada correctamente');
                    return view('facturacion.gestionar');
                }else{
                        Session::flash('respuesta', 'Ocurrió un error en la creacion de la factura '.$request->fileid[0]);
                        return redirect()->to($this->getRedirectUrl())->withInput($request->input());     
                      }
            }else{
                Session::flash('respuesta', 'Ocurrió un error al subir el Archivo '.$request->fileid[0]);
                return redirect()->to($this->getRedirectUrl())->withInput($request->input()); 
            }
        }else{
           return redirect()->to($this->getRedirectUrl())->withInput($request->input());
        }        
     }
  }        
  
   public  function subirArchivo($idFactura, $idProveedor,$nombre_archivo){ 
    $path_definitivo = $idProveedor.'/'.$idFactura.'/';
    \Storage::disk('local')->put($nombre_archivo,\File::get('/opt/lampp/htdocs/server/php/files/'.$nombre_archivo));
    \Storage::makeDirectory($path_definitivo);
    \Storage::move($nombre_archivo, $path_definitivo.$nombre_archivo);
    \Storage::delete($nombre_archivo);
    return true;        
  } 
  
    public function validarArchivos($archivos,$request ){ 
        if (count($archivos) > 1){
            Session::flash('message', 'Cantidad Máxima de Archivo deben ser uno(1).');
             return false;
        } else{
                for($i = 0; $i < count($archivos); $i++):    
                   $FileType = pathinfo('/opt/lampp/htdocs/server/php/files/'.$archivos[$i],PATHINFO_EXTENSION);    
                   if( $FileType != "zip" && $FileType != "ZIP"     ) {
                     Session::flash('message', $archivos[$i].' es de un tipo de Archivo invalido. ');
                     return false;
                   }
                endfor;
                return true;
              }   
    }  


   /* public function grabarArchivo()
    {

             $files = Input::file('files');
             $json = array(
                'files' => array()
                );

        foreach( $files as $file )
        {
            $filename = $file->getClientOriginalName().".".$file->getClientOriginalExtension();
            $json['files'][] = array(
                'name' => $filename,
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
                'url' => '/uploads/files/'.$filename,
                'deleteType' => 'DELETE',
                'deleteUrl' => self::$route.'/deleteFile/'.$filename,
                );

            $upload = $file->move( public_path().'/uploads/files', $filename );


        }
        return Response::json($json);
    }*/




    public function generarPago(Request $request)
    {
    $xml = new DomDocument('1.0', 'UTF-8');
 
    $biblioteca = $xml->createElement('biblioteca');
    $biblioteca = $xml->appendChild($biblioteca);
 
    $libro = $xml->createElement('libro');
    $libro = $biblioteca->appendChild($libro);
 
    $autor = $xml->createElement('autor','Paulo Coelho');
    $autor = $libro->appendChild($autor);
    $titulo = $xml->createElement('titulo','El Alquimista');
    $titulo = $libro->appendChild($titulo);
    $anio = $xml->createElement('anio','1988');
    $anio = $libro->appendChild($anio);
    $editorial = $xml->createElement('editorial','Maxico D.F. - Editorial Grijalbo');
    $editorial = $libro->appendChild($editorial);
 
    $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('libros.xml');
        
        
        
        
        
        
        
        
        
        
        
        
        
        
//        $array_xml = array(
//                        ['company code'] =>'1',
//                        ['company_name'] =>'ALTOCENTRO',
//                        ['agencies'] => Array(
//                                            ['agency code'] => '1',
//                                                            Array(['agency_name']=> 'AGENCY NAME' )
//                                            ['transactions'] => Array( ['transaction id'] => 'id Transaccion',
//                                                                                          Array(['type_code']=> 'type code',
//                                                                                                ['payment'] =>'0',
//                                                                                                Array( ['call_id'] =>'callid',
//                                                                                                       ['certificate_number'] => 'T-9',
//                                                                                                       ['product_code'] =>'T-10',
//                                                                                                       ['plan_code'] =>'T-11',
//                                                                                                       ['issue_date'] =>'T-12',
//                                                                                                       ['channel_code'] =>'T-13',
//                                                                                                       ['currency_type'] =>'T-14',
//                                                                                                       ['frequency_code'] =>'T-15'
//                                                                                                     )
//                                                                                              )
//                                                
//                                                
//                                                
//                                                                     )
//                            
//                            
//                                             )
//                                           
//            
//            
//                         );
        return $array_xml;
    }
    
}
