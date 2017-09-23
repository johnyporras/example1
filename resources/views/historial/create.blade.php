@extends('layouts.app')
@section('title','Historial Médico')

@push('styles')
<link rel="stylesheet" href="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endpush

@push('scripts')
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ url('plugins/parsley-js/i18n/es.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-fileinput/js/fileinput_locale_es.js') }}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-notes"></i> Historial Médico <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/historial/lista') }}">Historial Médico</a></li>
        <li>Generar Solicitud</li>
    </ul>
@endsection

@section('content')


<div class="col-xs-12">
    {!! Form::open(['route'=>'historial.store', 'id' => 'historialForm', 'class' => 'form-horizontal', 'files' => true, 'name' => 'afiliado']) !!}
    
    <div class="row">
        <div class="col-xs-12">
            <div class="pb25">
                <h3>Historial Médico</h3>
            </div>
        </div>
    </div> <!-- row -->

    <!-- incluye formulario -->
    @include('historial.form') 
    <!-- incluye  formulario -->

        <div class="row">
       <div class="col-xs-12 col-md-2 pb15">
            <button type="button" class="btn btn-info btn-sm addButton" title="Agregar Examen"><span><i class="fa fa-plus"></i></span> Examen</button>
        </div>
    </div> <!-- row -->

    <div class="row">
    <!-- ============== Template para campos dinamicos ============== -->
        <div class="col-md-6 padre hide" id="template">
            
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('examenes') ? ' has-error' : '' }}">
                        {{ Form::label('examenes', 'Examen', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            {{ Form::file('examenes') }}
                            <span class="help-block">
                                <strong>Permitido: PDF, Imagen</strong>
                            </span>
                            @if ($errors->has('examenes'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('examenes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  --> 
                </div>

                <div class="col-xs-12 pb25">
                    <button type="button" class="btn btn-sm btn-danger removeButton pull-right" title="Quitar Examen"><span><i class="fa fa-close"></i></span></button>
                </div>
                
            </div> <!-- row -->
        </div>
    <!-- ============== Template para campos dinamicos ============== -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <hr>
            {{ Form::hidden('id_afiliado', $id) }}
        </div>
    </div> <!-- row -->

    <div class="row pb25">
       <div class="col-xs-12 col-md-2">
            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Generar Historial"><i class="fa fa-save fa-fw"></i> Generar</button>
        </div>
    </div> <!-- row -->

 {!! Form::close() !!}   

</div> <!-- .col-12 -->

<div class="clearfix"></div>
@endsection

@section('script')
<script>

$(document).ready(function() {

    // Contador
    var contador = 1;

    // Validar formulario
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
        errorTemplate: '<div class=" col-md-offset-4 col-md-8"></div>',
    };

    // Genero la validacion del formulario...
    $('#historialForm').parsley(parsleyOptions);

    /* Para fecha de solicitud*/
    $("#date").datepicker({
        language: "es",
        format: 'yyyy-mm-dd',
        endDate: '0'
    }).on('changeDate', function (selected) {     
        //valida el campo al cambiar
        $('#date').parsley(parsleyOptions).validate();
    });


    /************************************************************************/
    //funcion para colocar valores Dinamicos
    function setHistorial(index) {
        
        var $template = $('#template'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('data-index', index)
                            .insertBefore($template);

            // Update the name attributes
            $clone

                .find('[name="examenes"]').attr('name', 'examen[]')
                                            .attr('id', 'examen' + index).end();


        // adicionar campo documentos facturas requerido
        $("#examen"+index).parsley(parsleyOptions).addConstraint("required", "true");

        /*Para subir factura*/
        $('#examen' + index).fileinput({
            language: 'es',
            showUpload: false,
            removeClass: 'btn btn-danger',
            allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf']
        });
   
    }

    /*************************************************************************/

    // Add button click handler
    $('#historialForm').on('click', '.addButton', function() {
        setHistorial(contador++);
    });

    // Remove button click handler
    $('#historialForm').on('click', '.removeButton', function() {
        var $row  = $(this).parents('.padre'),
            index = $row.attr('data-index');
            // Remove element containing the fields
            $row.remove();
    });

    /*************************************************************************/


});    
</script>
@endsection