@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')
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
						<th width="120">Documento</th>
					</tr> 
	         </thead>
	         <tbody>

         @foreach ($solicitud->presupuestos as $presupuesto)
	          <tr>
					<td>{{ $presupuesto->proveedor->razon_social }}</td>
					<td>{{ $presupuesto->factura }}</td>	
					<td>{{ $presupuesto->fecha->format('d/m/Y') }}</td>
					<td>{{ $presupuesto->monto }}</td>
					<td>{{ $presupuesto->detalles }}</td>
					<td>
						<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
							data-target="#modal" 
							data-title="{{ $presupuesto->factura }}" 
							data-url="{{ Storage::disk('funerario')->url($presupuesto->doc_factura) }}" 
							title="Ver"><i class="fa fa-eye"></i></button>
						<a class="btn btn-info btn-sm" 
							href="{{ Storage::disk('funerario')->getDriver()->getAdapter()->applyPathPrefix($presupuesto->doc_factura) }}" 
							download="filename" 
							title="Descargar"><i class="fa fa-download"></i></a>
							<p>{{ url(Storage::disk('funerario')->url('app/funerario/'.$presupuesto->doc_factura)) }}</p>
							<p>{{ storage_path('app/funerario/'.$presupuesto->doc_factura) }}</p>

							<p>{{ Storage::disk('funerario')->getDriver()->getAdapter()->applyPathPrefix($presupuesto->doc_factura) }}</p>

							<p>{{ asset(Storage::url('files/'.$presupuesto->doc_factura)) }}</p>
					</td>

				</tr>
         @endforeach
         	</tbody>
         </table>

        @endif
        </div> <!-- .col-xs-12 -->
    </div> <!-- row -->
</div>
		<p>
			<embed width="100%" src="{{ storage_path('app/funerario/'.$presupuesto->doc_factura) }}"></embed>
		</p>
	<!--  El modal para mostrar los archivos -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
		<div class="modal-dialog">
		    	<div class="modal-content">
			      <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title">Factura </h4>
			      </div>
			      <div class="modal-body">
			        Are you sure want to delete the product?
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

  //Inicializo tabla responsive
  $('.card').cardtable();

  	$('#modal').on('show.bs.modal', function (event) { // id of the modal with event
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var productid = button.data('productid') // Extract info from data-* attributes
	  var productname = button.data('productname')
	  
	  var title = 'Confirm Delete #' + productid
	  var content = 'Are you sure want to delete ' + productname + '?'
	  
	  // Update the modal's content.
	  var modal = $(this)
	  modal.find('.modal-title').text(title)
	  modal.find('.modal-body').text(content)	  
	  
	})

});
</script>
@endsection