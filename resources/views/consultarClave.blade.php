@extends('layouts.app')
@section('title','Consulta de Claves')

@section('content') 
{!! Form::open(['url' => 'claves/consultar', 'class' => 'form-horizontal', 'name' => 'consultar','method' => 'GET']) !!}
        {!! $filter->render('ac_claves.fecha_cita') !!}
        <?php
             $user = Auth::user();
             $user_type =  $user->type;
        ?>   
        <div class="form-group {{ $errors->has('ac_afiliados.nombre') || $errors->has('ac_claves.cedula_afiliado') ? 'has-error' : ''}}">
          {!! Form::label('ac_afiliados.nombre', 'Nombre Paciente: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! $filter->field('ac_afiliados.nombre',['onchange'=>"ValidarAlpha(this.value,'ac_afiliados_nombre')"]) !!}
              {!! $errors->first('ac_afiliados.nombre', '<p class="help-block">:message</p>') !!}
          </div>
         
          {!! Form::label('ac_claves.cedula_afiliado', 'C.I: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! $filter->field('ac_claves.cedula_afiliado') !!}
              {!! $errors->first('ac_claves_cedula_afiliado', '<p class="help-block">:message</p>') !!}
          </div>
        </div>      
        <div class="form-group {{ $errors->has('ac_claves.clave') || $errors->has('ac_estatus.id') ? 'has-error' : ''}}">

          {!! Form::label('ac_estatus.id', 'Estatus: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! $filter->field('ac_estatus.id',['selected', 'value'=>''] )!!}
              {!! $errors->first('ac_estatus.id', '<p class="help-block">:message</p>') !!}
          </div>
        </div>    
        <div class="form-group {{ $errors->has('ac_colectivos.codigo_colectivo') || $errors->has('ac_colectivos.codiogo_colectivo') ? 'has-error' : ''}}">
          
          {!! Form::label('ac_claves.clave', 'Clave: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! $filter->field('ac_claves.clave') !!}
              {!! $errors->first('ac_claves.clave', '<p class="help-block">:message</p>') !!}
          </div>  
        </div>    
        <div class="form-group {{ $errors->has('ac_proveedores_extranet.codigo_proveedor') || $errors->has('ac_colectivo.nombre') ? 'has-error' : ''}}">
        
        @if($user_type == 1 )
          {!! Form::label('user_types.id', 'Usuarios: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! $filter->field('user_types.id',['selected', 'value'=>'']) !!}
              {!! $errors->first('user_types.id', '<p class="help-block">:message</p>') !!}
          </div>           
        @endif
        </div>

        <div class="form-group {{ $errors->has('ac_proveedores_extranet.codigo_proveedor') || $errors->has('ac_colectivo.nombre') ? 'has-error' : ''}}">
        
        @if($user_type == 1 )
          {!! Form::label('user_types.id', 'Proveedores: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! $filter->field('ac_proveedores_extranet.id',['selected', 'value'=>'']) !!}
              {!! $errors->first('ac_proveedores_extranet.id', '<p class="help-block">:message</p>') !!}
          </div>           
        @endif
        </div>
         
  {!!$filter->footer!!}    
  {!!$grid!!}    
       <div class="table-responsive">    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Otorgadas</th>
                    <th>Aprobadas</th>
                    <th>Rechazadas</th>                    
                    <th>Consultas</th>                                        
                    <th>Laboratorios</th>                                                            
                    <th>Estudios</th>                                                                                
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td >{{$claves['otorgadas']}}</td>
                    <td>{{ $claves['aprobadas']}}</td>
                    <td>{{ $claves['rechazadas']}}</td>
                    <td>{{ $claves['consultas']}}</td>
                    <td>{{ $claves['laboratorios']}}</td>
                    <td>{{ $claves['consultas']}}</td>                    
                </tr>
            </tbody>
        </table>
    </div>    
  {{ Form::close() }}
@endsection
@section('script')
<script>
 function ValidarAlpha(valor,campo){
     var charRegExp = /^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/;
     var valor1 = valor;
             if (charRegExp.test(valor1)== true)
             {
                  return true;
              }else{ 
                  $("#result").addClass("alert alert-danger");
                  $("#result").html("Debe introducir solo carácteres Alfabéticos"); 
                  $("#"+campo).focus(); 
                   return false;
               }       
          };
    $("#fecha_desde" ).datepicker({ dateFormat: "dd/mm/yy" });
    $("#fecha_hasta" ).datepicker({ dateFormat: "dd/mm/yy" });
</script>
@endsection