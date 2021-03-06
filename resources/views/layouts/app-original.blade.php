<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <title>Atiempo| @yield('title','Grupo Atiempo')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="icon" href="{{url('/')}}/images/favicon.ico" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="{{ url('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->

    <link href="{{ url('/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Jquery UI CSS -->
    <link href="{{ url('/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('/plugins/jquery-ui/jquery-ui.theme.min.css') }}" rel="stylesheet">

    <link href="{{ url('/plugins/bootstrap-treeview/bootstrap-treeview.min.css') }}" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="{{ url('/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    
    <!-- blueimp Gallery styles -->
    <link href="{{ url('/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="{{ url('/plugins/jqueryFileUpload/css/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{ url('/plugins/jqueryFileUpload/css/jquery.fileupload-ui.css') }}">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="{{url('/plugins/jqueryFileUpload/css/query.fileupload-noscript.css') }}"></noscript>
    <noscript><link rel="stylesheet" href="{{url('/plugins/jqueryFileUpload/css/query.fileupload-ui-noscript.css') }}"></noscript>

    <!-- Custom default Styles for plugins -->
    @stack('styles')
    <!-- Custom CSS -->
    <link href="{{ url('/css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/styles.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php 
if(is_object(Auth::user()))
{
?>
    <script>
    var rutaInicio="/";
    var url = location.pathname;
    var id_type='<?php echo Auth::user()->type; ?>'
    var ruta = "/Seguridad/evalPermiso";
    var rutanoper="/Seguridad/nopermiso";
    //alert(url);
    //alert(rutaInicio);
    if(url!=rutaInicio && url!=rutanoper)
    {

        var params =
        {
          'url':url,
          'id_type':id_type
        }
        //alert(params);
        $.getJSON(ruta,params,function(data)
        {
            if(data.permiso==false)
            {
                //alert("accesso denegado a este módulo");
                location.href="/atiempon/public/Seguridad/nopermiso";              
            }
      
        });
    }
    </script>
<?php
}
?>
<body id="app-layout">
    <div id="wrapper">
    <!-- START OF HEADER -->
        <!-- Navigation -->
        <div id="head"></div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header visible-xs">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Atiempo b</a>
            </div>
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav hidden-xs" id="logo"><a href="{{ url('/') }}">
                <img src="{{ url('/images') }}/atiempo.png" alt="" height="70" width=""></a>
            </ul>
            <!-- /.navbar-header -->
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {{ Auth::user()->name }} <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>Perfil del Usuario</a>
                            </li>
                            <li><a href="{{ url('password/reset') }}"><i class="fa fa-gear fa-fw"></i>Cambiar Clave</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                @endif
                <!-- /.dropdown -->
                <li class="dropdown hidden-xs"><?php
                setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); # Asi es mucho mas seguro que funciones, ya que no todos los sistemas llaman igual al locale ;)
date_default_timezone_set('America/Caracas');
                $mytime = Carbon\Carbon::now('America/Caracas');
                echo $mytime->toDayDateTimeString();

                ?></li>
            </ul>
            <!-- /.navbar-top-links -->
            @if (Auth::check())
                @include('layouts.menu')
            @endif
        </nav>
        <!-- END OF HEADER -->

        <!-- START OF MAIN CONTENT -->
        @if(Auth::guest())
            <div id="page-wrapper" class="page-wrapper no-menu">
        @else
            <div id="page-wrapper" class="page-wrapper<?PHP if($_SERVER['REQUEST_URI'] == '/public/'){ echo ' home'; } ?>">
        @endif

            <div class="row">
                <h3>
                    @yield('title')
                </h3>
            </div>
            <!-- /.row -->
            @if (Session::has('message'))
                <div id="result" class="alert alert-danger">
                    {{Session::get('message')}}
                </div>
            @else
                <div id="result"></div>
            @endif
            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{Session::get('status')}}
                </div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- /.row -->
            <div class="row">
                @yield('content')
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <!-- foot -->
        <div id="footer">
            &copy; {{ date('Y') }} GRUPO Atiempo - Todos los derechos reservados |  Desarrollado por <a href="http://brizerconsulting.com/" target="_blank">BrizerConsulting.com</a>
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- JavaScripts -->
    
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
   <script src="{{ url('/plugins/jquery/jquery-1.12.3.min.js') }}"></script>
    <!-- BOOTSTRAP -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <script src="{{ url('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--Jquery-ui-->
    <script src="{{ url('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('/plugins/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ url('/plugins/parsley-js/parsley.min.js') }}"></script>
    <script src="{{ url('/plugins/parsley-js/i18n/es.js') }}"></script>
    <script src="{{ url('/plugins/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-treeview/bootstrap-treeview.min.js') }}"></script>
    <script src="{{ url('/js/sb-admin-2.js') }}"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <!-- Custom default scripts for plugins -->
    @stack('scripts')
    <!-- Custom scripts -->
    @yield('script')
</body>
</html>
