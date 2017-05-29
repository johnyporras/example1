@extends('layouts.app')
@section('title','Pagos')
@section('content') 

    <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nmero de factura</th>
            <th class="text-center">Nmero de control</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Proveedor</th>
         
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($query as $item)
<tr id="{{$item->id}}" class="row1" data-idprov="{{$item->idProveedor}}" >
    <td>{{$item->id}}</td>
    <td id="numfact{{$item->id}}">{{$item->numero_factura}}</td>
    <td id="numcon{{$item->id}}">{{$item->numero_control}}</td>
    <td id="monto{{$item->id}}">{{$item->monto}}</td>
    <td id="prov{{$item->id}}">{{$item->proveedor}}</td>	
   
    <td>
    <button class="edit-modal btn btn-info"
            data-info="{{$item->id}}">
            <span class="glyphicon glyphicon-edit"></span> Agregar a pago
        </button>
        </td>
</tr>
@endforeach
    </tbody>
</table>

<br>
<hr>
<br>

<div class="row">
<div class="col-sm-8">
    <table class="table" id="table1">
    <thead>
        <tr>
            
            <th class="text-center">Factura</th>
            <th class="text-center">Proveedor</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Impuesto Retenido</th>
            <th class="text-center">Total</th>
            
            <th class="text-center">
            
		       
            
            </th>
         
 
        </tr>
    </thead>
    <tbody>



    </tbody>
</table>
</div>

<div class="col-sm-4">
<table>
		<tr>
			<td>Monto Total: </td><td id="montotal">00,0</td>
		</tr>
		<tr>
			<td>Retenciones de Impuesto:</td><td id="imptotal">00,0</td>
		</tr>
		<tr>
			<td>Otras retenciones:</td><td id="otimptotal">00,0</td>
		</tr>
		<tr>
			<td>Total  pago:</td><td id="totaltotal">00,0</td>
		</tr>
</table>

	<button type="button" class="btn btn-primary" id="btnGuardarProg">Guardar Programacin</button>
	<button type="button" class="btn btn-secondary">Cancelar</button>

</div>


</div>


@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#table').DataTable({

    	  "language": {
        	  	"search": "Buscar:",
    	        "paginate": {
    	            "first":    '',
    	            "previous": '',
    	            "next":     '',
    	            "last":     ''
    	        },
    	        "aria": {
    	            "paginate": {
    	                "first":    'First',
    	                "previous": 'Previous',
    	                "next":     'Next',
    	                "last":     'Last'
    	            }
    	        }
    	    }
      });
    $('#table1').DataTable({
		"searching":false,
		"paging":false,
		"info":false
    });
} );

  var prov=null;
  idprov=null;
  var t1=null;
  $(".row1").on("click",function(){
	var paso=true; 
  	button="<button class='delete-modal btn btn-danger' id='facth"+$("#numfact"+$(this).attr("id")).text()+"' data-idfact='"+$(this).attr("id")+"'><span class='glyphicon glyphicon-trash'></span>Eliminar</button>";
	t1 = $('#table1').DataTable();
	numfactura=$("#numfact"+$(this).attr("id")).text();
	monto=$("#monto"+$(this).attr("id")).text();
	impuesto = (monto*2)/100;
	total=monto-impuesto; 
	var indexes = t1.rows().eq(0).filter( function (rowIdx)
	{
	    if(t1.cell( rowIdx, 0 ).data()==numfactura)
	    {
		    alert("Ya existe el registro");
		    paso=false;;
		}
	});
	if(paso)
	{
		prov=$("#prov"+$(this).attr("id")).text();
		idprov=$(this).data("idprov");
		t1.row.add([numfactura,prov,monto,impuesto,total,button]).draw(false);
		acumMonto = parseFloat($("#montotal").text())+parseFloat(monto);
		$("#montotal").text(acumMonto);
		acumImpuesto = parseFloat($("#imptotal").text())+parseFloat(impuesto);
		$("#imptotal").text(acumImpuesto);
		acumTotal = parseFloat($("#totaltotal").text())+parseFloat(total);
		$("#totaltotal").text(acumTotal);
		
		$('#facth'+$("#numfact"+$(this).attr("id")).text()).on("click",function(){
	
			ro = t1.row($(this).parent());
			montoh=ro.node().cells[2].innerHTML;
			acumMonto = parseFloat($("#montotal").text())-parseFloat(montoh);
			$("#montotal").text(acumMonto);
	
			imph=ro.node().cells[3].innerHTML;
			acumImp = parseFloat($("#imptotal").text())-parseFloat(imph);
			$("#imptotal").text(acumImp);
	
			totalh=ro.node().cells[4].innerHTML;
			totalMonto = parseFloat($("#totaltotal").text())-parseFloat(totalh);
			$("#totaltotal").text(totalMonto);
				
			ro.remove().draw(false);
			
		})
	}
})
detalles=[];
$("#btnGuardarProg").on("click",function()
{
	
	data1=t1.rows().data();
	auxTam =data1.length; 
//alert(auxTam);
	for(i=0;i<auxTam;i++)
	{
		detalle={};
		idfact=$("#facth"+data1[i][0]).data("idfact");
		montofact=data1[i][2];
		montoimp1=data1[i][3];
		detalle.idefact=idfact;
		detalle.monfact=montofact;
		detalle.monimp1=montoimp1;
		detalles.push(detalle);
	}
	
	
	//ro = t1.row($(this).parent());
	//montoh=ro.node().cells[2].innerHTML;
	

	//var url = '/Atiempo-Extranet.git/public/pagos/guardarProg';
	var url = '/pagos/guardarProg';
	var params = 
	{
		_token :'{!! csrf_token(); !!}',
		idprov: idprov,
		detlles:detalles
	}
	
	 $.post(url,params,function(data)
	{	
		 	detalles=null;		
		 	//alert(data)
            if(data.success==true)
            {
                alert("La programaci�n de pago fu� registrada con �xito");
                //location.href="/atiempon/public/Seguridad/nopermiso";              
            }
		      
	},'json');
})
	
 </script>
@endsection
