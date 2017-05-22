@extends('layouts.app')
@section('title','Modulo Funerario')

@push('styles')
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
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
        <li>Editar</li>
    </ul>
@endsection

@section('content')

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Listado solicitudes" class="btn btn-success"><span class="pr5"><i class="fa fa-table"></i></span> Solicitudes</a></p>
        </div>
    </div> <!-- row -->

</div> <!-- .col-12 -->

<div class="col-xs-12">
    
    <div class="row">
        <div class="col-md-6 col-lg-5">
            @if (isset($afiliado))
            <div class="panel panel-warning">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-user"></i></span> Afiliado
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-warning"><b>Cédula:</b></span> {{ $afiliado->cedula }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Nombre:</b></span> {{ $afiliado->nombre }} {{ $afiliado->apellido }} </li>
                    <li class="list-group-item"><span class="text-warning"><b>Edad:</b></span> {{ $afiliado->fecha_nacimiento->age }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Sexo:</b></span> {{ ($afiliado->sexo == 'M')?'Masculino':'Femenino' }}</li>
                </ul>
            </div>
            @endif 
        </div>

        <div class="col-md-6 col-lg-5 col-lg-offset-2">
            @if (isset($cuenta))
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-book"></i></span> Servicio
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-primary"><b>Codigo Cuenta:</b></span> {{ $cuenta->codigo_cuenta }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Estatus:</b></span> {{ $cuenta->estatus }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Plan:</b></span> {{ $plan->nombre }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Cobertura del Plan:</b></span> {{ $plan->cobertura }}</li>
                </ul>
            </div>
            @endif
        </div>
    </div> <!-- .row -->
</div>

<div class="col-xs-12">
    {{ Form::model($solicitud, ['route'=> ['funerario.update', $solicitud->id], 'method' =>'PUT', 'files' => true, 'id' => 'funerarioForm', 'class' => 'form-horizontal', 'role' => 'form']) }}
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Actualizar Solicitud: {{ $solicitud->codigo_solicitud }}</h3>
            </div>
        </div>
    </div> <!-- row -->
    
    <!-- Estado - Ciudad - Telefono -->
    <div class="row">

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('estado_id') ? ' has-error' : '' }}">
                        {{ Form::label('estado_id', 'Estado', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {!! Form::select('estado_id', $estados, null, ['class' => 'form-control', 'placeholder'=>'Seleccione Estado', 'required']) !!}
                        @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('ciudad') ? ' has-error' : '' }}">
                        {{ Form::label('ciudad', 'Ciudad', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('ciudad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Ciudad', 'required']) }}
                        @if ($errors->has('ciudad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ciudad') }}</strong>
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
                    <div class="form-group {{ $errors->has('contacto') ? ' has-error' : '' }}">
                        {{ Form::label('contacto', 'Teléfono Contacto', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('contacto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese teléfono contacto','pattern' => '^[0][24][1-9][0-9]+$', 'minlength' => "11", 'maxlength' => '11', 'required']) }}
                        <span class="help-block">
                            <strong>Ejemplo: 02121231122</strong>
                        </span>
                        @if ($errors->has('contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contacto') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
    </div> <!-- row -->
    
    <!-- Medoto de pago - Plazo de pago -->
    <div class="row">

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('metodo_id') ? ' has-error' : '' }}">
                {{ Form::label('metodo_id', 'Metodo Pago', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::select('metodo_id', $metodos, null, ['class' => 'form-control', 'placeholder'=>'Seleccione metodo pago', 'id' => 'metodo', 'required']) }}
                @if ($errors->has('metodo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metodo_id') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  -->
        </div>

        <div class="col-md-6 hidden" id="cdia">
            <div class="form-group {{ $errors->has('plazo') ? ' has-error' : '' }}">
                {{ Form::label('plazo', 'Plazo de Pago', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::select('plazo', $dias, null, ['class' => 'form-control', 'placeholder'=>'Seleccione plazo', 'id' => 'dia']) }}
                @if ($errors->has('plazo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('plazo') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  -->
        </div>
        
    </div> <!-- row -->
    
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h3>Documentos</h3>
            <hr>
        </div>
    </div> <!-- row -->

    <!-- Documentos Cedula - Acta defuncion -->
    <div class="row">

        <div class="col-md-6">
           <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                {{ Form::label('cedula', 'Cédula Fallecido', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::file('cedula', ['id' => 'cedula']) }}
                <span class="help-block">
                    <strong>Permitido: PDF, Imagen</strong>
                </span>
                @if ($errors->has('cedula'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cedula') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  --> 
        </div>

        <div class="col-md-6">
           <div class="form-group {{ $errors->has('acta') ? ' has-error' : '' }}">
                {{ Form::label('acta', 'Acta Defunción', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::file('acta', ['id'=>'acta']) }}
                <span class="help-block">
                    <strong>Permitido: PDF, Imagen</strong>
                </span>
                @if ($errors->has('acta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acta') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  --> 
        </div>

        <div class="col-xs-12">
            <!-- Campos ocultos necesarios para cargar la solicitud -->
            {{ Form::hidden('afiliado_id', 1) }}
            <hr>
        </div>

    </div> <!-- row -->

    <div class="row">
       <div class="col-xs-12 col-md-2">
            <p>
                {{ Form::submit('editar', ['class' => 'btn btn-info btn-block', 'id' => 'generar']) }}
            </p>
        </div>
    </div> <!-- row -->
 {{ Form::close() }}   

</div> <!-- .col-12 -->
<?php 
    $cedula = explode('.', $solicitud->doc_cedula);
    $acta = explode('.', $solicitud->doc_acta);
?>

@endsection

@section('script')
<script>
$(document).ready(function() {
    // Contador
    var contador = 1;
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

    /*Para subir Cedula*/
    $('#cedula').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
        @if (isset($solicitud->doc_cedula))
            initialPreview: [
                '{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_cedula]) }}',
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
            @if ($cedula[1] == 'pdf')
                {type: "pdf", caption: "{{$solicitud->doc_cedula }}", key: 1},
            @else
                {caption: "{{ $solicitud->doc_cedula }}",  key: 1},
            @endif
            ]
        @endif
    });

    /*Para subir acta defuncion*/
    $('#acta').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
        @if (isset($solicitud->doc_acta))
            initialPreview: [
                "{{ route('furnerario.files', ['path' => $solicitud->codigo_solicitud, 'file' => $solicitud->doc_acta]) }}",
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
            @if ($acta[1] == 'pdf')
                {type: "pdf", caption: "{{$solicitud->doc_acta }}", key: 1},
            @else
                {caption: "{{ $solicitud->doc_acta }}",  key: 1},
            @endif
            ]
        @endif
    });

    @if (isset($solicitud->plazo))
        // Remuevo el valor oculto si tiene tiene un plazo
        $("#cdia").removeClass("hidden");
    @endif

    //Valida cambio del metodo de pago
    $("#metodo").on('change', function() {
        // valido metodo para mostrar dias
        dia = this.value;

        if(dia == 2){
            $("#cdia").removeClass("hidden");
            $("#dia").parsley(parsleyOptions).addConstraint("required", "true");
            $("#dia").attr("required");
        }else{
            $("#cdia").addClass("hidden");
            $("#dia").parsley(parsleyOptions).removeConstraint("required");
            $("#dia").val(null);
        }
    });

});    
</script>
@endsection