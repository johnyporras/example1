    <div class="row">
        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                        {{ Form::label('fecha', 'Fecha Atención', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">

                            @if (Auth::user()->type == 5 || Auth::user()->type == 8)
                                <div class="input-group">
                                    {{ Form::text('fecha', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Atención', 'id' => 'date', 'required']) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            @else
                                {{ Form::text('fecha', date('Y-m-d'), ['class' => 'form-control', 'required', 'readonly']) }}
                            @endif

                            @if ($errors->has('fecha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
                
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('motivo') ? ' has-error' : '' }}">
                        {{ Form::label('motivo', 'Motivo Atención', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('motivo', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Motivo Atención', 'required']) }}
                            
                            @if ($errors->has('motivo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('motivo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('especialidad') ? ' has-error' : '' }}">
                        {{ Form::label('especialidad', 'Especialidad', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('especialidad', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Especialidad', 'required']) }}
                            
                            @if ($errors->has('especialidad'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('especialidad') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
                        {{ Form::label('procedimiento', 'Procedimiento o Examen', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('procedimiento', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Procedimiento o Examen', 'id' => 'finDate', 'required']) }}
                        
                        @if ($errors->has('procedimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('procedimiento') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('tratamiento') ? ' has-error' : '' }}">
                        {{ Form::label('tratamiento', 'Tratamiento', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                                {{ Form::text('tratamiento', null , ['class' => 'form-control', 'placeholder' => 'Ingrese Tratamiento', 'required']) }}
                            
                            @if ($errors->has('tratamiento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tratamiento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
                        {{ Form::label('diagnostico', 'Diagnostico', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::textArea('diagnostico', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el diagnostico', 'rows' => 4,'minlength' => "10", 'required' ]) }}
                        
                        @if ($errors->has('diagnostico'))
                            <span class="help-block">
                                <strong>{{ $errors->first('diagnostico') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <h4><span id="dias" class="label label-info"></span></h4>
        </div>

    </div> <!-- row -->

    <div class="row">
        <div class="col-md-6">
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('recomendaciones') ? ' has-error' : '' }}">
                        {{ Form::label('recomendaciones', 'Recomendaciones', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::textArea('recomendaciones', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus recomendaciones', 'rows' => 4,'minlength' => "10" ]) }}
                        
                        @if ($errors->has('recomendaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('recomendaciones') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
                        {{ Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::textArea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Ingrese sus observaciones', 'rows' => 4,'minlength' => "10" ]) }}
                        
                        @if ($errors->has('observaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <!-- End .form-group  -->
                </div>
            </div>
        </div>

    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div> <!-- row -->