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
        <h4 class="sub-header">
            <span><i class="fa fa-user fa-fw"></i></span> <span>Datos Basicos</span>
        </h4>

        <table class="tEdit table table-borderless table-striped table-hover table-vcenter">
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
                    <td><span class="xdate" 
                            data-type="date"
                            data-pk="{{ $perfil->id }}" 
                            data-name="fecha_nacimiento"
                            data-value="{{ $perfil->fecha_nacimiento->format('Y-m-d') }}"
                            data-title="Ingrese Fecha Nacimiento"
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
                        <strong>Lugar Nacimiento</strong>
                    </td>
                    <td><span class="xselect" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="id_estado"
                            data-value="{{ $perfil->id_estado }}"
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
                            data-name="ciudad"
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
                    <td class="text-right" style="width: 30%;">
                        <strong>Estado Civil</strong>
                    </td>
                    <td><span class="xcivil" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="civil"
                            data-value="{{ $perfil->civil }}"
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
                    <td><span class="xhijos" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="hijos"
                            data-value="{{ $perfil->hijos }}"
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
                    <td><span class="xphone" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="telefono"
                            data-value="{{ $perfil->telefono }}"
                            data-title="Ingrese Telefono"
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
                    <td><span class="xlang" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="idioma"
                            data-value="{{ $perfil->idioma or null }}"
                            data-title="Ingrese Idioma"
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

    <div class="clearfix"></div>
    
    <!-- Contactos -->
    <div class="col-md-6">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="modal" 
               data-target="#modalContactoo" title="Agregar"> <i class="fa fa-plus"></i></button> 
            <span>Contacto en caso de Emergencias</span>
        </h4>

        <table class="card table table-colored table-condensed table-borderless table-striped table-hover table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="35"><span><i class="fa fa-trash"></i></span></th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Parentesco</th>
                </tr>
            </thead>
            <tbody>

                @if (count($perfil->contactos) == 0 )
                    <tr class="text-center">
                        <td colspan="4"><span>No posee contactos agregados</span></td>
                    </tr>
                @endif
            @foreach ($perfil->contactos as $contacto)
                <tr>
                    <td>
                        <a href="/perfil/contacto/{{ $contacto->id }}" 
                            data-original-title="Eliminar" data-toggle="tooltip" 
                            class="btn btn-danger btn-xs sweet-danger">
                        <i class="fa fa-trash"> </i></a>
                    </td>
                    <td><a class="xtexto" href="#" 
                        data-type="text"
                        data-pk="{{ $contacto->id }}" 
                        data-name="nombre"
                        data-value="{{ $contacto->nombre }}"
                        data-title="Ingrese Nombre"
                        ></a></td>
                    <td><a class="xtelefono" href="#" 
                        data-type="number"
                        data-pk="{{ $contacto->id }}" 
                        data-name="telefono"
                        data-value="{{ $contacto->telefono }}"
                        data-title="Ingrese Teléfono"
                        ></a></td>
                    <td><a class="xtexto" href="#"
                        data-type="text"
                        data-pk="{{ $contacto->id }}" 
                        data-name="parentesco"
                        data-value="{{ $contacto->parentesco }}"
                        data-title="Ingrese Parentesco"
                        ></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pasatiempos -->
    <div class="col-md-6">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="modal" 
               data-target="#modalPtiempo" title="Agregar"> <i class="fa fa-plus"></i></button> 
            <span>Pasatiempo</span>
        </h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="35"><span><i class="fa fa-trash"></i></span></th>
                    <th>Pasatiempo</th>
                    <th>Frecuencia</th>
                </tr>
            </thead>
            <tbody>

            @if (count($perfil->motivoSelect(3)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="3"><span>No posee pasatiempos agregados</span></td>
                </tr>
            @endif
            @foreach ($perfil->motivoSelect(3)->get() as $motivo)
                <tr>
                    <td>
                        <a href="/perfil/motivo/{{ $motivo->id }}" 
                            data-original-title="Eliminar" data-toggle="tooltip" 
                            class="btn btn-danger btn-xs sweet-danger">
                        <i class="fa fa-trash"> </i></a>
                    </td>
                    <td><a class="xmotivo" href="#" 
                        data-type="text"
                        data-pk="{{ $motivo->id }}" 
                        data-name="tipo"
                        data-value="{{ $motivo->tipo }}"
                        data-title="Ingrese Pasatiempo"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="text"
                        data-pk="{{ $motivo->id }}" 
                        data-name="frecuencia"
                        data-value="{{ $motivo->frecuencia }}"
                        data-title="Ingrese Frecuencia"
                        ></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
    <!--  El modal para crear contacto -->
    <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nuevo Contacto</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.contacto', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                            {{ Form::label('nombre', 'Nombre', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('nombre', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre', 'id' => 'nombre', 'required']) }}
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                            {{ Form::label('telefono', 'Teléfono', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Teléfono', 'id' => 'telefono', 'pattern' => '^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$', 'minlength' => "11", 'maxlength' => '11', 'required']) }}
                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('parentesco') ? ' has-error' : '' }}">
                            {{ Form::label('parentesco', 'Parentesco', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('parentesco', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Parentesco', 'id' => 'parentesco', 'required']) }}
                                @if ($errors->has('parentesco'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parentesco') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::hidden('id_afiliado', $perfil->id) }}
                                <button type="submit" class="btn btn-sm btn-success" title="Guardar"><span><i class="fa fa-save"></i></span> Guardar</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><span><i class="fa fa-close"></i></span> Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--  El modal para crear pasatiempo -->
    <div class="modal fade" id="modalPtiempo" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nuevo Pasatiempo</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.motivo', 'class' => 'motivoForm form-horizontal']) }}
                    
                        <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            {{ Form::label('tipo', 'Pasatiempo', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('tipo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Pasatiempo', 'required']) }}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('frecuencia') ? ' has-error' : '' }}">
                            {{ Form::label('frecuencia', 'Frecuencia', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('frecuencia', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Frecuencia', 'required']) }}
                                @if ($errors->has('frecuencia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('frecuencia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::hidden('id_motivo', 3) }}
                                {{ Form::hidden('id_afiliado', $perfil->id) }}
                                <button type="submit" class="btn btn-sm btn-success" title="Guardar"><span><i class="fa fa-save"></i></span> Guardar</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><span><i class="fa fa-close"></i></span> Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('sub-script')
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
    //Fecha Nacimiento
    $('.xdate').editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'dd/mm/yyyy',    
        datepicker: {
            startView: 2,
            language: "es",
            endDate: '-18y',
        },
        toggle: 'manual',
        url:'{{ route('perfil.editar') }}',
    });
    //Estado
    $('.xselect').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        toggle: 'manual',
        mode: 'inline',
        source: {!! $estados !!}, 
        url:'{{ route('perfil.editar') }}',
    });
    // Nro de hijos
    $('.xhijos').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
            if($.isNumeric(value) == '') {
              return 'Solo se permiten numeros.';
            }
        },
        mode: 'inline', 
        toggle: 'manual',
        url:'{{ route('perfil.editar') }}',
    });
    //Estado civil
    $('.xcivil').editable({
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        source: [
            {value: 'SOLTERO', text: 'SOLTERO'},
            {value: 'CASADO', text: 'CASADO'},
            {value: 'DIVORCIADO', text: 'DIVORCIADO'},
            {value: 'VIUDO', text: 'VIUDO'}
        ],  
        url:'{{ route('perfil.editar') }}',
    });
    //Numero de telefono
    $('.xphone').editable({
        validate: function(value) {
            var regex = /^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$/;
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
            if(! regex.test(value)) {
                return 'Ingrese un Numero de Telefono Valido';
            }
        },
        mode: 'inline', 
        toggle: 'manual',
        url:'{{ route('perfil.editar') }}',
    })
    // Idioma
    $('.xlang').editable({
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        source: [
            {value: 'es', text: 'Español'},
            {value: 'en', text: 'Ingles'},
        ],  
        url:'{{ route('perfil.editar') }}',
    });

    /*********************************************************************************/
    // para texto editable
    $('.xtexto').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es Requerido.';
            }
        },
        url:'{{ route('perfil.contactoEditar') }}',
    });
    //Numero de telefono
    $('.xtelefono').editable({
        validate: function(value) {
            var regex = /^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$/;
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
            if(! regex.test(value)) {
                return 'Ingrese un Numero de Telefono Valido';
            }
        },
        url:'{{ route('perfil.contactoEditar') }}',
    })
    /*********************************************************************************/
    $('.xmotivo').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es Requerido.';
            }
        },
        url:'{{ route('perfil.motivoEditar') }}',
    });

});
</script>
@endpush