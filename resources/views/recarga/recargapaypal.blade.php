@extends('layouts.app')
@section('title','Pagos')
@section('content') 
<style>
th.dt-center, td.dt-center { text-align: center; }
</style>
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
	var montotal=0;
	var acuImp=0;
	var indexes = t1.rows().eq(0).filter( function (rowIdx)
	{
		obj = t1.cell( rowIdx, 4 ).nodes();
		obj1= obj[0].childNodes;
		chec = obj1[1].checked;
		if(chec)
		{
			montotal+= parseFloat(t1.cell( rowIdx, 3 ).data());
		}
	});	
	//alert(acuMonto);
	$("#montopago").html(montotal);
	$("#amount").val(montotal);
	$("#monto").val(montotal);

})



t1 = $('#table').DataTable({

	"columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
	"searching":false,
	"paging":false,
	"info":false
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
