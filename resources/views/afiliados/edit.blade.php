@extends('layouts.app')
@section('title','Editar Afiliado')
@section('content')

    <hr/>

    {!! Form::model($afiliado, [
        'method' => 'PATCH',
        'url' => ['afiliados', $afiliado->id],
        'class' => 'form-horizontal'
    ]) !!}
    
    <?php 
       // var_dump($afiliado->apellido);die();
    ?>

            <div class="form-group {{ $errors->has('cedula') ? 'has-error' : ''}}">
                {!! Form::label('cedula', 'Cedula: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('cedula', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('cedula', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('apellido') ? 'has-error' : ''}}">
                {!! Form::label('apellido', 'Apellido: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('apellido', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
                {!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('fecha_nacimiento', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sexo') ? 'has-error' : ''}}">
                {!! Form::label('sexo', 'Sexo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('sexo', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            
           
            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
                {!! Form::label('telefono', 'Telefono: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

<p>Datos de la Cuenta</p>

<table class="table table-bordered table-striped table-hover">
<thead>
 <th>C&oacute;digo de Cuenta</th> <th>Fecha de inicio </th><th>Nombre del Producto</th><th>  </th>
</thead>
 <tr>
                <td>{{ $afiliado->codigo_cuenta }}</td> <td>{{ $afiliado->fecha }} </td><td>{{ $afiliado->nombreprod }}</td><td>  </td>
  </tr>
</table>



    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection