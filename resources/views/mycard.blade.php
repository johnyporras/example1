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
    </div>  
</div>

</body>
</html>