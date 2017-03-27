@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')
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
    <script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
@endpush
<hr/>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Buscar otro beneficiario" class="btn btn-info"><span class="pr5"><i class="fa fa-search"></i></span> Listado</a></p>
        </div>
    </div> <!-- row -->

</div> <!-- .col-12 -->


<div class="col-xs-12">
    {!! Form::open(['route'=>'funerario.lista', 'id' => 'funerarioForm', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Generar Solicitud</h3>
            </div>
        </div>
    </div> <!-- row -->
    
    <div class="row">

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('estado_id') ? ' has-error' : '' }}">
                        {{ Form::label('estado_id', 'Estado', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('estado_id', $estados, null, ['class' => 'form-control', 'placeholder'=>'Seleccione Estado', 'required']) }}
                        @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('ciudad') ? ' has-error' : '' }}">
                        {{ Form::label('ciudad', 'Ciudad', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('ciudad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Ciudad', 'required']) }}
                        @if ($errors->has('ciudad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ciudad') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha_solicitud') ? ' has-error' : '' }}">
                        {{ Form::label('fecha_solicitud', 'Fecha Solicitud', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fecha_solicitud', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Solicitud', 'id' => 'fechaSl']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fecha_solicitud'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_solicitud') }}</strong>
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
                    <div class="form-group {{ $errors->has('nombre_fallecido') ? ' has-error' : '' }}">
                        {{ Form::label('nombre_fallecido', 'Nombre Fallecido ', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('nombre_fallecido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre fallecido', 'required']) }}
                        @if ($errors->has('nombre_fallecido'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre_fallecido') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('cedula_fallecido') ? ' has-error' : '' }}">
                        {{ Form::label('cedula_fallecido', 'Cédula Fallecido', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('cedula_fallecido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cédula fallecido', 'required']) }}
                        @if ($errors->has('cedula_fallecido'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cedula_fallecido') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('telefono_titular') ? ' has-error' : '' }}">
                        {{ Form::label('telefono_titular', 'Teléfono Titular', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('telefono_titular', null, ['class' => 'form-control', 'placeholder' => 'Ingrese teléfono titular', 'required']) }}
                        @if ($errors->has('telefono_titular'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono_titular') }}</strong>
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
        
        <div class="col-xs-12">
            <hr>
        </div>

    </div> <!-- row -->
<!-- ============== Template para campos dinamicos ============== -->

    <div class="row">
       <div class="col-xs-12 col-md-2 pb15">
            <button type="button" class="btn btn-info btn-sm addButton" title="Agragar otro destino"><span><i class="fa fa-plus"></i></span> Presupuesto</button>
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

    var index = 0;

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
        $("#fechaSl").datepicker({
            language: "es",
            format: 'yyyy-mm-dd',
        });

});    
</script>
@endsection