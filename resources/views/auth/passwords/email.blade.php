@extends('layouts.auth')

@section('title','Reiniciar Clave')

@section('content')
<div class="block push-bit">

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open(['url' => 'resclave/valemail', 'class' => 'form-horizontal form-bordered form-control-borderless' ]) !!}
                
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                    <input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="Email" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
               
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-envelope-o fa-fw"></i> Enviar Enlace de Reinicio de Clave</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/login') }}"><small>Iniciar Sesión</small></a>
            </div>
        </div>

    {!! Form::close() !!}           
</div>
@endsection