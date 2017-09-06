@extends('layouts.app')
@section('title','Pagos')
@section('content') 

<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<!--<script>Mercadopago.setPublishableKey("TEST-aae00c59-e71b-4ffb-ae6c-010859b6713d");</script>-->
<script>Mercadopago.setPublishableKey("TEST-150ab2b6-bd3f-444b-ace5-952efb10d132");</script>


@include('recarga.pagospedientes');
  
  
  
 
{!! Form::open(['url' => 'recargas/procesarPago', 'class' => 'form-horizontal', 'id' => 'pay', 'name' => 'procesarpago', 'lang' => 'es', 'data-parsley-validate' => '']) !!}
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('Email', 'Email: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
             
        {!! Form::text('email', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'Email','id'=>'email']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}         
            
        </div>
        {!! Form::label('numtarjeta', 'Numero de Tarjeta: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('cardNumber', null, ['class' => 'form-control input-sm', 'required' => 'required','data-checkout'=>'cardNumber','placeholder'=>'4509 9535 6623 3704','id'=>'cardNumber']) !!}
            {!! $errors->first('fecha_cita', '<p class="help-block">:message</p>') !!}
        </div>
       
    </div>
    
   
  
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('codseg', 'Codigo de Seguridad: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
             
        {!! Form::text('securityCode', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'Código de Seguridad','id'=>'securityCode','data-checkout'=>'securityCode']) !!}
        {!! $errors->first('emails', '<p class="help-block">:message</p>') !!}         
            
        </div>
        {!! Form::label('expdate', 'Mes de Expiracin: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
        
        
        
        {!! Form::number('cardExpirationMonth', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => '01','id'=>'cardExpirationMonth','data-checkout'=>'cardExpirationMonth','maxlength'=>'2','size'=>'2','style'=>'width:60px;','min'=>'1','max'=>'99','oninput'=>'maxLengthCheck(this)']) !!}
            		  
            
            {!! $errors->first('fecha_citad', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    
    
   <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('codsegq', 'Aioo de expiracion: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
             

       {!! Form::number('cardExpirationYear', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => '01','id'=>'cardExpirationYear','data-checkout'=>'cardExpirationYear','maxlength'=>'2','size'=>'2','style'=>'width:60px;','oninput'=>'maxLengthCheck(this)']) !!}
       
        {!! $errors->first('emaisl', '<p class="help-block">:message</p>') !!}         
            
        </div>
        {!! Form::label('expdate', 'Nombre del Titular: ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('cardholderName', null, ['class' => 'form-control input-sm', 'required' => 'required','data-checkout'=>'cardholderName','placeholder'=>'Mes de Expiración','id'=>'cardholderName']) !!}
            {!! $errors->first('fecha_citasd', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    
    <div class="form-group {{ $errors->has('fecha_cita') || $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('codsergq', 'Nmero de Cdula: ', ['class' => 'col-sm-2 control-label']) !!}
     <div class="col-sm-3">
        {!! Form::text('docNumber', null, ['class' => 'form-control input-sm', 'required' => 'required','placeholder' => 'Número de Cédula','id'=>'docNumber','data-checkout'=>'docNumber']) !!}
        {!! $errors->first('emaissl', '<p class="help-block">:message</p>') !!}
    </div>
    </div>
               
     <input data-checkout="docType" type="hidden" value="CI-V"/>
     <input type="hidden" id="issuer" name="issuer">        
     <input type="hidden" id="installments" name="installments">
     <input id="amount" name="amount" type="hidden">
     <input id="monto" name="monto" type="hidden"> 	
     <input id="idpago" name="idpago" type="hidden">    
    
        
    <div class="col-sm-offset-2 col-sm-3"><!--   -->
            {!! Form::submit('Pagar Ahora', ['class' => 'btn btn-primary form-control', 'id' => 'pagar']) !!}
    </div>
    
                               
 {!! Form::close() !!}















@endsection
@section('script')
<script>
/*Mercadopago.getIdentificationTypes(function(estatus,response1){
	$.each(response1, function(key2, value2){
		$.each(value2, function(key3, value3){
		    console.log(key3 + ": " + value3);
		});
	});
});*/
function maxLengthCheck(object)
{
  if (object.value.length > object.maxLength)
    object.value = object.value.slice(0, object.maxLength)
}
var montotal=0;
$('.checkpago').on('click',function(){	
	var montotal=0;
	var acuImp=0;
	var idpagos = "0";
	var indexes = t1.rows().eq(0).filter( function (rowIdx)
	{
		obj = t1.cell( rowIdx, 4 ).nodes();
		obj1= obj[0].childNodes;
		chec = obj1[1].checked;
		if(chec)
		{
			montotal+= parseFloat(t1.cell( rowIdx, 3 ).data());
			idpagos=idpagos+"|"+t1.cell( rowIdx, 0 ).data();
		}
	});	
	//alert(idpagos);
	$("#montopago").html(montotal);
	$("#amount").val(montotal);
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


function addEvent(el, eventName, handler){
    if (el.addEventListener) {
           el.addEventListener(eventName, handler);
    } else {
        el.attachEvent('on' + eventName, function(){
          handler.call(el);
        });
    }
};

function getBin() {
    var ccNumber = document.querySelector('input[data-checkout="cardNumber"]');
    return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
};

function guessingPaymentMethod(event) {
    var bin = getBin();

    if (event.type == "keyup") {
        if (bin.length >= 6) {
            Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethodInfo);
        }
    } else {
        setTimeout(function() {
            if (bin.length >= 6) {
                Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
};

function setPaymentMethodInfo(status, response) {

	
    if (status == 200) {
        // do somethings ex: show logo of the payment method
        var form = document.querySelector('#pay');

        if (document.querySelector("input[name=paymentMethodId]") == null) {
            var paymentMethod = document.createElement('input');
            paymentMethod.setAttribute('name', "paymentMethodId");
            paymentMethod.setAttribute('type', "hidden");
            paymentMethod.setAttribute('value', response[0].id);

            form.appendChild(paymentMethod);
        } else {
            document.querySelector("input[name=paymentMethodId]").value = response[0].id;
        }
    }
};



addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', guessingPaymentMethod);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'change', guessingPaymentMethod);


//gerar token do cartÃ£o
doSubmit = false;
addEvent(document.querySelector('#pay'),'submit',doPay);
function doPay(event){
    event.preventDefault();
    if(!doSubmit){
        var form = document.querySelector('#pay');
        
        Mercadopago.createToken(form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

        return false;
    }
};


//verificar dados preenchidos e inserir token no form
function sdkResponseHandler(status, response) {
	//alert(status);

	$.each(response.cause, function(key, value){
		$.each(response.cause[key], function(key1, value1){
		    console.log(key1 + ": " + value1);
		});
	});
	
    if (status != 200 && status != 201) {
        alert("Introduzca los campos correctamente");
    }else{
       
        var form = document.querySelector('#pay');

        var card = document.createElement('input');
        card.setAttribute('name',"token");
        card.setAttribute('type',"hidden");
        card.setAttribute('value',response.id);
        form.appendChild(card);
        doSubmit=true;
        form.submit();
    }
};


//mostra as parcelas e os bancos
function getBin() {
    var cardSelector = document.querySelector("#cardId");
    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        return cardSelector[cardSelector.options.selectedIndex].getAttribute('first_six_digits');
    }
    var ccNumber = document.querySelector('input[data-checkout="cardNumber"]');
    return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
}

function clearOptions() {
    var bin = getBin();
    if (bin.length == 0) {
        document.querySelector("#issuer").style.display = 'none';
        document.querySelector("#issuer").innerHTML = "";

       // var selectorInstallments = document.querySelector("#installments"),
            fragment = document.createDocumentFragment(),
            option = new Option("Choose...", '-1');

       // selectorInstallments.options.length = 0;
        fragment.appendChild(option);
       // selectorInstallments.appendChild(fragment);
        //selectorInstallments.setAttribute('disabled', 'disabled');
    }
}

function guessingPaymentMethod(event) {
    var bin = getBin(),
        amount = document.querySelector('#amount').value;
    if (event.type == "keyup") {
        if (bin.length == 6) {
            Mercadopago.getPaymentMethod({
                "bin": bin,
                "amount": amount
            }, setPaymentMethodInfo);
        }
    } else {
        setTimeout(function() {
            if (bin.length >= 6) {
                Mercadopago.getPaymentMethod({
                    "bin": bin,
                    "amount": amount
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
};

function setPaymentMethodInfo(status, response) {
    if (status == 200) {
        // do somethings ex: show logo of the payment method
        var form = document.querySelector('#pay');

        if (document.querySelector("input[name=paymentMethodId]") == null) {
            var paymentMethod = document.createElement('input');
            paymentMethod.setAttribute('name', "paymentMethodId");
            paymentMethod.setAttribute('type', "hidden");
            paymentMethod.setAttribute('value', response[0].id);
            form.appendChild(paymentMethod);
        } else {
            document.querySelector("input[name=paymentMethodId]").value = response[0].id;
        }

        // check if the security code (ex: Tarshop) is required
        var cardConfiguration = response[0].settings,
            bin = getBin(),
            amount = document.querySelector('#amount').value;

        for (var index = 0; index < cardConfiguration.length; index++) {
            if (bin.match(cardConfiguration[index].bin.pattern) != null && cardConfiguration[index].security_code.length == 0) {
                /*
                * In this case you do not need the Security code. You can hide the input.
                */
            } else {
                /*
                * In this case you NEED the Security code. You MUST show the input.
                */
            }
        }

/*        Mercadopago.getInstallments({
            "bin": bin,
            "amount": amount
        }, setInstallmentInfo);
*/
        // check if the issuer is necessary to pay
        var issuerMandatory = false,
            additionalInfo = response[0].additional_info_needed;

        for (var i = 0; i < additionalInfo.length; i++) {
            if (additionalInfo[i] == "issuer_id") {
                issuerMandatory = true;
            }
        };
       /* if (issuerMandatory) {
            Mercadopago.getIssuers(response[0].id, showCardIssuers);
            addEvent(document.querySelector('#issuer'), 'change', setInstallmentsByIssuerId);
        } else {
            document.querySelector("#issuer").style.display = 'none';
            document.querySelector("#issuer").options.length = 0;
        }*/
    }
};

function showCardIssuers(status, issuers) {
    var issuersSelector = document.querySelector("#issuer"),
        fragment = document.createDocumentFragment();

    issuersSelector.options.length = 0;
    var option = new Option("Choose...", '-1');
    fragment.appendChild(option);

    for (var i = 0; i < issuers.length; i++) {
        if (issuers[i].name != "default") {
            option = new Option(issuers[i].name, issuers[i].id);
        } else {
            option = new Option("Otro", issuers[i].id);
        }
        fragment.appendChild(option);
    }
    issuersSelector.appendChild(fragment);
    issuersSelector.removeAttribute('disabled');
    document.querySelector("#issuer").removeAttribute('style');
};

function setInstallmentsByIssuerId(status, response) {
    var issuerId = document.querySelector('#issuer').value,
        amount = document.querySelector('#amount').value;

    if (issuerId === '-1') {
        return;
    }

    Mercadopago.getInstallments({
        "bin": getBin(),
        "amount": amount,
        "issuer_id": issuerId
    }, setInstallmentInfo);
};

function setInstallmentInfo(status, response) {
   /* var selectorInstallments = document.querySelector("#installments"),
        fragment = document.createDocumentFragment();

    selectorInstallments.options.length = 0;

    if (response.length > 0) {
        var option = new Option("Choose...", '-1'),
            payerCosts = response[0].payer_costs;

        fragment.appendChild(option);
        for (var i = 0; i < payerCosts.length; i++) {
            option = new Option(payerCosts[i].recommended_message || payerCosts[i].installments, payerCosts[i].installments);
            fragment.appendChild(option);
        }
        selectorInstallments.appendChild(fragment);
        selectorInstallments.removeAttribute('disabled');
    } */
};

function cardsHandler() {
	
    clearOptions();
    var cardSelector = document.querySelector("#cardId"),
        amount = document.querySelector('#amount').value;

    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        var _bin = cardSelector[cardSelector.options.selectedIndex].getAttribute("first_six_digits");
        Mercadopago.getPaymentMethod({
            "bin": _bin
        }, setPaymentMethodInfo);
    }
}

addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', guessingPaymentMethod);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', clearOptions);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'change', guessingPaymentMethod);
cardsHandler();



</script>
@endsection
