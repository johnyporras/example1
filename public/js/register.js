$(document).ready(function() {
    // setup envio ajax token
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // default
    var validate = false;
    // Escondo los mensje por defecto
    $('#result').hide(); 
    
    /** Validar formulario **/
    var parsleyOptions = {
        errorClass: 'has-error',
        successClass: 'has-success',
        classHandler: function(el) {
            return el.$element.parents('.form-group');
        },
        errorsContainer: function(el) {
            return el.$element.closest('.form-group');
        },
        errorsWrapper: '<span class="help-block">',
        errorTemplate: '<div class=" col-md-offset-1 col-md-11"></div>',
    };

    // Genero la validacion del formulario...
    $('#checkForm').parsley(parsleyOptions);

    $('#cuentaForm').parsley(parsleyOptions);

    $('#afiliadoForm').parsley(parsleyOptions);


    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info btn-finish hidden')
        .on('click', function(){ });

    // Inicializo step form
    $('#wizard').smartWizard({ 
        selected: 0, 
        theme: 'default',
        transitionEffect:'fade',
        toolbarSettings: {
            toolbarPosition: 'bottom',
            toolbarExtraButtons: [btnFinish]
        },
        anchorSettings: {
            markDoneStep: true, // add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        lang:{
            next: 'Siguiente',
            previous: 'Atras'
        }
    });

    // Verifica si puede pasar al otro step
    $("#wizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection){
        // verifico si va adelante
        if(stepDirection === 'forward'){      
            if(validate == false){
                //validation failed
                return false;    
            }
        }else{
            validate = true;
            return true;
        }
        return true;
    });

    // Verifica si puede mostrar el ultimo boton para finalizar
    $("#wizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        // Enable finish button only on last step
        if(stepNumber == 1){ 
            validate = false; 
            console.log('estoy en 1');
        }

        if(stepNumber == 2){
            validate = false; 
            console.log('estoy en 2');
            //$('.btn-finish').removeClass('hidden');  
        }

    });

    /***********************************************************************/

    //Valida cambio del metodo de pago
    $("#plan").on('change', function() {
        // valido metodo para mostrar data adicional
        plan = this.value;
        //verifico valor
        if(plan == 17){
            $("#mascotas").addClass("hidden");
            $('#embarazada').attr('required','required');
            $("#maternidad").removeClass("hidden");
            $('.mascota').removeAttr('required','required');
        }else if(plan == 18){
            $("#mascotas").removeClass("hidden");
            $("#maternidad").addClass("hidden");
            $('.mascota').attr('required','required');
        }else{
            $("#mascotas").addClass("hidden");
            $("#maternidad").addClass("hidden");
            $('#embarazada').removeAttr('required','required');
            $('.mascota').removeAttr('required','required');
        }
    });

    //Valida si esta embarazada o no
    $("#embarazada").on('change', function() {
        // valido metodo para mostrar data adicional
        embarazada = this.value;
        //verifico valor
        if(embarazada == 'S'){
            $('#semanas').removeAttr('disabled','disabled');
            $('#semanas').attr('required','required');
        }else{
            $('#semanas').attr('disabled','disabled');
            $('#semanas').removeAttr('required','required');
        }
    }); 

    /* Para fecha de solicitud*/
    $('#fecha').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '-18y'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fecha').parsley(parsleyOptions).validate();
    });

    /* Para fecha de solicitud*/
    $('#fmascota').datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        startView: 2,
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#fmascota').parsley(parsleyOptions).validate();
    });

    /***********************************************************************/

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
                    validate = false;
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

     // Verificar tarjeta
    $('#cuentaForm').on('submit', function (e) {
        e.preventDefault();
        // Guardo el valor de la tarjeta ingresada..
        var producto = $('#producto').val();
        var plan = $('#plan').val();
        // Ejecuto la peticion para validar la tarjeta
        $.ajax({
            type: "GET",
            url:'/cuenta',
            data: {
                producto: producto,
                plan: plan
            },
            success: function(data) {
                // limpio el campo tarjeta
                //$("#tarjeta").val("");
                //Verifico la respuesta del servidor
                if (data.error) {
                    // Muestro mensaje de error
                    $('#result').show();
                    $('#result').removeClass('alert-success'); 
                    $('#result').addClass('alert-warning '); 
                    $('#result .text').text(data.error)
                } else {
                   console.log(data);
                    validate = true;
                }
            }
        });
    });

});