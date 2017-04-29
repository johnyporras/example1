@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')

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
            <h1><i class="gi gi-brush"></i>Page Title<br><small>Subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Category</li>
        <li><a href="">Page</a></li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/avi') }}" title="Buscar otro beneficiario" class="btn btn-info"><span class="pr5"><i class="fa fa-search"></i></span> Beneficiario</a></p>
        </div>
    </div> <!-- row -->

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


<div class="col-xs-12">
    {!! Form::open(['route'=>'avi.procesar', 'id' => 'destinoForm', 'class' => 'form-horizontal', 'name' => 'afiliado']) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Intinerario de viajes</h3>
            </div>
        </div>
    </div> <!-- row -->
    
    <div class="row">
        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('desde') ? ' has-error' : '' }}">
                        {{ Form::label('desde', 'Fecha Salida', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('desde[]', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Salida', 'id' => 'iniDate', 'required']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('desde'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('desde') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('hasta') ? ' has-error' : '' }}">
                        {{ Form::label('hasta', 'Fecha Retono', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('hasta[]', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Retorno', 'id' => 'finDate', 'required']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('hasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hasta') }}</strong>
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
                    <div class="form-group {{ $errors->has('destino') ? ' has-error' : '' }}">
                        {{ Form::label('destino', 'Destino', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('destino[]', $paises, null, ['class' => 'form-control', 'id' => 'destino', 'placeholder'=>'Seleccione Pais Destino', 'required']) }}
                        @if ($errors->has('destino'))
                            <span class="help-block">
                                <strong>{{ $errors->first('destino') }}</strong>
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
        <div class="col-xs-12">
            <hr>
        </div>
    </div> <!-- row -->

<!-- ============== Template para campos dinamicos ============== -->
    <div class="row padre hide" id="template">
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_desde') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_desde', 'Fecha Salida', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fecha_desde', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Salida']) }}
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
                                {{ Form::text('fecha_hasta', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Retorno']) }}
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
                        {{ Form::select('pais_destino', $paises, null, ['class' => 'form-control', 'placeholder'=>'Seleccione Pais Destino']) }}
                        @if ($errors->has('pais_destino'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pais_destino') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4><span id="dia" class="label label-info"></span></h4>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-sm btn-danger removeButton pull-right" title="Quitar destino"><span><i class="fa fa-close"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <hr>
        </div>

    </div> <!-- row -->
<!-- ============== Template para campos dinamicos ============== -->

    <div class="row">
       <div class="col-xs-12 col-md-2 pb15">
            <button type="button" class="btn btn-info btn-sm addButton" title="Agragar otro destino"><span><i class="fa fa-plus"></i></span> Destino</button>
        </div>
    </div> <!-- row -->

    <div class="row">

        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('cronograma') ? ' has-error' : '' }}">
                        {{ Form::label('cronograma', 'Número de cronograma ', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('cronograma', null, ['class' => 'form-control', 'placeholder' => 'Ingrese número de cronograma', 'required']) }}
                        @if ($errors->has('cronograma'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cronograma') }}</strong>
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
                        {{ Form::label('observaciones', 'Observaciones', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::textArea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus observaciones', 'rows' => 4,'minlength' => "10" ]) }}
                        @if ($errors->has('observaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->

                    <!-- Campos ocultos necesarios para cargar la solicitud -->
                    {{ Form::hidden('cedula', $afiliado->cedula) }}
                    {{ Form::hidden('edad', $afiliado->fecha_nacimiento->age) }}
                    {{ Form::hidden('contrato', $servicio['contrato']) }}
                </div>
            </div>
        </div>

    </div> <!-- row -->
    
    <div class="row">
       <div class="col-xs-12 col-md-2">
            <p>
                {!! Form::submit('Generar', ['class' => 'btn btn-primary btn-block', 'id' => 'generar']) !!}
            </p>
        </div>
    
    </div> <!-- row -->
 {!! Form::close() !!}   

</div> <!-- .col-12 -->

@endsection

@section('script')
<script>

$(document).ready(function() {

    // Contador
    var contador = 1;

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
    $('#destinoForm').parsley(parsleyOptions);

    /************************************************************************/
    //funcion para colocar valores Dinamicos
    function setIntinerario(index) {

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
                .find('[name="fecha_hasta"]').attr('name', 'hasta[]')
                                            .attr('id', 'finDate' + index).end()
                .find('[name="pais_destino"]').attr('name', 'destino[]')
                                            .attr('id', 'destino' + index).end()
                .find('#dia').attr('id', 'dias' + index ).end();

            // adicionar campo requerido
            $('#iniDate'+index).parsley(parsleyOptions).addConstraint("required", "true");

            // adicionar campo datepicker fecha Salida...
            $('#iniDate'+index).datepicker({
                language: "es",
                startDate: '0',
                format: 'yyyy-mm-dd',
            }).on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                $('#finDate'+index).datepicker('setStartDate', startDate);

                /* Diferencias de dias*/
                var diff = diffDates($("#iniDate"+index).val(), $("#finDate"+index).val());

                if (diff > 0)
                {
                  $("#dias"+index).text(diff + ' días');
                } 

                //valida el campo al cambiar
                $('#iniDate'+index).parsley(parsleyOptions).validate();

            }).on('clearDate', function (selected) {
                $('#finDate'+index).datepicker('setStartDate', null);
            });

            // adicionar campo requerido
            $("#finDate"+index).parsley(parsleyOptions).addConstraint("required", "true");

            // adicionar campo datepicker fecha Retorno...
            $("#finDate"+index).datepicker({
                language: "es",
                startDate: '0',
                format: 'yyyy-mm-dd',
            }).on('changeDate', function (selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#iniDate'+index).datepicker('setEndDate', endDate);

                /* Diferencias de dias*/
                var diff = diffDates($("#iniDate"+index).val(), $("#finDate"+index).val());

                if (diff > 0)
                {
                  $('#dias'+index).text(diff + ' días');
                }

                //valida el campo al cambiar
                $('#finDate'+index).parsley(parsleyOptions).validate();

            }).on('clearDate', function (selected) {
                $('#iniDate'+index).datepicker('setEndDate', null);
            });

            // adicionar campo requerido
            $("#destino"+index).parsley(parsleyOptions).addConstraint("required", "true");

            /*Para selet2*/
            $("#destino"+index).select2({
                language: "es",
                placeholder: "Seleccione pais destino",
                theme: "bootstrap",
            }).on("change", function (e) { 
                // Valida campo al cambiar valor
                $("#destino"+index).parsley(parsleyOptions).validate();
            });

    }

    /*************************************************************************/

    // Add button click handler
    $('#destinoForm').on('click', '.addButton', function() {
        setIntinerario(contador++);
    });

    // Remove button click handler
    $('#destinoForm').on('click', '.removeButton', function() {

        var $row  = $(this).parents('.padre'),
            index = $row.attr('data-index');
            // Remove element containing the fields
            $row.remove();
    });

    /*************************************************************************/

        /* Para fecha de salida y retorno*/
        $("#iniDate").datepicker({
            language: "es",
            startDate: '0',
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#finDate').datepicker('setStartDate', startDate);

            /* Diferencias de dias*/
            var diff = diffDates($("#iniDate").val(), $("#finDate").val());

            if(diff > 0)
            {
              $("#dias").text(diff + ' días');
            }

            // Valida campo al cambiar valor
            $("#iniDate").parsley(parsleyOptions).validate();

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

            /* Diferencias de dias*/
            var diff = diffDates($("#iniDate").val(), $("#finDate").val());

            if (diff > 0)
            {
              $("#dias").text(diff + ' días');
            }

            // Valida campo al cambiar valor
            $("#finDate").parsley(parsleyOptions).validate();

        }).on('clearDate', function (selected) {
            $('#iniDate').datepicker('setEndDate', null);
        });

        /*Para Destino select2*/
        $("#destino").select2({
            language: "es",
            placeholder: "Seleccione pais destino",
            theme: "bootstrap",
        }).on("change", function (e) { 
            // Valida campo al cambiar valor
            $("#destino").parsley(parsleyOptions).validate();
        });

        /**** Funcion recupera diferencias de dias ***/
        function diffDates(dateIni,dateEnd){
            var start = new Date(dateIni);
            var end = new Date(dateEnd);
            var diff = parseInt((end.getTime()-start.getTime())/(24*3600*1000));

            return diff;
        };

});    
</script>
@endsection