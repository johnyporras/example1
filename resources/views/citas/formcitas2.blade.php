  
@extends('layouts.app')

@section('content')
    
        <h3>
            Solicitud Citas para videollamadas
        </h3>
    
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'citas.incluir']) !!}

                        
                            
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('cedula', 'C&eacute;dula Afiliado:') !!}
                                {!! Form::text('cedula', null, ['class' => 'form-control','id'=>'cedula']) !!}
                                {!! Form::hidden('afiliado', null, ['id' => 'afiliado']) !!}
                            </div>
                            
                            
                            <!-- Hora Field -->
                            <div class="form-group col-sm-6">
                           		<span id="nombreafiliado" style="font-weight:bold;"></span>
                            </div>     
                            
                            <!-- Descripcion Field -->
                            <div class="form-group col-sm-12 col-lg-12">
                                 {!! Form::label('Especialidad', 'Especialidad:') !!}
                                 <select class="form-control" name="id" id="id">
                                 		<option value="">Seleccione</option>
                                        @foreach($Especialidades as $item)
                                          <option value="{{$item->id}}" data-horario="{{$item->horario}}">{{$item->nomesp}}</option>
                                        @endforeach
              					  </select>
                            </div>
                            
                            <!-- Fechainicio Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('Fecha', 'Fecha:') !!}
                                {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
                            </div>
                            
                            
                            <!-- Hora Field -->
                            <div class="form-group col-sm-6">
                            {!! Form::label('Hora', 'Hora:') !!}
                           		<select class="form-control" name="hora" id="hora">
                                        @foreach($Horarios as $item)
                                          <option value="{{$item->id}}">{{$item->hora}}</option>
                                        @endforeach
              					  </select>
                            </div>
                            
                            <!-- Submit Field -->
                            <div class="form-group col-sm-12">
                                {!! Form::submit('Solicitar Cita', ['class' => 'btn btn-primary']) !!}
                                <a href="#" class="btn btn-default">Cancel</a>
                            </div>
                            


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
	var diasactual = [];
	$( "#fecha").datepicker({dateFormat: "dd/mm/yy"});
	$('#fecha').blur(function () 
	  {
	          var currentDate = new Date($(this).val());
	          dia = currentDate.getDay();
	          if(currentDate<new Date())
			{
				alert("Fecha invalida, la fecha debe ser mayor a la fecha de hoy");
				$(this).val('');
				return false;
			}
				
	          if((dia==0 || dia==6))
	          {
					alert("Fecha invalida, No puede seleecionar los sabados o domingos para la cita");
					$(this).val('');
					return false;
		      }

	          console.log(dia);
	          console.log(diasactual.indexOf(dia));
	         // alert(diasactual[0]);alert(diasactual[1]);
	          if(diasactual.indexOf(dia) == -1)
	          {
					alert("Fecha invalida, Este du00eda no estu00e1 disponible para la especialidad");
					$(this).val('');
					return false;
		      }
		      
	         

	          
	          arr=$(this).val().split("/");
	          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
	          $(this).val(newDate);
	  });

	  $('#fecha').change(function () 
	  {
	          var currentDate = $(this).val();


	          arr=currentDate.split("/");
	          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
	          $(this).val(newDate);

	         
	          
	          //alert(newDate);
	  });


  $('#id').on('change', function(e)
  {
      horariojson = $(this).find('option:selected').data('horario');
      diasactual = [];
      $.each(horariojson, function (key, val)
      {
    	  diasactual.push(val.dia);
      });
  }).change();


  $("#cedula").on('keypress',function(ev)
	{
	  var keycode = (ev.keyCode ? ev.keyCode : ev.which);
      if (keycode == '13')
      {
        cedula= $(this).val();
        if(cedula!="")
        {
            var url = 'getAfiliado';
         	var params = 
         	{
         		'cedula':cedula
         	}         	
         	 $.getJSON(url,params,function(data)
         	{	
              	console.log(data);
                     if(data.success==true)
                     {
                           $("#nombreafiliado").html(data.data.nombre);
                           $("#afiliado").val(data.data.id);
                     }
                     else
                     {
                    	 $("#nombreafiliado").html("no existe el afiliado");
                     }         		      
         	},'json');
         
        }
        return false;
      }
      
   })
</script>
@endsection

  
