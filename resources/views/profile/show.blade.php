@extends('layouts.app')
@section('title','Consulta Usuario')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/x-editable/css/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('plugins/x-editable/js/config-editable.js') }}"></script>
<script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script> 
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ url('plugins/select2/js/es.js') }}"></script>
<script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-user"></i> Perfil <br> <small>Detalle de Perfil</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Perfil</li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">
    <!-- Example Block -->
    <div class="block full">

        <div class="block-title">
            <!-- Default Tabs -->
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li><a href="#1"><i class="gi gi-user fa-fw"></i> {{ strtoupper('Datos Personales') }}</a></li>
                <li><a href="#2"><i class="fa fa-heartbeat fa-fw"></i> {{ strtoupper('Datos de Salud') }}</a></li>
                <li><a href="#3"><i class="gi gi-qrcode fa-fw"></i> {{ strtoupper('Datos de Emergencia') }}</a></li>
            </ul>
        </div>
                            
        <div class="tab-content">
            <div class="tab-pane active" id="1">
               <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <td class="text-right"><span class="pr10">{{ strtoupper('Nombre') }}</span></td>
                            <td><span class="pl10">german </span></td>
                            <td><a href="#" class="btn btn-sm btn-warning pull-right">H</a> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="2">
                     fhfggfhgfhgfhgf hhdfhg                       
            </div>

            <div class="tab-pane" id="3">
                
            </div>
            
        </div>
        <!-- END Default Tabs -->
    </div>
    <!-- END Example Block -->
</div>

@endsection

@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
<script>
$(document).ready(function() {

    //Inicializo tabla responsive
    $('.card').stackcolumns();


});
</script>
@endsection