@extends('layouts.app')
@section('title','Detalle Paciente Atendido')
@section('content') 
<h4>Afiliado</h4>
@if (isset($clave))
    @foreach ($clave as $data_clave)    
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cédula del Afiliado</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Télefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data_clave->cedula_afiliado}}</td>
                    <td>{{ $data_clave->nombre}}</td>
                    <td>{{ date("d-m-Y",strtotime($data_clave->fecha_nacimiento))}}</td>
                    @if ($data_clave->sexo == 'M')
                      <td>Masculino</td>
                    @endif
                    @if ($data_clave->sexo == 'F')
                      <td>Femenino</td>
                    @endif
                    <td>{{ $data_clave->telefono}}</td>                                                            
                </tr>
            </tbody>
        </table>
    </div>
    <h4>Titular</h4>   
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Aseguradora</th>                    
                    <th>Colectivo</th>                                        
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data_clave->cedula_titular}}</td>
                    <td>{{ $data_clave->nombre_titular}}</td>
                    <td>{{ $data_clave->aseguradora}}</td>                    
                    <td>{{ $data_clave->colectivo}}</td>                                        
                </tr>
            </tbody>
        </table>
    </div>    
   <?php $cedula_afiliado =  $data_clave->cedula_afiliado; ?>
    @endforeach 
    <h4>Clave</h4>
    @foreach ($clave as $data_clave)    
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Contrato</th>
                    <th>Fecha Cita</th>                    
                    <th>Motivo</th>                                        
                    <th>Observaciónes</th>                                                            
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data_clave->clave}}</td>
                    <td>{{ $data_clave->contrato}}</td>
                    <td>{{ date("d-m-Y",strtotime($data_clave->fecha_cita))}}</td>                    
                    <td>{{ $data_clave->motivo}}</td>                                        
                    <td>{{ $data_clave->observaciones}}</td>                                                            
                </tr>
            </tbody>
        </table>
    </div>     
    <?php $clave =  $data_clave->clave; ?>
  @endforeach 
    <h4>Detalle Clave</h4> 
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Especialidad</th>
                    <th>Procedimiento</th>    
                    <th>Proveedor</th>   
                </tr>
            </thead>
            <tbody>
             @foreach ($clave_detalle as $detalle)       
                <tr>
                    <td>{{ $detalle->servicio}}</td>
                    <td>{{ $detalle->especialidad}}</td>
                    <td>{{ $detalle->procedimiento}}</td>                    
                    <td>{{ $detalle->proveedor}}</td>                                                    
                </tr>
             @endforeach    
            </tbody>
        </table>
    </div>         
    <h4>Atención Paciente</h4>
    @foreach ($pacienteatendido as $data_paciente)    
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Fecha Atención</th>
                    <th>Patologia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ date("d-m-Y",strtotime($data_paciente->fecha_atencion)) }}</td>
                    <td>{{ $data_paciente->patologia}}</td>
                </tr>
            </tbody>
        </table>
    </div>     
  @endforeach 
   <h4>Documentos</h4>
    <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($documentos as $data_documentos)        
                <tr>
                    <td>{{ $data_documentos->tipo_documento}}</td>
                    <td><a href="consultarDocumento?id_documento={{$data_documentos->id_documento}}&clave={{$clave}}&cedula_afiliado={{$cedula_afiliado}}">{{$data_documentos->file}}</a></td>
                </tr>
            @endforeach         
            </tbody>
        </table>
    </div>              
@endif
@endsection