@extends('layouts.app')
@section('title','Tablero')

@section('breadcrumb')
<div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            <!-- Main Title (hidden on small devices for-->
            <div class="col-md-4 col-lg-6">
                <h3>Bienvenido <strong>{{ Auth::user()->name }}</strong></h3>
            </div>
            <!-- END Main Title -->

            <!-- Top Stats -->
            <div class="col-md-8 col-lg-6 borde">

                <div class="row text-center">
                    <div class="col-md-6 col-lg-offset-2">
                        <h3 class="animation-hatch">
                           <span><i class="fa fa-calendar"></i></span> 
                           <span class="clock-date"></span>
                          <!--  <br><small><i class="fa fa-calendar"></i> <b>Caracas</b></small> -->
                        </h3>
                    </div>

                    <div class="col-md-6 col-lg-4 borde">
                        <h3 class="animation-hatch">
                            <span><i class="fa fa-clock-o"></i></span>
                            <span class="clock-hours"></span> :
				            <span class="clock-minutes"></span> :
				            <span class="clock-seconds"></span> 
				            <span class="clock-ampm"></span>
                			<!-- <br><small><i class="fa fa-clock-o"></i> <b>Caracas</b></small> -->
                        </h3>
                    </div>                     
                </div>

            </div>
            <!-- END Top Stats -->
        </div>
    </div>
    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
   	<img src="{{ url('images/dashboard_header.jpg') }}" alt="header image" class="animation-pulseSlow">
</div>
@endsection

@section('content')

@endsection
