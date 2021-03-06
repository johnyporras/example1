@extends('layouts.app')
@section('title','Generar Clave')
@section('content')
<hr/>
<h4>Datos del Beneficiario</h4>
@if (isset($beneficiario))
    <div class="table">
        <table class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>

                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Plan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $beneficiario['cedula_afiliado'] }}</td>
                    <td>{{ $beneficiario['nombre_afiliado'] }}</td>
                    <td>{{ $beneficiario['plan'] }}</td>

                </tr>
            </tbody>
        </table>
    </div>
@endif
<h4>Datos de la Atención</h4>
    {!! Form::open(['url' => 'claves/procesar', 'class' => 'form-horizontal', 'id' => 'procesar', 'name' => 'procesar', 'lang' => 'es', 'data-parsley-validate' => '']) !!}
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('Tipo', 'Tipo: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {{ Form::radio('tipoatencion', '2', false,['id' => 'tipoatenci']) }}M&eacute;dico
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ Form::radio('tipoatencion', '1',false,['id' => 'tipoatencion']) }}Odontol&oacute;gico
        </div>
        {!! Form::label('faecha_cita', 'Fecha de Atención: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('fecha_cita', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'dd-mm-aaaa','id'=>'fecha_cita2']) !!}
            {!! $errors->first('fecha_jcita', '<p class="help-block">:message</p>') !!}
        </div>
       
    </div>
    
    
    {!! Form::open(['url' => 'claves/procesar', 'class' => 'form-horizontal', 'id' => 'procesar', 'name' => 'procesar', 'lang' => 'es', 'data-parsley-validate' => '']) !!}
   
   
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('Estado', 'Estado: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
             <select class="form-control" name="estado" id="estado">
                @foreach($items as $item)
                  <option value="{{$item->id}}">{{$item->estado}}</option>
                @endforeach
              </select>
                        
            
        </div>
        {!! Form::label('ciudad', 'Ciudad: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('ciudad', null, ['class' => 'form-control input-sm','onchange'=>"validarFecha(this.value)", 'required' => 'required','placeholder' => 'Ciudad','id'=>'ciudad']) !!}
            {!! $errors->first('fecha_cita', '<p class="help-block">:message</p>') !!}
        </div>
       
    </div>
    
    
    
    
    
    
    
    
    <div class="form-group">
    
    	 {!! Form::label('telefono', 'Teléfono Móvil: ', ['class' => 'col-sm-1 col-sm-offset-1 control-label']) !!}
        <div class="col-sm-2">

            {!! Form::select('codigocel', ['0414' => '0414', '0424' => '0424','0412' =>'0412', '0416' => '0416', '0426' => '0426']) !!}
            {!! Form::number('telefono', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
     
    <div class="form-group">
    
    	 {!! Form::label('turno', 'Turno: ', ['class' => 'col-sm-1 col-sm-offset-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::select('turno', ['AM' => 'AM', 'PM' => 'PM','AMBOS' =>'AMBOS'],['id'=>'turno']) !!}
            {!! $errors->first('turno', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    
    
    <div class="form-group {{ $errors->has('motivo') ? 'has-error' : ''}}">
        {!! Form::label('motivo', 'Motivo: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('motivo', null, ['class' => 'form-control', 'rows' => '2']) !!}
            {!! $errors->first('motivo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{  $errors->has('codigo_servicio') || $errors->has('detalle_servicio') ? 'has-error' : ''}}">
        {!! Form::label('codigo_servicio', 'Tipo de Servicio: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('codigo_servicio', $servicios,null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción']) !!}
            {!! $errors->first('codigo_servicio', '<p class="help-block">:message</p>') !!}
        </div>
        {!! Form::label('detalle_servicio', 'Detalle Servicio: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::select('detalle_servicio', ['1' => 'Primera Vez', '2' => 'Control'], null, ['class' => 'form-control',
                            'placeholder' => 'Seleccione una opción']) !!}
            {!! $errors->first('detalle_servicio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('codigo_especialidad') ? 'has-error' : ''}}">
        {!! Form::label('codigo_especialidad', 'Especialidad: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-5" id='div_especialidad'>
            {!! Form::select('codigo_especialidad', $especialidades_cobertura,null, ['class' => 'form-control','placeholder' => 'Seleccione una opción']) !!}
            {!! $errors->first('codigo_especialidad', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{  $errors->has('procedimiento_medico') ? 'has-error' : ''}}">
        {!! Form::label('procedimiento_medico', 'Procedimiento Médico: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            <div id='div_procedimiento_medico'>
                {!! Form::select('procedimiento_medico',[''=>'Seleccione una opción'],null, ['class' => 'form-control']) !!}
            </div>
            {!! $errors->first('procedimiento_medico', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('codigo_proveedor') ? 'has-error' : ''}}">
        {!! Form::label('codigo_proveedor', 'Proveedor Preferido: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            @if (isset($proveedor))
                {!! Form::label('codigo_proveedor_creador', $proveedor->nombre, ['class' => 'control-label']) !!}
                {!! Form::hidden('codigo_proveedor_creador',$proveedor->codigo_proveedor,['class' => 'form-control']) !!}
                {!! Form::hidden('codigo_proveedor',$proveedor->nombre,['class' => 'form-control']) !!}
            @else
            <div id='div_proveedor'>
                <!--{!! Form::select('codigo_proveedor',[''=>'Seleccione una opción'],null, ['class' => 'form-control']) !!}-->
                {!! Form::text('codigo_proveedor', null, ['class' => 'form-control','id'=>'codigo_proveedor']) !!}
                {!! Form::hidden('codigo_proveedor_creador', null, ['id' => 'codigo_proveedor_creador', 'required' => 'required']) !!}
            </div>
            @endif
            {!! $errors->first('codigo_proveedor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group {{ $errors->has('codigo_proveedor') ? 'has-error' : ''}}">
        {!! Form::label('codigo_proveedor', 'Proveedor Secundario: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            @if (isset($proveedor))
                {!! Form::label('codigo_proveedor_creador', $proveedor->nombre, ['class' => 'control-label']) !!}
                {!! Form::hidden('codigo_proveedor_creador',$proveedor->codigo_proveedor,['class' => 'form-control']) !!}
                {!! Form::hidden('codigo_proveedor',$proveedor->nombre,['class' => 'form-control']) !!}
            @else
            <div id='div_proveedor'>
                <!--{!! Form::select('codigo_proveedor',[''=>'Seleccione una opción'],null, ['class' => 'form-control']) !!}-->
                {!! Form::text('codigo_proveedor2', null, ['class' => 'form-control','id'=>'codigo_proveedor2']) !!}
                {!! Form::hidden('codigo_proveedor_creador2', null, ['id' => 'codigo_proveedor_creador2', 'required' => 'required']) !!}
            </div>
            @endif
            {!! $errors->first('codigo_proveedor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-2">
            <button type="button" class="btn btn-sm btn-info btn-add-procedimiento">Agregar Procedimiento</button>
        </div>



    </div>
    <div id="resultproc"></div>
    <table id="procedimientos" class='table table-bordered table-striped table-hover table-responsive'>
        <thead>
            <tr>
                <th>Servicio</th><th>Especialidad</th><th>Procedimiento</th><th>Proveedor</th><th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <!--    <div class="form-group {{ $errors->has('cantidad_servicio') ? 'has-error' : ''}}">
        {!! Form::label('cantidad_servicio', 'Cantidad de Servicios: ', ['class' => 'col-sm-2 control-label', 'required' => 'required', 'step' => '1', 'min' => '0']) !!}
        <div class="col-sm-2">
            {!! Form::hidden('cantidad_servicio', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('cantidad_servicio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>-->
    <div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
        {!! Form::label('observaciones', 'Observaciones: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) !!}
            {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    {!! Form::hidden('max', 0, ['class' => 'form-control', 'required' => 'required','id' => 'max']) !!}
    {!! Form::hidden('cedula_afiliado', $beneficiario['cedula_afiliado'], ['class' => 'form-control','required' => 'required', 'id' => 'cedula_afiliado']) !!}
    {!! Form::hidden('codigo_contrato', $beneficiario['contrato'], ['class' => 'form-control','required' => 'required', 'id' => 'codigo_contrato']) !!}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-3"><!--   -->
            {!! Form::submit('Generar Clave', ['class' => 'btn btn-primary form-control', 'disabled' => 'disabled', 'id' => 'enviar_clave']) !!}
        </div>
    </div>
    
    
    
    
    
    
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Historial de consultas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="historicoCitas">
        
		


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    {!! Form::close() !!}
@endsection
@section('script')
    <script>

       
            //$( "#fecha_cita" ).datepicker({ minDate: -0, maxDate: "+4D", dateFormat: "dd-mm-yy", changeYear: true });
            $( "#fecha_cita2" ).datepicker();

          $('#fecha_cita2').blur(function () 
		  {
		          var currentDate = new Date($(this).val());
		          dia = currentDate.getDay();
		          if(dia==0 || dia==6)
		          {
						alert("Fecha invalida, No puede seleecionar los sabados o domingos para la cita");
						$(this).val('');
						return false;
			      }
		          if(currentDate<new Date())
					{
						alert("Fecha invalida, la fecha debe ser mayor a la fecha de hoy");
						$(this).val('');
						return false;
					}

		          
		          arr=$(this).val().split("/");
		          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
		          $(this).val(newDate);
		  });

		  $('#fecha_cita2').change(function () 
		  {
		          var currentDate = $(this).val();

  
		          arr=currentDate.split("/");
		          newDate=arr[1]+"/"+arr[0]+"/"+arr[2]; 
		          $(this).val(newDate);

		         
		          
		          //alert(newDate);
		  });

            $('#procesar').parsley();

            
            $("#codigo_especialidad").on('change',function(){
                getProcedimientos($(this).val(),$('#codigo_servicio').val());
            });

            
            $("#codigo_servicio").on('change',function(){
                getProcedimientos($('#codigo_especialidad').val(),$(this).val());
            });

            
            function getProcedimientos(especialidad,servicio){
                if(especialidad !== "" && servicio !== ""){
                    var data = {
                        'contrato': {{ $beneficiario['contrato'] }},
                        'cedula'  : {{ $beneficiario['cedula_afiliado'] }},
                        'especialidad': especialidad,
                        'servicio':  servicio,
                        'proveedor': proveedorX,
                        '_token': $('[name="_token"]').val()
                    };
                    var select = "";
                    $.post("{{url('selectProcedimientos')}}", data, function(data,select){
                        select = "<select class='form-control' id='procedimiento_medico' name='procedimiento_medico'>\n\
                                    <option selected='selected' value=''>Selecione una opción</option>";
                            $.each( data, function( key, val ) {
                                select = select + "<option value='" + key + "'>" + val + "</option>";
                              });
                            select = select + "</select>";
                            $("#div_procedimiento_medico").html(select);
//                            $("#procedimiento_medico").on('change',function(){
//                                getProveedor($('#codigo_especialidad').val(),$('#codigo_servicio').val(),$(this).val());
//                            });
                    });
                }
            }


			$("[name='tipoatencion']").on("click",function(){
				tipo = $(this).val();
				//alert(tipo);
				tipo2="";
				getEspecialidad(tipo,tipo2);
			});


			$("[name='detalle_servicio']").on("change",function(){
				detalleser = $(this).val();
				tipo = $("[name='tipoatencion']:checked").val();
				//alert(tipo);
				getEspecialidad(tipo,detalleser);

				if(detalleser==2)
				{
					//alert("aqui");
					mostrarHistorial();
				}
			});


			function mostrarHistorial()
			{
				//alert("llegate");
				$('#myModal').modal("show");
				tipo = $("[name='tipoatencion']").val();
				

				var data = {
                        '_token': $('[name="_token"]').val(),
                        'tipo':tipo 
                    };
                    
                    var select = "";
                    $.post("{{url('selectHistorico')}}", data, function(data,select){
				
                        if(data!="0")
                        {
                        	table = "<table class='table table responsive' id='table1' name='table1'>\n\
                                <tr><td>Fecha</td><td>Especialidad</td><td>Servicio</td><td>Motivo</td></tr>";
                                
                                $.each( data, function(k,key) {
                                    //alert(key);
                                	table = table + "<tr data-esp='"+key.codigo_especialidad+"' data-prov='"+key.codigo_proveedor+"' data-descesp='"+key.especialidad+"' data-descprov='"+key.proveedor+"' class='tr1'><td>"+key.fecha_cita+"</td><td>"+key.especialidad+"</td><td>"+key.servicio+"</td><td>"+key.proveedor+"</td></tr>";		
                                });
                                table = table + "</table>";
                         }
                        else
                        {
                            table  = "<p>No existe registro de una consulta de 1era. Vez con especialista de primer nivel atenci&oacute;n m&eacute;dica de nuestra red. Por favor gestionar cita de primer nivel de atenci&oacute;n para su evaluaci&oacute;n previo a la atenci&oacute;n de un especialista de segundo nivel de atenci&oacute;n</p>";
                        }
                        
                        $("#historicoCitas").html(table);

                        $('.tr1').on("click",function(){
							//alert(this('data').esp);
							
							$("#codigo_especialidad").empty();
							esp1="<option value='"+$(this).data('esp')+"'>"+$(this).data('descesp')+"</option>";
							$("#codigo_especialidad").append(esp1);
							 $( "#codigo_proveedor" ).val($(this).data('descprov'));
			                 $( "#codigo_proveedor_creador" ).val($(this).data('prov'));
			                 $('#myModal').modal('hide');
							
						})

                });
			}

			
            function getEspecialidad(tipo,detser){
                //alert(tipo);
                //alert(detser);
                //return false; 
                if(tipo !== ""){
                    var data = {
                        'contrato': {{ $beneficiario['contrato'] }},
                        'tipo': tipo,
                        '_token': $('[name="_token"]').val(),
                        'detser':detser
                    };
                    
                    var select = "";
                    $.post("{{url('selectEspecialidades')}}", data, function(data,select){
                        select = "<select class='form-control' id='codigo_especialidad' name='codigo_especialidad'>\n\
                                    <option selected='selected' value=''>Selecione una opción</option>";
                            $.each( data, function( key, val ) {
                                select = select + "<option value='" + key + "'>" + val + "</option>";
                              });
                            select = select + "</select>";
                            $("#div_especialidad").html(select);
//                            $("#procedimiento_medico").on('change',function(){
//                                getProveedor($('#codigo_especialidad').val(),$('#codigo_servicio').val(),$(this).val());
//                            });
                    });
                }
            }



            
            $( "#codigo_proveedor" ).autocomplete({

                delay: 0,
                source: function(request, response){

                    if($('#codigo_especialidad').val() !== "" && $('#codigo_servicio').val() !== "" && $('#procedimiento_medico').val() !== ""){
                        $.ajax( {
                          url       : "{{url('selectProveedores')}}",
                          dataType  : "json",
                          method    : "POST",
                          data: {
                            q: request.term.toUpperCase(),
                            'procedimiento' : $('#procedimiento_medico').val(),
                            'proveedor'     : proveedorX,
                            'estado'     : $('#estado').val(),
                            '_token'        : $('[name="_token"]').val()
                          },
                          success: function( data ) {
                            // Handle 'no match' indicated by [ "" ] response
                            response( data.length === 1 && data[ 0 ].length === 0 ? [] : data );
                          }
                        });
                    }else{
                        $("#result").addClass("alert alert-danger");
                        $("#result").html("Debe seleccionar todos los campos para agregar un Proveedor.");
                    }
                },
                focus: function( event, ui ) {
                    $( "#codigo_proveedor" ).val( ui.nombre );
                    return false;
                },
                select: function( event, ui ) {
                	if(ui.item.codigo_proveedor==$( "#codigo_proveedor_creador2" ).val())
                	{
                    	alert('Disculpe, los proveedores son pueden ser iguales');
                    }
                	else
                	{
                        $( "#codigo_proveedor" ).val( ui.item.nombre );
                        $( "#codigo_proveedor_creador" ).val( ui.item.codigo_proveedor );
                	}
                    return false;
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                //alert("")
                    return $( "<li>" )
                    .append( "<div>" + item.nombre + "<br></div>" )
                    .appendTo( ul );

            };


            $("#codigo_proveedor2" ).autocomplete({

                delay: 0,
                source: function(request, response){

                    if($('#codigo_especialidad').val() !== "" && $('#codigo_servicio').val() !== "" && $('#procedimiento_medico').val() !== ""){
                        $.ajax( {
                          url       : "{{url('selectProveedores')}}",
                          dataType  : "json",
                          method    : "POST",
                          data: {
                            q: request.term.toUpperCase(),
                            'procedimiento' : $('#procedimiento_medico').val(),
                            'proveedor'     : proveedorX,
                            'estado'     : $('#estado').val(),
                            '_token'        : $('[name="_token"]').val()
                          },
                          success: function( data ) {
                            // Handle 'no match' indicated by [ "" ] response
                            response( data.length === 1 && data[ 0 ].length === 0 ? [] : data );
                          }
                        });
                    }else{
                        $("#result").addClass("alert alert-danger");
                        $("#result").html("Debe seleccionar todos los campos para agregar un Proveedor.");
                    }
                },
                focus: function( event, ui ) {
                    $( "#codigo_proveedor2" ).val( ui.nombre );
                    return false;
                },
                select: function( event, ui ) {
                	if(ui.item.codigo_proveedor==$("#codigo_proveedor_creador").val())
                	{
                    	alert('Disculpe, los proveedores son pueden ser iguales');
                    }
                	else
                	{
                        $( "#codigo_proveedor2" ).val( ui.item.nombre );
                        $( "#codigo_proveedor_creador2" ).val( ui.item.codigo_proveedor );
                	}
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                //alert("")
                    return $( "<li>" )
                    .append( "<div>" + item.nombre + "<br></div>" )
                    .appendTo( ul );

            };

            
//            function getProveedor(especialidad,servicio,procedimiento){
//                if(especialidad !== "" && servicio !== "" && procedimiento !== ""){
//                    var data = {
//                        'procedimiento': procedimiento,
//                        'especialidad': especialidad,
//                        'servicio': servicio,
//                        'proveedor': proveedorX,
//                        '_token': $('[name="_token"]').val()
//                    };
//                    var select = "";
//                    $.post("{{url('selectProveedores')}}", data, function(data,select){
//                        select = "<select class='form-control' id='codigo_proveedor' name='codigo_proveedor'>\n\
//                                    <option selected='selected' value=''>Selecione una opción</option>";
//                            $.each( data, function( key, val ) {
//                                select = select + "<option value='" + key + "'>" + val + "</option>";
//                              });
//                            select = select + "</select>";
//                            $("#div_proveedor").html(select);
//                    });
//                }else{
//                    $("#result").addClass("alert alert-danger");
//                    $("#result").html("Debe seleccionar todos los campos para agregar un Proveedor.");
//                }
//            }
            $('table').on('click', '.btnAdd', function(){
                var itemIndex = $(this).closest('tr').index();
                var tr = "<tr><td><input type=text value=0 id= unit_" + itemIndex + "></input</td><td><input type=text value=0 id=rate></input></td><td><input type=button value=Add class=btnAdd></input></td></tr>";
                $(this).closest('table').append(tr);
                $(this).attr('value', 'Delete');
                $(this).toggleClass('btnDelete').toggleClass('btnAdd');
            }).on('click', '.btn-del-procedimiento', function(){
                //alert($(this).closest('tr').index());
                $(this).closest('tr').remove();
                if(a){
                    $('#codigo_servicio').append("<option value=1>Consulta</option>");
                    a = false;
                }
//                else if(b){
//                    $('#codigo_servicio').append("<option value=3>Estudio</option>");
//                    b = false;
//                }
                $('#max').val($('#max').val()-1);
                x--;
                if($('#max').val() == 0){
                    proveedorX = '';
                    $('#codigo_proveedor').prop('disabled', false);
                    $('#codigo_proveedor2').prop('disabled', false);
                    $('#codigo_especialidad').prop('disabled', false);
                    $('#enviar_clave').prop('disabled', true);
                }
                $("#resultproc").html("");
                $("#resultproc").removeClass("alert alert-danger");
            });;
            var x = 0, a = false, b = false, proveedorX = '';

            $('.btn-add-procedimiento').on('click',function(){

                if(x==1)
                {
                    $("#resultproc").addClass("alert alert-danger");
                    $("#resultproc").html("No puede agregar más de  un procedimientos.");
                    return false;
                }

                
                /*alert($('#estado').val());
                alert($('#ciudad').val());
                alert($('#turno').val());*/

                 if($('#codigo_especialidad').val() !== "" && $('#codigo_servicio').val() !== "" && $('#procedimiento_medico').val() !== "" && $('#codigo_proveedor_creador').val() !== ""){
                    var especialidad = "<input type='hidden' value='"+ $('#codigo_especialidad').val() +"' name='id_especialidad" + x +"' id='id_especialidad" + x +"'>";
                    var servicio     = "<input type='hidden' value='"+ $('#codigo_servicio').val() +"' name='id_servicio" + x +"' id='id_servicio" + x +"'>";
                    var tratamiento  = "<input type='hidden' value='"+ $('#procedimiento_medico').val() +"' name='id_tratamiento" + x +"'>";
                    var proveedor    = "<input type='hidden' value='"+ $('#codigo_proveedor_creador').val() +"' name='id_proveedor" + x +"'>";
                    var proveedor2    = "<input type='hidden' value='"+ $('#codigo_proveedor_creador2').val() +"' name='id_proveedor2" + x +"'>";
                    var detalle      = "<input type='hidden' value='"+ $('#detalle').val() +"' name='detalle" + x +"'>";
                    var estado      = "<input type='hidden' value='"+ $('#estado').val() +"' name='estado" + x +"'>";
                    var ciudad      = "<input type='hidden' value='"+ $('#ciudad').val() +"' name='ciudad" + x +"'>";
                    var turno      = "<input type='hidden' value='"+ $('#turno').val() +"' name='turno" + x +"'>";
                    proveedorX       = $('#codigo_proveedor_creador').val();
                    $('#procedimientos').append("<tr class='fila" + x +"'><td>"+$("#codigo_servicio option:selected").text()+"</td>"+
                                                "<td>"+$("#codigo_especialidad option:selected").text()+"</td>"+
                                                "<td>"+$("#procedimiento_medico option:selected").text()+"</td>"+
                                                "<td>"+$("#codigo_proveedor").val()+"</td>"+
                                                "<td><button type='button' class='btn btn-sm btn-danger btn-del-procedimiento'"+
                                                ">Quitar</button></td>"
                                                +especialidad+servicio+tratamiento+proveedor+proveedor2+detalle+estado+ciudad+turno+"</tr>");
                    x++;
                    if($('#codigo_servicio :selected').val() != 2 && $('#codigo_servicio :selected').val() != 3){ // Si no es laboratorio
                        if($('#codigo_servicio :selected').val() == 1){
                            a = true;
                        }else{
                            b = true;
                        }
                        $('#codigo_servicio :selected').remove();
                    }
                    //$('#codigo_especialidad').val("");
                    //$('#codigo_servicio').val("");
                    $('#procedimiento_medico').val("");
                    //$('#codigo_proveedor').val("");
                    $('#codigo_proveedor').prop('disabled', true);
                    $('#codigo_proveedor2').prop('disabled', true);
                    $('#codigo_especialidad').prop('disabled', true);
                    //$('#codigo_proveedor_creador').val("");
                    //$('#detalle_servicio').val("");
                    $('#max').val(x);
                    $("#resultproc").html("");
                    $("#resultproc").removeClass("alert alert-danger");
                    $('#enviar_clave').prop('disabled', false);
                }else{
                    $("#resultproc").addClass("alert alert-danger");
                    $("#resultproc").html("Debe seleccionar todos los campos para agregar un Procedimiento.");
                }
            });
        

        function validarFecha(fechaCita){
                var fechaArr = fechaCita.split('-');
                var aho = fechaArr[2];
                var mes = fechaArr[1];
                var dia = fechaArr[0];
                var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0
                if ((plantilla.getDay() == 6) ||(plantilla.getDay() == 7)) {
                   $("#fecha_cita").focus();
                   $("#result").addClass("alert alert-danger");
                   $("#result").html("No se pueden otorgar Claves los dias Sabados y Domingos.");
                   $('#enviar_clave').prop('disabled', true);
                   return false;
                }else{
                       return true;
                     }
            }
    </script>
@endsection
