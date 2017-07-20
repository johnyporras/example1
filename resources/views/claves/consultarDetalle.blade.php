@extends('layouts.app')
@section('title','Detalle')
@section('content')
<h4>Afiliado</h4>
@if (isset($clave))
<?php
     $user = Auth::user();
     $user_type =  $user->type;
     $coduser =  $user->detalles_usuario_id
     //dd($user_type);
?>
  @foreach ($clave as $data_clave)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre y Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Télefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data_clave->cedula_afiliado}}</td>
                    <td>{{ $data_clave->nombre}}</td>
                    <td>{{ date("d-m-Y",strtotime($data_clave->fecha_nacimiento)) }}</td>
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
    @endforeach
    <h4>Clave</h4>
    @foreach ($clave as $data_clave)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                 @if($user_type !='3' && $user_type!='5')
                    <th>Clave</th>
                 @endif
                    <th>Cuenta</th>
                    <th>Fecha Cita</th>
                    <th>Motivo</th>
                    <th>Observaciónes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  @if($user_type !='3' && $user_type!='5')
                    <td>{{ $data_clave->clave}}</td>
                  @endif
                    <td>{{ $data_clave->contrato}}</td>
                    <td>{{ date("d-m-Y",strtotime($data_clave->fecha_cita)) }}</td>
                    <td>{{ $data_clave->motivo}}</td>
                    <td>{{ $data_clave->observaciones}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    {!! Form::hidden('id_clave', $data_clave->id_clave) !!}
    <?php $id_clave =  $data_clave->id_clave; ?>
  @endforeach
    <h4>Detalle Clave</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="detalle">Servicio</th>
                    <th class="detalle">Especialidad</th>
                    <th class="detalle">Procedimiento</th>
                    <th class="detalle">Proveedor</th>
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
    
    
    @if($user_type=='3' && $data_clave->estatus_clave==1)
    
    <?php //dd($detalleProv->preferido); ?>
    @if($detalleProv->preferido==1)
    {{	$tipo=1 }}
    @else
    {{	$tipo=2 }}
    @endif
       <table bgcolor="#6dcff6" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button" bgcolor="#6dcff6">
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('claves.aceptar',['id' => $data_clave->id_clave, 'idprov' => $detalleProv->id_proveedor]) }}" style="color: #ffffff; text-align: center; text-decoration: none;">Aceptar</a>
                            </td>    
                            <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button" bgcolor="#FF0000">
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('claves.rechazar',['id' =>$data_clave->id_clave, 'idprov' => $detalleProv->id_proveedor, 'tipo' =>$tipo ]) }}" style="color: #ffffff; text-align: center; text-decoration: none;">Rechazar</a>
                            </td>
                        </tr>
       </table>
	@endif                
   <!-- <div class="form-group">
      <div class="col-sm-offset-2 col-sm-3">
          <p><a href="{{ url('claves/pdfDetalle?id_clave='.$id_clave.'&accion=imprimir') }}"  target="_blank" class="btn btn-primary form-control ">Imprimir</a>
          </p>
      </div>
        <div class="col-sm-offset-2 col-sm-3">
          <p><a href="{{ url('claves/pdfDetalle?id_clave='.$id_clave.'&accion=descargar') }}" target="_blank" class="btn btn-primary form-control ">Descargar</a>
          </p>
        </div> -->
    </div>
@endif
@endsection
