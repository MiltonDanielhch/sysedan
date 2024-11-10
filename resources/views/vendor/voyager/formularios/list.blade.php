<div class="mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provincias as $row => $provincia)
                    <tr>
                        <td scope="row">{{ $row + 1 }}</td>
                        <td>{{ $provincia->nombre_provincia }}</td>
                            <td class="no-sort no-click bread-actions text-right">
                                @if (auth()->user()->hasPermission('browse_admin'))
                                    <a href="" title="Editar" class="btn btn-sm btn-info">
                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                    </a>
                                @endif
                                @if (auth()->user()->hasPermission('browse_admin'))
                                    <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('{{route('')">
                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                    </button>
                                @endif
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



