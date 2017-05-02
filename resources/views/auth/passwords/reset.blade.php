@extends('layouts.auth')

@section('title','Reiniciar Clave')

@section('content')

<div class="block push-bit">

    {!! Form::open(['url' => '/password/reset', 'class' => 'form-horizontal form-bordered form-control-borderless' ]) !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                    <input type="email" class="form-control input-lg" name="user" value="{{ old('email') }}" placeholder="Email" >
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password" class="form-control input-lg" name="password" placeholder="Clave" >
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirmar Clave" >
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-refresh fa-fw"></i> Reiniciar Clave</button>
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