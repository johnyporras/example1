@extends('layouts.auth')

@section('title','Login')

@section('content')
<div class="block push-bit">
    <!--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">-->
    {!! Form::open(['url' => '/login', 'class' => 'form-horizontal form-bordered form-control-borderless' ]) !!}

        @if (session('message'))
            <div class="alert alert-danger">
                    {{ session('message') }}
            </div>
        @endif
                
        <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                    <input type="text" class="form-control input-lg" name="user" value="{{ old('user') }}" placeholder="Usuario" >
                </div>
                @if ($errors->has('user'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
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

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesión</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/password/reset') }}" ><small>¿Olvido su clave?</small></a> -
                <a href="{{ url('/register') }}" ><small>Registrate</small></a>
            </div>
        </div>

    {!! Form::close() !!}           
</div>
@endsection