@extends('layouts.app')
@section('title','Sistema Avi')
@section('content')

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
@endpush
<hr/>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/avi') }}" title="Buscar otro beneficiario" class="btn btn-info"><span class="pr5"><i class="fa fa-search"></i></span> Beneficiario</a></p>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-lg-5">
            @if (isset($servicio))
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-plane"></i></span> Servicio
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-primary"><b>Cédula:</b></span> {{ $servicio['cedula_afiliado'] }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Nombre:</b></span> {{ $servicio['nombre_afiliado'] }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Tipo:</b></span> {{ $servicio['tipo_afiliado'] }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Cobertura del Plan:</b></span> {{ $servicio['plan'] }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Colectivo:</b></span> {{ $servicio['colectivo'] }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Aseguradora:</b></span> {{ $servicio['aseguradora'] }}</li>
                </ul>
            </div>
            @endif 
        </div>

        <div class="col-md-6 col-lg-5 col-lg-offset-2">
            @if (isset($afiliado))
            <div class="panel panel-warning">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-user"></i></span> Afiliado
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-warning"><b>Cédula:</b></span> {{ $afiliado->cedula }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Nombre:</b></span> {{ $afiliado->nombre }} {{ $afiliado->apellido }} </li>
                    <li class="list-group-item"><span class="text-warning"><b>Edad:</b></span> {{ $afiliado->fecha_nacimiento->age }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Sexo:</b></span> {{ ($afiliado->sexo == 'M')?'Masculino':'Femenino' }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Correo:</b></span> {{ $afiliado->email }}</li>
                    <li class="list-group-item"><span class="text-warning"><b>Teléfono:</b></span> {{ $afiliado->telefono }}</li>
                </ul>
            </div>
            @endif
        </div>

    </div> <!-- .row -->
</div> <!-- .col-12 -->

{!! Form::open(['route'=>'avi.procesar', 'id' => 'destinoForm', 'class' => 'form-horizontal', 'name' => 'afiliado']) !!}
<div class="col-xs-12">
    
    <div class="pb25">
        <h3>Intinerario de viajes</h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">


                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_desde') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_desde', 'Fecha Salida', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('desde[]', null , ['class' => 'form-control required', 'placeholder' => 'Ingrese Fecha Salida', 'id' => 'iniDate']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha_desde'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_desde') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_hasta') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_hasta', 'Fecha Retono', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('hasta[]', null , ['class' => 'form-control required', 'placeholder' => 'Ingrese Fecha Retorno', 'id' => 'finDate']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha_hasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_hasta') }}</strong>
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
                    <div class="form-group {{ $errors->has('pais_destino') ? ' has-error' : '' }}">
                        {{ Form::label('pais_destino', 'Destino', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('destino[]', $paises, null, ['class' => 'form-control select2', 'id' => 'destino', 'placeholder'=>'Seleccione Pais Destino']) }}
                        @if ($errors->has('pais_destino'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pais_destino') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
            </div>
        </div>
        <div class="col-xs-12 pb10">
            <hr>
        </div>

    </div> <!-- row -->

    <div class="row hide" id="template">
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_desde') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_desde', 'Fecha Salida', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fecha_desde', null , ['class' => 'form-control required', 'placeholder' => 'Ingrese Fecha Salida']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha_desde'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_desde') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_hasta') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_hasta', 'Fecha Retono', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fecha_hasta', null , ['class' => 'form-control required', 'placeholder' => 'Ingrese Fecha Retorno']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha_hasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_hasta') }}</strong>
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
                    <div class="form-group {{ $errors->has('pais_destino') ? ' has-error' : '' }}">
                        {{ Form::label('pais_destino', 'Destino', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('pais_destino', $paises, null, ['class' => 'form-control select2', 'placeholder'=>'Seleccione Pais Destino']) }}
                        @if ($errors->has('pais_destino'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pais_destino') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
            </div>
        </div>
        <div class="col-xs-12 pb10">
            <hr>
        </div>

    </div> <!-- row -->
    
    <div class="row">
       <div class="col-sm-2 pt10 pb15">
            <button type="button" class="btn btn-info addButton" title="Agragar otro destino"><span><i class="fa fa-plus"></i></span> Destino</button>
        </div>
    </div>

    <hr>
    <div class="row">
       <div class="col-sm-2">
            {!! Form::submit('Generar', ['class' => 'btn btn-primary btn-block', 'id' => 'generar']) !!}
        </div>
    </div>
    
</div> <!-- .col-12 -->
{!! Form::close() !!}
@endsection

@section('script')
<script>

$(document).ready(function() {

    var index = 0;

    // Add button click handler
        $('#destinoForm').on('click', '.addButton', function() {
            index++;
            var $template = $('#template'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-index', index)
                                .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="fecha_desde"]').attr('name', 'desde[]')
                                             .attr('id', 'iniDate' + index).end()

                .find('[name="fecha_hasta"]').attr('name', 'hasta[]' + index)
                                             .attr('id', 'finDate' + index ).end()

                .find('[name="pais_destino"]').attr('name', 'destino[]' + index )
                                             .attr('id', 'destino' + index ).end();

            /* Para fecha de salida y retorno*/
            $('#iniDate'+index).datepicker({
                language: "es",
                startDate: '0',
                format: 'yyyy-mm-dd',
            }).on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                $('#finDate'+index).datepicker('setStartDate', startDate);
            }).on('clearDate', function (selected) {
                $('#finDate'+index).datepicker('setStartDate', null);
            });

            $("#finDate"+index).datepicker({
                language: "es",
                startDate: '0',
                format: 'yyyy-mm-dd',
            }).on('changeDate', function (selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#iniDate'+index).datepicker('setEndDate', endDate);
            }).on('clearDate', function (selected) {
                $('#iniDate'+index).datepicker('setEndDate', null);
            });

            /*Para selet2*/
            $("#destino"+index).select2({
                language: "es",
                placeholder: "Seleccione pais destino",
                theme: "bootstrap",
            });
                    
            console.log('muestra este mensaje:'+ index);
            
        });

        /* Para fecha de salida y retorno*/
        $("#iniDate").datepicker({
            language: "es",
            startDate: '0',
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#finDate').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('#finDate').datepicker('setStartDate', null);
        });

        $("#finDate").datepicker({
            language: "es",
            startDate: '0',
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $('#iniDate').datepicker('setEndDate', endDate);
        }).on('clearDate', function (selected) {
            $('#iniDate').datepicker('setEndDate', null);
        });

        /*Para Destino select2*/
        $("#destino").select2({
            language: "es",
            placeholder: "Seleccione pais destino",
            theme: "bootstrap",
        });


});    
</script>
@endsection