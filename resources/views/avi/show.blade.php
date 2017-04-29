@extends('layouts.app')
@section('title','Asistencia al Viajero Internacional')

@push('styles')
  <link rel="stylesheet" href="{{ url('css/timeline.css') }}">
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-brush"></i>Page Title<br><small>Subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Category</li>
        <li><a href="">Page</a></li>
    </ul>
@endsection

@section('content')
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/avi/lista') }}" title="Listado Solicitudes" class="btn btn-success"><span class="pr5"><i class="fa fa-table"></i></span> Listado</a></p>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-xs-12">
            <h2 class="pt10 pb10 m0">Solicitud: {{ strtoupper($solicitud->codigo_solicitud) }}</h2>
        </div>
    </div> <!-- row -->
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="text-center">Intinerario</h2>
            <hr>
        </div>
    </div> <!-- row -->
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">

        @if (count($solicitud->destinos) > 0)
          <ul class="timeline">
           <!-- {{$i = 1 }} -->
          @foreach ($solicitud->destinos as $destino)
           
            @if ($i % 2 == 0)
             <li class="timeline-inverted">
            @else
             <li>
            @endif
              <div class="timeline-badge info"><i class="fa fa-plane"></i></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4 class="timeline-title">{{ $destino->pais->name_es }}</h4>
                </div>
                <div class="timeline-body">
                  <div class="col-md-6">
                    <div class="media">
                      <div class="media-left">
                        <span class="fa-2x text-info">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Fecha Salida</h4>
                        <p>{{ $destino->fecha_desde->format('d/m/Y')}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="media">
                      <div class="media-left">
                        <span class="fa-2x text-success">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">Fecha Retorno</h4>
                        <p>{{ $destino->fecha_hasta->format('d/m/Y')}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <!-- {{  $i++  }} -->
          @endforeach

          </ul>
        @endif
        </div> <!-- .col-xs-12 -->
    </div> <!-- row -->
</div>

@endsection
@section('script')

<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->

<script>
$(document).ready(function() {
    
}); 
</script>
@endsection