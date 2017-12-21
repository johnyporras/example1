@extends('layouts.app')
@section('title','Afiliados')
@section('content')
   <div class="row">
   		<div class="col-sm-6">
   			{!! Form::open([
                            'method'=>'POST',
                            'url' => ['afiliado/buscar'],
                            'style' => 'display:inline'
                        ]) !!}
                        	{!! Form::text('palabra', null, ['class' => 'form-control']) !!}
   		</div>
   		<div class="col-sm-4">
   		  {!! Form::submit('Buscar', ['class' => 'btn btn-danger btn-xs']) !!}
          {!! Form::close() !!}
         </div>
   
   </div>
   <br>
   <br>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th><th>Cedula</th><th>Nombre</th><th>Apellido</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($afiliados as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('afiliados', $item->id) }}">{{ $item->cedula }}</a></td><td>{{ $item->nombre }}</td><td>{{ $item->apellido }}</td>
                    <td>
                        <a href="{{ url('afiliados/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Actualizar</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['afiliados', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                    
                    <td>
                        <a href="{{ url('afiliados/' . $item->id . '/pagos') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Pagos</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $afiliados->render() !!} </div>
    </div>

@endsection
