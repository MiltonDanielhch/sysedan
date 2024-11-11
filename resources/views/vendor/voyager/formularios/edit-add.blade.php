@extends('voyager::master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_title', isset($formulario) ? 'Editar formulario' : 'Crear formulario')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-people"></i>
    {{ isset($formulario) ? 'Editar' : 'Crear' }} formulario
</h1>
@stop

@section('content')
<div class="page-content edit-add container-fluid">
    <div class="row">
        <form action="{{route('formularios.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            {{-- LISTADO DE LUGAR --}}
                            <div class="row">
                                <div class="panel-group" id="accordionLugar" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingLugar">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionLugar"
                                                    href="#collapseLugar" aria-expanded="true"
                                                    aria-controls="collapseLugar">
                                                    LISTADO DEL LUGAR
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseLugar" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingLugar">
                                            <div class="panel-body">
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Lugar</b></div>
                                                        <div class="panel-body">
                                                            {{-- Select Provincia --}}
                                                            <div class="form-group">
                                                                <label for="provincia"><b>Provincia</b></label>
                                                                <select name="provincia" id="select_provincia"
                                                                    class="form-control" required>
                                                                    <option value="" disabled selected>-- Selecciona
                                                                        Provincia--</option>
                                                                    @foreach ($provincias as $provincia)
                                                                    <option value="{{ $provincia->id }}">{{
                                                                        $provincia->nombre_provincia }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            {{-- Select Municipio --}}
                                                            <div class="form-group">
                                                                <label for="municipio">Municipio</label>
                                                                <div id="respuesta_provincia">
                                                                    <div class="loading-indicator">Cargando...</div>
                                                                </div>
                                                            </div>

                                                            {{-- Nombre del Alcalde --}}
                                                            <div class="form-group">
                                                                <label for="nombre_alcalde">Nombre del Alcalde</label>
                                                                <input type="text" id="nombre_alcalde" name="nombre_alcalde"
                                                                    placeholder="Nombre Alcalde" class="form-control"
                                                                    readonly>
                                                            </div>
                                                            {{-- Población Total --}}
                                                            <div class="form-group">
                                                                <label for="poblacion_total">Población Total</label>
                                                                <input type="number" id="poblacion_total"
                                                                    name="poblacion_total" placeholder="Población Total"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Detalles de la Comunidad --}}
                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Detalles de la Comunidad</b></div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="fecha_llenado">Fecha de Llenado</label>
                                                            <input type="date" id="fecha_llenado" name="fecha_llenado" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_comunidad">Nombre Comunidad</label>
                                                            <input type="text" name="nombre_comunidad" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipo_comunidad">Tipo de Comunidad</label>
                                                            <select name="tipo_comunidad" id="tipo_comunidad" class="form-control" required>
                                                                <option value="INDÍGENA">INDÍGENA</option>
                                                                <option value="CAMPESINA">CAMPESINA</option>
                                                                <option value="INTERCULTURAL">INTERCULTURAL</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                              {{-- INCENDIOS FORESTALES --}}
                              <div class="row">
                                <div class="panel-group" id="accordionIncendio" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingIncendio">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionIncendio" href="#collapseIncendio"
                                                    aria-expanded="true" aria-controls="collapseIncendio">
                                                    INCENDIOS FORESTALES
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseIncendio" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingIncendio">
                                            <div class="panel-body">
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Incendio</b></div>
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label for="fecha_inicio">Fecha de Inicio</label>
                                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="causas_probables">Causas Probables</label>
                                                                <input type="text" id="causas_probables" name="causas_probables" placeholder="Introducir Probables"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="estado">Estado</label>
                                                                <input type="text" id="estado" name="estado" placeholder="Introducir estado del incendio"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Incendios en la comunidad --}}
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Incendios en la Comunidad</b></div>
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label for="incendios_registrados">Incendios Registrados</label>
                                                                <input type="number" id="incendios_registrados" name="incendios_registrados"
                                                                    placeholder="Introducir Incendios Registrados" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="incendios_activos">Incendios Activos</label>
                                                                <input type="number" id="incendios_activos" name="incendios_activos"
                                                                    placeholder="Introducir Incendios Activos" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="necesidades">Necesidades</label>
                                                                <input type="text" id="necesidades" name="necesidades" placeholder="Introducir necesidades"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="num_familias_afectadas">Familias Afectadas</label>
                                                                <input type="number" id="num_familias_afectadas" name="num_familias_afectadas"
                                                                    placeholder="Introducir Numero" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="num_familias_damnificadas">Familias Damnificadas</label>
                                                                <input type="number" id="num_familias_damnificadas" name="num_familias_damnificadas"
                                                                    placeholder="Introducir Numero" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>

</div>
@stop

@section('javascript')
<script>
$('#select_provincia').on('change', function() {
    var id_provincia = $(this).val();
    $('#respuesta_provincia').html('<div class="loading-indicator">Loading...</div>');
    $.ajax({
        url: "{{ url('/admin/formularios/create/provincia/') }}/" + id_provincia,
        type: "GET",
        success: function(data) {
            $('#respuesta_provincia').html(data);
        },
        error: function() {
            $('#respuesta_provincia').html('<div class="error-message">An error occurred. Please try again later.</div>');
        }
    });
});
</script>
<script>
    $(document).on('change', '#select_municipio', function(){
        var id_municipio = $(this).val();
        // alert(id_municipio);
        if(id_municipio){
            $.ajax({
                url:"{{ url('/admin/formularios/create/get-alcalde') }}/" + id_municipio,
                type: "GET",
                        success: function(response) {
                            // Si la respuesta es exitosa, carga el nombre del alcalde en el campo
                            if (response.nombre_alcalde) {
                                $('#nombre_alcalde').val(response.nombre_alcalde);
                            } else {
                                $('#nombre_alcalde').val('');
                            }
                        },
                        error: function() {
                            alert('Error al cargar el nombre del alcalde');
                        }
                    });
                } else {
                    $('#nombre_alcalde').val('');
            }
    });
</script>

<script>
    $(document).on('change', '#select_municipio', function(){
        var id_municipio = $(this).val();
        // alert(id_municipio);
        if(id_municipio){
            $.ajax({
                url:"{{ url('/admin/formularios/create/get-poblacion') }}/" + id_municipio,
                type: "GET",
                        success: function(response) {
                            // Si la respuesta es exitosa, carga el nombre del alcalde en el campo
                            if (response.poblacion_total) {
                                $('#poblacion_total').val(response.poblacion_total);
                            } else {
                                $('#poblacion_total').val('');
                            }
                        },
                        error: function() {
                            alert('Error al cargar el nombre del alcalde');
                        }
                    });
                } else {
                    $('#nombre_alcalde').val('');
            }
    });
</script>

@stop
