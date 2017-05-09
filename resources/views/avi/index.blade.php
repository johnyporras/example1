@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-airplane"></i> Asistencia al Viajero Internacional <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/avi/lista') }}">Asistencia al Viajero Internacional</a></li>
        <li>Generar</li>
    </ul>
@endsection

@section('content')

    <div class="col-xs-12">
    {!! Form::open(['url' => 'avi', 'class' => 'form-horizontal', 'name' => 'buscar', 'lang' => 'es']) !!}
        
        <div class="form-group {{ $errors->has('cedula') ? 'has-error' : ''}}">
            {!! Form::label('cedula', 'Cédula Afiliado: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::number('cedula', Input::old('cedula'), ['class' => 'form-control', 'required' => 'required', 'min' => '0', 'placeholder' => 'Ej:12345678']) !!}
                {!! $errors->first('cedula', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-sm-2">
                {!! Form::submit('Buscar', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        </div>

    {!! Form::close() !!}  
    </div>
    
    <div class="col-xs-12">
    @if (Session::has('respuesta'))
        <div id="result" class="alert alert-warning">
            <p><i class="fa fa-exclamation-triangle"></i> <span> {{ Session::get('respuesta') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif
    </div>

    <div class="col-xs-12">

    @if (isset($contratos))
        @if (count($contratos) > 0)
            {!! Form::open(['url' => 'avi/seleccion', 'class' => 'form-horizontal', 'name' => 'beneficiario']) !!}
            
                <table class="card table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cédula Afiliado</th><th>Nombre</th><th>Cobertura del Plan</th><th>Colectivo</th>
                            <th>Aseguradora</th><th>Tipo</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- */$x=0;/* --}}
                        @foreach ($contratos as $contrato)
                            {{-- */$x++;/* --}}
                            <tr>
                                {!! Form::hidden('contrato'.$x, $contrato->codigo_contrato) !!}
                                <td>{{ $contrato->cedula_afiliado }}</td>
                                {!! Form::hidden('cedula_afiliado'.$x, $contrato->cedula_afiliado) !!}
                                <td>{{ $contrato->nombre_afiliado }}</td>
                                {!! Form::hidden('nombre_afiliado'.$x, $contrato->nombre_afiliado) !!}
                                <td>{{ $contrato->plan }}</td>
                                {!! Form::hidden('plan'.$x, $contrato->plan) !!}
                                <td>{{ $contrato->colectivo }}</td>
                                {!! Form::hidden('colectivo'.$x, $contrato->colectivo) !!}
                                <td>{{ $contrato->aseguradora }}</td>
                                {!! Form::hidden('aseguradora'.$x, $contrato->aseguradora) !!}
                                <td>{{ $contrato->tipo_afiliado }}</td>
                                {!! Form::hidden('tipo_afiliado'.$x, $contrato->tipo_afiliado) !!}
                                <td>{!! Form::radio('icedula', $x,null, ['id' => 'icedula']) !!}
                                    {!! $errors->first('icedula', '<p class="help-block">:message</p>') !!}</td>
                            </tr>
                        @endforeach
                        {!! Form::hidden('max', $x) !!}
                    </tbody>
                </table>
                <div class="form-group">
                   <div class="col-sm-2 pull-right">
                    {!! Form::submit('Seleccionar', ['class' => 'btn btn-primary btn-block', 'id' => 'seleccionar']) !!}
                    </div> 
                </div>
                
            {!! Form::close() !!}
        @endif
    @endif
    </div>
@endsection
@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->

    <script>
        $(function(){
            $("#seleccionar").click(function(e){
                entro = false;
                $(":checked").each(function(index){
                    entro = true;
                });
                if(entro === false){
                    $("#result").addClass("alert alert-danger");
                    $("#result").html('<p><i class="fa fa-exclamation-circle"></i> ¡Debe seleccionar un Beneficiario!</p>');
                    return false;
                }else{
                    return true;
                }
            });
        });

        //Inicializo tabla responsive
        $('.card').cardtable();
        
    </script>
@endsection