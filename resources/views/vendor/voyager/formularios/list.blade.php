<div class="col-md-12">
    <div class="table-responsive">
        {{-- <table id="dataTableStyle" class="table table-bordered table-hover"> --}}
        <table id="dataTable" class="table table-bordered table-hover">
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
                @foreach($data as $row => $formulario)
                    <tr>
                        <td scope="row">{{ $row + 1 }}</td>
                        <td>{{ $formulario->id }} - {{ $formulario->fecha_llenado }}</td>
                        <td>{{ $formulario->comunidad->municipio->provincia->nombre_provincia }} <br> {{ $formulario->comunidad->municipio->nombre_municipio }} <br> {{ $formulario->comunidad->nombre_comunidad }} <br> {{ $formulario->comunidad->tipo_comunidad }}</td>
                        <td>{{ $formulario->incendio->fecha_inicio }} - {{ $formulario->incendio->causas_probables }} - {{ $formulario->incendio->estado }} </td>

                        <td><p>
                            Incendios Registrados: {{ $formulario->comunidad->incendios->first()->pivot->incendios_activos  }}
                            <br> Incendios Activos: {{ $formulario->comunidad->incendios->first()->pivot->incendios_activos  }}
                            <br> Necesidades: {{ $formulario->comunidad->incendios->first()->pivot->necesidades  }}
                            <br> Familias Afectadas: {{ $formulario->comunidad->incendios->first()->pivot->num_familias_afectadas  }}
                            <br> Familias Damnificadas: {{ $formulario->comunidad->incendios->first()->pivot->num_familias_damnificadas  }}
                        </p></td>


                        {{-- @foreach ($personasAfectadas as $personaAfectada)
                            <td>{{ $personaAfectada->grupoEtario->nombre_grupo_etario }}</td>
                            <td>{{ $personaAfectada->cantidad_afectados_por_incendios }}</td>
                            @dump($personaAfectada);
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
                                
                                @if (auth()->user()->hasPermission('browse_admin'))
                                    <form action="{{ route('formularios.destroy', $formulario->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">Delete</button>    
                                    </form>
                                @endif
                            </td>
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