<div class="row">
    <!-- Customer Info -->
    <div class="col-xs-4">
        <div class="block-section text-right">
            
            @if ($usuario->imagen_perfil == null)
                <img src="{{ url('images/avatars/avatar.jpg') }}" width="100px" alt="avatar" class="img-thumbnail img-responsive">
            @else
                <img src="{{ url('images/avatars/'.$usuario->imagen_perfil) }}" width="100px" alt="avatar" class="img-thumbnail img-responsive">
            @endif
        </div>
    </div>

    <div class="col-xs-8">
        <div class="row">
            <div class="col-xs-12">
                <p>Pon tu foto. Una en la que salgas muy bien</p>
            </div>
            <div class="col-lg-7">

                {{ Form::open(['route'=>'perfil.image', 'files' => true, 'id' => 'imageForm']) }}
        
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                    {{ Form::file('image', ['id' => 'image', 'required' ]) }}
                    <span class="help-block">
                        <strong>Permitido: jpg, png</strong>
                    </span>
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- End .form-group  -->
            </div>
            {{ Form::close() }}  
        </div> <!-- .row -->
    </div>

    <div class="col-xs-12">
        <table id="tpersona" class="table table-borderless table-striped table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Nombre</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="1" 
                            data-name="nombre"
                            data-value="{{ $perfil->nombre }}"
                            data-title="Ingrese Nombre"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Apellido</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="1" 
                            data-name="apellido"
                            data-value="{{ $perfil->apellido }}"
                            data-title="Ingrese Apellido"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Correo</strong>
                    </td>
                    <td><span>{{ $perfil->email }}</span></td>
                    <td style="width: 50px;"></td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Cédula</strong>
                    </td>
                    <td><span>{{ $perfil->cedula }}</span></td>
                    <td style="width: 50px;"></td>
                </tr>

            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div>              
</div>

@push('persona')
<script>
$(document).ready(function() {

    // Para subir imagen
    $('#image').fileinput({
        language: 'es',
        //showUpload: false,
        showPreview: false,
        removeClass: 'btn btn-danger',
        browseClass: 'btn btn-primary',
        uploadClass: 'btn btn-success',
        mainClass: "input-group-sm",
        allowedFileExtensions : ['jpg', 'jpeg', 'png','pdf'],
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
    });
    // para texto editable
    $('.xtext').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es Requerido.';
            }
        },
        url:'{{ route('perfil.editar') }}',
    });

    // Para seleccionar editable en la tabla
    $('#tpersona tbody').on('click', '.b-edit', function (e) {
        e.preventDefault();
        e.stopPropagation();
       $(this).closest('tr').find('.editable').editable('show');  
    });

});
</script>
@endpush