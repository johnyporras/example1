<div class="row">

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
                    <td><span>{{ $afiliado->nombre }}</td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Apellido</strong>
                    </td>
                    <td><span>{{ $afiliado->apellido }} </span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Correo</strong>
                    </td>
                    <td><span>{{ $afiliado->email }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Cédula</strong>
                    </td>
                    <td><span>{{ $afiliado->cedula }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Fecha Nacimiento</strong>
                    </td>
                    <td><span>{{ $afiliado->fecha_nacimiento->format('Y-m-d') }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Edad</strong>
                    </td>
                    <td><span>{{ $afiliado->fecha_nacimiento->age }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Lugar Nacimiento</strong>
                    </td>
                    <td><span>{{ $afiliado->id_estado }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ciudad</strong>
                    </td>
                    <td><span>{{ $afiliado->ciudad }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Estado Civil</strong>
                    </td>
                    <td><span>{{ $afiliado->civil }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Nro Hijos</strong>
                    </td>
                    <td><span>{{ $afiliado->hijos }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Teléfono</strong>
                    </td>
                    <td><span>{{ $afiliado->telefono }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ocupación</strong>
                    </td>
                    <td><span>{{ $afiliado->ocupacion or null }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Idioma</strong>
                    </td>
                    <td><span>{{ $afiliado->idioma or null }}</span></td>
                </tr>

            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div> 

    <div class="clearfix"></div>
    
    <!-- Contactos -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Contacto en caso de Emergencias</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-striped table-hover table-vcenter">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Parentesco</th>
                </tr>
            </thead>
            <tbody>
                @if (count($afiliado->contactos) == 0 )
                    <tr class="text-center">
                        <td colspan="3"><span>No posee contactos agregados</span></td>
                    </tr>
                @endif
            @foreach ($afiliado->contactos as $contacto)
                <tr>
                    
                    <td><span>{{ $contacto->nombre }}</span></td>
                    <td><span>{{ $contacto->telefono }}</span></td>
                    <td><span>{{ $contacto->parentesco }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pasatiempos -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Pasatiempo</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Pasatiempo</th>
                    <th>Frecuencia</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(3)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="2"><span>No posee pasatiempos agregados</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(3)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->frecuencia }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>   
</div>