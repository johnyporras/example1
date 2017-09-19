@extends('layouts.auth')

@section('title','Reiniciar Clave')

@section('content')
<div class="block push-bit">
	Hemos enviado un enlace a su direcci&oacute;n de correo para continuar con el proceso por favor revise su bandeja de entrada
	y haga click en el enlace que se le indica
 </div>  
 <div class="form-group">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/login') }}"><small>Iniciar Sesión</small></a>
            </div>
  </div>
@endsection