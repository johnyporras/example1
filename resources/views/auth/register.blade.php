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
        <li><a href="#step-1">Step 1<br /></a></li>
        <li><a href="#step-2">Step 2<br /></a></li>
        <li><a href="#step-3">Step 3<br /></a></li>
    </ul>

    <div>
        <div id="step-1">
            {!! Form::open(['url' => '/check', 'class' => 'form-horizontal form-bordered form-control-borderless', 'method' => 'get', 'id' => 'checkForm' ]) !!}
                
            <div class="form-group {{ $errors->has('tarjeta') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-credit_card"></i></span>
                        <input type="text" class="form-control input-lg" id="tarjeta" name="tarjeta" placeholder="Codigo Tarjeta" required>
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
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-check fa-fw"></i> Verificar</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>

        <div id="step-2">
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

    //$('#wizard').bootstrapWizard();

    $('#wizard').smartWizard({ 
        selected: 0, 
        theme: 'default',
        transitionEffect:'fade',
        toolbarSettings: {
            toolbarPosition: 'bottom',
            //toolbarExtraButtons: [btnFinish, btnCancel]
            }
    });

    // setup envio ajax token
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

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

    // Verificar tarjeta
    $('#checkForm').on('submit', function (e) {
        e.preventDefault();
        var tarjeta = $('#tarjeta').val();
        $.ajax({
            type: "GET",
            url:'/check',
            data: {tarjeta: tarjeta},
            success: function(data) {
                console.log(data);
            }
        });
    });



    


});      
</script>
@endsection