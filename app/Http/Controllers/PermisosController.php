<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\UserType;
use App\Models\TypesProfile;

class PermisosController extends Controller
{
    public function index()
    {
        return view('seguridad.permisos');
    }

    public function leerModulos()
    {
        $modulos = Module::get();
        $arrModulo=array();
        
        foreach ($modulos as $modulo)
        {
        	$Auxarr["text"]=$modulo->description;
        	$Auxarr["href"]="#";
        	$sumodulos = $modulo->submodules();
        	$i=0;
            $arrSubmodulo=array();
        	foreach ($sumodulos as $submodulo)
        	{
        		$i++;
        		$Auxarr1["text"]=$submodulo->description;
        		$Auxarr1["id"]=$submodulo->id;
        		$Auxarr1["href"]=$submodulo->href;
        		array_push($arrSubmodulo,$Auxarr1);
        	}
        	$Auxarr["nodes"]=$arrSubmodulo;
        	$Auxarr["tags"]=$i;
        	array_push($arrModulo, $Auxarr);
        }
        return json_encode($arrModulo);
    }

    public function leerTipoUsuarios()
    {
        $tipos = UserType::get();
        $arr1= array();
        foreach ($tipos as $tipo)
        {
            $res["id"] = $tipo->id;
            $res["name"] = $tipo->name;
            array_push($arr1, $res);
        }
        return json_encode($arr1);
    }

    public function leerPermisos(Request $request)
    {
        if($request->modulo!="" && $request->perfil1)
        {

            $tipo = new TypesProfile();
            $tipo->id_module= $request->modulo;
            $tipo->id_type= $request->perfil1;
            $rest = $tipo->tienePermiso();
            $arr1["permiso"] = $rest;
            return json_encode($arr1);
        }
    }

    public function evalPermiso(Request $request)
    {
        if($request->url!="" && $request->id_type)
        {

            $tipo = new TypesProfile();
            $tipo->url= $request->url;
            $tipo->id_type= $request->id_type;
            $rest = $tipo->checkPermiso();
            $arr1["permiso"] = $rest;
            return json_encode($arr1);
        }
    }

    public function incPermiso(Request $request)
    {
        if($request->modulo!="" && $request->perfil && $request->permiso)
        {
            
            if($request->permiso=="true")
            {
                $tipo1 = new TypesProfile();
                $tipo1->id_module= $request->modulo;
                $tipo1->id_type= $request->perfil;
                //dd($tipo1->tienePermiso());
                if(!$tipo1->tienePermiso())
                {
                    //dd("asd");
                    $rest = $tipo1->incluir();    
                }
                else
                {
                    $rest=true;
                }               
                
            }
            else
            {
                $rest = TypesProfile::where("id_type","=",$request->perfil)
                                    ->where("id_module","=",$request->modulo)
                                    ->delete(); 
                                      
            }
            $arr1["success"] = $rest;
            return json_encode($arr1);
        }
    }
}
