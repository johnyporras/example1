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
            <h2 class="pt10 pb10 m0">Solicitud: {{ $solicitud->codigo_solicitud }}</h2>
        </div>
    </div> <!-- row -->

    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-warning">
               <!-- Default panel contents -->
               <div class="panel-heading">
                     <span class="pr-1"><i class="fa fa-plane"></i></span> Datos Solicitud
               </div>
                 <!-- List group -->
               <ul class="list-group">
                     <li class="list-group-item"><span class="text-warning"><b>Nro Cronograma:</b></span> {{ $solicitud->nro_cronograma }}</li>
                     <li class="list-group-item"><span class="text-warning"><b>Contrato:</b></span> {{ $solicitud->codigo_contrato }} </li>
                     <li class="list-group-item"><span class="text-warning"><b>Monto Cobertura:</b></span> {{ $solicitud->cobertura_monto }}</li>
                     <li class="list-group-item"><span class="text-warning"><b>Observaciones:</b></span> {{ $solicitud->observaciones }}</li>
               </ul>
            </div>
      </div>

      <div class="col-md-4">
         
            <div class="panel panel-success">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-user"></i></span> Afiliado
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-success"><b>Cédula:</b></span> {{ $solicitud->afiliado->cedula }}</li>
                    <li class="list-group-item"><span class="text-success"><b>Nombre:</b></span> {{ $solicitud->afiliado->nombre }} {{ $solicitud->afiliado->apellido }} </li>
                    <li class="list-group-item"><span class="text-success"><b>Edad:</b></span> {{ $solicitud->afiliado->fecha_nacimiento->age }}</li>
                    <li class="list-group-item"><span class="text-success"><b>Sexo:</b></span> {{ ($solicitud->afiliado->sexo == 'M')?'Masculino':'Femenino' }}</li>
                </ul>
            </div>
           
        </div>

      <div class="col-md-4">
            @if (isset($cuenta))
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <span class="pr-1"><i class="fa fa-book"></i></span> Servicio
                </div>
                 <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><span class="text-primary"><b>Codigo Cuenta:</b></span> {{ $cuenta->codigo_cuenta }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Estatus:</b></span> {{ $cuenta->status->descripcion }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Plan:</b></span> {{ $plan->nombre }}</li>
                    <li class="list-group-item"><span class="text-primary"><b>Cobertura del Plan:</b></span> {{ $plan->cobertura }}</li>
                </ul>
            </div>
            @endif
        </div>

      <div class="clearfix"></div>
    </div> <!-- .row -->

</div> <!-- .col-12 -->


<div class="col-xs-12">
    {!! Form::open(['route'=>['historial.update', $solicitud->id], 'id' => 'destinoForm', 'class' => 'form-horizontal', 'name' => 'destinos']) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Intinerario de viajes</h3>
            </div>
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
                        {{ Form::text('cronograma', $solicitud->nro_cronograma, ['class' => 'form-control', 'placeholder' => 'Ingrese número de cronograma', 'required']) }}
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
                        {{ Form::textArea('observaciones', $solicitud->observaciones, ['class' => 'form-control', 'placeholder' => 'Ingrese sus observaciones', 'rows' => 4,'minlength' => "10" ]) }}
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

    </div> <!-- row -->
    
    <div class="row">
       <div class="col-xs-12 col-md-2">
            <p>
                {!! Form::submit('Editar', ['class' => 'btn btn-warning btn-block', 'id' => 'editar']) !!}
            </p>
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
    $('#destinoForm').parsley(parsleyOptions);

    /****** Bucle total de destinos cargados ******/
    // variables para configurar funcion
    var fecha1 = new Array(),
        fecha2 = new Array(),
        destino = new Array(),
        limit = {{ count($solicitud->destinos) }},
        contador = 1;

    // Lleno el array con los datos que vienen de BD...
    @foreach ($solicitud->destinos as $destino)
        fecha1.push("{{ $destino->fecha_desde->format('Y-m-d') }}");
        fecha2.push("{{ $destino->fecha_hasta->format('Y-m-d') }}");
        destino.push({{ $destino->pais_id }}); 
    @endforeach

    // Realizo el bucle con jquery para cargar los campos defaults
    for (var i = 0; i < limit; i++) {
        //Ejecuto la funcion para generar los campos
        setDestino(contador,fecha1[i],fecha2[i],destino[i]);
        contador++;
    }
    /****** Bucle total de destinos generados ******/
 
    /*funcion para colocar valores Dinamicos*/
    function setDestino(index,fecha1 = null, fecha2 = null, destino = null) {
        
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

            $('#iniDate'+index).val(fecha1).trigger("change");

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

            $('#finDate'+index).val(fecha2).trigger("change");

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

            // Valido que le pase parametro para cargarlo automaticamente
            if (destino != null) {
                $("#destino"+index).val(destino).trigger("change");
            } 
    }

    /*************************************************************************/
    // Add button click handler
    $('#destinoForm').on('click', '.addButton', function() {
        setDestino(contador++);
    });

    // Remove button click handler
    $('#destinoForm').on('click', '.removeButton', function() {

        var $row  = $(this).parents('.padre'),
            index = $row.attr('data-index');

            // Remove element containing the fields
            $row.remove();
            alert(count);
    });
    /*************************************************************************/

    /**** Funcion recupera diferencias de dias ***/
    function diffDates(dateIni,dateEnd){
        var start = new Date(dateIni);
        var end = new Date(dateEnd);
        var diff = parseInt((end.getTime()-start.getTime())/(24*3600*1000));
        // retorna los dias de diferencia
        return diff;
    };

});    
</script>
@endsection