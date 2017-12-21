@extends('layouts.app')
@section('title','Afiliados')
@section('content')
   <div class="row">
   	
   </div>
   <br>
   <br>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th><th>Fecha de Corte</th><th>Fecha de Pago</th><th>Estatus</th><th>Monto</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($pagos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->fechacorte }}</td><td>{{ $item->fechapago }}</td><td>{{ $item->estatuspago }}</td><td>{{ $item->monto }}</td>  
               </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
