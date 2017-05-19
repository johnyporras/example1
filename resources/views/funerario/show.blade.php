@extends('layouts.app')
@section('title','Modulo Funerario')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/x-editable/css/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('plugins/x-editable/js/config-editable.js') }}"></script>
<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script> 
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ url('plugins/select2/js/es.js') }}"></script>
<script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="glyphicon glyphicon-king"></i> Modulo Funerario <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/funerario/lista') }}">Modulo Funerario</a></li>
        <li>Detalles</li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Listado Solicitudes" class="btn btn-success btn-sm"><span class="pr5"><i class="fa fa-table"></i></span> Listado</a></p>
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
								<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" 
									data-target="#modal" 
									data-title="Cédula Fallecido"
									data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$solicitud->doc_cedula) }}" 
									data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_cedula]) }}" 
									title="Ver"><i class="fa fa-eye"></i>
								</button>
								<a class="btn btn-info btn-xs" 
									href="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_cedula]) }}" 
									download="{{ "dni-".$solicitud->codigo_solicitud }}" 
									title="Descargar"><i class="fa fa-download"></i>
								</a>
                     </li>
                    	@endif

							@if ($solicitud->doc_acta)
                    	<li class="list-group-item"><span class="text-primary pr5"><b>Acta Defunción</b></span>
                    		<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" 
									data-target="#modal" 
									data-title="Acta Defunción"
									data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$solicitud->doc_acta) }}" 
									data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_acta]) }}" 
									title="Ver"><i class="fa fa-eye"></i>
								</button>
								<a class="btn btn-info btn-xs" 
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

<div class="col-xs-12 block">
   <div class="row">

      <div class="col-xs-12">
         <h2>Presupuestos</h2>
         <hr>
      </div>
      <div class="col-xs-12">
         <p>
            <button
               data-toggle="modal" 
               data-target="#fmodal"
               title="Nuevo Presupuesto" 
               class="btn btn-info btn-sm">
               <span class="pr5"><i class="fa fa-plus"></i></span> Presupuesto
            </button>
         </p>
      </div>

      <div class="col-xs-12">

        	@if (count($solicitud->presupuestos) > 0)
        	<table class="card table table-hover table-striped table-bordered table-colored nowrap" cellspacing="0" width="100%">
	         <thead>
	         	<tr>
            <th class="text-center" width="50"><span><i class="fa fa-trash"></i></span></th>
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
               <td class="text-center"><a href="/funerario/delete/{{ $presupuesto->id }}" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a></td>
					<td><a class="xselect" 
                	data-type="select"
                	data-pk="{{ $presupuesto->id }}"
                	data-name="proveedor_id" 
                	data-value="{{ $presupuesto->proveedor_id }}"
                	data-title="Ingrese Proveedor"
                	></a></td>
               <td><a class="xtext" 
                  data-type="text"
                  data-pk="{{ $presupuesto->id }}" 
                  data-name="factura"
                  data-value="{{ $presupuesto->factura }}"
                  data-title="Ingrese No Factura"
                  ></a></td>
               <td><a class="xdate" 
                  data-type="date"
                  data-pk="{{ $presupuesto->id }}"
                  data-name="fecha" 
                  data-value="{{ $presupuesto->fecha->format('Y-m-d') }}"
                  data-title="Ingrese Fecha"
                  ></a></td>
               <td><a class="xnumber" 
                  data-type="text"
                  data-pk="{{ $presupuesto->id }}"
                  data-name="monto"
                  data-value="{{ $presupuesto->monto  }}"
                  data-title="Ingrese Monto Factura"
                  ></a></td>
               <td><a class="xtext" 
                  data-type="textarea"
                  data-pk="{{ $presupuesto->id }}"
                  data-name="detalles"
                  data-value="{{ $presupuesto->detalles  }}"
                  data-title="Ingrese Detalles"
                  ></a></td>
					<td class="text-center">
						<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" 
							data-target="#modal" 
							data-title="{{ $presupuesto->factura }}"
							data-mime="{{ Storage::disk('funerario')->mimeType($solicitud->codigo_solicitud.'/'.$presupuesto->doc_factura) }}" 
							data-url="{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $presupuesto->doc_factura]) }}" 
							title="Ver"><i class="fa fa-eye"></i>
						</button>
						<a class="btn btn-info btn-xs" 
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

  <!--  El modal para crear presupuesto -->
  <div class="modal fade" id="fmodal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Presupuesto</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(['route'=>'funerario.save', 'files' => true, 'id' => 'funerarioForm', 'class' => 'form-horizontal']) }}
              <!-- Proveedor - Fecha solicitud - Monto Detalle - factura - numero factura -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('proveedor') ? ' has-error' : '' }}">
                                    {{ Form::label('proveedor', 'Proveedor', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                    {{ Form::select('proveedor', $proveedores, null, ['class' => 'form-control', 'placeholder'=>'Seleccione proveedor', 'required']) }}
                                    @if ($errors->has('proveedor'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('proveedor') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!-- End .form-group  -->
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('fsolicitud') ? ' has-error' : '' }}">
                                    {{ Form::label('fsolicitud', 'Fecha Solicitud', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            {{ Form::text('fsolicitud', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Solicitud', 'id' => 'fechaSl', 'required']) }}
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('fsolicitud'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fsolicitud') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- End .form-group  -->
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('monto') ? ' has-error' : '' }}">
                                    {{ Form::label('monto', 'Monto', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                    {{ Form::text('monto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese monto factura', 'pattern' => '[1-9][0-9]{1,10}', 'maxlength' => '10', 'required']) }}
                                    @if ($errors->has('monto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('monto') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!-- End .form-group  -->
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('detalle') ? ' has-error' : '' }}">
                                    {{ Form::label('detalle', 'Detalles', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                    {{ Form::textArea('detalle', null, ['class' => 'form-control', 'placeholder' => 'Ingrese detalles', 'rows' => 3,'minlength' => "10" ]) }}
                                    @if ($errors->has('detalle'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('detalle') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!-- End .form-group  -->
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('factura') ? ' has-error' : '' }}">
                                    {{ Form::label('factura', 'Nro Factura', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                    {{ Form::text('factura', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nro factura', 'required']) }}
                                    @if ($errors->has('factura'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('factura') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!-- End .form-group  -->
                            </div>

                            <div class="col-xs-12">
                               <div class="form-group {{ $errors->has('envoice') ? ' has-error' : '' }}">
                                    {{ Form::label('envoice', 'Factura', ['class' => 'col-md-3 control-label']) }}
                                    <div class="col-md-9">
                                    {{ Form::file('envoice', ['id' => 'envoice', 'required']) }}
                                    <span class="help-block">
                                        <strong>Permitido: PDF, Imagen</strong>
                                    </span>
                                    @if ($errors->has('envoice'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('envoice') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!-- End .form-group  --> 
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12">
                    {{ Form::hidden('id', $solicitud->id) }}
                    <button type="submit" class="btn btn-sm btn-success" title="Guardar"><span><i class="fa fa-save"></i></span> Guardar</button>
                </div>
                    
                </div> <!-- row -->
              {{ Form::close() }}  
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><span><i class="fa fa-close"></i></span> Cerrar</button>
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

  // Validar formulario
    var parsleyOptions = {
        errorClass: 'has-error',
        successClass: 'has-success',
        classHandler: function(el) {
            return el.$element.parents('.form-group');
        },
        errorsContainer: function(el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<span class="help-block">',
        errorTemplate: '<div class=" col-md-offset-3 col-md-9"></div>',
    };

    // Genero la validacion del formulario...
    $('#funerarioForm').parsley(parsleyOptions);

    /*Para subir factura*/
    $('#envoice').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
    });

    /* Para fecha de solicitud*/
    $("#fechaSl").datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaSl').parsley(parsleyOptions).validate();
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
      url:'{{ route('funerario.modify') }}',
   });

   $('.xselect').editable({
   	validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
      },
      source: {!! $valores !!}, 
      url:'{{ route('funerario.modify') }}',
   });

	$('.xnumber').editable({
      validate: function(value) {
         if($.trim(value) == '') {
              return 'Valor es requerido.';
        	}
         if($.isNumeric(value) == '') {
              return 'Solo se permiten numeros.';
         }
      },
      url:'{{ route('funerario.modify') }}',
	});

   $('.xtext').editable({
      validate: function(value) {
         if($.trim(value) == '') 
             return 'Valor es requerido.';
      },
      url:'{{ route('funerario.modify') }}',
   })

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
	  		var content = '<p><embed width="100%" height="400" src="'+url+'"></embed></p>';
	  }else
	  {
	  		var content = '<p class="text-center"><img class="img-responsive" src="'+url+'" alt=""></p>';
	  }

	  // Update the modal's content.
	  var modal = $(this);
	  modal.find('.modal-title').text(titulo);
	  modal.find('.modal-body').html(content);
	});

   $('.sweet-danger').on( 'click', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({   
            title: "Advertencia",
            text: "¿Esta seguro de continuar?",         
            type: "warning",   
            showCancelButton: true,   
            confirmButtonClass: "btn-danger btn-sm",
            confirmButtonText: "Eliminar",
            cancelButtonClass: "btn-sm",
            cancelButtonText: "Cancelar", 
            closeOnConfirm: false 
            }, 
            function(){  
                window.location = link
        });
    });

});
</script>
@endsection