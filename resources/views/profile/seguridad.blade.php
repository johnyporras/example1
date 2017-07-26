<div class="row">

	<div class="col-xs-12">
        <h4 class="sub-header">
            <span><i class="fa fa-shield fa-fw"></i></span> <span>Información de Seguridad</span>
        </h4>

        <table class="tEdit table table-borderless table-striped table-hover table-vcenter">
            <tbody>
                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Contraseña</strong>
                    </td>
                    <td>**********</td>
                    <td style="width: 50px;">
                        <button type="button" class="btn btn-sm btn-info btn-circle" title="Editar"
                        	data-toggle="modal" data-target="#modalClave" >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Clave telefonica</strong>
                    </td>
                    <td>**********</td>
                    <td style="width: 50px;">
                        <button type="button" class="btn btn-sm btn-info btn-circle" title="Editar"
                        	data-toggle="modal" data-target="#modalClaveTel" >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>Preguntas de Seguridad</strong> 
                    </td>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿{{ $usuario->pregunta_1 }}?</strong>
                    </td>
                    <td>**********</td>
                    <td style="width: 50px;">
                        <button type="button" class="btn btn-sm btn-info btn-circle" title="Editar"
                        	data-toggle="modal" data-target="#modalPr1" >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td class="text-right" style="width: 30%;">
                        <strong>¿{{ $usuario->pregunta_2 }}?</strong>
                    </td>
                    <td>**********</td>
                    <td style="width: 50px;">
                        <button type="button" class="btn btn-sm btn-info btn-circle" title="Editar"
                        	data-toggle="modal" data-target="#modalPr2" >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
        <!-- END Customer Info -->   
    </div>

    <!-- Modal Contraseña -->
    <div class="modal fade" id="modalClave" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Nueva Contraseña</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.change', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {{ Form::label('current_password', 'Contraseña Actual', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Contraseña Actual', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Nueva Contraseña', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'id' => 'password', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Confirma Contraseña', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirma Contraseña', 'data-parsley-equalto' => '#password', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-primary" title="Guardar"><span><i class="fa fa-save"></i></span> Actualizar</button>
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

    <!-- Modal Clave Telefonica -->
    <div class="modal fade" id="modalClaveTel" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Nueva Clave Teléfonica</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.change', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {{ Form::label('current_password', 'Contraseña Actual', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Contraseña Actual', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('clave') ? ' has-error' : '' }}">
                            {{ Form::label('clave', 'Nueva Clave telefonica', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('clave', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Clave Teléfonica', 'id' => 'clave', 'minlength' => '4', 'maxlength' => '6', 'pattern' => '[0-9]+', 'required']) }} 
                                @if ($errors->has('clave'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clave') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Confirma Clave Teléfonica', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirma Clave Teléfonica', 'pattern' => '[0-9]+', 'data-parsley-equalto' => '#clave', 'minlength' => '4', 'maxlength' => '6',  'required']) }} 
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-primary" title="Guardar"><span><i class="fa fa-save"></i></span> Actualizar</button>
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

    <!-- Modal Preguntas y Respuestas 1 -->
    <div class="modal fade" id="modalPr1" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Nuevos valores</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.change', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {{ Form::label('current_password', 'Contraseña Actual', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Contraseña Actual', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('pregunta_1') ? ' has-error' : '' }}">
                            {{ Form::label('pregunta_1', 'Pregunta de Seguridad', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::select('pregunta_1', $preguntas1, $usuario->pregunta_1, ['class' => 'form-control', 'placeholder'=>'Seleccione Pregunta', 'required']) }}
                                @if ($errors->has('pregunta_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pregunta_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('respuesta_1') ? ' has-error' : '' }}">
                            {{ Form::label('respuesta_1', 'Respuesta', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('respuesta_1', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Ingrese Respuesta', 'required']) }} 
                                @if ($errors->has('respuesta_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('respuesta_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-primary" title="Guardar"><span><i class="fa fa-save"></i></span> Actualizar</button>
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

    <!-- Modal Preguntas y Respuestas 2 -->
    <div class="modal fade" id="modalPr2" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ingrese Nuevos valores</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'perfil.change', 'class' => 'motivoForm form-horizontal']) }}

                        <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {{ Form::label('current_password', 'Contraseña Actual', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Contraseña Actual', 'minlength' => '6', 'maxlength' => '16', 'required']) }} 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('pregunta_2') ? ' has-error' : '' }}">
                            {{ Form::label('pregunta_2', 'Pregunta de Seguridad', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::select('pregunta_2', $preguntas2, $usuario->pregunta_2, ['class' => 'form-control', 'placeholder'=>'Seleccione Pregunta', 'required']) }}
                                @if ($errors->has('pregunta_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pregunta_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('respuesta_2') ? ' has-error' : '' }}">
                            {{ Form::label('respuesta_2', 'Respuesta', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('respuesta_2', ['class' => 'usuario form-control input-lg', 'placeholder' => 'Ingrese Respuesta', 'required']) }} 
                                @if ($errors->has('respuesta_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('respuesta_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-primary" title="Guardar"><span><i class="fa fa-save"></i></span> Actualizar</button>
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