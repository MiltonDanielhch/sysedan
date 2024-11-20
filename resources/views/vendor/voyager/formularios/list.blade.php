<div class="mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>formulario</th>
                    <th>Lugar</th>
                    <th>incendio</th>
                    <th>Com-in</th>
                    {{-- <th>Personas Afectadas</th> --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formularios as $row => $formulario)
                    <tr>
                        <td scope="row">{{ $row + 1 }}</td>
                        <td>{{ $formulario->id }} - {{ $formulario->fecha_llenado }}</td>
                        <td>{{ $formulario->comunidad->municipio->provincia->nombre_provincia }} <br> {{ $formulario->comunidad->municipio->nombre_municipio }} <br> {{ $formulario->comunidad->nombre_comunidad }} <br> {{ $formulario->comunidad->tipo_comunidad }}</td>
                        <td>{{ $formulario->incendio->estado }} </td>
                        @foreach ($formulario->comunidad->incendios as $incendio)
                            <td>{{ $incendio->incendios_registrados }}</td>
                        @endforeach

                        {{-- @foreach ($personaAfectadas as $personaAfectada)
                            <h2>Formulario {{ $personaAfectada->id }}</h2>
                            <ul>
                                @foreach ($personaAfectadas->personaAfectadas as $personaAfectad)
                                    <li>{{ $personaAfectad->nombre }} ({{ $personaAfectad->grupoEtario->nombre }})</li>
                                @endforeach
                            </ul>
                        @endforeach --}}
                        {{-- @foreach ($personasAfectadas as $personaAfectada)
                            <td>{{ $personaAfectada->grupo_etario->nombre }}</td> <td>{{ $personaAfectada->cantidad_afectados_por_incendios }}</td>
                        @endforeach --}}

                        <td class="no-sort no-click bread-actions text-right">
                                <a href="{{ route('formularios.show', $formulario->id) }}" title="Ver" class="btn btn-sm btn-warning view">
                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                </a>
                                @if (auth()->user()->hasPermission('browse_admin'))
                                    <a href="{{ route('formularios.edit', $formulario->id) }}" title="Editar" class="btn btn-sm btn-info">
                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                    </a>
                                @endif
                                <form action="{{ route('formularios.destroy', $formulario) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
{{-- <div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($provincias)>0)
            <p class="text-muted">Mostrando del {{$provincias->firstItem()}} al {{$provincias->lastItem()}} de {{$provincias->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $provincias->links() }}
        </nav>
    </div>
</div> --}}
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
<style>
    .btn-sm{
        font-size: 12px;
        padding: 5px 10px;
    }
</style>



