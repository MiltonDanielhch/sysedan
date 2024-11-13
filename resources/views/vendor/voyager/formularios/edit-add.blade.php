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
                        <div class="form-group">
                             {{-- PERSONAS AFECTADAS --}}
                            <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    PERSONAS AFECTADAS
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">

                                                <div class="form-group col-md-7">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Personas</b></div>
                                                        <div class="panel-body">
                                                            <h4> PERSONAS AFECTADAS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Grupo Etario</th>
                                                                        <th>N° Afectados por Incendios</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($grupoEtarios as $grupoEtario)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $grupoEtario->nombre_grupo_etario }}
                                                                            <input type="hidden" name="grupo_etario_id[]"
                                                                                value="{{ $grupoEtario->id }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="cantidad_afectados_por_incendios[]"
                                                                                class="form-control">
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Personas</b></div>
                                                        <div class="panel-body">
                                                            <h4>INFORMACIÓN EN EDUCACIÓN</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Institución</th>
                                                                        @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                            <th>{{ $modalidadEducacion->nombre_modalidad_educacion }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($institucions as $institucion)
                                                                        <tr>
                                                                            <td>{{ $institucion->nombre_institucion }}
                                                                                <input type="hidden" name="institucion_id[]" value="{{ $institucion->id }}">
                                                                            </td>
                                                                            @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                                <td>
                                                                                    <input type="number" name="num_estudiantes[{{ $institucion->id }}][{{ $modalidadEducacion->id }}]" class="form-control">
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
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
                            {{-- INFORMACIÓN DE SALUD --}}
                            <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    INFORMACIÓN DE SALUD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <div class="form-group col-md-10">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Salud</b></div>
                                                        <div class="panel-body">
                                                            <h4> INFORMACIÓN DE SALUD</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Grupo Etario</th>
                                                                        @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                            <th>{{ $detalleEnfermedad->nombre_detalle_enfermedad }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($grupoEtarioSaluds as $grupoEtarioSalud)
                                                                        <tr>
                                                                            <td>{{ $grupoEtarioSalud->nombre_grupo_etario }}</td>
                                                                            @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                                <td>
                                                                                    <input type="number" name="cantidad_grupo_enfermos[{{ $grupoEtarioSalud->id }}][{{ $detalleEnfermedad->id }}]" class="form-control" min="0">
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

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
                              {{-- DAÑOS A INFRAESTRUCTURAS AFECTADAS --}}
                            <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    DAÑOS A INFRAESTRUCTURAS AFECTADAS
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Daños</b></div>
                                                        <div class="panel-body">
                                                            <h4>DAÑOS A INFRAESTRUCTURAS AFECTADAS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tipo Infraestructura</th>
                                                                        <th>N° de infraestructuras afectadas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($tipoInfraestructuras as $tipoInfraestructura)
                                                                        <tr>
                                                                            <td>
                                                                                {{ $tipoInfraestructura->nombre_tipo_infraestructura }}
                                                                                <input type="hidden" name="tipo_infraestructura_id[]" value="{{ $tipoInfraestructura->id }}">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" name="numeros_infraestructuras_afectadas[]" class="form-control" min="0" required>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Personas</b></div>
                                                        <div class="panel-body">
                                                            <h4>SERVICIOS BÁSICOS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Servicios Basicos</th>
                                                                        <th>Información/Tipo de Daño</th>
                                                                        <th>N° de Comunidades Afectadas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($tiposerviciobasicos as $tiposerviciobasico)
                                                                        <tr>
                                                                            <td>{{ $tiposerviciobasico->nombre_servicio_basico }}
                                                                                <input type="hidden" name="tipo_servicio_basico_id[]" value="{{ $tiposerviciobasico->id }}">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="informacion_tipo_dano[]" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" name="numero_comunidades_afectadas[]" class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- DAÑOS PECUARIOS POR INCENDIOS FORESTALES --}}
                            {{-- <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    DAÑOS PECUARIOS POR INCENDIOS FORESTALES
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Daños</b></div>
                                                        <div class="panel-body">
                                                            <h4>DAÑOS PECUARIOS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Especies</th>
                                                                        <th>Nro de animales Afectados</th>
                                                                        <th>Nro de Animales Fallecidos</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($tipoEspecies as $tipoEspecie)
                                                                    <tr>
                                                                        <td>{{ $tipoEspecie->nombre_tipo_especie }}
                                                                            <input type="hidden" name="tipo_especie_id[]" value="{{ $tipoEspecie->id }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="numero_animales_afectados[]" class="form-control">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="numero_animales_fallecidos[]" class="form-control">
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Daños</b></div>
                                                        <div class="panel-body">
                                                            <h4>DAÑOS AGRÍCOLAS POR INCENDIOS FORESTALES</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Agricola</th>
                                                                        <th>Hectáreas Afectadas</th>
                                                                        <th>Hectáreas Perdidas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($tipoCultivos as $tipoCultivo)
                                                                    <tr>
                                                                        <td>{{ $tipoCultivo->nombre_tipo_cultivo }}
                                                                            <input type="hidden" name="tipo_cultivo_id[]" value="{{ $tipoCultivo->id }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_afectados[]" class="form-control">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_perdidas[]" class="form-control">
                                                                        </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
                        </div>
                        <div class="form-group">
                              {{-- ÁREAS FORESTALES PERDIDAS --}}
                            {{-- <div class="row">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    ÁREAS FORESTALES PERDIDAS
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Areas</b></div>
                                                        <div class="panel-body">
                                                            <h4> ÁREAS FORESTALES PERDIDAS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Areas Forestales</th>
                                                                        <th>Hectáreas Perdidas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($detalleAreaForestals as $detalleAreaForestal)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $detalleAreaForestal->nombre_detalle_area_forestal }}
                                                                            <input type="hidden" name="detalle_area_forestal_id[]"
                                                                                value="{{ $detalleAreaForestal->id }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_perdidas[]"
                                                                                class="form-control">
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Fauna Silvestre</b></div>
                                                        <div class="panel-body">
                                                            <h4>FAUNA SILVESTRE AFECTADA POR INCENDIOS FORESTALES</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Detalle</th>
                                                                        @foreach ($tipoFaunaEspecies as $tipoFaunaEspecie)
                                                                            <th>{{ $tipoFaunaEspecie->nombre_tipo_especie }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($detalleFaunaSilvestres as $detalleFaunaSilvestre)
                                                                        <tr>
                                                                            <td>{{ $detalleFaunaSilvestre->nombre_detalle_fauna_silvestre }}
                                                                                <input type="hidden" name="detalle_fauna_silvestre_id[]" value="{{ $detalleFaunaSilvestre->id }}">
                                                                            </td>
                                                                            @foreach ($tipoFaunaEspecies as $tipoFaunaEspecie)
                                                                                <td>
                                                                                    <label for="numero_fauna_silvestre_{{ $tipoFaunaEspecie->id }}">{{ $tipoFaunaEspecie->nombre_tipo_especie }}</label>
                                                                                    <input type="number" name="numero_fauna_silvestre[{{ $tipoFaunaEspecie->id }}]" id="numero_fauna_silvestre_{{ $tipoFaunaEspecie->id }}" class="form-control">
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
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
