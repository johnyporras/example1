@extends('layouts.app')
@section('title','Aceptar Clave')
@section('content')
<hr/>
    
    
            {!! Form::open(['url' => 'claves/grabarClaveRechazar1','class' => 'form-horizontal', 'name' => 'beneficiario', 'id' => 'beneficiario']) !!}
            <div class="table">
   
    <div class="row">
           {!! Form::label('observa', 'Observaciones: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::textarea('observac','',['id'=>'observac']) !!}

              {!! Form::hidden('id',$id,['id'=>'id']) !!}
              {!! Form::hidden('idclaveprov',$idclaveprov,['id'=>'idclaveprov']) !!}
              {!! Form::hidden('tipo',$tipo,['id'=>'tipo']) !!}
              
          </div>
     </div>               
     <div class="row">
                <div class="col-sm-3 pull-left">
                    {!! Form::submit('Rechazar Cita', ['class' => 'btn btn-primary form-control', 'id' => 'seleccionar']) !!}
                </div>
      </div>
            {!! Form::close() !!}
@endsection
@section('script')
    <script>
     


    </script>
@endsection
