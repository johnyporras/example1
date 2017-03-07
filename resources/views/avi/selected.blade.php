@extends('layouts.app')
@section('title','Sistema Avi')
@section('content')
<hr/>

<div class="col-xs-12">
<p><a href="{{ url('/avi') }}" title="Buscar otro beneficiario" class="btn btn-info"><span class="pr5"><i class="fa fa-search"></i></span> Beneficiario</a></p>
<h4>Datos de Servicio</h4>
@if (isset($servicio))
    <div class="table">
        <table class="table table-bordered table-striped table-hover table-responsive">
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

    </div>
@endif 
</div>

@if (isset($afiliados))

    @if (count($afiliados) > 0)
    
    <div class="col-xs-12">
        <h4>Afiliados</h4>
    </div>

    {!! Form::open(['url' => 'avi/generar', 'class' => 'form-horizontal', 'name' => 'afiliado']) !!}

        {!! Form::hidden('servicio[cedula_afiliado]', $servicio['cedula_afiliado'] ) !!}
        {!! Form::hidden('servicio[nombre_afiliado]', $servicio['nombre_afiliado'] ) !!}
        {!! Form::hidden('servicio[tipo_afiliado]', $servicio['tipo_afiliado'] ) !!}
        {!! Form::hidden('servicio[plan]', $servicio['plan'] ) !!}
        {!! Form::hidden('servicio[colectivo]', $servicio['colectivo'] ) !!}
        {!! Form::hidden('servicio[aseguradora]', $servicio['aseguradora'] ) !!}

    @foreach ($afiliados as $afiliado)
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ $afiliado->acTipoAfiliado->nombre }}</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                            <img class="img-circle img-responsive"
                                    src="{{ asset('images/user.jpg') }}"
                                    alt="User Pic">
                        </div>

                        <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                            <p><strong>{{ $afiliado->nombre }} {{ $afiliado->apellido }}</strong></p>
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td>Cédula:</td>
                                        <td>{{ $afiliado->cedula }} </td>
                                    </tr>
                                    <tr>
                                        <td>Edad:</td>
                                        <td>{{ $afiliado->fecha_nacimiento->age }} </td>
                                    </tr>
                                    <tr>
                                        <td>Sexo:</td>
                                        <td>{{ ($afiliado->sexo == 'M')?'Masculino':'Femenino'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Correo:</td>
                                        <td>{{ $afiliado->email }} </td>
                                    </tr>
                                    <tr>
                                        <td>Teléfono:</td>
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

    @endif
    
@endif
@endsection

@section('script')
<script>
    $(document).ready(function() {   
       $('input[name=id]').change(function(){  
            $('form').submit();  
       });  
  }); 

</script>



@endsection