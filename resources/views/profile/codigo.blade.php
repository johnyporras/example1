<div class="row">
    <!-- Customer Info -->
    <div class="col-xs-12">
        <h4 class="sub-header text-center mt0">Codigo QR para Emergencias</h4>
    </div>

    <div class="col-sm-4">
        <div class="block-section text-right hidden-xs">
            {!! QrCode::backgroundColor(57,66,99)
                    ->color(255,255,255)
                    ->size(150)
                    ->generate(Request::url()) !!} 
            <div class="m0 pr15">
                <button type="button" class="btn btn-primary btn-sm hidden-print" onclick="window.print()"><i class="fa fa-print fa-fw"></i> Imprimir</button>
            </div>
        </div>
        <div class="block-section text-center visible-xs">
            {!! QrCode::backgroundColor(57,66,99)
                    ->color(255,255,255)
                    ->size(150)
                    ->generate(Request::url()) !!} 
            <div class="m0 pr15">
                <button type="button" class="btn btn-primary btn-sm hidden-print" onclick="window.print()"><i class="fa fa-print"></i> Imprimir</button>
            </div>
        </div>

    </div> 

    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12">
                <div class="widget">
                    <div class="widget-simple themed-background-dark">
                        <a href="javascript:void(0)" class="widget-icon pull-right animation-fadeIn themed-buble">
                            <i class="gi gi-heart"></i>
                        </a>
                        <h4 class="widget-content animation-hatch mt0">
                            <span class="text-white">Este código puede salvarte</span>
                            <small class="text-white text-justify">En él se recoge información relevante sobre ti, como tus datos de contacto, alergias, ultimas medicaciones, enfermedades destacables. En caso de emergencia resultara muy útil a las personas que te asistan.</small>
                        </h4>
                    </div>
                    <!-- END Widget -->
                </div>

                <div class="widget">
                    <div class="widget-simple themed-buble">
                        <a href="javascript:void(0)" class="widget-icon pull-left animation-fadeIn themed-background">
                            <i class="gi gi-iphone"></i>
                        </a>
                        <h4 class="widget-content animation-hatch">
                            <span>¡Prueba tu código QR!</span>
                            <small class="text-white">Escanea el código con tu smartphone</small>
                        </h4>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>
        </div> <!-- .row -->
    </div>

    <div class="col-xs-12 text-center hidden-print">
       <h4 class="sub-header m0">Configura tu Codigo QR</h4>
       <p>Puedes seleccionar la información que quieres mostrar cuando alguien accede a tu QR.</p> 
    </div>

    <div class="col-xs-12 hidden-print">
         <div class="row">
            {{ Form::open(['route'=>'perfil.codigo', 'class' => 'form-horizontal']) }}

            <div class="col-sm-6 col-lg-3">
                <h4 class="sub-header">
                    <span><i class="gi gi-user fa-fw"></i></span> <span>Información Personal</span>
                </h4>

                <div class="form-group">
                    {{ Form::label('email', 'Correo Electronico', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="email" value="true" 
                        {{ isset($preferencias->email)?'checked' :'' }} ><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('telefono', 'Numero de teléfono', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="telefono" value="true" {{ isset($preferencias->telefono)?'checked':'' }} ><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('id_estado', 'Estado', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="id_estado" value="true" {{ isset($preferencias->id_estado)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('ciudad', 'Ciudad', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="ciudad" value="true" {{ isset($preferencias->ciudad)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('civil', 'Estado Civil', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="civil" value="true" {{ isset($preferencias->civil)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('hijos', 'Número de Hijos', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="hijos" value="true" {{ isset($preferencias->hijos)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 
                
                <div class="form-group">
                    {{ Form::label('ocupacion', 'Ocupación', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="ocupacion" value="true" {{ isset($preferencias->ocupacion)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('contactos', 'Contactos de Emergencias', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="contactos" value="true" {{ isset($preferencias->contactos)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('idioma', 'Idioma', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="idioma" value="true" {{ isset($preferencias->idioma)?'checked':'' }}><span></span></label>    
                    </div>
                </div> 
            </div>

            <div class="col-sm-6 col-lg-3">
                <h4 class="sub-header">
                    <span><i class="fa fa-user-md fa-fw"></i></span> <span>Información Fisica</span>
                </h4>

                <div class="form-group">
                    {{ Form::label('altura', 'Altura', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="altura" value="true" {{ isset($preferencias->altura)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('peso', 'Peso', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="peso" value="true" {{ isset($preferencias->peso)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('imc', 'Indice de Masa Corporal iMC)', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="imc" value="true" {{ isset($preferencias->imc)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('grupo_sangre', 'Grupo Sanguineo', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="grupo_sangre" value="true" {{ isset($preferencias->grupo_sangre)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('lentes', 'Uso de Lentes', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="lentes" value="true" {{ isset($preferencias->lentes)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('sexo', 'Genero', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="sexo" value="true" {{ isset($preferencias->sexo)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                @if ($perfil->sexo == 'F')

                    <div class="form-group">
                        {{ Form::label('menstruacion', 'Ultima menstruación', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="menstruacion" value="true" {{ isset($preferencias->menstruacion)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('embarazada', 'Estado de Embarazo', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="embarazada" value="true" {{ isset($preferencias->embarazada)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('partos', 'Cantidad de Partos', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="partos" value="true" {{ isset($preferencias->partos)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('cesarea', 'Cantidad de Cesareas', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="cesarea" value="true" {{ isset($preferencias->cesarea)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('perdidas', 'Cantidad de Perdidas', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="perdidas" value="true" {{ isset($preferencias->perdidas)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('abortos', 'Cantidad de Abortos', ['class' => 'col-xs-8 control-label']) }}
                        <div class="col-xs-4">
                            <label class="switch switch-primary"><input type="checkbox" name="abortos" value="true" {{ isset($preferencias->abortos)?'checked':'' }}><span></span></label>    
                        </div>
                    </div>

                @endif
            </div>

            <div class="clearfix hidden-lg"></div>

            <div class="col-sm-6 col-lg-3">
                <h4 class="sub-header">
                    <span><i class="fa fa-heartbeat fa-fw"></i></span> <span>Antecedentes Personales</span>
                </h4>

                <div class="form-group">
                    {{ Form::label("motivo[habito]", 'Habitos de Consumo, Cigarros, Café, Etc...', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[habito]" value="true" {{ isset($preferencias->motivo->habito)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[actividad_fisica]", 'Actividad Fisica', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[actividad_fisica]" value="true" {{ isset($preferencias->motivo->actividad_fisica)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[pasatiempo]", 'Pasatiempos', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[pasatiempo]" value="true" {{ isset($preferencias->motivo->pasatiempo)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[alimentacion]", 'Alimentación, Dietas, Etc..', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[alimentacion]" value="true" {{ isset($preferencias->motivo->alimentacion)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[alergia]", 'Alergias', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[alergia]" value="true" {{ isset($preferencias->motivo->alergia)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[vacuna]", 'Vacunas', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[vacuna]" value="true" {{ isset($preferencias->motivo->vacuna)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

            </div>

            <div class="col-sm-6 col-lg-3">
                <h4 class="sub-header">
                    <span><i class="fa fa-medkit fa-fw"></i></span> <span>Antecedentes Medicos</span>
                </h4>

                <div class="form-group">
                    {{ Form::label("motivo[discapacidad]", 'Discapacidades', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[discapacidad]" value="true" {{ isset($preferencias->motivo->discapacidad)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("motivo[hospitalizacion]", 'Hospitalizaciones', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[hospitalizacion]" value="true" {{ isset($preferencias->motivo->hospitalizacion)?'checked':'' }}><span></span></label>    
                    </div>
                </div>


                <div class="form-group">
                    {{ Form::label("motivo[operacion]", 'Operaciones', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[operacion]" value="true" {{ isset($preferencias->motivo->operacion)?'checked':'' }}><span></span></label>    
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label("motivo[enfermedad_cronica]", 'Enfermedades Cronicas', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="motivo[enfermedad_cronica]" value="true" {{ isset($preferencias->motivo->enfermedad_cronica)?'checked':'' }}><span></span></label>    
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('medicamentos', 'Medicamentos', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="medicamentos" value="true" {{ isset($preferencias->medicamentos)?'checked':'' }}><span></span></label>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('ac_documentos', 'Estudios / Examens de laboratorio', ['class' => 'col-xs-8 control-label']) }}
                    <div class="col-xs-4">
                        <label class="switch switch-primary"><input type="checkbox" name="ac_documentos" value="true" {{ isset($preferencias->ac_documentos)?'checked':'' }}><span></span></label>    
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                        {{ Form::hidden('id_afiliado', $perfil->id) }}
                        {{ Form::hidden('codigo', $perfil->cuenta->codigo_cuenta) }}
                        <button type="submit" class="btn btn-sm btn-success btn-block" title="Guardar"><span><i class="fa fa-edit"></i></span> Actualizar Preferencias</button>
                    </div>
                </div>
            </div>

            {{ Form::close() }}
        </div> 
    </div>
    
</div>

@push('sub-script')
<script>
$(document).ready(function() {

    $valor = 'Estoy escribiendo desde codigo'
});
</script>
@endpush