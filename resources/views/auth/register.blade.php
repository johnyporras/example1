@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ url('plugins/smartWizard/css/smart_wizard.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ url('plugins/smartWizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
@endpush

@section('title','Agregar Nuevo Usuario')

@section('content')

<div id="wizard" class="block push-bit">
    
    <ul>
        <li><a href="#step-1">Tarjeta</a></li>
        <li><a href="#step-2">Cuenta</a></li>
        <li><a href="#step-3">Afiliado</a></li>
        <li><a href="#step-4">Registro</a></li>
    </ul>

    <div>
 
        <div id="step-1">

            <div id="result" class="alert alert-warning">
                <p><i class="fa fa-exclamation-triangle"></i> <span class="text"></span>
                <button type="button" class="close" onclick="$('#result').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>

            {!! Form::open(['url' => '/check', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'checkForm' ]) !!}
                    
            <div class="form-group {{ $errors->has('tarjeta') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-credit_card"></i></span>
                        {{ Form::number('tarjeta', null, ['class' => 'form-control input-lg', 'placeholder' => 'Codigo Tarjeta', 'id' => 'tarjeta','minlength' => '6', 'maxlength' => '16', 'required']) }}
                    </div>
                    @if ($errors->has('tarjeta'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tarjeta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12 text-center">
                    <button id="valid" type="submit" class="btn btn-success btn-md"><i class="fa fa-check fa-fw"></i> Verificar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div id="step-2">
            {!! Form::open(['url' => '/cuenta', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'cuentaForm']) !!}
                    
            <div class="form-group {{ $errors->has('producto') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-tag"></i></span>
                        {{ Form::select('producto', $productos, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Producto', 'required', 'id' => 'producto']) }}
                    </div>
                    @if ($errors->has('producto'))
                        <span class="help-block">
                            <strong>{{ $errors->first('producto') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('plan') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-coins"></i></span>
                        {{ Form::select('plan', $planes, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Plan', 'required', 'id' => 'plan']) }}
                    </div>
                    @if ($errors->has('plan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('plan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div id="mascotas" class="hidden">
                <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-dog"></i></span>
                            {{ Form::text('nombre', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Nombre ', 'id' => 'nombre']) }}
                        </div>
                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('raza') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-dog"></i></span>
                            {{ Form::text('raza', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Raza', 'id' => 'raza']) }}
                        </div>
                        @if ($errors->has('raza'))
                            <span class="help-block">
                                <strong>{{ $errors->first('raza') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-dog"></i></span>
                            {{ Form::text('color', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Color Pelaje', 'id' => 'color']) }}
                        </div>
                        @if ($errors->has('color'))
                            <span class="help-block">
                                <strong>{{ $errors->first('color') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-circle_question_mark"></i></span>
                            {{ Form::select('tipo', ['gato' => 'Gato','perro' => 'Perro'], null, ['class' => 'mascota form-control input-lg', 'placeholder'=>'Tipo de Mascota', 'id' => 'tipo']) }}
                        </div>
                        @if ($errors->has('tipo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('edad') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-clock"></i></span>
                            {{ Form::number('edad', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Edad mascota', 'id' => 'edad','min' => '0', 'max' => '40', 'maxlength' => '2']) }}
                        </div>
                        @if ($errors->has('edad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('edad') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('fmascota') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-calendar"></i></span>
                            {{ Form::text('fmascota', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Fecha nacimiento', 'id' => 'fmascota', 'required']) }}
                        </div>
                        @if ($errors->has('fmascota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fmascota') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('tamano') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-resize_full"></i></span>
                            {{ Form::select('   ', $tamanos, null, ['class' => 'mascota form-control input-lg', 'placeholder'=>'Tamaño mascota', 'id' => 'tamano']) }}
                        </div>
                        @if ($errors->has('tamano'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tamano') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div> <!-- .mascotas -->

            <div id="maternidad" class="hidden">

                <div class="form-group {{ $errors->has('embarazada') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-comments"></i></span>
                            {{ Form::select('embarazada', ['S' => 'SI','N' => 'NO'], null, ['class' => 'form-control input-lg', 'placeholder'=>'¿Usted esta Embarazada?', 'id' => 'embarazada']) }}
                        </div>
                        @if ($errors->has('embarazada'))
                            <span class="help-block">
                                <strong>{{ $errors->first('embarazada') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('semanas') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-clock"></i></span>
                            {{ Form::number('semanas', null, ['class' => 'form-control input-lg', 'placeholder' => 'Semanas de Embarazo', 'id' => 'semanas','min' => '1', 'max' => '40', 'maxlength' => '2', 'disabled']) }}
                        </div>
                        @if ($errors->has('semanas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('semanas') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div> <!-- .maternidad -->

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>

        <div id="step-3">
            {!! Form::open(['url' => '/afiliado', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'afiliadoForm']) !!}
                    
            <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-credit_card"></i></span>
                        {{ Form::number('cedula', null, ['class' => 'form-control input-lg', 'placeholder' => 'Cédula', 'id' => 'cedula', 'minlength' => '6', 'maxlength' => '2', 'required']) }}
                    </div>
                    @if ($errors->has('cedula'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cedula') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        {{ Form::text('nombre', null, ['class' => 'form-control input-lg', 'placeholder' => 'Nombre ', 'id' => 'nombre', 'required']) }}
                    </div>
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        {{ Form::text('apellido', null, ['class' => 'form-control input-lg', 'placeholder' => 'Apellido', 'id' => 'apellido', 'required']) }}
                    </div>
                    @if ($errors->has('apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                        {{ Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'Correo', 'id' => 'email', 'required']) }}
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-earphone"></i></span>
                        {{ Form::text('telefono', null, ['class' => 'form-control input-lg', 'placeholder' => 'Teléfono', 'id' => 'telefono', 'required']) }}
                    </div>
                    @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-calendar"></i></span>
                        {{ Form::text('fecha', null, ['class' => 'form-control input-lg', 'placeholder' => 'Fecha nacimiento', 'id' => 'fecha', 'required']) }}
                    </div>
                    @if ($errors->has('fecha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fecha') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('sexo') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                        {{ Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Sexo', 'required', 'id' => 'sexo']) }}
                    </div>
                    @if ($errors->has('plan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sexo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-globe"></i></span>
                        {{ Form::select('estado', $estados, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Estado', 'required', 'id' => 'estado']) }}
                    </div>
                    @if ($errors->has('plan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('estado') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('ciudad') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-globe"></i></span>
                        {{ Form::text('ciudad', null, ['class' => 'form-control input-lg', 'placeholder' => 'Ciudad', 'id' => 'ciudad', 'required']) }}
                    </div>
                    @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ciudad') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>

        <div id="step-4">
                {!! Form::open(['url' => '/register', 'class' => 'form-horizontal form-bordered form-control-borderless' ]) !!}
                    
                <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                            <input type="text" class="form-control input-lg" name="user" value="{{ old('user') }}" placeholder="Usuario" >
                        </div>
                        @if ($errors->has('user'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                            <input type="text" class="form-control input-lg" name="user" value="{{ old('name') }}" placeholder="Nombre" >
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                            <input type="email" class="form-control input-lg" name="user" value="{{ old('email') }}" placeholder="Email" >
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                            <input type="password" class="form-control input-lg" name="password" placeholder="Clave" >
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                            <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirmar Clave" >
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
                    </div>
                </div>
        {!! Form::close() !!}
        </div>

    </div> 

</div>

@endsection

@section('script')

<script type="text/javascript">
$(document).ready(function() {
    // setup envio ajax token
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // default
    var validate = false;
    var submitted = false;
    var submitted1 = false;
    // Escondo los mensje por defecto
    $('#result').hide(); 
    
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
        errorTemplate: '<div class=" col-md-offset-1 col-md-11"></div>',
    };

    // Genero la validacion del formulario...
    $('#checkForm').parsley(parsleyOptions);

    $('#cuentaForm').parsley(parsleyOptions);

    $('#afiliadoForm').parsley(parsleyOptions);

    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info btn-finish hidden')
        .on('click', function(){ });

    // Inicializo step form
    $('#wizard').smartWizard({ 
        selected: 0, 
        theme: 'default',
        transitionEffect:'fade',
        toolbarSettings: {
            toolbarPosition: 'bottom',
            toolbarExtraButtons: [btnFinish]
        },
        anchorSettings: {
            markDoneStep: true, // add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        lang:{
            next: 'Siguiente',
            previous: 'Atras'
        }
    });

    // Verifica si puede pasar al otro step
    $("#wizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection){
        // verifico si va adelante
        if(stepDirection === 'forward'){      
            if(validate == false){
                //validation failed
                return false;    
            }
        }else{
            validate = true;
            return true;
        }
        return true;
    });

    // Verifica si puede mostrar el ultimo boton para finalizar
    $("#wizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last step
        if(stepNumber == 1){ 

            if (!submitted) {
                validate = false;
            }
            console.log('estoy en 1');
        }

        if(stepNumber == 2){
            if (!submitted1) {
                validate = false;
            }
            console.log('estoy en 2');
            //$('.btn-finish').removeClass('hidden');  
        }

    });

    /***********************************************************************/

    //Valida cambio del metodo de pago
    $("#plan").on('change', function() {
        // valido metodo para mostrar data adicional
        plan = this.value;
        //verifico valor
        if(plan == 17){
            $("#mascotas").addClass("hidden");
            $('#embarazada').attr('required','required');
            $("#maternidad").removeClass("hidden");
            $('.mascota').removeAttr('required','required');
        }else if(plan == 18){
            $("#mascotas").removeClass("hidden");
            $("#maternidad").addClass("hidden");
            $('.mascota').attr('required','required');
        }else{
            $("#mascotas").addClass("hidden");
            $("#maternidad").addClass("hidden");
            $('#embarazada').removeAttr('required','required');
            $('.mascota').removeAttr('required','required');
        }
    });

    //Valida si esta embarazada o no
    $("#embarazada").on('change', function() {
        // valido metodo para mostrar data adicional
        embarazada = this.value;
        //verifico valor
        if(embarazada == 'S'){
            $('#semanas').removeAttr('disabled','disabled');
            $('#semanas').attr('required','required');
        }else{
            $('#semanas').attr('disabled','disabled');
            $('#semanas').removeAttr('required','required');
        }
    }); 

    /* Para fecha de solicitud*/
    $('#fecha').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '-18y'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fecha').parsley(parsleyOptions).validate();
    });

    /* Para fecha de solicitud*/
    $('#fmascota').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fmascota').parsley(parsleyOptions).validate();
    });

    /***********************************************************************/

     // Verificar tarjeta
    $('#checkForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var tarjeta = $('#tarjeta').val();
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "GET",
            url:'{{ url('/check') }}',
            data: {tarjeta: tarjeta},
            success: function(data) {
                // limpio el campo tarjeta
                $("#tarjeta").val("");
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result').show();
                    $('#result').removeClass('alert-success'); 
                    $('#result').addClass('alert-warning '); 
                    $('#result .text').text(data.error)
                    validate = false;
                } else {
                    // Desabilito los campos paa evitar errores
                    $('#valid').attr('disabled','disabled');
                    $('#tarjeta').attr('disabled','disabled');
                    // Muestro mensaje de exito
                    $('#result').show(); 
                    $('#result').removeClass('alert-warning'); 
                    $('#result').addClass('alert-success'); 
                    $('#result .text').text(data.success)
                    // Permito pasar al otro step del registro
                    validate = true;
                }
            }
        });
    }); 

     // Verificar tarjeta
    $('#cuentaForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var producto = $('#producto').val();
        var plan = $('#plan').val();
        var embarazada = $('#embarazada').val();
        var semanas = $('#semanas').val();
        var nombre = $('#nombre').val();
        var raza = $('#raza').val();
        var color = $('#color').val();
        var tipo = $('#tipo').val();
        var edad = $('#edad').val();
        var fmascota = $('#fmascota').val();
        var tamano = $('#tamano').val();    
         
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "GET",
            url:'{{ url('/cuenta') }}',
            data: {
                producto: producto,
                plan: plan,
                embarazada: embarazada,
                semanas: semanas,
                nombre: nombre,
                raza: raza,
                color: color,
                tipo: tipo,
                edad: edad,
                fmascota: fmascota,
                tamano: tamano 
            },
            success: function(data) {
                // limpio el campo tarjeta
                //$("#tarjeta").val("");
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result1').show();
                    $('#result1').removeClass('alert-success'); 
                    $('#result1').addClass('alert-danger '); 
                    $('#result1 .text').text(data.error)
                } else {
                   console.log(data);
                    validate = true;
                    submitted = true;
                }
            }
        });
    });

});
</script>
@endsection