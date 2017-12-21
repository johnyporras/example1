@extends('layouts.app')
@section('title','Usuarios')

@section('content')

	<div class="row">
   		<div class="col-sm-6">
   			{!! Form::open([
                            'method'=>'POST',
                            'url' => ['usuarios/buscar'],
                            'style' => 'display:inline'
                        ]) !!}
                        	{!! Form::text('palabra', null, ['class' => 'form-control']) !!}
   		</div>
   		<div class="col-sm-4">
   		  {!! Form::submit('Buscar', ['class' => 'btn btn-danger btn-xs']) !!}
          {!! Form::close() !!}
         </div>
   </div>
    <div class="pull-right">
    <a href="{{ url('usuarios/create') }}" class="btn btn-primary pull-right btn-sm">Agregar Nuevo Usuario</a>
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Usuario</th><th>Nombre</th><th>Email</th><th>Perfil</th><th>Estatus</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($usuarios as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td><a href="{{ url('usuarios', $item->id) }}">{{ $item->user }}</a></td><td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->userType->name }}</td>
                    @if($item->active == 'S')
                        <td>Activo</td>
                    @else
                        <td>Inactivo</td>
                    @endif
                    <td>
                        <a href="{{ url('usuarios/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Actualizar</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['usuarios', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $usuarios->render() !!} </div>
    </div>

@endsection
