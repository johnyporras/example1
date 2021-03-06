@extends('layouts.app')
@section('title','Consulta Usuario')

@push('styles')
<link rel="stylesheet" href="{{ url('plugins/x-editable/css/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
<script src="{{ url('plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ url('plugins/x-editable/js/config-editable.js') }}"></script>
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
                <li><a href="#3"><i class="gi gi-qrcode fa-fw"></i> {{ strtoupper('Datos de Emergencia') }}</a></li>
                <li><a href="#4"><i class="gi gi-keys fa-fw"></i> {{ strtoupper('Datos de Seguridad') }}</a></li>
            </ul>
        </div>
                            
        <div class="tab-content">

            <div class="tab-pane active" id="1">
            <!-- incluye  profile table -->
                @include('profile.perfil')
            <!-- incluye  profile table -->
            </div>

            <div class="tab-pane" id="2">
            <!-- incluye  profile table -->
                @include('profile.salud')
            <!-- incluye  profile table -->
            </div>
                
            <div class="tab-pane" id="3">
            <!-- incluye  profile table -->
                @include('profile.codigo')
            <!-- incluye  profile table -->  
            </div>

            <div class="tab-pane" id="4">
            <!-- incluye  profile table -->
                @include('profile.seguridad')
            <!-- incluye  profile table -->  
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
    // Validar formulario
    var parsleyOptions = {
        errorClass: 'has-error',
        successClass: 'has-success',
        classHandler: function(el) {
            return el.$element.parents('.form-group');
        },
        errorsContainer: function(el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<span class="help-block">',
        errorTemplate: '<div class=" col-md-offset-3 col-md-9"></div>',
    };

    // Validar formulario
    var parsleyOptions1 = {
        errorClass: 'has-error',
        successClass: 'has-success',
        classHandler: function(el) {
            return el.$element.parents('.form-group');
        },
        errorsContainer: function(el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<span class="help-block">',
        errorTemplate: '<div></div>',
    };

    //Inicializo tabla responsive
    $('.card').cardtable();
    // Genero la validacion del formulario...
    $('.motivoForm').parsley(parsleyOptions);
    // Modal medicamento
    $('#medicamentoForm').parsley(parsleyOptions1);

    /*Para subir files*/
    $('#file').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png'],
    });

    /*Para subir files*/
    $('#files').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png'],
    });

    /*Para subir files*/
    $('#filed').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png'],
    });

    // Para fecha vacuna
    $('#fechaV').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaV').parsley(parsleyOptions).validate();
    });

    // Para fecha alergia
    $('#fechaA').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaA').parsley(parsleyOptions).validate();
    });

    // Para fecha alergia
    $('#fechaH').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaH').parsley(parsleyOptions).validate();
    });

    // Para fecha Enfermedad
    $('#fechaE').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaE').parsley(parsleyOptions).validate();
    });

    // Para fecha operación
    $('#fechaO').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaO').parsley(parsleyOptions).validate();
    });

    // Sweet alert
    $('.sweet-danger').on( 'click', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({   
            title: "Advertencia",
            text: "¿Esta seguro de continuar?",         
            type: "warning",   
            showCancelButton: true,   
            confirmButtonClass: "btn-danger btn-sm",
            confirmButtonText: "Eliminar",
            cancelButtonClass: "btn-alt btn-default btn-sm",
            cancelButtonText: "Cancelar", 
            closeOnConfirm: false 
            }, 
        function(){  
            window.location = link
        });
    });

    // Para seleccionar editable en la tabla
    $('.tEdit tbody').on('click', '.b-edit', function (e) {
        e.preventDefault();
        e.stopPropagation();
       $(this).closest('tr').find('.editable').editable('show');  
    });
});
</script>
@stack('sub-script')
@endsection