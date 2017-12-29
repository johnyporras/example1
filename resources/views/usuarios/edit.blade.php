@extends('layouts.app')
@section('title','Editar Usuario')
@section('content')
    <hr/>
    {!! Form::model($usuario, [
        'method' => 'PATCH',
        'url' => ['usuarios', $usuario->id],
        'class' => 'form-horizontal'
    ]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nombre: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Tipo Perfil: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::select('type', $perfil, $usuario->type, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
                {!! Form::label('active', 'Estatus: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::select('active',['S'=>'Activo','N'=>'Inactivo'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
   			<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('clave', 'Contrase&ntilde;a: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Verificar Contrase&ntilde;a: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('password2', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('password2', '<p class="help-block">:message</p>') !!}
                    
                    {!! Form::hidden('user', null, ['class' => 'form-control','id'=>'user']) !!}
                </div>
            </div>   
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('clave', 'Clave Telef&oacute;nica: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                    {!! Form::number('clave', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('clave', '<p class="help-block">:message</p>') !!}
            </div>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('clave2', 'Verificar Clave Telef&oacute;nica: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                    {!! Form::number('clave2', $usuario->clave, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('clave2', '<p class="help-block">:message</p>') !!}
            </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

@endsection

@section('script') 
<script>

$("#form1").submit(function(event)
{
	$("#user").val($("#email").val())
})

</script>
@endsection('script')