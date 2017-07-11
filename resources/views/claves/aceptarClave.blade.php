@extends('layouts.app')
@section('title','Aceptar Clave')
@section('content')


<hr/>


<table border="0">
                        <tr>
                            <td>Cedula del afiliado</td>
                            <td>{{ $data['cedula'] }}</td>
                              <td>Nombre del afiliado</td>
                            <td>{{ $data['nombreafiliado'].' '.$data['apafiliado'] }}</td>
                        </tr>
                        <tr>
                            <td>Telefono</td>
                            <td>{{ $data['telefono'] }}</td>
                             <td>Fecha de la cita</td>
                            <td>{{ $data['fecha_cita'] }}</td>
                        </tr>
                        <tr>
                            <td>Motivo</td>
                            <td>{{ $data['motivo'] }}</td>
                            <td>Observaciones</td>
                            <td>{{ $data['obser'] }}</td>
                        </tr>
                        <tr>
                            <td>Servicio</td>
                            <td>{{ $data['servicio'] }}</td>
                            <td>Especialidad</td>
                            <td>{{ $data['especialidad'] }}</td>
                        </tr>
                        <tr>
                            <td>Procedimiento</td>
                            <td>{{ $data['procedimiento'] }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

<hr/>
    
    
            {!! Form::open(['url' => 'claves/grabarClaveAceptar','class' => 'form-horizontal', 'name' => 'beneficiario', 'id' => 'beneficiario']) !!}
            <div class="table">
    <div class="row">
          {!! Form::label('fechacita', 'Fecha Cita: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('fechacita',$data['fecha_cita'],['id'=>'fechacita','readonly'=>true]) !!}
              
          </div>
    </div>
    <div class="row">
          {!! Form::label('horacita', 'Hora Cita: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('horacita','',['id'=>'horacita']) !!}
              
          </div>
    </div>
    <div class="row">
           {!! Form::label('observa', 'Observaciones: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::textarea('observac','',['id'=>'observac']) !!}

              {!! Form::hidden('id',$id,['id'=>'id']) !!}
              {!! Form::hidden('idclaveprov',$idclaveprov,['id'=>'idclaveprov']) !!}
              
          </div>
     </div>               
     <div class="row">
                <div class="col-sm-3 pull-center">
                    {!! Form::submit('Aceptar Cita', ['class' => 'btn btn-primary form-control', 'id' => 'seleccionar']) !!}
                </div>
      </div>
            {!! Form::close() !!}
@endsection
@section('script')
    <script>
     
//  $( "#fechacita" ).datepicker({dateFormat: "dd/mm/yy"});
  
    </script>
@endsection
