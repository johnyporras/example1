@extends('layouts.auth')

@section('title','Login')

@push('style')
    <link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
@endpush

@section('content')
<div class="block push-bit">
    {!! Form::open(['url' => '/login', 'class' => 'form-horizontal form-bordered form-control-borderless', 'id' => 'loginForm' ]) !!}

        @if (session('message'))
            <div class="alert alert-danger">
                    {{ session('message') }}
            </div>
        @endif
                
        <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                    <input type="email" class="form-control input-lg" name="user" value="{{ old('user') }}" placeholder="Usuario" required >
                </div>
                @if ($errors->has('user'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password" class="form-control input-lg" name="password" placeholder="Clave" required >
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesión</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/password/reset') }}" ><small>¿Olvido su clave?</small></a> |
                <a href="{{ url('/register') }}" ><small>Registrate</small></a>
            </div>
        </div>

    {!! Form::close() !!}           
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
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
    $('#loginForm').parsley(parsleyOptions);
});
</script>
@endsection