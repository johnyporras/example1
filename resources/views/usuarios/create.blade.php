@extends('layouts.app')
@section('title','Editar Usuario')
@section('content')
    <hr/>
   {!! Form::open(['url' => 'usuarios/store', 'class' => 'form-horizontal','id'=>'form1']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nombre: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required','id'=>'email']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Tipo Perfil: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::select('type', $perfil, null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                    {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required','id'=>'password']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Verificar Contrase&ntilde;a: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('password2', null, ['class' => 'form-control', 'required' => 'required','id'=>'password2']) !!}
                    {!! $errors->first('password2', '<p class="help-block">:message</p>') !!}
                    
                    {!! Form::hidden('user', null, ['class' => 'form-control','id'=>'user']) !!}
                </div>
            </div>   
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('clave', 'Clave Telef&oacute;nica: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                    {!! Form::number('clave', null, ['class' => 'form-control', 'required' => 'required','id'=>'clave']) !!}
                    {!! $errors->first('clave', '<p class="help-block">:message</p>') !!}
            </div>
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('clave2', 'Verificar Clave Telef&oacute;nica: ', ['class' => 'col-sm-2 control-label','id'=>'clave2']) !!}
            <div class="col-sm-4">
                    {!! Form::number('clave2', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
	
	if($("input[name='password']").val()!=$("input[name='password2']").val())
	{
		alert("La contraseña y la confimación de la contraseña no coinciden");
		return false;
	}

	if($("input[name='clave']").val()!=$("input[name='clave2']").val())
	{
		alert("La clave telefónica y la confimación de la clave telefónica no coinciden");
		return false;
	}
	
	$("#user").val($("#email").val());
})



$("#clave,#clave2").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
});





</script>
@endsection('script')