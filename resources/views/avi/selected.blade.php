@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/stacktable/stacktable.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/stacktable/stacktable.js') }}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-airplane"></i> Asistencia al Viajero Internacional <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/avi/lista') }}">Asistencia al Viajero Internacional</a></li>
        <li>Generar</li>
    </ul>
@endsection

@section('content') 
<div class="col-xs-12">

    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/avi') }}" title="Buscar otro beneficiario" class="btn btn-info"><span class="pr5"><i class="fa fa-search"></i></span> Beneficiario</a></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4>Datos de Servicio</h4>
            @if (isset($servicio))
                <table class="card table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Cédula</th><th>Nombre</th><th>Tipo</th><th>Cobertura del Plan</th><th>Colectivo</th><th>Aseguradora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $servicio['cedula_afiliado'] }}</td>
                            <td>{{ $servicio['nombre_afiliado'] }}</td>
                            <td>{{ $servicio['tipo_afiliado'] }}</td>
                            <td>{{ $servicio['plan'] }}</td>
                            <td>{{ $servicio['colectivo'] }}</td>
                            <td>{{ $servicio['aseguradora'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif 
        </div> <!-- .col -->
    </div><!-- .row -->

</div>

<div class="col-xs-12">
    <div class="row">
        @if (isset($afiliados))

            @if (count($afiliados) > 0)
            
            <div class="col-xs-12">
                <h4>Afiliados</h4>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    {!! Form::open(['url' => 'avi/generar', 'class' => 'form-horizontal', 'name' => 'afiliado']) !!}

                {!! Form::hidden('servicio[cedula_afiliado]', $servicio['cedula_afiliado'] ) !!}
                {!! Form::hidden('servicio[nombre_afiliado]', $servicio['nombre_afiliado'] ) !!}
                {!! Form::hidden('servicio[tipo_afiliado]', $servicio['tipo_afiliado'] ) !!}
                {!! Form::hidden('servicio[plan]', $servicio['plan'] ) !!}
                {!! Form::hidden('servicio[colectivo]', $servicio['colectivo'] ) !!}
                {!! Form::hidden('servicio[aseguradora]', $servicio['aseguradora'] ) !!}
                {!! Form::hidden('servicio[contrato]', $servicio['contrato'] ) !!}

                    @foreach ($afiliados as $afiliado)
                        <div class="col-md-6 col-lg-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">{{ $afiliado->acTipoAfiliado->nombre }}</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p>
                                                        <img class="img-circle img-responsive" width="60" 
                                                            src="{{ asset('images/user.jpg') }}"
                                                            alt="User Pic">
                                                    </p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p>
                                                    <strong>{{ $afiliado->nombre }} {{ $afiliado->apellido }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-xs-12">
                                            <table class="table table-responsive table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td width="90">Cédula:</td>
                                                        <td>{{ $afiliado->cedula }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="90">Edad:</td>
                                                        <td>{{ $afiliado->fecha_nacimiento->age }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="90">Sexo:</td>
                                                        <td>{{ ($afiliado->sexo == 'M')?'Masculino':'Femenino'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="90">Correo:</td>
                                                        <td>{{ $afiliado->email }} </td>
                                                    </tr>
                                                        <tr>
                                                        <td width="90">Teléfono:</td>
                                                        <td>{{ $afiliado->telefono }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <label class="btn btn-sm btn-success" title="Seleccionar">
                                        <i class="glyphicon glyphicon-ok"></i>
                                        <input type="radio" name="id" value="{{ $afiliado->id }}" class="hidden"> 
                                    </label>
                                </div>
                            </div>

                        </div>
                    @endforeach
                     {!! Form::close() !!}
                </div>
            </div>

            @endif
        @endif
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {   
    
    $('input[name=id]').change(function(){  
        $('form').submit();  
    });

    //Inicializo tabla responsive
    $('.card').cardtable();  

}); 

</script>



@endsection