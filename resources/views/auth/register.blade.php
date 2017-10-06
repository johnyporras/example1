@extends('layouts.auth')

@section('title','Registro')

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

@section('content')

<div id="wizard" class="block push-bit">

    <ul>
        <li><a href="#step-1">Tarjeta</a></li>
        <li><a href="#step-2">Terminos</a></li>
        <li><a href="#step-3">Cuenta</a></li>
        <li><a href="#step-4">Afiliado</a></li>
        <li><a href="#step-5">Seguridad</a></li>
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
                        {{ Form::text('tarjeta', null, ['class' => 'form-control input-lg', 'placeholder' => 'Codigo Tarjeta', 'id' => 'tarjeta','minlength' => '20', 'maxlength' => '20', 'pattern' => '[0-9]+', 'required']) }}
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

            <div id="rAccept" class="alert alert-success">
                <p><i class="fa fa-check"></i> <span class="text">He leído y acepto los términos y condiciones de uso</span>
                <button type="button" class="close" onclick="$('#rAccept').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>

            {!! Form::open(['url' => '/pais', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'checkForm' ]) !!}

            <div class="form-group {{ $errors->has('pais') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-credit_card"></i></span>
                        {{ Form::select('pais', $paises, Session::get('terminos.code'), ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Pais', 'required', 'id' => 'pais','readonly', 'disabled']) }}
                    </div>
                    @if ($errors->has('pais'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pais') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div id="contTerminos">

                <div id="pTerminos" class="text-justify">{!! Session::get('terminos.terminos') !!}</div>
                <hr>
                <div id="bTerminos" class="mt20">
                    <div class="col-xs-6 text-center">
                        <button id="clear" type="button" class="btn btn-danger btn-md"><i class="fa fa-close fa-fw"></i>Cancelar</button>
                     </div>
                    <div class="col-xs-6 text-center">
                        <button id="accept" type="button" class="btn btn-success btn-md"><i class="fa fa-check fa-fw"></i> Acepto</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <div id="step-3">

            <div id="result1" class="alert alert-danger">
                <p><i class="fa fa-exclamation-triangle"></i> <span class="text"></span>
                <button type="button" class="close" onclick="$('#result1').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>

            <div id="contentCard">
                <h3 id="textPlan" class="text-center"></h3>
                <img class="img-responsive" src="{{ url('images/tarjeta-acard.png') }}" alt="tarjeta">
                <p id="textCuenta"></p>
            </div>

            {!! Form::open(['url' => '/cuenta', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'cuentaForm']) !!}

            <div id="cPlan" class="hidden" >
                <div class="form-group {{ $errors->has('producto') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-tag"></i></span>
                            {{ Form::select('producto', $productos, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Producto', 'id' => 'producto']) }}
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
                            {{ Form::select('plan', $planes, null, ['class' => 'form-control input-lg', 'placeholder'=>'Seleccione Plan', 'id' => 'plan']) }}
                        </div>
                        @if ($errors->has('plan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('plan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div id="mascotas" class="hidden">
                <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-dog"></i></span>
                            {{ Form::text('nombre', null, ['class' => 'mascota form-control input-lg', 'placeholder' => 'Nombre ', 'id' => 'nmascota']) }}
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
                            {{ Form::select('embarazada', ['S' => 'SI','N' => 'NO'], 'N', ['class' => 'form-control input-lg', 'placeholder'=>'¿Usted esta Embarazada?', 'id' => 'embarazada']) }}
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
                    <button type="submit" id="valid1" class="btn btn-success btn-md"><i class="fa fa-check-circle fa-fw"></i> Aceptar</button>
                </div>
            </div>
        {!! Form::close() !!}

        </div>

        <div id="step-4">

            <div id="result2" class="alert alert-danger">
                <p><i class="fa fa-exclamation-triangle"></i> <span class="text"></span>
                <button type="button" class="close" onclick="$('#result2').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>

            {!! Form::open(['url' => '/afiliado', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'afiliadoForm']) !!}

            <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-credit_card"></i></span>
                        {{ Form::text('cedula', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Cédula', 'id' => 'cedula','minlength' => '4', 'maxlength' => '9', 'pattern' => '[1-9][0-9]+', 'required']) }}
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
                        {{ Form::text('nombre', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Nombre ', 'id' => 'nafiliado', 'required']) }}
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
                        {{ Form::text('apellido', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Apellido', 'id' => 'apellido', 'required']) }}
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
                        {{ Form::email('email', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Correo', 'id' => 'email', 'required']) }}
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
                        {{ Form::text('telefono', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Teléfono', 'id' => 'telefono', 'pattern' => '^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$', 'minlength' => "11", 'maxlength' => '11', 'required']) }}
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
                        {{ Form::text('fecha', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Fecha nacimiento', 'id' => 'fecha', 'required']) }}
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
                        {{ Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['class' => 'afiliado form-control input-lg', 'placeholder'=>'Seleccione Sexo', 'required', 'id' => 'sexo']) }}
                    </div>
                    @if ($errors->has('sexo'))
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
                        {{ Form::select('estado', $estados, null, ['class' => 'afiliado form-control input-lg', 'placeholder'=>'Seleccione Estado', 'required', 'id' => 'estado']) }}
                    </div>
                    @if ($errors->has('estado'))
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
                        {{ Form::text('ciudad', null, ['class' => 'afiliado form-control input-lg', 'placeholder' => 'Ciudad', 'id' => 'ciudad', 'required']) }}
                    </div>
                    @if ($errors->has('ciudad'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ciudad') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="submit" id="valid2" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>

        <div id="step-5">

            <div id="result3" class="alert alert-danger">
                <p><i class="fa fa-exclamation-triangle"></i> <span class="text"></span>
                <button type="button" class="close" onclick="$('#result3').hide()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </p>
            </div>

            {!! Form::open(['url' => '/valido', 'class' => 'form-horizontal form-bordered form-control-borderless', 'id' => 'userForm']) !!}

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        {{ Form::password('password', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Clave', 'id' => 'password', 'minlength' => '6', 'maxlength' => '16', 'required']) }}
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
                        {{ Form::password('password_confirmation', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Confirmar Clave', 'id' => 'password1', 'data-parsley-equalto' => '#password', 'minlength' => '6', 'maxlength' => '16', 'required']) }}

                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('pregunta1') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-circle_question_mark"></i></span>
                        {{ Form::select('pregunta1', $preguntas1, null, ['class' => 'usuario form-control input-lg', 'placeholder'=>'Seleccione Pregunta', 'required', 'id' => 'pregunta1']) }}
                    </div>

                    @if ($errors->has('pregunta1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pregunta1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('respuesta1') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-circle_info"></i></span>
                        {{ Form::text('respuesta1', null, ['class' => 'usuario form-control input-lg', 'placeholder' => 'Respuesta', 'id' => 'respuesta1', 'required']) }}
                     </div>
                     @if ($errors->has('respuesta1'))
                         <span class="help-block">
                                <strong>{{ $errors->first('respuesta1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('pregunta2') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-circle_question_mark"></i></span>
                        {{ Form::select('pregunta2', $preguntas2, null, ['class' => 'usuario form-control input-lg', 'placeholder'=>'Seleccione Pregunta', 'required', 'id' => 'pregunta2']) }}
                    </div>
                    @if ($errors->has('pregunta2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pregunta2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('respuesta2') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-circle_info"></i></span>
                        {{ Form::text('respuesta2', null, ['class' => 'usuario form-control input-lg', 'placeholder' => 'Respuesta', 'id' => 'respuesta2', 'required']) }}
                     </div>
                     @if ($errors->has('respuesta2'))
                         <span class="help-block">
                                <strong>{{ $errors->first('respuesta2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('clave') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon" data-toggle="tooltip" data-original-title="Su clave telefonica le servira para acceder a sus servicios via telefonica"><i class="gi gi-earphone"></i></span>
                        
                        {{ Form::password('clave', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Clave Teléfonica', 'id' => 'clave', 'minlength' => '4', 'maxlength' => '6', 'pattern' => '[0-9]+', 'required']) }}
                        <span class="help-block"> Solo se permiten Números</span>
                    </div>

                     @if ($errors->has('clave'))
                        <span class="help-block">
                            <strong>{{ $errors->first('clave') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('clave_confirmation') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon" data-toggle="tooltip" data-original-title="Su clave telefonica le servira para acceder a sus servicios via telefonica"><i class="gi gi-earphone"></i></span>
                        {{ Form::password('clave_confirmation', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Confirmar Clave Telefonica', 'id' => 'clave1', 'data-parsley-equalto' => '#clave', 'minlength' => '4', 'maxlength' => '6', 'required']) }}
                        <span class="help-block"> Solo se permiten Números</span>
                    </div>
                    @if ($errors->has('clave_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('clave_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="submit" id="valid3" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
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

    // Valores por defecto
    var validate = false;
    var accept = false;
    var submitt = false;
    var submitted = false;
    var submitted1 = false;
    var success = false;

    // Escondo los mensje por defecto
    $('#result').hide();
    $('#result1').hide();
    $('#result2').hide();
    $('#result3').hide();
    // Para los terminos
   // $('#contTerminos').hide();
    $('#rAccept').hide();

    /** Variable Config parsley **/
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
    $('#userForm').parsley(parsleyOptions);

    // Inicializo step form
    $('#wizard').smartWizard({
        selected: 0,
        theme: 'default',
        transitionEffect:'fade',
        toolbarSettings: {
            toolbarPosition: 'bottom',
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
                return false;
            }
        }
        //verifico si va atras
        if(stepDirection === 'backward'){
            validate = true;
            return true;
        }
        return true;
    });

    // Verifica si puede mostrar el ultimo boton para finalizar
    $("#wizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last steps
        if(stepNumber == 0){
            if (submitt == false) {
                validate = false;
            }
        }

        if(stepNumber == 1){
            if (accept == false) {
                validate = false;
            }
        }

        if(stepNumber == 2){
            if (submitted == false) {
                validate = false;
            }
        }

        if(stepNumber == 3){
            if (submitted1 == false) {
                validate = false;
            }
        }
    });

    /***********************************************************************/

    //Valida cambio del metodo de pago
    $("#plan").on('change', function() {
        // valido metodo para mostrar data adicional
        plan = this.value;
        //verifico valor
        if(plan == 7){
            $("#mascotas").addClass("hidden");
            $('#embarazada').attr('required','required');
            $("#maternidad").removeClass("hidden");
            $('.mascota').removeAttr('required','required');
        }else if(plan == 8){
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
            type: "POST",
            url:'{{ url('/check') }}',
            data: {tarjeta: tarjeta},
            beforeSend:function() {
               $('#valid').attr('disabled','disabled');
               $('#valid').html("<i class='fa fa-refresh fa-spin fa-fw'></i> Cargando");
            },
            complete:function() {
                $('#valid').html('<i class="fa fa-check fa-fw"></i> Verificar');
                if(success !== true){
                    $('#valid').removeAttr('disabled');
                }
            },
            success: function(data) {
                // limpio el campo tarjeta
                $("#tarjeta").val('');
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result').show();
                    $('#result').removeClass('alert-success');
                    $('#result').addClass('alert-warning ');
                    $('#result .text').text(data.error)
                    validate = false;
                }
                // Verifica si existe cuenta generada en estatus pendiente
                if(data.id) {
                    // Redirecciono a otra pagina
                    window.location.href = "{{ url('/resend') }}/"+data.id;
                }
                // Verifica que se puede utilizar la tarjeta
                if(data.success) {
                    // Desabilito los campos paa evitar errores
                    $('#valid').attr('disabled','disabled');
                    $('#tarjeta').attr('disabled','disabled');
                    // Muestro mensaje de exito
                    $('#result').show();
                    $('#result').removeClass('alert-warning');
                    $('#result').addClass('alert-success');
                    $('#result .text').text(data.success)
                    // Permito pasar al otro step del registro
                    submitt = true;
                    validate = true;
                    // paso el siguiente punto
                    setTimeout(function() {
                            $('.sw-btn-next').click();
                        }, 1000);
                }
            }
        });
    });

    // Generar Cuenta
    //$('#cuentaForm').on('submit', function (e) {
    $('#valid1').on('click', function (e) {
        e.preventDefault();

        // Guardo el valor de la tarjeta ingresada..
        var plan     = 25;
        var producto = $('#producto').val();
        var embarazada = $('#embarazada').val();
        var semanas = $('#semanas').val();
        var nombre  = $('#nmascota').val();
        var raza    = $('#raza').val();
        var color   = $('#color').val();
        var tipo    = $('#tipo').val();
        var edad    = $('#edad').val();
        var fmascota = $('#fmascota').val();
        var tamano  = $('#tamano').val();

        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "POST",
            url:'{{ url('/cuenta') }}',
            data: {
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
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result1').show();
                    $('#result1').removeClass('alert-success');
                    $('#result1').addClass('alert-danger');
                    $('#result1 .text').text(data.error)
                    validate = false;
                    console.log(data);
                } else {
                    // Desabilito los campos paa evitar errores
                    $('#valid1').attr('disabled','disabled');
                    $('#producto').attr('disabled','disabled');
                    $('#plan').attr('disabled','disabled');
                    $('.mascota').attr('disabled','disabled');
                    $('#embarazada').attr('disabled','disabled');
                    $('#semanas').attr('disabled','disabled');
                    // Muestro mensaje de exito
                    $('#result1').show();
                    $('#result1').removeClass('alert-danger');
                    $('#result1').addClass('alert-success');
                    $('#result1 .text').text(data.success);
                    // Permito pasar al otro step del registro
                    validate = true;
                    submitted = true;
                    // paso el siguiente punto
                    setTimeout(function() {
                            $('.sw-btn-next').click();
                        }, 1000);
                }
            }
        });
    });

    // Generar Afiliado
    $('#afiliadoForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var cedula   = $('#cedula').val();
        var nombre   = $('#nafiliado').val();
        var apellido = $('#apellido').val();
        var correo   = $('#email').val();
        var telefono   = $('#telefono').val();
        var nacimiento = $('#fecha').val();
        var sexo   = $('#sexo').val();
        var estado = $('#estado').val();
        var ciudad = $('#ciudad').val();

        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "POST",
            url:'{{ url('/afiliado') }}',
            data: {
                cedula: cedula,
                nombre: nombre,
                apellido: apellido,
                correo: correo,
                telefono: telefono,
                nacimiento: nacimiento,
                sexo: sexo,
                estado: estado,
                ciudad: ciudad
            },
            success: function(data) {
                // limpio el campo tarjeta
                //$("#tarjeta").val("");
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result2').show();
                    $('#result2').removeClass('alert-success');
                    $('#result2').addClass('alert-danger');
                    $('#result2 .text').text(data.error)
                    validate = false;
                    console.log(data);
                } else {
                    // Desabilito los campos paa evitar errores
                    $('#valid2').attr('disabled','disabled');
                    $('.afiliado').attr('disabled','disabled');

                    // Muestro mensaje de exito
                    $('#result2').show();
                    $('#result2').removeClass('alert-danger');
                    $('#result2').addClass('alert-success');
                    $('#result2 .text').text(data.success);
                    // Permito pasar al otro step del registro
                    validate = true;
                    submitted1 = true;
                    // paso el siguiente punto
                    setTimeout(function() {
                            $('.sw-btn-next').click();
                        }, 1000);
                }
            }
        });
    });

    // Generar Usuario
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var usuario    = $('#user').val();
        var pregunta1  = $('#pregunta1').val();
        var respuesta1 = $('#respuesta1').val();
        var pregunta2  = $('#pregunta2').val();
        var respuesta2 = $('#respuesta2').val();
        var password   = $('#password').val();
        var clave      = $('#clave').val();

        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "POST",
            url:'{{ url('/registro') }}',
            data: {
                user: usuario,
                pregunta1: pregunta1,
                respuesta1: respuesta1,
                pregunta2: pregunta2,
                respuesta2: respuesta2,
                password: password,
                clave: clave,
            },
            beforeSend:function() {
               $('#valid3').attr('disabled','disabled');
               $('#valid3').html("<i class='fa fa-refresh fa-spin fa-fw'></i> Cargando");
            },
            complete:function() {
                $('#valid3').html('<i class="fa fa-save fa-fw"></i> Guardar');

                if(success != true){
                    $('#valid3').prop("disabled", false);
                }
            },
            success: function(data) {

                if (data.error) {
                    // Muestro mensaje de error
                    $('#result3').show();
                    $('#result3').removeClass('alert-success');
                    $('#result3').addClass('alert-danger');
                    $('#result3 .text').text(data.error);
                    console.log(data);
                } else {
                    // Deshabilito los campos paa evitar errores
                    $('.usuario').attr('disabled','disabled');
                    $('#valid3').attr('disabled','disabled');
                    $('#valid3').html("<i class='fa fa-refresh fa-spin fa-fw'></i> Cargando");
                    // Muestro mensaje de exito
                    success = true;
                    // Redirecciono a otra pagina
                    //$('#userForm').submit();
                    $('#userForm').trigger('submit');
                }
            }
        });
    });

    /************************************************************************/
    // Terminos y Condiciones

    // Al aceptar las condiciones
    $('#accept').on('click', function (e) {
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "POST",
            url:'{{ url('/pais') }}',
            success: function(data) {
                // paso valor de la tarjeta Ingresada
                $('#textPlan').text(data.plan);
                // paso valor de la tarjeta Ingresada
                $('#textCuenta').text(data.codigo);
            }
        });

        // valido los terminos
        accept = true;
        validate = true;

        // Muestro mensaje de acceptacion
        $('#rAccept').show();

        // paso el siguiente punto
        setTimeout(function() {
            $('.sw-btn-next').click();
            $('#bTerminos').hide();
        }, 1000);
    });

    // Al aceptar las condiciones
    $('#clear').on('click', function (e) {
        // regreso al paso 1
        $('.sw-btn-prev').click();
    });

});
</script>
@endsection
