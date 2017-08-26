@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/select2/js/es.js') }}"></script>
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
        <li>Generar Solicitud</li>
    </ul>
@endsection

@section('content')


<div class="col-xs-12">
    {!! Form::open(['route'=>'historial.store', 'id' => 'destinoForm', 'class' => 'form-horizontal', 'name' => 'afiliado']) !!}
    
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Historial Médico</h3>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                        {{ Form::label('fecha', 'Fecha Atención', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            <div class="input-group">
                                {{ Form::text('fecha[]', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Atención', 'id' => 'date', 'required']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('motivo') ? ' has-error' : '' }}">
                        {{ Form::label('motivo', 'Motivo Atención', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('motivo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Motivo Atención', 'required']) }}
                            
                            @if ($errors->has('motivo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('motivo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('especialidad') ? ' has-error' : '' }}">
                        {{ Form::label('especialidad', 'Especialidad', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('especialidad', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Especialidad', 'required']) }}
                            
                            @if ($errors->has('especialidad'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('especialidad') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('tratamiento') ? ' has-error' : '' }}">
                        {{ Form::label('tratamiento', 'Tratamiento', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('tratamiento', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Tratamiento', 'required']) }}
                            
                            @if ($errors->has('tratamiento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tratamiento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
                        {{ Form::label('procedimiento', 'Procedimiento o Examen', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('procedimiento', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Procedimiento o Examen', 'id' => 'finDate', 'required']) }}
                        
                        @if ($errors->has('procedimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('procedimiento') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h4><span id="dias" class="label label-info"></span></h4>
        </div>

    </div> <!-- row -->

    <div class="row">
        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('recomendaciones') ? ' has-error' : '' }}">
                        {{ Form::label('recomendaciones', 'Recomendaciones', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::textArea('recomendaciones', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus recomendaciones', 'rows' => 4,'minlength' => "10" ]) }}
                        
                        @if ($errors->has('recomendaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('recomendaciones') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
                        {{ Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::textArea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus observaciones', 'rows' => 4,'minlength' => "10" ]) }}
                        
                        @if ($errors->has('observaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h4><span id="dias" class="label label-info"></span></h4>
        </div>

    </div> <!-- row -->
    
    <div class="row">
       <div class="col-xs-12 col-md-2">
            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Generar Historial"><i class="fa fa-save fa-fw"></i> Generar</button>
        </div>
    </div> <!-- row -->
 {!! Form::close() !!}   

</div> <!-- .col-12 -->

@endsection

@section('script')
<script>

$(document).ready(function() {


});    
</script>
@endsection