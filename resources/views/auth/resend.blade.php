@extends('layouts.auth')

@section('title','Verificar Cuenta')

@section('content')
<div class="block push-bit">
    <div class="row pb25">

        @if (session('success'))
        <div class="col-xs-12">
            <div id="result" class="alert alert-success">
            <p><i class="fa fa-exclamation-triangle"></i> <span class="text">{{ session('success') }}</span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="col-xs-12">
            <div id="result" class="alert alert-danger">
            <p><i class="fa fa-exclamation-triangle"></i> <span class="text">{{ session('error') }}</span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </p>
            </div>
        </div>
        @endif

        <div class="col-xs-12 text-center mb25">
            <h3>Usuario ya Registrado</h3>
            <h4>Haga click en el botón para reenviar correo de confirmación.</h4>
        </div>

        <div class="col-xs-12 text-center">
            <a id="send" href="{{ route('register.resendEmail', $usuario->id) }}" class="btn btn-success btn-md btn-block" ><i class="fa fa-paper-plane-o fa-fw"></i> Enviar Correo</a> 
        </div> 

    </div> <!-- .row -->
</div><!-- .blok -->
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    // Realizo animacion de envio de correo
    $('#send').on('click', function(e) {
        // start the loading script
        $('#send').attr('disabled','disabled');
        $('#send').html("<i class='fa fa-refresh fa-spin fa-fw'></i> Enviando");
    });

});
</script>
@endsection