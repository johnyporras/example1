<div class="row">
    <!-- Customer Info -->
    <div class="col-xs-4">
        <div class="block-section text-right">
            
            
            {!! QrCode::size(100)->generate(Request::url()); !!}
            <p>Scan me to return to the original page.</p>
            

        </div>
    </div>

    <div class="col-xs-8">
        <div class="row">
            <div class="col-xs-12">
                <p>Prueba codigo QR</p>
            </div>
            <div class="col-lg-7">

               
            </div>
        </div> <!-- .row -->
    </div>

    <div class="col-xs-12">
        
    </div> 
    
</div>

@push('persona')
<script>
$(document).ready(function() {


});
</script>
@endpush