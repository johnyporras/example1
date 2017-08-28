@extends('layouts.app')
@section('title','Modulo Funerario')

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

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="glyphicon glyphicon-king"></i> Modulo Funerario <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/funerario/lista') }}">Modulo Funerario</a></li>
        <li>Generar</li>
    </ul>
@endsection

@section('content')

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario/lista') }}" title="Listado solicitudes" class="btn btn-info btn-sm"><span class="pr5"><i class="fa fa-table"></i></span> Solicitudes</a></p>
        </div>
    </div> <!-- row -->
</div> <!-- .col-12 -->

<div class="col-xs-12">
    <div class="row">
        <div class="col-md-6 col-lg-5">
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
                </ul>
            </div>
            @endif 
        </div>

        <div class="col-md-6 col-lg-5 col-lg-offset-2">
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
    </div> <!-- .row -->
</div>

<div class="col-xs-12">
    {{ Form::open(['route'=>'funerario.store', 'files' => true, 'id' => 'funerarioForm', 'class' => 'form-horizontal']) }}
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
                        {!! Form::select('estado_id', $estados, null, ['class' => 'form-control', 'placeholder'=>'Seleccione Estado', 'required']) !!}
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
                    <div class="form-group {{ $errors->has('contacto') ? ' has-error' : '' }}">
                        {{ Form::label('contacto', 'Teléfono Contacto', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('contacto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese teléfono contacto', 'pattern' => '^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$', 'minlength' => "11", 'maxlength' => '11', 'required']) }}
                        <span class="help-block">
                            <strong>Ejemplo: 02121231122</strong>
                        </span>
                        @if ($errors->has('contacto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contacto') }}</strong>
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
            <div class="form-group {{ $errors->has('plazo') ? ' has-error' : '' }}">
                {{ Form::label('plazo', 'Plazo de Pago', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9">
                {{ Form::select('plazo', $dias, null, ['class' => 'form-control', 'placeholder'=>'Seleccione plazo', 'id' => 'dia']) }}
                @if ($errors->has('plazo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('plazo') }}</strong>
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
    
    <!-- Proveedor - Fecha solicitud - Monto Detalle - factura - numero factura -->
    <div class="row">

        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('proveedor') ? ' has-error' : '' }}">
                        {{ Form::label('proveedor', 'Proveedor', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::select('proveedor[]', $proveedores, null, ['class' => 'form-control', 'placeholder'=>'Seleccione proveedor', 'required']) }}
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
                    <div class="form-group {{ $errors->has('monto') ? ' has-error' : '' }}">
                        {{ Form::label('monto', 'Monto', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('monto[]', null, ['class' => 'form-control', 'placeholder' => 'Ingrese monto factura', 'pattern' => '[1-9][0-9]{1,10}', 'maxlength' => '10', 'required']) }}
                        @if ($errors->has('monto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('monto') }}</strong>
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
                        {{ Form::file('envoice[]', ['id' => 'envoice', 'required']) }}
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
                        {{ Form::select('proveedores', $proveedores, null, ['class' => 'form-control', 'placeholder'=>'Seleccione proveedor']) }}
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
                    <div class="form-group {{ $errors->has('montos') ? ' has-error' : '' }}">
                        {{ Form::label('montos', 'Monto', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                        {{ Form::text('montos', null, ['class' => 'form-control', 'pattern' => '[1-9][0-9]{1,10}', 'maxlength' => '10', 'placeholder' => 'Ingrese monto factura']) }}
                        @if ($errors->has('montos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('montos') }}</strong>
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
                        {{ Form::file('envoices') }}
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

                <div class="col-xs-12">
                    <button type="button" class="btn btn-sm btn-danger removeButton pull-right" title="Quitar Presupuesto"><span><i class="fa fa-close"></i></span></button>
                </div>

            </div>
        </div>
        
    </div> <!-- row -->
<!-- ============== Template para campos dinamicos ============== -->

    <div class="row">
       <div class="col-xs-12 col-md-2 pb15">
            <button type="button" class="btn btn-info btn-sm addButton" title="Agregar otro presupuesto"><span><i class="fa fa-plus"></i></span> Presupuesto</button>
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
                    <strong>Permitido: PDF, Imagen</strong>
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
            <!-- Campos ocultos necesarios para cargar la solicitud -->
            {{ Form::hidden('afiliado_id', $id) }}
            <hr>
        </div>

    </div> <!-- row -->

    <div class="row">
       <div class="col-xs-12 col-md-2">
            <p>
                {{ Form::submit('Generar', ['class' => 'btn btn-primary btn-block', 'id' => 'generar']) }}
            </p>
        </div>
    
    </div> <!-- row -->
 {{ Form::close() }}   

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
                .find('[name="montos"]').attr('name', 'monto[]')
                                            .attr('id', 'monto' + index).end()
                .find('[name="detalles"]').attr('name', 'detalle[]')
                                            .attr('id', 'detalle' + index).end()
                .find('[name="facturas"]').attr('name', 'factura[]')
                                            .attr('id', 'factura' + index).end()
                .find('[name="envoices"]').attr('name', 'envoice[]')
                                            .attr('id', 'envoice' + index).end();

        // adicionar campo proveedor requerido
        $('#proveedor'+index).parsley(parsleyOptions).addConstraint("required", "true");
        
        // adicionar campo monto requerido
        $('#monto'+index).parsley(parsleyOptions).addConstraint("required", "true");
        
        // adicionar campo numero factura requerido
        $("#factura"+index).parsley(parsleyOptions).addConstraint("required", "true");

        // adicionar campo documentos facturas requerido
        $("#envoice"+index).parsley(parsleyOptions).addConstraint("required", "true");

        /*Para subir factura*/
        $('#envoice' + index).fileinput({
            language: 'es',
            showUpload: false,
            removeClass: 'btn btn-danger',
            allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf']
        });

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
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
    });

    /*Para subir factura*/
    $('#envoice').fileinput({
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