@extends('layouts.app')
@section('title','Pagos')
@section('content') 

@include('recarga.pagospedientes');
  
<div id="paypal-button"></div>
<input id="amount" name="amount" type="hidden">
<input id="monto" name="monto" type="hidden">

@endsection
@section('script')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
var montotal=0;
$('.checkpago').on('click',function(){
	
	monto = parseInt($(this).data('monto'));
	if(monto>0)
	{
		montotal=montotal+monto;
		actMonto();
	}
})


function actMonto()
{
	//alert(montotal);
	$("#montopago").html(montotal);
	$("#amount").val(montotal);
	$("#monto").val(montotal);
}

$('#table').DataTable({

	  "language": {
  	  	"search": "Buscar:",
	        "paginate": {
	            "first":    '',
	            "previous": '',
	            "next":     '',
	            "last":     ''
	        },
	        "aria": {
	            "paginate": {
	                "first":    'First',
	                "previous": 'Previous',
	                "next":     'Next',
	                "last":     'Last'
	            }
	        }
	    }
});


    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox'

        client: {
            sandbox:'AduXrz4I1oqqn058F1aoJOONqVgq18TJqKwNU3x-xay1soqFNaLXie4n2lx7jDjpCe80ZwCvzfRp1Kc3',
            production: 'xxxxxxxxx'
        },

        commit: true, // Show a 'Pay Now' button

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            
                        	"amount": {
                                "total": "3",
                                "currency": "USD"
                              },
                              "description": "The payment transaction description."
                           ,

                           'item_list': {
                               'items': [
                                 {
                                   "name": "Pago de recarga servicios atiempo",
                                   "sku": "1",
                                   "price": "3.00",
                                   "currency": "USD",
                                   "quantity": "1",
                                   "description": "Pago de recarga servicios atiempo",
                                   "tax": "0"
                                 }
                               ]
                           }
                        }
                    ]
                  
                }
            ,
            experience: {
                input_fields: {
                    no_shipping: 1
                }
            }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {

                // The payment is complete!
                alert("El pago se realizó con éxito");
                //alert(payment);
                // You can now show a confirmation message to the customer
            });
        }
        ,

        style: {
            size: 'responsive',
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        }
    }
    , '#paypal-button');
</script>
@endsection
