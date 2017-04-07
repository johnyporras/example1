@extends('layouts.app')
@section('title','Modulo Funerario')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/x-editable/css/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('plugins/x-editable/js/config-editable.js') }}"></script>
<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
@endpush

@section('content')
<hr/>
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Listado Solicitudes" class="btn btn-success"><span class="pr5"><i class="fa fa-table"></i></span> Listado</a></p>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h2 class="pt10 pb10 m0">Solicitud: {{ strtoupper($solicitud->codigo_solicitud) }}</h2>
        </div>
    </div> <!-- row -->

    <div class="row">

        <div class="col-md-6 col-lg-5">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-plane"></i></span> Solicitud Detalles
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-primary"><b>Afiliado:</b></span> {{ $solicitud->afiliado->nombre }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Estado:</b></span> {{ $solicitud->estado->es_desc }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Ciudad:</b></span> {{ $solicitud->ciudad }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Cobertura:</b></span> Bs.{{ $solicitud->cobertura}}</li>
                    @if ($solicitud->doc_cedula)
                    <li class="list-group-item"><span class="text-primary pr5"><b>Cedula:</b></span>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
									data-target="#modal" 
									data-title="Cédula Fallecido"
									data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$solicitud->doc_cedula) }}" 
									data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_cedula]) }}" 
									title="Ver"><i class="fa fa-eye"></i>
								</button>
								<a class="btn btn-info btn-sm" 
									href="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_cedula]) }}" 
									download="{{ "dni-".$solicitud->codigo_solicitud }}" 
									title="Descargar"><i class="fa fa-download"></i>
								</a>
                     </li>
                    	@endif

							@if ($solicitud->doc_acta)
                    	<li class="list-group-item"><span class="text-primary pr5"><b>Acta Defunción</b></span>
                    		<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
									data-target="#modal" 
									data-title="Acta Defunción"
									data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$solicitud->doc_acta) }}" 
									data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_acta]) }}" 
									title="Ver"><i class="fa fa-eye"></i>
								</button>
								<a class="btn btn-info btn-sm" 
									href="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_acta]) }}" 
									download="{{ "acta-".$solicitud->codigo_solicitud }}" 
									title="Descargar"><i class="fa fa-download"></i>
								</a> 
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div> <!-- .row -->
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <h2>Presupuestos</h2>
            <hr>
        </div>
    </div> <!-- row -->
</div>

<div class="col-xs-12">
   <div class="row">
      <div class="col-xs-12">

        	@if (count($solicitud->presupuestos) > 0)
        	<table class="card table table-hover table-striped table-bordered table-colored nowrap" cellspacing="0" width="100%">
	         <thead>
	         	<tr>
						<th>Proveedor</th>
						<th>Factura No</th>
						<th>Fecha</th>	
						<th>Monto</th>
						<th>Detalles</th>
						<th width="110">Documento</th>
					</tr> 
	         </thead>
	         <tbody>

         	@foreach ($solicitud->presupuestos as $presupuesto)
	          <tr>
	          
					<li class="list-group-item">
                	<a class="xtext btn btn-succes" 
                	data-type="text"
                	data-pk="{{ $presupuesto->id }}"
                	data_url="{{ route('funerario.modify', ['id' => $presupuesto->id]) }}" 
                	data-id="13" 
                	data-name="type" 
                	data-value="valor"
                	data-title="Ingrese Fecha"
                	></a>
               </li>
               <li><button class="btn btn-danger cantidad" data-id="{{ $presupuesto->id }}">Ver valores</button></li>
               <!-- 
					<li class="list-group-item"><a class="xdate" data-type="date"  data-id="13" data-title="Ingrese Fecha">valor</a></li>
               <li class="list-group-item"><a class="xselect" data-type="select" data-id="13" data-value="1"></a></li>
               <li class="list-group-item"><a class="xnumber" data-type="text" data-id="13" data-value="35000"></a></li> 
                -->
					<td>{{ $presupuesto->proveedor->razon_social }}</td>
					<td><a class="xselect" 
                	data-type="select"
                	data-pk="{{ $presupuesto->id }}"
                	data_url="{{ route('funerario.modify', ['id' => $presupuesto->id]) }}" 
                	data-name="proveedor_id" 
                	data-value="{{ $presupuesto->proveedor_id }}"
                	data-title="Ingrese Proveedor"
                	></a></td>
					<td>{{ $presupuesto->factura }}</td>	
					<td>{{ $presupuesto->fecha->format('d/m/Y') }}</td>
					<td>{{ $presupuesto->monto }}</td>
					<td>{{ $presupuesto->detalles }}</td>
					<td class="text-center">
						<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
							data-target="#modal" 
							data-title="{{ $presupuesto->factura }}"
							data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$presupuesto->doc_factura) }}" 
							data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $presupuesto->doc_factura]) }}" 
							title="Ver"><i class="fa fa-eye"></i>
						</button>
						<a class="btn btn-info btn-sm" 
							href="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $presupuesto->doc_factura]) }}" 
							download="{{ "fact-".$presupuesto->factura }}" 
							title="Descargar"><i class="fa fa-download"></i>
						</a>
					</td>

				</tr>
         	@endforeach
         	</tbody>
         </table>
			@endif

     	</div> <!-- .col-xs-12 -->
   </div> <!-- row -->
</div>
		
	<!--  El modal para mostrar los archivos -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
		<div class="modal-dialog">
		    	<div class="modal-content">
			      <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title"></h4>
			      </div>
			      <div class="modal-body">
			      </div>
			      <div class="modal-footer">
			        	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
		    </div>
		</div>
	</div>
	

@endsection
@section('script')

<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->

<script>
$(document).ready(function() {
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

   // x-editable
   $('.xdate').editable({
   	validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
      },
      viewformat: 'dd/mm/yyyy',    
      datepicker: {
         language: 'es'
      },
      ajaxOptions: {
         dataType: 'json',
         type: 'post'
      }
   });

   $('.xselect').editable({
   	validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
      },
      source: {!! $valores !!},
      ajaxOptions: {
         dataType: 'json',
         type: 'post'
      } 
   });

	$('.xtext').editable({
      validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
      },
      ajaxOptions: {
         dataType: 'json',
         type: 'post'
      }
	});

	$('.xnumber').editable({
      validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
      },
      validate: function(value) {
         if($.isNumeric(value) == '') {
              return 'Solo se permiten numeros.';
        	}
      },
      ajaxOptions: {
         dataType: 'json',
         type: 'post'
      }
	});

	// Prueba valores ajax
	$('.cantidad').on('click', function() {

		var id = $(this).attr('data-id');

      $.ajax({
         type: 'POST',
         url: '/funerario/'+ id +'/modify',
         success: function(valores) {
            console.log(valores);
         }
     });

    });

  //Inicializo tabla responsive
  $('.card').cardtable();

  	$('#modal').on('show.bs.modal', function (event) { // id of the modal with event
	  var button = $(event.relatedTarget) ;// Button that triggered the modal
	  var title = button.data('title'); // Extract info from data-* attributes
	  var mime = button.data('mime');
	  var url = button.data('url');
	 
	  var titulo = 'Documento ' + title;

	  if (mime == 'application/pdf' ) 
	  {
	  		var content = ' <p><embed width="100%" height="400" src="'+url+'"></embed></p>';
	  }else
	  {
	  		var content = '<p class="text-center"><img class="img-responsive" src="'+url+'" alt=""></p>';
	  }

	  // Update the modal's content.
	  var modal = $(this);
	  modal.find('.modal-title').text(titulo);
	  modal.find('.modal-body').html(content); 
	  ;
	})

});
</script>
@endsection