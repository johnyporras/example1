<?php
namespace App\Lib;
Class  functions
{
	public  static function uf_convertirdatetobd($as_fecha)
	{
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//    Function:   uf_convertirdatetobd
		// Descripción:   método que convierte el formato de una fecha tipo caracter a formato (yyyy/mm/dd)
		//   Arguments:   $cadena: cadena, $catacter->caracter a ser rellenado , longitud de la cadena
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		$ls_fecreg="";
		$li_pos=strpos($as_fecha,"/");
		$li_pos2=strpos($as_fecha,"-");
		if(($li_pos==2)||($li_pos2==2))
		{
			$ls_fecreg=(substr($as_fecha,6,4)."-".substr($as_fecha,3,2)."-".substr($as_fecha,0,2));
		}
		elseif(($li_pos==4)||($li_pos2==4))
		{
			$ls_fecreg=str_replace("/","-",$as_fecha);
		}
		return $ls_fecreg;
	} // end function
	
	public  static function uf_convertirfecmostrar($as_fecha)
	{
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//    Function:   uf_convertirfecmostrar
		// Descripción:   método que convierte el formato de una fecha tipo caracter a formato (dd/mm/yyyy)
		//   Arguments:   $cadena: cadena, $catacter->caracter a ser rellenado , longitud de la cadena
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		$ls_fecha="";
		$li_pos=strpos($as_fecha,"-");
		$li_pos2=strpos($as_fecha,"/");
		if(($li_pos==4)||($li_pos2==4))
		{
			$ls_fecha=(substr($as_fecha,8,2)."/".substr($as_fecha,5,2)."/".substr($as_fecha,0,4));
		}
		elseif(($li_pos==2)||($li_pos2==2))
		{
			$ls_fecha=$as_fecha;
		}
		return $ls_fecha;
	} // end function()
	
}
?>