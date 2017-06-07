$(document).ready(function() {

    // setup envio ajax token
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     // Verificar tarjeta
    $('#checkForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var tarjeta = $('#tarjeta').val();
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "GET",
            url:'/check',
            data: {tarjeta: tarjeta},
            success: function(data) {
                // limpio el campo tarjeta
                $("#tarjeta").val("");
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result').show();
                    $('#result').removeClass('alert-success'); 
                    $('#result').addClass('alert-warning '); 
                    $('#result .text').text(data.error)
                } else {
                    // Desabilito los campos paa evitar errores
                    $('#valid').attr('disabled','disabled');
                    $('#tarjeta').attr('disabled','disabled');
                    // Muestro mensaje de exito
                    $('#result').show(); 
                    $('#result').removeClass('alert-warning'); 
                    $('#result').addClass('alert-success'); 
                    $('#result .text').text(data.success)
                    // Permito pasar al otro step del registro
                    validate = true;
                }
            }
        });
    });

});  