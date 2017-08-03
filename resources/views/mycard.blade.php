<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Atiempo | @yield('title','Corporacion Atiempo')</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">
        <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ url('plugins/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }}">
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </head>
<body>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 text-center">

                <h1><img src="{{ url($preferencias->imagen) }}" width="100px" alt="avatar" class="img-thumbnail img-responsive"></h1>
                    
            </div>

            <div class="col-xs-12">
                <h1 class="text-center pb50"><span><i class="fa fa-user fa-fw"></i></span> Información Personal</h1>
            </div>

            <div class="col-xs-12">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Nombre:</strong>
                            </td>
                            <td colspan="2">{{ $perfil->fullname }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Fecha de Nacimieto:</strong>
                            </td>
                            <td colspan="2"> {{ $perfil->fecha_nacimiento->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" style="width: 30%;">
                                <strong>Edad:</strong>
                            </td>
                            <td colspan="2"> {{ $perfil->fecha_nacimiento->age }}</td>
                        </tr>

                        @if (isset($preferencias->email))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Correo:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->email }}</td>
                            </tr>
                        @endif


                        @if (isset($preferencias->telefono))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Teléfono:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->telefono }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->id_estado))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Estado:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->estado->estado }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->ciudad))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Ciudad:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->ciudad }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->civil))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Estado Civil:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->civil }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->hijos))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Número de Hijos:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->hijos }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->ocupacion))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Ocupación:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->ocupacion }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->idioma))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Idioma:</strong>
                                </td>
                                <td colspan="2"> {{ ($perfil->idioma == 'es')?'Español':'Ingles' }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->contactos))
                            <tr>
                                <td colspan="3" class="text-center"> <b>Contacto en caso de Emergencias</b></td>
                            </tr>
                            @if (count($perfil->contactos) > 0)
                                <tr>
                                    <td>nombre</td>
                                    <td>Telefono</td>
                                    <td>Parentesco</td>            
                                </tr>
                                @foreach ($perfil->contactos as $contacto)
                                    <tr>
                                        <td>{{ $contacto->nombre }}</td>
                                        <td>{{ $contacto->telefono }}</td>
                                        <td>{{ $contacto->parentesco }}</td>
                                    </tr>
                                @endforeach      
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No se encontraron contactos</td>
                                </tr>    
                            @endif
                            
                        @endif

                    
                    </tbody>
                </table>
                <!-- END Customer Info -->   
            </div>

            <div class="col-xs-12">
                <h1 class="text-center"><span><i class="fa fa-user-md fa-fw"></i></span> Información Fisica</h1>
            </div>
            
            <div class="col-xs-12">
                <table class="table table-striped table-hover">
                    <tbody>
                        @if (isset($preferencias->sexo))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Genero:</strong>
                                </td>
                                <td colspan="2"> {{ ($perfil->sexo == 'F')?'Femenino':'Masculino'}}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->altura))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Altura:</strong>
                                </td>
                                <td colspan="2">{{ $perfil->altura }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->peso))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Peso:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->peso }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->imc))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Indice de Masa Corporal iMC:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->imc($perfil->altura, $perfil->peso ) }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->grupo_sangre))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Grupo Sanguineo:</strong>
                                </td>
                                <td colspan="2"> {{ $perfil->grupo_sangre }}</td>
                            </tr>
                        @endif

                        @if (isset($preferencias->lentes))
                            <tr>
                                <td class="text-right" style="width: 30%;">
                                    <strong>Uso de Lentes:</strong>
                                </td>
                                <td colspan="2"> {{ ($perfil->lentes == 'S')?'Si':'No' }}</td>
                            </tr>
                            @if ($perfil->lentes == 'S')
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Condición uso de Lentes:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->condicion_lentes }}</td>
                                </tr>
                            @endif 
                        @endif

                        @if ($perfil->sexo == 'F')
                            @if (isset($preferencias->embarazada))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>¿Esta Embarazada?:</strong>
                                    </td>
                                    <td colspan="2"> {{ ($perfil->embarazada == 'S')?'Si':'No' }}</td>
                                </tr>
                            @endif

                            @if (isset($preferencias->menstruacion))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Ultima Menstruación:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->menstruacion }}</td>
                                </tr>
                            @endif

                            @if (isset($preferencias->partos))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Cantidad de Partos:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->partos }}</td>
                                </tr>
                            @endif

                            @if (isset($preferencias->cesarea))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Cantidad de Cesareas:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->cesarea }}</td>
                                </tr>
                            @endif

                            @if (isset($preferencias->perdidas))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Cantidad de Perdidas:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->perdidas }}</td>
                                </tr>
                            @endif

                            @if (isset($preferencias->abortos))
                                <tr>
                                    <td class="text-right" style="width: 30%;">
                                        <strong>Cantidad de Abortos:</strong>
                                    </td>
                                    <td colspan="2"> {{ $perfil->abortos }}</td>
                                </tr>
                            @endif

                        @endif
                    </tbody>
                </table>
                <!-- END Customer Info --> 
            </div>

            <div class="col-xs-12">
                <h1 class="text-center"><span><i class="fa fa-heartbeat fa-fw"></i></span> Antecedentes Personales</h1>
            </div>
            
            @if (isset($preferencias->motivo->habito))
            <div class="col-xs-12">
                <h4>Habitos de Consumo, Cigarros, Café, Etc...</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(1)->get()) > 0)
                        <tr>
                            <td>Sustancia</td>
                            <td>Cantidad</td>
                            <td>Frecuencia</td>            
                        </tr>
                        @foreach ($perfil->motivoSelect(1)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->cantidad }}</td>
                                <td>{{ $motivo->frecuencia }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="3" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            @if (isset($preferencias->motivo->actividad_fisica))
            <div class="col-xs-12">
                <h4>Actividad Fisica</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(2)->get()) > 0)
                        <tr>
                            <td>Actividad</td>
                            <td>Frecuencia</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(2)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->frecuencia }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="3" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            @if (isset($preferencias->motivo->pasatiempo))
            <div class="col-xs-12">
                <h4>Pasatiempos</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(3)->get()) > 0)
                        <tr>
                            <td>Actividad</td>
                            <td>Frecuencia</td>
                        </tr>
                        @foreach ($perfil->motivoSelect(3)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->frecuencia }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="2" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif 

            @if (isset($preferencias->motivo->alimentacion))
            <div class="col-xs-12">
                <h4>Alimentación, Dietas, Etc..</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(4)->get()) > 0)
                        <tr>
                            <td>Descripción</td>
                            <td>Causa</td>
                            <td>Frecuencia</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(4)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->causa }}</td>
                                <td>{{ $motivo->frecuencia }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="4" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif 

            @if (isset($preferencias->motivo->alergia))
            <div class="col-xs-12">
                <h4>Alergias</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(5)->get()) > 0)
                        <tr>
                            <td>Alergia</td>
                            <td>Fecha Aparición</td>
                            <td>Tratamiento</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(5)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->fecha->format('d/m/Y') }}</td>
                                <td>{{ $motivo->tratamiento }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="4" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            @if (isset($preferencias->motivo->vacuna))
            <div class="col-xs-12">
                <h4>Vacunas</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(6)->get()) > 0)
                        <tr>
                            <td>Vacuna</td>
                            <td>Fecha</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(6)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->fecha->format('d/m/Y') }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="3" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            <div class="col-xs-12">
                <h1 class="text-center"><span><i class="fa fa-medkit fa-fw"></i></span> Antecedentes Medicos</h1>
            </div>

            @if (isset($preferencias->motivo->discapacidad))
            <div class="col-xs-12">
                <h4>Discapacidades</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(7)->get()) > 0)
                        <tr>
                            <td>Discapacidad</td>
                            <td>Causa</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(7)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->causa }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="3" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif 

            @if (isset($preferencias->motivo->hospitalizacion))
            <div class="col-xs-12">
                <h4>Hospitalizaciones</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(8)->get()) > 0)
                        <tr>
                            <td>Descripción</td>
                            <td>Fecha</td>
                            <td>Causa</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(8)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->fecha->format('d/m/Y') }}</td>
                                <td>{{ $motivo->causa }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="4" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            @if (isset($preferencias->motivo->operacion))
            <div class="col-xs-12">
                <h4>Operaciones</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(9)->get()) > 0)
                        <tr>
                            <td>Operación</td>
                            <td>Fecha</td>
                            <td>Causa</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(9)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->fecha->format('d/m/Y') }}</td>
                                <td>{{ $motivo->causa }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="4" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif 

            @if (isset($preferencias->motivo->enfermedad_cronica))
            <div class="col-xs-12">
                <h4>Enfermedades Cronicas</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->motivoSelect(10)->get()) > 0)
                        <tr>
                            <td>Enfermedad</td>
                            <td>Fecha Aparición</td>
                            <td>Tratamiento</td>
                            <td>Frecuencia Consulta</td>
                            <td>Profesional / Médico</td>
                            <td>Comentarios</td> 
                        </tr>
                        @foreach ($perfil->motivoSelect(10)->get() as $motivo)
                            <tr>
                                <td>{{ $motivo->tipo }}</td>
                                <td>{{ $motivo->fecha->format('d/m/Y') }}</td>
                                <td>{{ $motivo->tratamiento }}</td>
                                <td>{{ $motivo->frecuencia }}</td>
                                <td>{{ $motivo->profecional }}</td>
                                <td>{{ $motivo->comentarios }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="6" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            @if (isset($preferencias->medicamentos))
            <div class="col-xs-12">
                <h4>Medicamentos</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->medicamentos) > 0)
                        <tr>
                            <td>Tipo Medicamento</td>
                            <td>Medicamento</td>
                            <td>Dosis</td>
                            <td>Frecuencia</td>
                            <td>Duración</td>
                            <td>Diagnostico</td>
                            <td>Recetado por</td> 
                        </tr>
                        @foreach ($perfil->medicamentos as $medicamento)
                            <tr>
                                <td>{{ $medicamento->tipo->descripcion }}</td>
                                <td>{{ $medicamento->nombre }}</td>
                                <td>{{ $medicamento->dosis }}</td>
                                <td>{{ $medicamento->frecuencia }}</td>
                                <td>{{ $medicamento->duracion }}</td>
                                <td>{{ $medicamento->diagnostico }}</td>
                                <td>{{ $medicamento->recetado }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="6" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif 

            @if (isset($preferencias->ac_documentos))
            <div class="col-xs-12">
                <h4>Examenes / Estudios</h4>
                <table class="table table-striped table-hover">
                    <tbody>
                    @if (count($perfil->documentos) > 0)
                        <tr>
                            <td>Tipo</td>
                            <td>Detalle</td>
                        </tr>
                        @foreach ($perfil->documentos as $documento)
                            <tr>
                                <td>{{ $documento->tipo->descripcion }}</td>
                                <td>{{ $documento->detalle }}</td>
                            </tr>
                        @endforeach 
                    @else
                        <tr>
                             <td colspan="2" class="text-center">No se encontraron resultadoss</td>
                        </tr>    
                    @endif
                    </tbody>
                </table>    
            </div>
            @endif

            <div class="col-xs-12">
                <p class="text-center">
                    <button type="button" class="btn btn-primary btn-sm hidden-print" onclick="window.print()"><i class="fa fa-print"></i> Imprimir</button>
                </p>
            </div>

        </div><!--/.row -->
    </div><!--/.container -->
</body>
</html>