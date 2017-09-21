@extends('layouts.app')
@section('title','Pagos')
@section('content') 
<style>
th.dt-center, td.dt-center { text-align: center; }
</style>
@include('recarga.pagospedientes');
  

{!! Form::open(['url' => 'paypal/procesarPago', 'class' => 'form-horizontal', 'id' => 'pay', 'name' => 'procesarpago', 'lang' => 'es', 'method' => 'post']) !!}
    <input type="hidden" name="paymentType" value="Sale"/>
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('Primer', 'Nombre: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
             
        {!! Form::text('firstName', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'Email','id'=>'firstName']) !!}
        {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}         
        
    </div>
        
        
        {!! Form::label('ape', 'Apellido: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('lastName', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder'=>'Apellido','id'=>'lastName']) !!}
            {!! $errors->first('fecha_cita', '<p class="help-block">:message</p>') !!}
        </div>
       
    </div>
    
  <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('tiptar', 'Tipo de Tarjeta: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
              
            	{!! Form::select('creditCardType', array('visa' =>'Visa','masterdcard'=>'MasterdCard','amex'=>'American Express'), 'Visa'); !!}
    		
    </div>
    {!! Form::label('numtar', 'N&uacute;mero de Tarjeta: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
              
            	{!! Form::text('creditCardNumber', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder'=>'Número de Tarjeta']) !!}
    		
    </div>
  </div>
  
   <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('ddd', 'Mes de Expiraci&oacute;n: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
              
            	{!! Form::select('expDateMonth',
            	array('01' =>'01',
            		  '02'=>'02',
            		  '03'=>'03',
            		  '04' =>'04',
            		  '05'=>'05',
            		  '06'=>'06',
            		  '07' =>'08',
            		  '09'=>'09',
            		  '10'=>'10',
            		  '11' =>'11',
            		  '12'=>'12')) !!}
    		
    </div>
    {!! Form::label('wewe', 'A&ntilde;o de Expiraci&oacute;n: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
              
            	{!! Form::select('expDateYear',
            	array('2017' =>'2017',
            		  '2018'=>'2018',
            		  '2019'=>'2019',
            		  '2020' =>'2020',
            		  '2021'=>'2021',
            		  '2022'=>'2022',
            		  '2023' =>'2023',
            		  '2024'=>'2024',
            		  '2025'=>'2025',
            		  '2026' =>'2026',
            		  '2027'=>'2027',
            		  '2028'=>'2028',
            		  '2029'=>'2029')) !!}
    		
    </div>
  </div>
  
  
   <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('lsdl', 'C&oacute;digo de Seguridad: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
             
        {!! Form::text('cvv2Number', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'Codigo de seguridad','id'=>'ccv','style'=>'width:100px;']) !!}
        {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}         
        
    </div>  
      
    </div>

<input type="hidden" id="monto" name="monto">

<div class="col-sm-offset-2 col-sm-3">
            {!! Form::submit('Pagar Ahora', ['class' => 'btn btn-primary form-control', 'id' => 'pagar']) !!}
</div>
     <input id="idpago" name="idpago" type="hidden"> 
                               
 {!! Form::close() !!}



@endsection
@section('script')
<script>
var montotal=0;
$('.checkpago').on('click',function(){	
	var montotal=0;
	var acuImp=0;
	var idpagos="";
	var indexes = t1.rows().eq(0).filter( function (rowIdx)
	{
		obj = t1.cell( rowIdx, 4 ).nodes();
		obj1= obj[0].childNodes;
		chec = obj1[1].checked;
		if(chec)
		{
			
			numero =uf_convertir_monto2(t1.cell( rowIdx, 3 ).data());
			montotal+= parseFloat(numero);
			idpagos=idpagos+"|"+t1.cell( rowIdx, 0 ).data();
		}
	});	
	//alert(montotal);
	
	var string = numeral(montotal).format('$0,0.00');
	//alert(string);
	$("#montopago").html(string);
	$("#monto").val(montotal);
	$("#idpago").val(idpagos);

})



t1 = $('#table').DataTable({

	"columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
	"searching":false,
	"paging":false,
	"info":false
});
 

</script>
@endsection
