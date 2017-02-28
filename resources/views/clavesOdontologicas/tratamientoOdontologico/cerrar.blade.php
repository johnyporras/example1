@extends('layouts.app')
@section('title','Cierre de Mes')
@section('content')
<hr/>
    {!! Form::open(['url' => 'tratamiento/procesarcierre', 'class' => 'form-horizontal', 'name' => 'buscar', 'lang' => 'es', 'data-parsley-validate' => '', 'id' => 'procesar']) !!}
        <div class="form-group {{ $errors->has('cedula') ? 'has-error' : ''}}">
            {!! Form::label('fecha_desde', 'Fecha Desde: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('fecha_desde', Input::old('fecha_desde'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'dd-mm-aaaa']) !!}
                {!! $errors->first('fecha_desde', '<p class="help-block">:message</p>') !!}
            </div>
            {!! Form::label('fecha_hasta', 'Fecha Hasta: ', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('fecha_hasta', Input::old('fecha_hasta'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'dd-mm-aaaa']) !!}
                {!! $errors->first('fecha_hasta', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
   <div class="form-group">    
      <div class="col-sm-offset-2 col-sm-2">  
            {!! Form::submit('Generar Cierre', ['class' => 'btn btn-primary form-control']) !!}
      </div>
    </div>    
{!! Form::close() !!}
@endsection
@section('script')
    <script>
        $(function(){
            $("#fecha_desde" ).datepicker({ minDate: -45, maxDate: "+0D", dateFormat: "dd-mm-yy", changeYear: true });
            $("#fecha_hasta" ).datepicker({ minDate: -45, maxDate: "+0D", dateFormat: "dd-mm-yy", changeYear: true });
            $('#procesar').parsley();
        });
    </script>
@endsection