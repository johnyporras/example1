@extends('layouts.app')
@section('title','Modulo Funerario')
@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('plugins/select2/js/es.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush
<hr/>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Listado solicitudes" class="btn btn-info"><span class="pr5"><i class="fa fa-table"></i></span> Solicitudes</a></p>
        </div>
    </div> <!-- row -->

</div> <!-- .col-12 -->

<div class="col-xs-12">
    {!! Form::open(['route'=>'funerario.prueba', 'files' => true, 'id' => 'funerarioForm', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Generar Solicitud</h3>
            </div>
        </div>
    </div> <!-- row -->
    
    <!-- Estado - Ciudad - Telefono -->
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

            </div>
        </div>

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('telefono_contacto') ? ' has-error' : '' }}">
                        {{ Form::label('telefono_contacto', 'Teléfono Contacto', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('telefono_contacto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese teléfono contacto', 'required']) }}
                        @if ($errors->has('telefono_contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono_contacto') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
    </div> <!-- row -->
    
    <!-- Medoto de pago - Plazo de pago -->
    <div class="row">

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('metodo_id') ? ' has-error' : '' }}">
                {{ Form::label('metodo_id', 'Metodo Pago', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::select('metodo_id', $metodos, null, ['class' => 'form-control', 'placeholder'=>'Seleccione metodo pago', 'id' => 'metodo', 'required']) }}
                @if ($errors->has('metodo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metodo_id') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  -->
        </div>

        <div class="col-md-6 hidden" id="cdia">
            <div class="form-group {{ $errors->has('dias') ? ' has-error' : '' }}">
                {{ Form::label('dias', 'Plazo de Pago', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::select('dias', $dias, null, ['class' => 'form-control', 'placeholder'=>'Seleccione días', 'id' => 'dia']) }}
                @if ($errors->has('dias'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dias') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  -->
        </div>
        
    </div> <!-- row -->
    
    <!-- Titulo presupuesto -->
    <div class="row">
        <div class="col-xs-12">
            <h3>Presupuesto</h3>
            <hr>
        </div>
    </div> <!-- row -->
    
    <!-- Proveedor - Fecha solicitud - Detalle - factura - numero factura -->
    <div class="row">

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('proveedor') ? ' has-error' : '' }}">
                        {{ Form::label('proveedor', 'Proveedor', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('proveedor[]', $estados, null, ['class' => 'form-control', 'placeholder'=>'Seleccione proveedor', 'required']) }}
                        @if ($errors->has('proveedor'))
                            <span class="help-block">
                                <strong>{{ $errors->first('proveedor') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fsolicitud') ? ' has-error' : '' }}">
                        {{ Form::label('fsolicitud', 'Fecha Solicitud', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fsolicitud[]', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Solicitud', 'id' => 'fechaSl', 'required']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fsolicitud'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fsolicitud') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('detalle') ? ' has-error' : '' }}">
                        {{ Form::label('detalle', 'Detalles', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::textArea('detalle[]', null, ['class' => 'form-control', 'placeholder' => 'Ingrese detalles', 'rows' => 3,'minlength' => "10" ]) }}
                        @if ($errors->has('detalle'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detalle') }}</strong>
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
                    <div class="form-group {{ $errors->has('factura') ? ' has-error' : '' }}">
                        {{ Form::label('factura', 'Nro Factura', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('factura[]', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nro factura', 'required']) }}
                        @if ($errors->has('factura'))
                            <span class="help-block">
                                <strong>{{ $errors->first('factura') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                   <div class="form-group {{ $errors->has('envoice') ? ' has-error' : '' }}">
                        {{ Form::label('envoice', 'Factura', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::file('envoice[]', ['class' => 'envoice', 'required']) }}
                        <span class="help-block">
                            <strong>Permitido: PDF, Imagen</strong>
                        </span>
                        @if ($errors->has('envoice'))
                            <span class="help-block">
                                <strong>{{ $errors->first('envoice') }}</strong>
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
        <div class="col-xs-12">
            <hr>
        </div>
    </div> <!-- row -->

<!-- ============== Template para campos dinamicos ============== -->

    <div class="row padre hide" id="template">

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('proveedores') ? ' has-error' : '' }}">
                        {{ Form::label('proveedores', 'Proveedor', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('proveedores', $estados, null, ['class' => 'form-control', 'placeholder'=>'Seleccione proveedor']) }}
                        @if ($errors->has('proveedores'))
                            <span class="help-block">
                                <strong>{{ $errors->first('proveedores') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fechasl') ? ' has-error' : '' }}">
                        {{ Form::label('fechasl', 'Fecha Solicitud', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{ Form::text('fechasl', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Solicitud']) }}
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            @if ($errors->has('fechasl'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fechasl') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('detalles') ? ' has-error' : '' }}">
                        {{ Form::label('detalles', 'Detalles', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::textArea('detalles', null, ['class' => 'form-control', 'placeholder' => 'Ingrese detalles', 'rows' => 4,'minlength' => "10" ]) }}
                        @if ($errors->has('detalles'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detalles') }}</strong>
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
                    <div class="form-group {{ $errors->has('facturas') ? ' has-error' : '' }}">
                        {{ Form::label('facturas', 'Nro Factura', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('facturas', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nro factura']) }}
                        @if ($errors->has('facturas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('facturas') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                   <div class="form-group {{ $errors->has('envoices') ? ' has-error' : '' }}">
                        {{ Form::label('envoices', 'Factura', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::file('envoices', ['class' => 'envoice']) }}
                        <span class="help-block">
                            <strong>Permitido: PDF, Imagen</strong>
                        </span>
                        @if ($errors->has('envoices'))
                            <span class="help-block">
                                <strong>{{ $errors->first('envoices') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  --> 
                </div>

            </div>
        </div>
        
    </div> <!-- row -->
<!-- ============== Template para campos dinamicos ============== -->

    <div class="row">
       <div class="col-xs-12 col-md-2 pb15">
            <button type="button" class="btn btn-info btn-sm addButton" title="Agragar otro destino"><span><i class="fa fa-plus"></i></span> Presupuesto</button>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h3>Documentos</h3>
            <hr>
        </div>
    </div> <!-- row -->

    <!-- Documentos Cedula - Acta defuncion -->
    <div class="row">

        <div class="col-md-6">
           <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                {{ Form::label('cedula', 'Cédula Fallecido', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::file('cedula', ['id' => 'cedula']) }}
                <span class="help-block">
                    <strong>Permitido: PDF, Imagen</strong>
                </span>
                @if ($errors->has('cedula'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cedula') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  --> 
        </div>

        <div class="col-md-6">
           <div class="form-group {{ $errors->has('acta') ? ' has-error' : '' }}">
                {{ Form::label('acta', 'Acta Defunción', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::file('acta', ['id'=>'acta']) }}
                <span class="help-block">
                    <strong>Permitido: PDF, Imagen, Word</strong>
                </span>
                @if ($errors->has('acta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acta') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <!-- End .form-group  --> 
        </div>

        <div class="col-xs-12">
            <hr>
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

    // Genero la validacion del formulario...
    $('#funerarioForm').parsley(parsleyOptions);

    /************************************************************************/
    //funcion para colocar valores Dinamicos
    function setPresupuesto(index) {
        
        var $template = $('#template'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('data-index', index)
                            .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="proveedores"]').attr('name', 'proveedor[]')
                                            .attr('id', 'proveedor' + index).end()
                .find('[name="fechasl"]').attr('name', 'fsolicitud[]')
                                            .attr('id', 'fechasl' + index).end()
                .find('[name="detalles"]').attr('name', 'detalle[]')
                                            .attr('id', 'detalle' + index).end()
                .find('[name="facturas"]').attr('name', 'factura[]')
                                            .attr('id', 'factura' + index).end()
                .find('[name="envoices"]').attr('name', 'envoice[]')
                                            .attr('id', 'envoice' + index).end();

        // adicionar campo proveedor requerido
        $('#proveedor'+index).parsley(parsleyOptions).addConstraint("required", "true");
        
        // adicionar campo detalles requerido
        $('#detalle'+index).parsley(parsleyOptions).addConstraint("required", "true");
        
        // adicionar campo numero factura requerido
        $("#factura"+index).parsley(parsleyOptions).addConstraint("required", "true");

        // adicionar campo documentos facturas requerido
        $("#envoice"+index).parsley(parsleyOptions).addConstraint("required", "true");

        // adicionar campo fecha solicitud requerido
        $("#fechasl"+index).parsley(parsleyOptions).addConstraint("required", "true");

        /* Para fecha de solicitud*/
        $("#fechasl"+index).datepicker({
            language: "es",
            format: 'yyyy-mm-dd',
        }).on('changeDate', function (selected) {     
            //valida el campo al cambiar
            $('#fechasl'+index).parsley(parsleyOptions).validate();
        });
   
    }

    /*************************************************************************/

    // Add button click handler
    $('#funerarioForm').on('click', '.addButton', function() {
        setPresupuesto(contador++);
    });

    // Remove button click handler
    $('#funerarioForm').on('click', '.removeButton', function() {

        var $row  = $(this).parents('.padre'),
            index = $row.attr('data-index');

            // Remove element containing the fields
            $row.remove();
    });

    /*************************************************************************/

    /* Para fecha de solicitud*/
    $("#fechaSl").datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fechaSl').parsley(parsleyOptions).validate();
    });

    /*Para subir Cedula*/
    $('#cedula').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
    });

    /*Para subir acta defuncion*/
    $('#acta').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf','doc','docx'],
    });

    /*Para subir factura*/
    $('.envoice').fileinput({
        language: 'es',
        showUpload: false,
        removeClass: 'btn btn-danger',
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
    });

    //Valida cambio del metodo de pago
    $("#metodo").on('change', function() {
        // valido metodo para mostrar dias
        dia = this.value;

        if(dia == 2){
            $("#cdia").removeClass("hidden");
            $("#dia").parsley(parsleyOptions).addConstraint("required", "true");
            $("#dia").attr("required");
        }else{
            $("#cdia").addClass("hidden");
            $("#dia").parsley(parsleyOptions).removeConstraint("required");
            $("#dia").val(null);
        }
    });

});    
</script>
@endsection