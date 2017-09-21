@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

@endpush

@push('scripts')
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
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
        <li>Editar</li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/historial/lista') }}" title="Listado Solicitudes" class="btn btn-success"><span class="pr5"><i class="fa fa-table"></i></span> Listado</a></p>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h2 class="pt10 pb25 m0">Actualizar Historial: </h2>
        </div>
    </div> <!-- row -->

</div> <!-- .col-12 -->


<div class="col-xs-12">

    {{ Form::model($historial, ['route'=> ['historial.update', $historial->id], 'method' =>'PUT', 'files' => true, 'id' => 'historialForm', 'class' => 'form-horizontal', 'role' => 'form']) }}
 
    <!-- incluye formulario -->
    @include('historial.form') 
    <!-- incluye  formulario -->

    <div class="row">
       <div class="col-xs-12 col-md-2">
            <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-original-title="Actualizar Historial"><i class="fa fa-edit fa-fw"></i> Actualizar</button>
        </div>
    
    </div> <!-- row -->
    
 {!! Form::close() !!}   

</div> <!-- .col-12 -->

@endsection

@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
<script>
$(document).ready(function() {
    /** Validar formulario **/
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

    // Genero la validacion del formulario...
    $('#historialForm').parsley(parsleyOptions);

});    
</script>
@endsection