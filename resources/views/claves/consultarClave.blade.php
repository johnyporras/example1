@extends('layouts.app')


@section('title','Consulta de Claves')

@section('content') 
{!! Form::open(['url' => 'claves/consultar', 'class' => 'form-horizontal', 'name' => 'consultar','method' => 'GET']) !!}
        
        <?php
             $user = Auth::user();
             $user_type =  $user->type;
        ?>

        <div class="form-group {{ $errors->has('ac_afiliados.nombre') || $errors->has('ac_claves.cedula_afiliado') ? 'has-error' : ''}}">
          {!! Form::label('fechadesde', 'Fecha desde: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! Form::text('fechadesde','',['id'=>'fechadesde']) !!}
              {!! $errors->first('ac_afiliados.nombre', '<p class="help-block">:message</p>') !!}
          </div>
         
          {!! Form::label('fechahasta', 'Fecha Hasta: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('fechahasta','',['id'=>'fechahasta']) !!}
              {!! $errors->first('ac_claves_cedula_afiliado', '<p class="help-block">:message</p>') !!}
          </div>
        </div>


        <div class="form-group {{ $errors->has('ac_afiliados.nombre') || $errors->has('ac_claves.cedula_afiliado') ? 'has-error' : ''}}">
          {!! Form::label('ac_afiliados.nombre', 'Nombre Paciente: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! Form::text('nombre') !!}
              {!! $errors->first('ac_afiliados.nombre', '<p class="help-block">:message</p>') !!}
          </div>
         
          {!! Form::label('cedula_afiliado', 'C.I: ', ['class' => 'col-sm-2 control-label']) !!}
         <div class="col-sm-3">
              {!! Form::text('cedula_afiliado') !!}
              {!! $errors->first('ac_claves_cedula_afiliado', '<p class="help-block">:message</p>') !!}
          </div>
        </div>      
        <div class="form-group {{ $errors->has('ac_claves.clave') || $errors->has('ac_estatus.id') ? 'has-error' : ''}}">

          {!! Form::label('ac_estatus.id', 'Estatus: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              <select name="codestatus" id="codestatus">
              <option value=''>Seleccione una opción</option>
              <?php
                foreach ($estatus as $key=>$value)
                {
                  //echo 
                  echo "<option value='{$key}'>{$value}</option>";
                }
              ?>
              </select>
          </div>
        </div>    
        <div class="form-group {{ $errors->has('ac_colectivos.codigo_colectivo') || $errors->has('ac_colectivos.codiogo_colectivo') ? 'has-error' : ''}}">
          
          {!! Form::label('ac_claves.clave', 'Clave: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              {!! Form::text('ac_claves.clave') !!}
              {!! $errors->first('ac_claves.clave', '<p class="help-block">:message</p>') !!}
          </div>  
        </div>   
        <div class="form-group {{ $errors->has('ac_proveedores_extranet.codigo_proveedor') || $errors->has('ac_colectivo.nombre') ? 'has-error' : ''}}">
        
        @if($user_type == 1 )
          {!! Form::label('user_types.id', 'Proveedores: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
              <select name="proveedor" id="proveedor">
              <option value=''>Seleccione una opción</option>
              <?php
                foreach ($prov as $key=>$value)
                {
                  echo "<option value='{$key}'>{$value}</option>";
                }
              ?>
              </select>
          </div>           
        @endif
        </div> 

     {!! Form::submit('Buscar') !!}

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


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  $( "#fechadesde" ).datepicker({dateFormat: "dd/mm/yyyy"});
  $( "#fechahasta" ).datepicker({ dateFormat:'dd/mm/yyyy' });


  $('#fechadesde, #fechahasta').blur(function () 
  {
          var currentDate = $(this).val();
          arr=currentDate.split("/");
          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
          $(this).val(newDate);
  });

  $('#fechadesde, #fechahasta').change(function () 
  {
          var currentDate = $(this).val();
          arr=currentDate.split("/");
          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
          $(this).val(newDate);
  });

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

 })
</script>
