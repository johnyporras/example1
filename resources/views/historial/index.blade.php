@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
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
        <li>Buscar Afiliado</li> 
    </ul>
@endsection

@section('content')

    {!! Form::open(['route' => 'historial.index', 'id' => 'buscarForm', 'lang' => 'es', 'method' => 'GET']) !!}
        
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
            {{ Form::label('nombre', 'Nombre:', ['class' => 'control-label']) }}
            {{ Form::text('nombre', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre', 'required']) }}
            @if ($errors->has('nombre'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
            @endif
        </div> <!-- End .form-group  -->
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
            {{ Form::label('apellido', 'Apellido:', ['class' => 'control-label']) }}
            {{ Form::text('apellido', null , ['class' => 'form-control', 'placeholder' => 'Ingrese apellido']) }}
            @if ($errors->has('apellido'))
                <span class="help-block">
                    <strong>{{ $errors->first('apellido') }}</strong>
                </span>
            @endif
        </div> <!-- End .form-group  -->
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
            {!! Form::label('cedula', 'Cédula: ', ['class' => 'control-label']) !!}
            {!! Form::number('cedula', null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Ej:12345678']) !!}
            @if ($errors->has('cedula'))
                <span class="help-block">
                    <strong>{{ $errors->first('cedula') }}</strong>
                </span>
            @endif
        </div> <!-- End .form-group  -->
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
            {{ Form::label('fecha', 'Fecha Nacimiento', ['class' => 'control-label']) }}

            <div class="input-group">
                {{ Form::text('fecha', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Nacimiento', 'id' => 'date']) }}
                <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </div>
            </div>
            @if ($errors->has('fecha'))
                <span class="help-block">
                    <strong>{{ $errors->first('fecha') }}</strong>
                </span>
            @endif
        </div><!-- End .form-group  -->
    </div>
    
    <div class="clearfix"></div>          

    <div class="col-xs-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i>
                Buscar </button>
        </div>    
    </div>

{!! Form::close() !!}


    @if (Session::has('respuesta'))
        <div id="result" class="alert alert-warning">
            <p><i class="fa fa-exclamation-triangle"></i> <span> {{ Session::get('respuesta') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif

    @if (isset($afiliados))
        <div class="col-xs-12 mt25 mb25">
            <table class="card table table-hover table-striped table-bordered table-colored nowrap">
                 <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Cuenta</th>
                        <th width="80">Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($afiliados) > 0)
                        @foreach ($afiliados as $afiliado)
                        <tr class="text-center">
                            <td>{{ $afiliado->nombre }}</td>
                            <td>{{ $afiliado->apellido }}</td>
                            <td>{{ $afiliado->cuenta->codigo_cuenta }}</td>
                            <td><a href="{{ route('historial.show', $afiliado->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a></td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4"><p class="m0 text-center">No se encontraron resultados</></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
    @endif
@endsection

@section('script')
<script>
$(document).ready(function() {

    /** Validar formulario **/
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
        errorTemplate: '<div></div>',
    };

    // Genero la validacion del formulario...
    $('#buscarForm').parsley(parsleyOptions);

    //Inicializo tabla responsive
    $('.card').cardtable();

    /* Para fecha de nacimiento*/
    $("#date").datepicker({
        language: "es",
        endDate: '-18y',
        format: 'yyyy-mm-dd',
    }).on('changeDate', function () {   
        // Valida campo al cambiar valor
        $("#iniDate").parsley(parsleyOptions).validate();
    });

});    
</script>
@endsection