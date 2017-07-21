<div class="row">
    
    <div class="col-xs-12">
        <table class="tEdit table table-borderless table-striped table-hover table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Sexo</strong>
                    </td>
                    <td><span class="xsexo" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="sexo"
                            data-value="{{ $perfil->sexo  }}"
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
                        <strong>Altura (CM)</strong>
                    </td>
                    <td><span class="xaltura" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="altura"
                            data-value="{{ $perfil->altura }}"
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
                    <td><span class="xpeso" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="peso"
                            data-value="{{ $perfil->peso }}"
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
                    <td><span class="calculo">
                        {{ $perfil->imc($perfil->altura, $perfil->peso ) }}</span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Grupo Sanguíneo</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="grupo_sangre"
                            data-value="{{ $perfil->grupo_sangre }}"
                            data-title="Ingrese Grupo Sanguineo"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿Usa Lentes?</strong>
                    </td>
                    <td><span class="xchoice" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="lentes"
                            data-value="{{ $perfil->lentes }}"
                            data-title="¿Usa Lentes o Anteojos?"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr class="trl {{ ($perfil->lentes == 'N')? 'hidden' : 'visible' }}">
                    <td class="text-right" style="width: 30%;">
                        <strong>Condición uso de Lentes</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="condicion_lentes"
                            data-value="{{ $perfil->condicion_lentes }}"
                            data-title="Ingrese ´condición uso lentes"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @if ($perfil->sexo == 'F')
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿Esta Embarazada?</strong>
                    </td>
                    <td><span class="xembarazo" 
                            data-type="select"
                            data-pk="{{ $perfil->id }}" 
                            data-name="embarazada"
                            data-value="{{ $perfil->embarazada }}"
                            data-title="Ingrese un valor"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr class="trh {{ ($perfil->embarazada == 'N')? 'hidden' : 'visible' }}">
                    <td class="text-right" style="width: 30%;">
                        <strong>Semanas Embarazo</strong>
                    </td>
                    <td><span class="xsemanas" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="tiempo_gestacion"
                            data-value="{{ $perfil->tiempo_gestacion }}"
                            data-title="Ingrese semanas de embarazo"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Ultima Menstruación</strong>
                    </td>
                    <td><span class="xtext" 
                            data-type="text"
                            data-pk="{{ $perfil->id }}" 
                            data-name="menstruacion"
                            data-value="{{ $perfil->menstruacion }}"
                            data-title="Ingrese ultima menstruación"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Partos</strong>
                    </td>
                    <td><span class="xnumber" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="partos"
                            data-value="{{ $perfil->partos }}"
                            data-title="Ingrese Nro Partos"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Cesareas</strong>
                    </td>
                    <td><span class="xnumber" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="cesarea"
                            data-value="{{ $perfil->cesarea }}"
                            data-title="Ingrese Cantidad de Cesareas"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Perdidas</strong>
                    </td>
                    <td><span class="xnumber" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="perdidas"
                            data-value="{{ $perfil->perdidas }}"
                            data-title="Ingrese Cantidad de Perdidas"
                            ></span></td>
                    <td style="width: 50px;">
                        <button type="button" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Cantidad de Abortos</strong>
                    </td>
                    <td><span class="xnumber" 
                            data-type="number"
                            data-pk="{{ $perfil->id }}" 
                            data-name="abortos"
                            data-value="{{ $perfil->abortos }}"
                            data-title="Ingrese cantidad de Abortos"
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
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="modal" 
               data-target="#modalVacuna" title="Agregar"> <i class="fa fa-plus"></i></button> 
            <span>Vacunas</span>
        </h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="35"><span><i class="fa fa-trash"></i></span></th>
                    <th>Vacuna</th>
                    <th>Fecha</th>
                    <th>comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($perfil->motivoSelect(6)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee vacunas agregadas</span></td>
                </tr>
            @endif
            @foreach ($perfil->motivoSelect(6)->get() as $motivo)
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
                    <td><a class="xfecha" href="#" 
                        data-type="date"
                        data-pk="{{ $motivo->id }}" 
                        data-name="fecha"
                        data-value="{{ $motivo->fecha }}"
                        data-title="Ingrese Fecha"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="textarea"
                        data-pk="{{ $motivo->id }}" 
                        data-name="comentarios"
                        data-value="{{ $motivo->comentarios }}"
                        data-title="Ingrese comentarios"
                        ></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Discapacidades -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="modal" 
               data-target="#modalDiscap" title="Agregar"> <i class="fa fa-plus"></i></button> 
            <span>Discapacidades</span>
        </h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="35"><span><i class="fa fa-trash"></i></span></th>
                    <th>Discapacidad</th>
                    <th>Causa</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($perfil->motivoSelect(7)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="4"><span>No posee discapacidades agregadas</span></td>
                </tr>
            @endif
            @foreach ($perfil->motivoSelect(7)->get() as $motivo)
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
                        data-title="Ingrese Discapacidad"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="text"
                        data-pk="{{ $motivo->id }}" 
                        data-name="causa"
                        data-value="{{ $motivo->causa }}"
                        data-title="Ingrese Causa"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="textarea"
                        data-pk="{{ $motivo->id }}" 
                        data-name="comentarios"
                        data-value="{{ $motivo->comentarios }}"
                        data-title="Ingrese comentarios"
                        ></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Alergias -->
    <div class="col-xs-12">
        <h4 class="sub-header">
            <button type="button" class="btn btn-circle btn-success btn-sm " data-toggle="modal" 
               data-target="#modalAlergia" title="Agregar"> <i class="fa fa-plus"></i></button> 
            <span>Alergias</span>
        </h4>

        <table class="card table table-colored table-condensed table-borderless table-hover table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" width="35"><span><i class="fa fa-trash"></i></span></th>
                    <th>Alergia</th>
                    <th>Fecha Aparición</th>
                    <th>Tratamiento</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>

            @if (count($perfil->motivoSelect(5)->get()) == 0 )
                <tr class="text-center">
                    <td colspan="5"><span>No posee alergias agregadas</span></td>
                </tr>
            @endif
            @foreach ($perfil->motivoSelect(5)->get() as $motivo)
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
                        data-title="Ingrese Alergia"
                        ></a></td>
                    <td><a class="xfecha" href="#" 
                        data-type="date"
                        data-pk="{{ $motivo->id }}" 
                        data-name="fecha"
                        data-value="{{ $motivo->fecha }}"
                        data-title="Ingrese Fecha"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="text"
                        data-pk="{{ $motivo->id }}" 
                        data-name="tratamiento"
                        data-value="{{ $motivo->tratamiento }}"
                        data-title="Ingrese Tratamiento"
                        ></a></td>
                    <td><a class="xmotivo" href="#" 
                        data-type="textarea"
                        data-pk="{{ $motivo->id }}" 
                        data-name="comentarios"
                        data-value="{{ $motivo->comentarios }}"
                        data-title="Ingrese comentarios"
                        ></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Modal vacunas -->
    <div class="modal fade" id="modalVacuna" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Vacuna</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.motivo', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            {{ Form::label('tipo', 'Vacuna', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('tipo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese vacuna', 'required']) }}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                            {{ Form::label('fecha', 'Fecha', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {{ Form::text('fecha', null , ['class' => 'form-control', 'id' => 'fechaV', 'placeholder' => 'Ingrese Fecha de Vacuna', 'required']) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                                @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                            {{ Form::label('comentarios', 'Comentarios', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::textArea('comentarios', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Comentarios', 'rows' => '5']) }}
                                @if ($errors->has('comentarios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comentarios') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::hidden('id_motivo', 6) }}
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

    <!-- modal Discpacidades -->
    <div class="modal fade" id="modalDiscap" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Discapacidad</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.motivo', 'class' => 'motivoForm form-horizontal']) }}
                        <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            {{ Form::label('tipo', 'Discapacidad', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('tipo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Discapacidad', 'required']) }}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('causa') ? ' has-error' : '' }}">
                            {{ Form::label('causa', 'Causa', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('causa', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Causa']) }}
                                @if ($errors->has('causa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('causa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                            {{ Form::label('comentarios', 'Comentarios', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::textArea('comentarios', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Comentarios', 'rows' => '5']) }}
                                @if ($errors->has('comentarios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comentarios') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::hidden('id_motivo', 7) }}
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

    <!-- modal Alergias -->
    <div class="modal fade" id="modalAlergia" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Alergia</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.motivo', 'class' => 'motivoForm form-horizontal']) }}
                        <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            {{ Form::label('tipo', 'Alergia', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('tipo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Alergia', 'required']) }}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                            {{ Form::label('fecha', 'Fecha Aparición', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {{ Form::text('fecha', null , ['class' => 'form-control', 'id' => 'fechaA', 'placeholder' => 'Ingrese fecha aparición de alergia', 'required']) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                                @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('tratamiento') ? ' has-error' : '' }}">
                            {{ Form::label('tratamiento', 'Tratamiento', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('tratamiento', null , ['class' => 'form-control', 'required', 'placeholder' => 'Ingrese Tratamiento']) }}
                                @if ($errors->has('tratamiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tratamiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                            {{ Form::label('comentarios', 'Comentarios', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::textArea('comentarios', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Comentarios', 'rows' => '5']) }}
                                @if ($errors->has('comentarios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comentarios') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::hidden('id_motivo', 5) }}
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
    // Sexo
    $('.xsexo').editable({
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        source: [
            {value: 'M', text: 'Masculino'},
            {value: 'F', text: 'Femenino'},
        ],  
        url:'{{ route('perfil.editar') }}',
    });
    
    //Fecha Nacimiento
    $('.xfecha').editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'dd/mm/yyyy',    
        datepicker: {
            startView: 2,
            language: "es",
            endDate: '0',
        },
        url:'{{ route('perfil.motivoEditar') }}',
    });
    // Para valores con numeros
    $('.xnumber').editable({
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
    // Semanas de embarazo
    $('.xsemanas').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
            if($.isNumeric(value) == '') {
              return 'Solo se permiten numeros.';
            }
            if(value < 1 || value > 40) {
              return 'Valor entre 1 y 40 Semanas';
            }
        },
        mode: 'inline', 
        toggle: 'manual',
        url:'{{ route('perfil.editar') }}',
    });
    // Para valor si o no
    $('.xchoice').editable({
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        source: [
            {value: 'S', text: 'Si'},
            {value: 'N', text: 'No'},
        ],  
        url:'{{ route('perfil.editar') }}',
    });
    // Valida el valor de campa 
    $('.xchoice').on('save', function(e, params) {
        if (params.newValue == 'S'){
            $(".trl").removeClass('hidden');
            $(".trl").addClass("visible");
        }else{
            $(".trl").removeClass("visible");
            $(".trl").addClass("hidden");
        }
    });
    //------------------------------------------------//
    // Para valor si o no
    $('.xembarazo').editable({
        mode: 'inline', 
        toggle: 'manual',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Valor es requerido.';
            }
        },
        source: [
            {value: 'S', text: 'Si'},
            {value: 'N', text: 'No'},
        ],  
        url:'{{ route('perfil.editar') }}',
    });
    // Valida el valor de campa 
    $('.xembarazo').on('save', function(e, params) {
        if (params.newValue == 'S'){
            $(".trh").removeClass('hidden');
            $(".trh").addClass("visible");
        }else{
            $(".trh").removeClass("visible");
            $(".trh").addClass("hidden");
        }
    });
    //----------------------------------------------------//
    // para calculo IMC
    $('.xpeso').editable({
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
    // Valida el valor de campa 
    $('.xpeso').on('save', function(e, params) {
        $('.calculo').html('<i class="fa fa-spinner fa-pulse fa-fw"></i> cargando');
        var peso = params.newValue;
        var altura = $('.xaltura').editable('getValue',true);
        $.ajax({
            type: "GET",
            url:'{{ url('calculo') }}',
            data: {peso: peso, altura: altura },
            success: function(data) {
                $('.calculo').text(data.imc);
                console.log('valor de peso '+peso +' valor altura '+ altura);
            }
        });
    });

    //----------------------------------------------------//
    // para calculo IMC
    $('.xaltura').editable({
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
    // Valida el valor de campa 
    $('.xaltura').on('save', function(e, params) {
        $('.calculo').html('<i class="fa fa-spinner fa-pulse fa-fw"></i> cargando');
        var peso = $('.xpeso').editable('getValue',true);
        var altura = params.newValue;
        $.ajax({
            type: "GET",
            url:'{{ url('calculo') }}',
            data: {peso: peso, altura: altura },
            success: function(data) {
                $('.calculo').text(data.imc);
                console.log('valor de peso '+ peso +' valor altura '+ altura);
            }
        });
    });

});
</script>
@endpush