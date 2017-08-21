@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')

<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')

<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script> 
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

        <div class="block-title hidden-print">
            <!-- Default Tabs -->
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li><a href="#1"><i class="gi gi-user fa-fw"></i> {{ strtoupper('Datos Personales') }}</a></li>
                <li><a href="#2"><i class="fa fa-heartbeat fa-fw"></i> {{ strtoupper('Datos de Salud') }}</a></li>
                <li><a href="#3"><i class="gi gi-notes fa-fw"></i> {{ strtoupper('Historial') }}</a></li>
            </ul>
        </div>
                            
        <div class="tab-content">

            <div class="tab-pane active" id="1">
            <!-- incluye  profile table -->
                @include('historial.perfil') 
            <!-- incluye  profile table -->
            </div>

            <div class="tab-pane" id="2">
            <!-- incluye  profile table -->
                @include('historial.salud') 
            <!-- incluye  profile table -->
            </div>
                
            <div class="tab-pane" id="3">
            <!-- incluye  profile table -->
               
            <!-- incluye  profile table -->  
            </div>

        </div>
        <!-- END Default Tabs -->
    </div>
    <!-- END Example Block -->
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    
}); 
</script>
@endsection