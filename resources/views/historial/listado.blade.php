<div class="row">
    
    <div class="col-xs-12">
       <p><a href="{{ route('historial.create', $afiliado->id) }}" title="Nuevo Historial Médico" class="btn btn-success btn-sm"><span class="pr5"><i class="fa fa-plus"></i></span> Nuevo</a></p>
    </div>

    <div class="col-xs-12">
       <h4 class="sub-header m0">Listado de Historiales Medicos</h4>
    </div>

    <div class="col-xs-12">
        
        <table class="card table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Fecha de Atencion</th>
                    <th>Motivo de Atencion</th>
                    <th>Especialidad</th>
                    <th style="width: 50px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $historial)
                    <tr>
                        <td>{{ $historial->fecha->format('d/m/Y') }}</td>
                        <td>{{ $historial->motivo }}</td>
                        <td>{{ $historial->especialidad }}</td>
                        <td class="text-center">
                            <a href="{{ route('historial.edit', $historial->id) }}" data-toggle="tooltip" class="b-edit btn btn-sm btn-info btn-circle" data-original-title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('historial.view', $historial->id) }}" data-toggle="tooltip" class="b-edit btn btn-sm btn-warning btn-circle" data-original-title="Ver Detalles">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    
</div>

@push('sub-script')
<script>
$(document).ready(function() {

    
});
</script>
@endpush