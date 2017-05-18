<!DOCTYPE html>
<!--[if IE 9]> <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Atiempo | @yield('title','Corporacion Atiempo')</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description')" />
        <meta name="keywords" content="@yield('keywords')" />
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
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
        <!-- Custom default Styles for plugins -->
        @stack('styles')
        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/atiempo.css') }}">

        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="{{ asset('plugins/modernizr/modernizr.min.js') }}"></script>
    </head>
    <?php
if(is_object(Auth::user()))
{
?>
    <script>
    var rutaInicio="/";
    var url = location.pathname;
    var id_type='<?php echo Auth::user()->type; ?>'
    var ruta = "/atiempon2/public/Seguridad/evalPermiso";
    var rutanoper="/atiempon2/public/Seguridad/nopermiso";
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
              ///  location.href="/atiempon/public/Seguridad/nopermiso";
            }

        });
    }
    </script>
<?php
}
?>
    <body>
        <!-- Page Wrapper -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available classes: 'page-loading' enables page preloader
        -->
        <div id="page-wrapper">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
                </div>
            </div>
            <!-- END Preloader -->

            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

                <!-- Start Sidebar -->
                @include('partials.sidebar')
                <!-- End Sidebar -->

                <!-- Main Container -->
                <div id="main-container">

                    <!-- Header -->
                    @include('partials.header')
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Page Header -->
                        @yield('breadcrumb')
                        <!-- END Page Header -->

                            <!--  Page Content -->
                            <div class="row">

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

                                @yield('content')

                            </div>
                            <!-- END Page Content -->
                    </div>
                    <!-- END Page Content -->

                    <!-- Footer -->
                    @include('partials.footer')
                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/metisMenu/metisMenu.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('plugins/parsley-js/parsley.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
        <!-- Custom default scripts for plugins -->
        @stack('scripts')
        <!-- Custom scripts -->
        @yield('script')
    </body>
</html>

    </div>
    <!-- /#wrapper -->
    <!-- JavaScripts -->

   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
    <!-- BOOTSTRAP -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <script src="{{url('/')}}/bootstrap/js/bootstrap.min.js"></script>
    <!--Jquery-ui-->
    <script src="{{url('/')}}/js/jquery-ui.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('/')}}/js/metisMenu.min.js"></script>
    <script src="{{url('/')}}/js/sb-admin-2.js"></script>
    <script src="{{url('/')}}/js/parsley.min.js"></script>
    <script src="{{url('/')}}/js/i18n/es.js"></script>
    <script src="{{url('/')}}/js/typeahead.bundle.js"></script>
    <script src="{{url('/')}}/js/bootstrap-treeview.js"></script>



<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">




    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <!-- Custom default scripts for plugins -->
    @stack('scripts')
    <!-- Custom scripts -->
    @yield('script')
</body>
</html>
