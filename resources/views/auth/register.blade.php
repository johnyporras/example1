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
                            {{ Form::select('tamano', $tamanos, null, ['class' => 'mascota form-control input-lg', 'placeholder'=>'Tamaño mascota', 'id' => 'tamano']) }}
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

<script src="{{url('js/register.js') }}"></script>

@endsection