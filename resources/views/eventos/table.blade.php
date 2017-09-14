<table class="table table-responsive" id="eventos-table">
    <thead>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Desde</th>
        <th>Hasta</th>
        <th>Hora</th>
        <th colspan="3">Acci&oacute;n</th>
    </thead>
    <tbody>
    @foreach($eventos as $eventos)
        <tr>
            <td>{!! $eventos->titulo !!}</td>
            <td>{!! $eventos->descripcion !!}</td>
            <td>{!! $eventos->fechainicio !!}</td>
            <td>{!! $eventos->fechafin !!}</td>
            <td>{!! $eventos->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['eventos.destroy', $eventos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('eventos.show', [$eventos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('eventos.edit', [$eventos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>