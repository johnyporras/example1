@extends('layouts.app')
@section('title','Historial Médico')

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-notes"></i> Historial Médico <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/historial/lista') }}">Historial Médico</a></li>
        <li>Consultar Cédula</li> 
    </ul>
@endsection

@section('content')

{!! Form::open(['route' => 'historial.create', 'class' => 'form-horizontal', 'name' => 'buscar', 'lang' => 'es', 'method' => 'GET']) !!}
        
        <div class="form-group {{ $errors->has('cedula') ? 'has-error' : ''}}">
            {!! Form::label('cedula', 'Cédula Afiliado: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::number('cedula', Input::old('cedula'), ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Ej:12345678']) !!}
                {!! $errors->first('cedula', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-sm-2">
                {!! Form::submit('Buscar', ['class' => 'btn btn-primary btn-block']) !!}
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
    
@endsection