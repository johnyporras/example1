<div class="row">
    
    <div class="col-xs-12">
        <table class="tpersona table table-borderless table-striped table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Altura (CM)</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="altura"
                            data-value="{{ $perfil->altura or null }}"
                            data-title="Ingrese Altura"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Peso (KG)</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="peso"
                            data-value="{{ $perfil->peso or null }}"
                            data-title="Ingrese Peso"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Índice de Masa Corporal (IMC)</strong>
                    </td>
                    <td><span>calculo</span></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Grupo Sanguíneo</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="sangre"
                            data-value="{{ $perfil->sangre or null }}"
                            data-title="Ingrese Grupo Sanguineo"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
               @if ($perfil->sexo == 'M')

               <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿Esta Embarazada?</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="sangre"
                            data-value="{{ ($perfil->embarazada == 'N')? 'No' : 'Si' }}"
                            data-title="Ingrese un valor"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                   
               @endif
            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div>

    <!-- Vacunas -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="tooltip" data-original-title="Crear Nuevo"> <i class="fa fa-plus"></i></button> 
            <span>Vacunas</span>
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

    
    <!-- Discapacidades -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="tooltip" data-original-title="Crear Nuevo"> <i class="fa fa-plus"></i></button> 
            <span>Discapacidades</span>
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

    <!-- Alergias -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="tooltip" data-original-title="Crear Nuevo"> <i class="fa fa-plus"></i></button> 
            <span>Alergias</span>
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

});
</script>
@endpush