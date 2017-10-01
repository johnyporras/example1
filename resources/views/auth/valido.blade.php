@extends('layouts.auth')

@section('title','Verificar Cuenta')

@section('content')
<div class="block push-bit">
    <div class="row pb25">

        <div class="col-xs-12">
            <div id="result" class="alert alert-success">
            <p><span class="pull-left pr10 pt5"><i class="fa fa-exclamation-triangle fa-2x"></i></span> <span class="text">Hemos enviado un enlace de confirmación a su cuenta de correo electrónico</span>
            </p>
            </div>
        </div>

        <div class="col-xs-12 text-center mb25">
            <h4>¡Por favor verifique su buzón de correo!</h4>
        </div>

        <div class="col-xs-12 text-center">
            <a id="send" href="{{ url('login') }}" class="btn btn-success btn-md btn-block" ><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesión</a>
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
        $('#send').html("<i class='fa fa-refresh fa-spin fa-fw'></i> Cargando");
    });

});
</script>
@endsection
