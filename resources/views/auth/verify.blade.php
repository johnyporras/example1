@extends('layouts.auth')

@section('title','Verificar Cuenta')

@section('content')
<div class="block push-bit">
    <div class="row pb25">
    @if (isset($success))
        <div class="col-xs-12">
            <div id="result" class="alert alert-success">
            <p><i class="fa fa-exclamation-triangle"></i> <span class="text">{{ $success }}</span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
            </div>
        </div>
    @endif

    @if (isset($warning))
        <div class="col-xs-12">
            <div id="result" class="alert alert-warning">
            <p><i class="fa fa-exclamation-triangle"></i> <span class="text">{{ $warning }}</span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
            </div>
        </div>
    @endif

    @if (isset($error))
        <div class="col-xs-12">
            <div id="result" class="alert alert-danger">
            <p><i class="fa fa-exclamation-triangle"></i> <span class="text">{{ $error }}</span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
            </div>
        </div>
    @endif

    <div class="col-xs-12 text-center">
        <a href="{{ url('/login') }}" class="btn btn-primary btn-md" ><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesión</a> 
    </div> 
           
</div>
@endsection