@extends('layouts.app')
@section('title','Aceptar Clave')
@section('content')
<hr/>
    
    
            {!! Form::open(['url' => 'claves/grabarClaveAceptar','class' => 'form-horizontal', 'name' => 'beneficiario', 'id' => 'beneficiario']) !!}
            <div class="table">
    <div class="row">
          {!! Form::label('fechacita', 'Fecha Cita: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('fechacita','',['id'=>'fechacita']) !!}
              
          </div>
    </div>
    <div class="row">
          {!! Form::label('horacita', 'Hora Cita: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('horacita','',['id'=>'horacita']) !!}
              
          </div>
    </div>
    <div class="row">
          {!! Form::label('direccion', 'Dirección: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::textarea('direccion','',['id'=>'direccion']) !!}              
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
     
  $( "#fechacita" ).datepicker({dateFormat: "dd/mm/yyyy"});
  
    </script>
@endsection
