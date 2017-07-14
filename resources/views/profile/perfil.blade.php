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
        <table class="tpersona table table-borderless table-striped table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Nombre</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
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
                            data-pk="{{ $perfil->id }}" 
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
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Fecha Nacimiento</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="fecha_nacimiento"
                            data-value="{{ $perfil->fecha_nacimiento->format('d/m/Y') }}"
                            data-title="Ingrese Fecha Nacimiento"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Lugar Nacimiento</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="fecha_nacimiento"
                            data-value="{{ $perfil->estado->estado }}"
                            data-title="Ingrese Lugar Nacimiento"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ciudad</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="fecha_nacimiento"
                            data-value="{{ $perfil->ciudad }}"
                            data-title="Ingrese Ciudad"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Edad</strong>
                    </td>
                    <td><span>{{ $perfil->fecha_nacimiento->age }}</span></td>
                    <td style="width: 50px;"></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Sexo</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="sexo"
                            data-value="{{ ($perfil->sexo == 'M')? 'Masculino' : 'Femenino' }}"
                            data-title="Ingrese Sexo"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Estado Civil</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="civil"
                            data-value="{{ $perfil->civil or null }}"
                            data-title="Ingrese Estado Civil"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Nro Hijos</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="sexo"
                            data-value="{{ $perfil->hijos or null }}"
                            data-title="Ingrese nro Hijos"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Teléfono</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="fecha_nacimiento"
                            data-value="{{ $perfil->telefono }}"
                            data-title="Ingrese telefono"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ocupación</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="ocupacion"
                            data-value="{{ $perfil->ocupacion or null }}"
                            data-title="Ingrese Ocupación"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Idioma</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="idioma"
                            data-value="{{ $perfil->idioma or null }}"
                            data-title="Ingrese Fecha Nacimiento"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div> 
    
    <!-- Contactos -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="tooltip" data-original-title="Crear Nuevo"> <i class="fa fa-plus"></i></button> 
            <span>Contacto en caso de Emergencias</span>
        </h4>

        <table class="table table-colored table-condensed table-borderless table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="50"><span><i class="fa fa-trash"></i></span></th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="btn btn-sm btn-danger btn-circle sweet-danger" data-original-title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    <td><a class="xtext1" 
                        data-type="text"
                        data-pk="{{ $perfil->id }}" 
                        data-name="nombre"
                        data-value="{{ $perfil->nombre }}"
                        data-title="Ingrese Nombre"
                        ></a></td>
                    <td><a class="xtext1" 
                        data-type="text"
                        data-pk="{{ $perfil->id }}" 
                        data-name="nombre"
                        data-value="{{ $perfil->nombre }}"
                        data-title="Ingrese Nombre"
                        ></a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pasatiempos -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="tooltip" data-original-title="Crear Nuevo"> <i class="fa fa-plus"></i></button> 
            <span>Pasatiempos</span>
        </h4>

        <table class="table table-colored table-borderless table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="50"><span><i class="fa fa-trash"></i></span></th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="btn btn-sm btn-danger btn-circle sweet-danger" data-original-title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    <td><a class="xtext1" 
                        data-type="text"
                        data-pk="{{ $perfil->id }}" 
                        data-name="nombre"
                        data-value="{{ $perfil->nombre }}"
                        data-title="Ingrese Nombre"
                        ></a></td>
                    <td><a class="xtext1" 
                        data-type="text"
                        data-pk="{{ $perfil->id }}" 
                        data-name="nombre"
                        data-value="{{ $perfil->nombre }}"
                        data-title="Ingrese Nombre"
                        ></a></td>
                </tr>
            </tbody>
        </table>
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
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es Requerido.';
            }
        },
        url:'{{ route('perfil.editar') }}',
    });

    // para texto editable
    $('.xtext1').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es Requerido.';
            }
        },
        url:'{{ route('perfil.editar') }}',
    });

    // Para seleccionar editable en la tabla
    $('.tpersona tbody').on('click', '.b-edit', function (e) {
        e.preventDefault();
        e.stopPropagation();
       $(this).closest('tr').find('.editable').editable('show');  
    });

});
</script>
@endpush