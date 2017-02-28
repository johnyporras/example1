@extends('layouts.app')
@section('title','Tratamientos Realizados')
@section('content')
@if (isset($tratamientos))
    @if (count($tratamientos) > 0)
        <div class="col-md-12">
	        <div class="table">
	            <table class="table table-bordered table-striped table-hover">
	                <thead>
	                    <tr>
                                <th>Paciente</th>
	                        <th>Clave</th>
                                <th>Procedimiento</th>
                                <th>Diente</th>
                                <th>Ubicacion</th>
	                        <th>Fecha Atencion</th>
                                <th>Estatus</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    {{-- */$x=0;/* --}}
	                    @foreach ($tratamientos as $tratamiento)
	                        {{-- */$x++;/* --}}
	                        <tr>
	                            <td>{{ $tratamiento->nombre}}</td>                                     
	                            <td>{{ $tratamiento->clave }}</td> 
	                            <td>{{ $tratamiento->tipo_examen }}</td>
	                            <td>{{ $tratamiento->descripcion }}</td>
	                            <td>{{ $tratamiento->cara }}</td>
	                            <td>{{  date("d-m-Y",strtotime($tratamiento->fecha_atencion)) }}</td>
	                            <td>{{ $tratamiento->estatus }}</td>
	                        </tr>
	                    @endforeach
	                    {!! Form::hidden('max', $x) !!}
	                </tbody>
	            </table>
	        </div>
        </div>
    @endif
@endif
@endsection
