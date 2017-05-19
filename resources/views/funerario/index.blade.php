@extends('layouts.app')
@section('title','Modulo Funerario')

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

{!! Form::open(['route' => 'funerario.create', 'class' => 'form-horizontal', 'name' => 'buscar', 'lang' => 'es', 'method' => 'GET']) !!}
        
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

    @if (Session::has('respuesta'))
        <div id="result" class="alert alert-warning">
            <p><i class="fa fa-exclamation-triangle"></i> <span> {{ Session::get('respuesta') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif

@endsection
@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
@endsection