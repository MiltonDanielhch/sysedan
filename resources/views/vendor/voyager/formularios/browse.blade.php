@extends('voyager::master')

@section('page_title', 'Formularios')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-people"></i> Formulario
                            </h1>
                        </div>
                        <div class="col-md-4 text-right" style="margin-top: 30px">
                            @if (auth()->user()->hasPermission('browse_admin'))
                            <a href="{{ route('formularios.create') }}" class="btn btn-success">
                                <i class="voyager-plus"></i> <span>Crear</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-9" style="margin-bottom: 0px">
                            <div class="dataTables_length" id="dataTable_length">
                                <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> registros</label>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-bottom: 0px">
                            <input type="text" id="input-search" class="form-control" placeholder="Ingrese busqueda..."> <br>
                        </div>
                    </div>
                    <div class="row" id="tabla_contenido" style="min-height: 120px">
                        <h1>hi</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@stop

@push('javascript')
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script>
        var countPage = 10;
        $(document).ready(function() {
            list();
            // $("#tabla_contenido").html("<h1>tabla</h1>");


            $('#input-search').on('keyup', function(e){
                if(e.keyCode == 13) {
                    list();
                }
            });
            $('#select-paginate').change(function(){
                countPage = $(this).val();
                list();
            });
        });
        function list(page = 1){
            // console.log("HOLA");
            // peticion ajax
            $.ajax({
                type: 'POST',
                url: "{{ route('formularios.list') }}",
                dataType: 'json',
                beforeSend: function(){
                    $('#tabla_contenido').html('<div class="cargando"><i class="fa-solid fa-spinner fa-5x"></i></div>');
                },
                error: function(data){
                    let errorJson = JSON.parse(data.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorJson.message,
                        footer: '<a href="#">Vuelva a intentarlo</a>'
                    });
                },
                success: function(data){
                    $("#tabla_contenido").html(data.html);
                }
            });
        }
    </script>
@endpush
