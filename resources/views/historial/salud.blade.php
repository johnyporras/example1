<div class="row">
    
    <div class="col-xs-12">
        <h4 class="sub-header">
            <span><i class="fa fa-user-md fa-fw"></i></span> <span>Información Medica</span>
        </h4>
        
        <table class="tEdit table table-borderless table-striped table-hover table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Sexo</strong>
                    </td>
                    <td><span>{{ $afiliado->sexo  }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Altura (CM)</strong>
                    </td>
                    <td><span>{{ $afiliado->altura }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Peso (KG)</strong>
                    </td>
                    <td><span>{{ $afiliado->peso }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width:30%;">
                        <strong>Índice de Masa Corporal (IMC)</strong>
                    </td>
                    <td><span class="calculo">
                        {{ $afiliado->imc($afiliado->altura, $afiliado->peso ) }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Grupo Sanguíneo</strong>
                    </td>
                    <td><span>{{ $afiliado->grupo_sangre }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿Usa Lentes?</strong>
                    </td>
                    <td><span>{{ $afiliado->lentes }}</span></td>
                </tr>
                <tr class="trl {{ ($afiliado->lentes == 'N')? 'hidden' : 'visible' }}">
                    <td class="text-right" style="width: 30%;">
                        <strong>Condición uso de Lentes</strong>
                    </td>
                    <td><span>{{ $afiliado->condicion_lentes }}</span></td>
                </tr>
                @if ($afiliado->sexo == 'F')
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿Esta Embarazada?</strong>
                    </td>
                    <td><span>{{ $afiliado->embarazada }}</span></td>
                </tr>
                <tr class="trh {{ ($afiliado->embarazada == 'N')? 'hidden' : 'visible' }}">
                    <td class="text-right" style="width: 30%;">
                        <strong>Semanas Embarazo</strong>
                    </td>
                    <td><span>{{ $afiliado->tiempo_gestacion }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ultima Menstruación</strong>
                    </td>
                    <td><span>{{ $afiliado->menstruacion }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Partos</strong>
                    </td>
                    <td><span>{{ $afiliado->partos }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Cesareas</strong>
                    </td>
                    <td><span>{{ $afiliado->cesarea }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Perdidas</strong>
                    </td>
                    <td><span>{{ $afiliado->perdidas }}</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Abortos</strong>
                    </td>
                    <td><span>{{ $afiliado->abortos }}</span></td>
                </tr>

               @endif
            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <h4 class="sub-header">
            <span><i class="fa fa-heartbeat fa-fw"></i></span> <span>Habitos y Estilo de vida</span>
        </h4>
    </div>

    <!-- drogas -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Consumo Alcohol, Cafe, Cigarrillos, etc...</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Sustancia</th>
                    <th>Cantidad</th>
                    <th>Frecuencia</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(1)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="3"><span>No posee algun habito agregado</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(1)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->cantidad }}</span></td>
                    <td><span>{{ $motivo->frecuencia }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- actividad Fisica -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Actividad Fisica</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Frecuencia</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(2)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="3"><span>No posee actividades agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(2)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->frecuencia }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <!-- alimentación -->
    <div class="col-xs-12">
        <h4 class="sub-header"><span>Alimentación</span></h4>
        <p>Dietas, Nro de ingestas, problemas alimenticios, intolerancias, etc...</p>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Causa</th>
                    <th>Frecuencia</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(4)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee valores agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(4)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->causa }}</span></td>
                    <td><span>{{ $motivo->frecuencia }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <h4 class="sub-header">
            <span><i class="fa fa-medkit fa-fw"></i></span> <span>Antecedentes Personales</span>
        </h4>
    </div>

    <!-- Vacunas -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Vacunas</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Vacuna</th>
                    <th>Fecha</th>
                    <th>comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(6)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="3"><span>No posee vacunas agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(6)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->fecha }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Discapacidades -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Discapacidades</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Discapacidad</th>
                    <th>Causa</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(7)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="3"><span>No posee discapacidades agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(7)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->causa }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <!-- Alergias -->
    <div class="col-xs-12">
        <h4 class="sub-header"><span>Alergias</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Alergia</th>
                    <th>Fecha Aparición</th>
                    <th>Tratamiento</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(5)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee alergias agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(5)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->fecha }}</span></td>
                    <td><span>{{ $motivo->tratamiento }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Hospitalizaciones -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Hospitalizaciones</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Causa</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(8)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee alergias agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(8)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->fecha }}</span></td>
                    <td><span>{{ $motivo->causa }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Operaciones -->
    <div class="col-md-6">
        <h4 class="sub-header"><span>Operaciones</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Operación</th>
                    <th>Fecha</th>
                    <th>Causa</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(9)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee operaciones agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(9)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}</span></td>
                    <td><span>{{ $motivo->fecha }}</span></td>
                    <td><span>{{ $motivo->causa }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <!-- Enfermedades Cronicas -->
    <div class="col-xs-12">
        <h4 class="sub-header"><span>Enfermedades Cronicas</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Enfermedad</th>
                    <th>Fecha Aparición</th>
                    <th>Tratamiento</th>
                    <th>Frecuencia Consulta</th>
                    <th>Profesional / Médico</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->motivoSelect(10)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="6"><span>No posee enfermedades cronicas agregadas</span></td>
                </tr>
            @endif
            @foreach ($afiliado->motivoSelect(10)->get() as $motivo)
                <tr>
                    <td><span>{{ $motivo->tipo }}"
                        data-title="Ingrese Enfermedad"
                        ></span></td>
                    <td><span>{{ $motivo->fecha }}</span></td>
                    <td><span>{{ $motivo->tratamiento }}</span></td>
                    <td><span>{{ $motivo->frecuencia }}</span></td>
                    <td><span>{{ $motivo->profecional }}</span></td>
                    <td><span>{{ $motivo->comentarios }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <h4 class="sub-header">
            <span><i class="fa fa-stethoscope fa-fw"></i></span> <span>Antecedentes Medicos</span>
        </h4>
    </div>

    <!-- Medicamentos -->
    <div class="col-xs-12">
        <h4 class="sub-header"><span>Medicamentos</span></h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Tipo Medicamento</th>
                    <th>Medicamento</th>
                    <th>Dosis</th>
                    <th>Frecuencia</th>
                    <th>Duración</th>
                    <th>Diagnostico</th>
                    <th>Recetado por</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>

            @if (count($afiliado->medicamentos) == 0 )
                <tr class="text-center">
                    <td colspan="9"><span>No posee medicamentos agregados</span></td>
                </tr>
            @endif
            @foreach ($afiliado->medicamentos as $medicamento)
                <tr>
                    <td><span>{{ $medicamento->id_tipo_medicamento }}/span></td>
                    <td><span>{{ $medicamento->nombre }}</span></td>
                    <td><span>{{ $medicamento->dosis }}</span></td>
                    <td><span>{{ $medicamento->frecuencia }}</span></td>
                    <td><span>{{ $medicamento->duracion }}</span></td>
                    <td><span>{{ $medicamento->diagnostico }}</span></td>
                    <td><span>{{ $medicamento->recetado }}</span></td>
                    <td class="text-center">
                    @if ($medicamento->file != null)
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" 
                            data-target="#modal" 
                            data-title="{{ $medicamento->file }}"
                            data-mime="{{ Storage::disk('documento')->mimeType($medicamento->file) }}" 
                            data-url="{{ route('profile.file', ['file' => $medicamento->file]) }}" 
                            title="Ver"><i class="fa fa-eye"></i>
                        </button>
                        <span class="btn btn-info btn-xs" 
                            href="{{ route('profile.file', ['file' => $medicamento->file]) }}" 
                            download="{{ $medicamento->file }}" 
                            title="Descargar"><i class="fa fa-download"></i>
                        </span>
                    @else
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
                            data-target="#modalUpload" 
                            data-id="{{ $medicamento->id }}"
                            data-tipo="medicamento"  
                            title="Subir"> <i class="fa fa-upload"></i>
                        </button>
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!--  El modal para mostrar los archivos -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>