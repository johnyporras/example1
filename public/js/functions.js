function uf_convertir(obj)
{
	var valor=new String(obj);
	if(valor<0)
	{
		li_temp="-";
		valor = Math.abs(valor);
		valor = new String(valor);
	}
	else
	{
		li_temp="";			
	}
	li_coma=valor.indexOf(',');
	if(li_coma>0)
	{
		while(valor.indexOf('.')>0)
		{
			valor=valor.replace(".","");
		}
		valor=valor.replace(",",".");
	}
	valor=roundNumber(valor);
	var valor=new String(valor);
	li_punto=valor.indexOf('.');	
	li_longitud=valor.length;
	if(li_punto>=0)
	{
		ls_new=valor.substr(0,li_punto);
		ldec_monto=roundNumber(valor);
		var aux=new String(ldec_monto);
		ls_dec=aux.substr(li_punto+1,li_longitud-li_punto);
	}
	else
	{
		ls_new=valor;
		ls_dec="00";
	}
	li_long_new=ls_new.length;
	if(li_long_new>3)
	{	
		ls_new_int=uf_convertir_entero(ls_new);
	}
	else
	{
		ls_new_int=ls_new;
	}
	if(ls_dec.length<2)
	{
		while(ls_dec.length<2)
		{
			ls_dec=ls_dec+"0";
		}
	}
	else
	{
		ls_dec=ls_dec.substr(0,2);
	}	
	return li_temp+ls_new_int+","+ls_dec;	
}





function uf_convertir_monto(ldec_monto)
{
	var valor=new String(ldec_monto);
	while(valor.indexOf('.')>0)
	{//Elimino todos los puntos o separadores de miles
		valor=valor.replace(".","");
	}
	valor=valor.replace(",",".");
	
	return valor;
	
}

function uf_convertir_monto2(ldec_monto)
{
	var valor=new String(ldec_monto);
	while(valor.indexOf(',')>0)
	{//Elimino todos los puntos o separadores de miles
		valor=valor.replace(",","");
	}
	valor=valor.replace(",",".");
	
	return valor;
	
}

  


