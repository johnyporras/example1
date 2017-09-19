@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')

<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')

<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script> 
<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush
@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-notes"></i> Historial Médico <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/historial/lista') }}">Historial Médico</a></li>
        <li>{{ $afiliado->cuenta->codigo_cuenta }}</li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">

    @if (Session::has('error'))
        <div id="result" class="alert alert-danger">
            <p><i class="fa fa-exclamation-triangle"></i> <span> {{ Session::get('error') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </p>
        </div>
    @endif

    <!-- Example Block -->
    <div class="block full">


        @include('historial.listado') 
         
    </div>
    <!-- END Example Block -->
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    //Inicializo tabla responsive
    $('.card').cardtable();
}); 
</script>
@endsection