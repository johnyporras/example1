@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')
@section('content')
<hr/>
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/avi') }}" title="Generar otra Solicitud" class="btn btn-success"><span class="pr5"><i class="fa fa-plus"></i></span> Generar</a></p>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h1 class="pt10 pb10 m0">Listado de Solicitudes</h1>
        </div>
    </div> <!-- row -->
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <table></table>
        </div>
    </div> <!-- row -->

   
</div>

@endsection
@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
@endsection