@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
@endpush

@push('scripts')
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script> 
<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush
@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-notes"></i> Historial Médico <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/historial/lista') }}">Historial Médico</a></li>
        <li>Detalle Historial</li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">

    @if (Session::has('error'))
        <div id="result" class="alert alert-danger">
            <p><i class="fa fa-exclamation-triangle"></i> <span> {{ Session::get('error') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif

    <!-- Example Block -->
    <div class="block full">

        <div class="row">

            <div class="col-xs-12">
                <h4 class="sub-header"><span>Detalle historial Médico</span></h4>
            </div>
            
            <div class="col-xs-12">
                <table class="table table-borderless table-striped table-hover table-vcenter">
                    <tbody>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Fecha Atención:</strong>
                            </td>
                            <td><span>{{ $historial->fecha->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Motivo Atención:</strong>
                            </td>
                            <td><span>{{ $historial->motivo }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Especialidad:</strong>
                            </td>
                            <td><span>{{ $historial->especialidad }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Procedimiento:</strong>
                            </td>
                            <td><span>{{ $historial->procedimiento }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Tratamiento:</strong>
                            </td>
                            <td><span>{{ $historial->tratamiento }}</td>
                        </tr>
                        @if ($historial->medico)
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Médico / Doctor:</strong>
                                </td>
                                <td><span>{{ $historial->medico }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Observaciones:</strong>
                            </td>
                            <td><span>{{ $historial->observaciones }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Recomendaciones:</strong>
                            </td>
                            <td><span>{{ $historial->recomendaciones }}</td>
                        </tr>
                        
                    </tbody>
                </table>
                <!-- END Customer Info --> 
                
            </div>

            <div class="col-xs-12">
                <h4 class="sub-header"><span>Examenes Médicos</span></h4>
            </div>

            <div class="col-xs-12">
                <p>
                    <button
                       data-toggle="modal" 
                       data-target="#fmodal"
                       title="Nuevo Presupuesto" 
                       class="btn btn-warning btn-sm">
                       <span class="pr5"><i class="fa fa-plus"></i></span> Examen
                    </button>
                </p>
            </div>

            <div class="col-xs-12">
            @if (count($historial->examenes) > 0)
                <table class="card table table-hover table-striped table-bordered table-colored nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="50"><span><i class="fa fa-trash"></i></span></th>
                            <th>Examen</th>
                            <th width="110">acciones</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach ($historial->examenes as $archivo)
                        <tr>
                            <td class="text-center"><a href="/historial/delete/{{ $archivo->id }}" class="btn btn-danger btn-xs sweet-danger"> <i class="fa fa-trash"> </i></a></td>
                            <td>{{ $archivo->examen }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" 
                                    data-target="#modal" 
                                    data-title="{{ $archivo->examen }}"
                                    data-mime="{{ Storage::disk('documento')->mimeType($archivo->examen) }}" 
                                    data-url="{{ route('profile.file', ['path' => $archivo->examen]) }}" 
                                    title="Ver"><i class="fa fa-eye"></i>
                                </button>
                                <a class="btn btn-info btn-xs" 
                                    href="{{ route('profile.file', ['path' => $archivo->examen]) }}" 
                                    download="{{$archivo->examen }}" 
                                    title="Descargar"><i class="fa fa-download"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            @endif
                
            </div>

        </div> <!-- /.row -->

    </div>
    <!-- END Example Block -->

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
    <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Examen Médico</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(['route'=>'historial.save', 'files' => true, 'id' => 'examenForm', 'class' => 'form-horizontal']) }}

                <div class="row">
                    
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('examen') ? ' has-error' : '' }}">
                            {{ Form::label('examen', 'Examen', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::file('examen', ['id' => 'examen', 'required']) }}
                                <span class="help-block">
                                    <strong>Permitido: PDF, Imagen</strong>
                                </span>
                                @if ($errors->has('envoice'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('examen') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End .form-group  --> 
                    </div>
                    
                    <div class="col-xs-12">
                        {{ Form::hidden('id', $historial->id) }}
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
</div>
@endsection

@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
<script>
$(document).ready(function() {

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
    $('#examenForm').parsley(parsleyOptions);

    //Inicializo tabla responsive
    $('.card').cardtable();

    /*Para subir factura*/
    $('#examen').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
    });

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