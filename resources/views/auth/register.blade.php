@extends('layouts.auth')

@section('title','Agregar Nuevo Usuario')

@section('content')

<div class="block push-bit">
    <!--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">-->
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

        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                {!! Form::label('type', 'Tipo Perfil: ', ['class' => 'control-label']) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <?php
                        $perfiles = \App\Models\UserType::get();
                        $perfil = array_pluck($perfiles,'name','id');
                    ?>
                    {!! Form::select('type', $perfil, null, ['id' => 'type', 'class' => 'form-control', 'required' => 'required']) !!}
                </div>
                @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('codigo_proveedor') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                {!! Form::label('codigo_proveedor', 'Proveedores: ', ['class' => 'control-label']) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    {!! Form::select('codigo_proveedor', ['' => 'Seleccione una opción'], null, ['id' => 'codigo_proveedor', 'class' => 'form-control']) !!}
                </div>
                @if ($errors->has('codigo_proveedor'))
                    <span class="help-block">
                        <strong>{{ $errors->first('codigo_proveedor') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save fa-fw"></i> Guardar</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 text-center">
                <small>¿Ya tienes cuenta?</small> 
                <a href="{{ url('/login') }}"><small>Iniciar Sesión</small></a>
            </div>
        </div>

    {!! Form::close() !!}           
</div>
@endsection

@section('script')
    <script>
        $(function(){
            $("#type").on('change',function(this){
                var data = {
                    '_token': $('[name="_token"]').val()
                };
                var select = "";alert($(this).val());
                if($('#type').val() === 3){//Analista Proveedor
                    $.post("{{url('selectProveedores')}}", data, function(data,select){
                        select = "<select class='form-control' id='codigo_proveedor' name='codigo_proveedor'>\n\
                                    <option selected='selected' value=''>Selecione una opción</option>";
                            $.each( data, function( key, val ) {
                                select = select + "<option value='" + key + "'>" + val + "</option>";
                              });
                            select = select + "</select>";
                            $("#div_proveedor").html(select);
                    });
                }else if($('#type').val() === 4){//Analista Aseguradora
                    $.post("{{url('selectAseguradors')}}", data, function(data,select){
                        select = "<select class='form-control' id='codigo_proveedor' name='codigo_proveedor'>\n\
                                    <option selected='selected' value=''>Selecione una opción</option>";
                            $.each( data, function( key, val ) {
                                select = select + "<option value='" + key + "'>" + val + "</option>";
                              });
                            select = select + "</select>";
                            $("#div_proveedor").html(select);
                    });
                }else{
                    $('#codigo_proveedor').prop( "disabled", true);
                }
            });
        });
    </script>
@endsection