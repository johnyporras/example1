<div class="row">
    <!-- Customer Info -->
    <div class="col-xs-12">
        <h4 class="sub-header text-center pt0 mt0 mb0">Codigo QR para Emergencias</h4>
    </div>
    <div class="col-sm-4">
        <div class="block-section text-right hidden-xs">
            {!! QrCode::backgroundColor(57,66,99)
                    ->color(255,255,255)
                    ->size(150)
                    ->generate(Request::url()) !!} 
            <div class="m0 pr15">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-print fa-fw"></i> Imprimir</button>
            </div>
        </div>
        <div class="block-section text-center visible-xs">
            {!! QrCode::backgroundColor(57,66,99)
                    ->color(255,255,255)
                    ->size(150)
                    ->generate(Request::url()) !!} 
            <div class="m0 pr15">
                <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
            </div>
        </div>
    </div> 

    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12">

                <div class="widget">
                    <div class="widget-simple themed-background-dark">
                        <a href="javascript:void(0)" class="widget-icon pull-right animation-fadeIn themed-buble">
                            <i class="gi gi-heart"></i>
                        </a>
                        <h4 class="widget-content animation-hatch mt0">
                            <span class="text-white">Este código puede salvarte</span>
                            <small class="text-white text-justify">En él se recoge información relevante sobre ti, como tus datos de contacto, alergias, ultimas medicaciones, enfermedades destacables. En caso de emergencia resultara muy útil a las personas que te asistan.</small>
                        </h4>
                    </div>
                    <!-- END Widget -->
                </div>

                <div class="widget">
                    <div class="widget-simple themed-buble">
                        <a href="javascript:void(0)" class="widget-icon pull-left animation-fadeIn themed-background">
                            <i class="gi gi-iphone"></i>
                        </a>
                        <h4 class="widget-content animation-hatch">
                            <span>¡Prueba tu código QR!</span>
                            <small class="text-white">Escanea el código con tu smartphone</small>
                        </h4>
                    </div>
                    <!-- END Widget -->
                </div>
            <div class="col-lg-7">

               
            </div>
        </div> <!-- .row -->
    </div>

    <div class="col-xs-12">
        
    </div> 
    
</div>

@push('sub-script')
<script>
$(document).ready(function() {

    $valor = 'Estoy escribiendo desde codigo'
});
</script>
@endpush