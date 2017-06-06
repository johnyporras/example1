@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ url('plugins/smartWizard/css/smart_wizard.min.css') }}">
@endpush

@push('scripts')
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
        <li><a href="#step-3">Step 3</a></li>
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
                        <input type="number" class="form-control input-lg" id="tarjeta" name="tarjeta" placeholder="Codigo Tarjeta" minlength="6" maxlength="16" required>
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
            {!! Form::open(['url' => '/register', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'cuentaForm']) !!}
                    
            <div class="form-group {{ $errors->has('producto') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        {{ Form::select('producto', $productos, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Producto', 'required']) }}
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
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        {{ Form::select('plan', $planes, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Producto', 'required']) }}
                    </div>
                    @if ($errors->has('plan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('plan') }}</strong>
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

        <div id="step-3">
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
<script>
$(document).ready(function() {

    // setup envio ajax token
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //lista de productos
    // Ejecuto la peticion para validar la tarjeta
    $.ajax({
        type: "GET",
        url:'/productos',
        success: function(data) {
                console.log('hola');
        }
    });

    // default
    var validate = false;
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
        errorTemplate: '<div class=" col-md-offset-3 col-md-9"></div>',
    };

    // Genero la validacion del formulario...
    $('#checkForm').parsley(parsleyOptions);

    $('#cuentaForm').parsley(parsleyOptions);

    // Verificar tarjeta
    $('#checkForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var tarjeta = $('#tarjeta').val();
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "GET",
            url:'/check',
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
        if(stepDirection === 'forward'){      
            if(validate == false){
                //validation failed
                return false;    
            }
        }
        return true;
    });

    // Verifica si puede mostrar el ultimo boton para finalizar
    $("#wizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last step
        if(stepNumber == 2){ 
            $('.btn-finish').removeClass('hidden');  
        }
    });  

});      
</script>
@endsection