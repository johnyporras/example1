@extends('layouts.app')
@section('title','Modulo Funerario')

@push('styles')
<link rel="stylesheet" href="{{ url('plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/datatables/css/fixedHeader.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/datatables/css/responsive.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/bootstrap-sweetalert/sweetalert.css')}}" >
@endpush

@push('scripts')
<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/js//responsive.bootstrap.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
@endpush

@section('breadcrumb')
    <div class="content-header">
        <div class="header-section">
            <h1><i class="glyphicon glyphicon-king"></i> Modulo Funerario <br> <small class="text-white">subtitle</small></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Modulo Funerario</li>
    </ul>
@endsection

@section('content')

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <p><a href="{{ url('/funerario') }}" title="Generar otra Solicitud" class="btn btn-success btn-sm"><span class="pr5"><i class="fa fa-plus"></i></span> Generar</a></p>
        </div>
    </div> <!-- row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="pt10 pb10 m0">Listado de Solicitudes</h2>
        </div>
    </div> <!-- row -->
</div>
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <table id="tsolicitud" class="table table-hover table-striped table-bordered table-colored nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="20">Id</th>
                        <th width="50">Solicitud</th>
                        <th>Afiliado</th>
                        <th>Estado</th>
                        <th>Ciudad</th>
                        <th>Telefono</th>
                        <th>Cobertura</th>
                        <th>Metodo</th>
                        <th>Creado</th>
                        <th width="80">Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="non_searchable"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> <!-- row -->
    <br>
</div>
@endsection
@section('script')
<!-- Incluye las alertas start -->
<!-- ================ -->
@include('partials.alert-toast')
<!-- Incluye las alertas end -->
<script>
$(document).ready(function() {
    
    var table = $('#tsolicitud').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '/api/funerarios',
        language: {
            url: '/plugins/datatables/language/Spanish.json',
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'codigo_solicitud', name: 'codigo_solicitud'},
            {data: 'afiliado.nombre', name: 'afiliado.nombre'},
            {data: 'estado.estado'},
            {data: 'ciudad', name: 'ciudad' },
            {data: 'contacto', name: 'contacto' },
            {data: 'cobertura', name: 'cobertura' },
            {data: 'pago.metodo', name: 'pago.metodo' },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    column.search($(this).val()).draw();
                });
            });
        }
    });

    new $.fn.dataTable.FixedHeader( table );

    $('#tsolicitud tbody').on( 'click', '.sweet-danger', function (e) {
        e.preventDefault();
        var link = $(this).attr('href')+'/destroy';
        swal({   
            title: "Advertencia",
            text: "¿Esta seguro de continuar?",         
            type: "warning",   
            showCancelButton: true,   
            confirmButtonClass: "btn-danger btn-sm",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            cancelButtonClass: "btn-sm", 
            closeOnConfirm: false 
            }, 
            function(){  
                window.location = link
        });
    });
}); 
</script>
@endsection