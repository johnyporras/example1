@extends('layouts.app')
@section('title','Generar Clave')
@section('content')
<hr/>

<div class="col-xs-12">
<h4>Datos del Beneficiario</h4>
@if (isset($beneficiario))
    <div class="table">
        <table class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Cédula</th><th>Nombre</th><th>Tipo</th><th>Cobertura del Plan</th><th>Colectivo</th><th>Aseguradora</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $beneficiario['cedula_afiliado'] }}</td>
                    <td>{{ $beneficiario['nombre_afiliado'] }}</td>
                    <td>{{ $beneficiario['tipo_afiliado'] }}</td>
                    <td>{{ $beneficiario['plan'] }}</td>
                    <td>{{ $beneficiario['colectivo'] }}</td>
                    <td>{{ $beneficiario['aseguradora'] }}</td>
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
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                        </div>

                        <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                            <p><strong>{{ $afiliado->nombre }} {{ $afiliado->apellido }}</strong></p>
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td>User level:</td>
                                        <td>Administrator</td>
                                    </tr>
                                    <tr>
                                        <td>Registered since:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Topics</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>Warnings</td>
                                        <td>0</td>
                                    </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-sm btn-success" type="button"
                            data-toggle="tooltip"
                            data-original-title="Seleccionar"><i class="glyphicon glyphicon-ok"></i>
                    </button>
                        
                </div>
            </div>

        </div>
    @endforeach
    @endif
@endif

@endsection
@section('script')
    <script>

@endsection