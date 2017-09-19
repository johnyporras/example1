@extends('layouts.auth')

@section('title','Reiniciar Clave')

@section('content')

<div class="block push-bit">

    {!! Form::open(['url' => 'resclave/valrespuestas', 'class' => 'form-horizontal form-bordered form-control-borderless' ]) !!}

       

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
           <p>{{ $user->pregunta_1 }}</p>
            <div class="col-xs-12">
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="text" class="form-control input-lg" name="respuesta1" value="" placeholder="Respuesta 1" >
                	<input type="hidden" name="id" value="{{ $user->id }}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
           <p>{{ $user->pregunta_2 }}</p>
            <div class="col-xs-12">
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="text" class="form-control input-lg" name="respuesta2" placeholder="Respuesta 2" >
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-refresh fa-fw"></i> Enviar respuestas</button>
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