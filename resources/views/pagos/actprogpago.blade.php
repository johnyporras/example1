@extends('layouts.app')
@section('title','Planificaciones de Pago')
@section('content') 
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    
    <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Proveedor</th>
            <th class="text-center">Fecha de Registro</th>
            <th class="text-center">Cantidad de Facturas</th>
            <th class="text-center">Monto Total</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
 @foreach($res as $item)
<tr id="{{$item->id}}" class="row1"  data-montimp="{{$item->montimpfacturas}}" data-idprov="{{$item->proveedor_id}}">
    <td>{{$item->id}}</td>
    <td id="numfact{{$item->id}}">{{$item->nomprov}}</td>
    <td id="numcon{{$item->id}}">{{$item->fecha}}</td>
    <td id="cant{{$item->id}}">{{$item->cantfacturas}}</td>
    <td id="mont{{$item->id}}">{{$item->montfacturas}}</td>	
   
    <td>
    <button class="edit-modal btn btn-info">
            <span class="glyphicon glyphicon-edit"></span>Ver detalle
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnFactura">Agregar Factura</button>
    <table class="table" id="table1">
    <thead>
        <tr>
            
            <th class="text-center">Factura</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Impuesto Retenido</th>
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
			<td>Total Retenido:</td><td id="imptotal">00,0</td>
		</tr>
</table>

	<button type="button" class="btn btn-primary" id="btnGuardarProg">Aprobar para pago</button>
	<button type="button" class="btn btn-secondary">Cancelar</button>

</div>


</div>


@endsection
@section('script')




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Listado de facturas</h4>
      </div>
      <div class="modal-body">
        
        
		<table class="table" id="table2">
		    <thead>
		        <tr>
		            <th class="text-center">Factura</th>
		            <th class="text-center">Monto</th>
		            <th class="text-center">Proveedor</th>
		            <th class="text-center">
		            </th>
		        </tr>
		    </thead>
		    <tbody>
		    </tbody>
		</table>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

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

  
  var idprog=null;
  var prov=null;
  var idprov=null;
  var t1=null;
  $(".row1").on("click",function(){
	var paso=true; 
  	
	t1 = $('#table1').DataTable();
	idprog = $(this).attr("id");
	montotal = $("#mont"+$(this).attr("id")).text();
	imptotal = $(this).data("montimp");
	idprov = $(this).data("idprov");
	
	//alert();
	//alert();
	//var url = '/atiempon2/public/pagos/getDetalleProgPago';
	var url = '/pagos/getDetalleProgPago';
	var params = 
	{
		idpro: idprog
	}
	 $.getJSON(url,params,function(data)
	{ 
		t1 = $('#table1').DataTable();
		t1.clear();	
		auxTam = data.datos.length;
		for(i=0;i<auxTam;i++)
		{
			button="<button class='delete-modal btn btn-danger'  id="+data.datos[i].id+"    data-idfact='"+data.datos[i].id+"' data-monto='"+data.datos[i].montofact+"' data-montoimp='"+data.datos[i].montoimp1+"'><span class='glyphicon glyphicon-trash'></span>Eliminar</button>";
			numfact = data.datos[i].numfact;
			idfact = data.datos[i].id;
			monfact = data.datos[i].montofact;
			montoimp1 = data.datos[i].montoimp1;
			t1.row.add([numfact,monfact,montoimp1,button]).draw(false);
			///alert(data.datos[0].numfact);	

			$('#'+data.datos[i].id).on("click",function()
			{
				if(confirm("¿En realidad desea eliminar el registro?"))
				{
					//alert(idprog);
					//var url = '/atiempon2/public/pagos/elimDetalleProgPago';
					var url = '/pagos/elimDetalleProgPago';
					var params = 
					{
						idpro: $(this).attr("id"),
						idprog: idprog
					}
					var auxmon = $(this).data("monto");
					var montoimp = $(this).data("montoimp");
					 $.getJSON(url,params,function(data)
					{ 	
						if(data.success==true)
						{
							//alert(t1);
							ro = t1.row($(this).parent());
							//alert(ro);
							$("#"+params.idprog).trigger( "click" );
							//alert(auxmon);
							///alert($(this).data("montoimp"));
							acumMonto = parseFloat($("#montotal").text())-parseFloat(auxmon);
							$("#montotal").text(acumMonto);
							acumImp = parseFloat($("#imptotal").text())-parseFloat(montoimp);
							$("#imptotal").text(acumImp);						
							ro.remove().draw(false);
							alert("El registro se eliminó con éxito");
						}
						else
						{
							alert("No se pudo realizar la operación")
						}	
					})
				}	
			})	
		}				

		actTotales();
	})


	
})
detalles=[];

  
$("#btnGuardarProg").on("click",function()
{
	//ro = t1.row($(this).parent());
	//montoh=ro.node().cells[2].innerHTML;
	

	//var url = '/atiempon2/public/pagos/aprobarProg';
	var url = '/pagos/aprobarProg';
	var params = 
	{
		_token :'{!! csrf_token(); !!}',
		idprog: idprog
	}
	
	 $.post(url,params,function(data)
	{	
            if(data.success==true)
            {
                alert("La programación de pago fué actualizada con éxito");
                //location.href="/atiempon2/public/pagos/actpropago";
                location.href="/pagos/actpropago";              
            }
		      
	},'json');
})
	
	
	
	$("#btnFactura").on("click",function(){
		
		//var url = '/atiempon2/public/pagos/getFacturas';
		var url = '/pagos/getFacturas';
		var params = 
		{
			idprove: idprov
		}
		 $.getJSON(url,params,function(data)
		{ 
			 t2 = $('#table2').DataTable();
				t2.clear();	
				auxTam = data.datos.length;
				for(i=0;i<auxTam;i++)
				{
					button="<button class='btn btn-primary icon-save'  id="+data.datos[i].id+"    data-idfact='"+data.datos[i].id+"'><span class='glyphicon glyphicon-plus'></span>Agregar Factura</button>";
					numfact = data.datos[i].numfact;
					idfact = data.datos[i].id;
					monfact = data.datos[i].montofact;
					montoimp1 = data.datos[i].proveedor;
					t2.row.add([numfact,monfact,montoimp1,button]).draw(false);
					///alert(data.datos[0].numfact);	
					$('#'+data.datos[i].id).on("click",function()
					{

						//var url = '/atiempon2/public/pagos/guardarDetProg';
						var url = '/pagos/guardarDetProg';
						var params = 
						{
							_token :'{!! csrf_token(); !!}',
							idfact: $(this).data("idfact"),
							idprog:idprog
						}
						
						 $.post(url,params,function(data)
						{	
							 	detalles=null;		
							 	//alert(data)
					            if(data.success==true)
					            {
					                alert("La programación de pago fué registrada con éxito");
					                $("#"+idprog).trigger( "click" );
					                actTotales();
					                $('#myModal').modal('hide');
					                //location.href="/atiempon/public/Seguridad/nopermiso";              
					            }
							      
						},'json');
						
							
					})
				}
		})
	})
	
	function actTotales()
	{
		var acuMonto=0;
		var acuImp=0;
		var indexes = t1.rows().eq(0).filter( function (rowIdx)
		{
			acuMonto+= parseFloat(t1.cell( rowIdx, 1 ).data());
			acuImp+=parseFloat(t1.cell( rowIdx, 2 ).data());
		});	
		//alert(acuMonto);
		$("#montotal").text(acuMonto);
		$("#imptotal").text(acuImp);
	}
 </script>
@endsection
