<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Llenado del formulario</th>
                    <th>Lugar</th>
                    <th>incendio</th>
                    <th>Comunidad - incendio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $formulario)
                    <tr>
                        <td>{{ $formulario->id }} </td>
                        <td>{{ $formulario->fecha_llenado }}</td>
                        <td>
                            Provincia: {{ $formulario->comunidad->municipio->provincia->nombre_provincia }} <br>
                            Municipio: {{ $formulario->comunidad->municipio->nombre_municipio }} <br>
                            <b>Comunidad:</b> {{ $formulario->comunidad->nombre_comunidad }} <br>
                            Tipo Comunidad: {{ $formulario->comunidad->tipo_comunidad }}
                        </td>

                        <td>
                            Fecha: Inicio: {{ $formulario->incendio->fecha_inicio }} <br>
                            Causa Probable: {{ $formulario->incendio->causas_probables }} <br>
                            Estado: {{ $formulario->incendio->estado }}
                        </td>

                        @php
                            $incendioPivot = $formulario->comunidad->incendios->first()->pivot;
                        @endphp
                        <td><p>
                            Incendios Registrados: {{ $incendioPivot->incendios_activos }} <br>
                            Incendios Activos: {{ $incendioPivot->incendios_activos }} <br>
                            Necesidades: {{ $incendioPivot->necesidades }} <br>
                            Familias Afectadas: {{ $incendioPivot->num_familias_afectadas }} <br>
                            Familias Damnificadas: {{ $incendioPivot->num_familias_damnificadas }} <br>
                        </p></td>

                        <td class="no-sort no-click bread-actions text-right">
                            <a href="{{ route('formularios.show', $formulario->id) }}" title="Ver" class="btn btn-sm btn-warning view">
                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                            </a>
                            @if (auth()->user()->hasPermission('browse_admin'))
                                <a href="{{ route('formularios.edit', $formulario->id) }}" title="Editar" class="btn btn-sm btn-info">
                                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                </a>
                            @endif
                            <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('{{  route('formularios.destroy', $formulario->id) }}')">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                            </button>
                            {{-- @if (auth()->user()->hasPermission('browse_admin'))
                                <form action="{{ route('formularios.destroy', $formulario->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif --}}

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} de {{$data->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

<script>
$('.page-link').click(function(e){
    e.preventDefault();
    let link = $(this).attr('href');
    if(link){
        page = link.split('=')[1];
        list(page);
    }
});
</script>

