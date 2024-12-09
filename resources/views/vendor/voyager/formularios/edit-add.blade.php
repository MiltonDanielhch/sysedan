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


    <!-- Incluir el archivo del modal -->
    @include('vendor.voyager.formularios.modal_comunidad');

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
                                                    LISTADO DEL LUGAR DEL LUGAR DE INCENDIO
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseLugar" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingLugar">
                                            <div class="panel-body">
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Detalle del Lugar</b></div>
                                                        <div class="panel-body"><br>
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
                                                                <label for="municipio"><b>Municipio</b></label>
                                                                <div id="respuesta_provincia">
                                                                    <div class="loading-indicator">Cargando...</div>
                                                                </div>
                                                            </div>

                                                            {{-- Nombre del Alcalde --}}
                                                            <div class="form-group">
                                                                <label for="nombre_alcalde"><b>Nombre del Alcalde</b></label>
                                                                <input type="text" id="nombre_alcalde" name="nombre_alcalde"
                                                                    placeholder="Nombre Alcalde" class="form-control"
                                                                    readonly>
                                                            </div>
                                                            {{-- Población Total --}}
                                                            <div class="form-group">
                                                                <label for="poblacion_total"><b>Población Total</b></label>
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
                                                    <div class="panel-heading"><b>Detalles de la Comunidad y Actividades Realizadas</b></div>
                                                    <div class="panel-body"><br>
                                                        <div class="form-group">
                                                            <label for="fecha_llenado"><b>Fecha de Llenado</b></label>
                                                            <input type="date" id="fecha_llenado" name="fecha_llenado" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_comunidad"><b>Nombre Comunidad</b></label>
                                                            <div id="respuesta_municipio">
                                                                <div class="loading-indicator">Cargando...</div>
                                                            </div>
                                                        </div>

                                                           <!-- Botón que abre el modal -->
                                                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                                            Añadir Comunidad
                                                        </button>

                                                        {{-- Actividad --}}
                                                        <div class="form-group">
                                                            <label for="actividades"><b>Actividades</b></label>
                                                            <textarea id="actividades" name="actividades" placeholder="Actividades" class="form-control"></textarea>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="cantidad_beneficiarios"><b>cantidad beneficiarios</b></label>
                                                            <input type="number" id="cantidad_beneficiarios" name="cantidad_beneficiarios"
                                                                placeholder="Introducir Cantidad Beneficiarios" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fecha_asistencia"><b>Fecha de la Actividad</b></label>
                                                            <input type="date" id="fecha_asistencia" name="fecha_asistencia" class="form-control" required>
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
                                                    DATOS DEL INCENDIOS FORESTALES DE LAS COMUNIDAD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseIncendio" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingIncendio">
                                            <div class="panel-body">
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos del Incendio</b></div>
                                                        <div class="panel-body"><br>
                                                            <div class="form-group">
                                                                <label for="fecha_inicio"><b>Fecha de Inicio</b></label>
                                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="causas_probables"><b>Causas Probables</b></label>
                                                                <input type="text" id="causas_probables" name="causas_probables" placeholder="Introducir Probables"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="estado"><b>Estado</b></label>
                                                                <select id="estado" name="estado" class="form-control" required>
                                                                    <option value="Activo">Activo</option>
                                                                    <option value="Controlado">Controlado</option>
                                                                    <option value="Apagado">Apagado</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de los Afectados en el Incendios en la Comunidad</b></div>
                                                        <div class="panel-body"><br>
                                                            <div class="form-group">
                                                                <label for="incendios_registrados"><b>Incendios Registrados</b></label>
                                                                <input type="number" id="incendios_registrados" name="incendios_registrados"
                                                                    placeholder="Introducir Incendios Registrados" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="incendios_activos"><b>Incendios Activos</b></label>
                                                                <input type="number" id="incendios_activos" name="incendios_activos"
                                                                    placeholder="Introducir Incendios Activos" class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="necesidades"><b>Necesidades</b></label>
                                                                <input type="text" id="necesidades" name="necesidades" placeholder="Introducir necesidades" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="num_familias_afectadas"><b>Familias Afectadas</b></label>
                                                                <input type="number" id="num_familias_afectadas" name="num_familias_afectadas"
                                                                    placeholder="Introducir Numero" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="num_familias_damnificadas"><b>Familias Damnificadas</b></label>
                                                                <input type="number" id="num_familias_damnificadas" name="num_familias_damnificadas"
                                                                    placeholder="Introducir Numero" class="form-control">
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
                                <div class="panel-group" id="accordionPersonaAfectada" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingPersonaAfectada">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapsePersonaAfectada" aria-expanded="true" aria-controls="collapsePersonaAfectada">
                                                    DATOS DE LAS PERSONAS AFECTADAS E INFORMACIÓN EN LA EDUCACIÓN
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapsePersonaAfectada" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingPersonaAfectada">
                                            <div class="panel-body">

                                                <div class="form-group col-md-7">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Personas afectadas en la Comunidad</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>PERSONAS AFECTADAS</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="personaAfectadaTable">
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
                                                                                    class="form-control" min="0">

                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de afectados en Educación en la Comunidad</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>INFORMACIÓN EN EDUCACIÓN</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="educacionTable">
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
                                                                                        <input type="number" name="num_estudiantes[{{ $institucion->id }}][{{ $modalidadEducacion->id }}]" class="form-control" min="0">
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
                        </div>

                        <div class="form-group">
                            {{-- INFORMACIÓN DE SALUD --}}
                            <div class="row">
                                <div class="panel-group" id="accordionSalud" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingSalud">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionSalud"
                                                    href="#collapseSalud" aria-expanded="true" aria-controls="collapseSalud">
                                                    INFORMACIÓN DE SALUD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSalud" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingSalud">
                                            <div class="panel-body">
                                                <div class="form-group col-md-10">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Salud por Grupo Etario y Enfermedad</b></div>
                                                        <div class="panel-body"><br>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="saludTable">
                                                                    <caption></caption>
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
                                                                                        <input type="number" name="cantidad_grupo_enfermos[{{ $grupoEtarioSalud->id }}][{{ $detalleEnfermedad->id }}]"
                                                                                            class="form-control" min="0">
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
                        </div>

                        <div class="form-group">
                            {{-- DAÑOS A INFRAESTRUCTURAS AFECTADAS --}}
                            <div class="row">
                                <div class="panel-group" id="accordionInfraestructura" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingInfraestructura">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionInfraestructura"
                                                    href="#collapseInfraestructura" aria-expanded="true" aria-controls="collapseInfraestructura">
                                                    DATOS DE DAÑOS A INFRAESTRUCTURAS AFECTADAS Y SERVICIOS BASICOS
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseInfraestructura" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingInfraestructura">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Información sobre Daños a Infraestructuras</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>INFRAESTRUCTURAS AFECTADAS</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="infraestructuraTable">
                                                                    <caption></caption>
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
                                                                                    <input type="hidden" name="tipo_infraestructura_id[]"
                                                                                        value="{{ $tipoInfraestructura->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="numeros_infraestructuras_afectadas[]"
                                                                                        class="form-control">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Daños a Servicios Básicos</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>SERVICIOS BÁSICOS</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="serviciosBasicosTable">
                                                                    <caption></caption>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Servicios Básicos</th>
                                                                            <th>Descripción del Daño</th>
                                                                            <th>N° de Comunidades Afectadas</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($tiposerviciobasicos as $tiposerviciobasico)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $tiposerviciobasico->nombre_servicio_basico }}
                                                                                    <input type="hidden" name="tipo_servicio_basico_id[]"
                                                                                        value="{{ $tiposerviciobasico->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="informacion_tipo_dano[]"
                                                                                        class="form-control" placeholder="Describa el daño" >
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="numero_comunidades_afectadas[]"
                                                                                        class="form-control" >
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

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- DAÑOS PECUARIOS POR INCENDIOS FORESTALES --}}
                            <div class="row">
                                <div class="panel-group" id="accordionPecuario" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingPecuario">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionPecuario"
                                                    href="#collapsePecuario" aria-expanded="true" aria-controls="collapsePecuario">
                                                    DATOS DE LOS DAÑOS PECUARIOS Y AGRICOLAS POR INCENDIOS FORESTALES
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapsePecuario" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingPecuario">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Información sobre Daños Pecuarios</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>DAÑOS PECUARIOS</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" aria-labelledby="damagesLivestockTable">
                                                                    <caption></caption>
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
                                                                                    <input type="hidden" name="tipo_especie_id[]"
                                                                                        value="{{ $tipoEspecie->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="numero_animales_afectados[]"
                                                                                        class="form-control" min="0" >
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="numero_animales_fallecidos[]"
                                                                                        class="form-control" min="0" >
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Información sobre Daños Agrícolas</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>DAÑOS AGRÍCOLAS </h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" aria-labelledby="damagesAgriculturalTable">
                                                                    <caption></caption>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Agrícola</th>
                                                                            <th>Hectáreas Afectadas</th>
                                                                            <th>Hectáreas Perdidas</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($tipoCultivos as $tipoCultivo)
                                                                            <tr>
                                                                                <td>{{ $tipoCultivo->nombre_tipo_cultivo }}
                                                                                    <input type="hidden" name="tipo_cultivo_id[]"
                                                                                        value="{{ $tipoCultivo->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="hectareas_afectados[]"
                                                                                        class="form-control" min="0" >
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="hectareas_perdidas[]"
                                                                                        class="form-control" min="0" >
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

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{-- ÁREAS FORESTALES PERDIDAS --}}
                            <div class="row">
                                <div class="panel-group" id="accordionForestales" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingForestales">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionForestales"
                                                    href="#collapseForestales" aria-expanded="true" aria-controls="collapseForestales">
                                                    DAÑOS DE ÁREAS FORESTALES PERDIDAS Y FAUNA SILVESTRES AFECTADAS
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseForestales" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingForestales">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Áreas Forestales Perdidas por Incendio</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4> ÁREAS FORESTALES PERDIDAS</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" aria-labelledby="forestAreasLostTable">
                                                                    <caption></caption>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Áreas Forestales</th>
                                                                            <th>Hectáreas Perdidas</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($detalleAreaForestals as $detalleAreaForestal)
                                                                            <tr>
                                                                                <td>{{ $detalleAreaForestal->nombre_detalle_area_forestal }}
                                                                                    <input type="hidden" name="detalle_area_forestal_id[]"
                                                                                        value="{{ $detalleAreaForestal->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="hectareas_perdidas_forestales[]"
                                                                                        class="form-control" min="0" placeholder="Número de hectáreas">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Fauna Silvestre Afectada por incendios</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>FAUNA SILVESTRE AFECTADA</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table table-bordered table-striped" aria-labelledby="wildlifeAffectedTable">
                                                                    <caption></caption>
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
                                                                                    <input type="hidden" name="detalle_fauna_silvestre_id[]"
                                                                                        value="{{ $detalleFaunaSilvestre->id }}">
                                                                                </td>
                                                                                @foreach ($tipoFaunaEspecies as $tipoFaunaEspecie)
                                                                                    <td>
                                                                                        <input type="number" name="numero_fauna_silvestre[{{ $detalleFaunaSilvestre->id }}][{{ $tipoFaunaEspecie->id }}]"
                                                                                               class="form-control" min="0"  placeholder="Número de animales afectados">
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
                        </div>

                        <div class="form-group">
                            {{-- REFORESTACION --}}
                            <div class="row">
                                <div class="panel-group" id="accordionReforestacion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingReforestacion">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordionReforestacion"
                                                    href="#collapseReforestacion" aria-expanded="true" aria-controls="collapseReforestacion">
                                                    ENTREGA DE PLANTINES PARA REFORESTACIONES
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseReforestacion" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingReforestacion">
                                            <div class="panel-body">

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Información sobre la Reforestación</b></div>
                                                        <div class="panel-body"><br>
                                                            <h4>REFORESTACION</h4>
                                                            <div class="table-responsive table-striped">
                                                                <table class="table" role="table" aria-labelledby="reforestacionTable">
                                                                    <caption></caption>
                                                                    @php
                                                                        $plantines = ['Tajibo', 'Tamarindo', 'Asaí', 'Acerola', 'Limón', 'Toronja', 'Palmeras', 'Achachairú', 'Maracuyá', 'Cacao', 'Naranja', 'Albaca', 'Limón Camba', 'Cáctus', 'Sábila', 'Guayaba', 'Sinini', 'Cayú'];
                                                                    @endphp
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Plantín</th>
                                                                            <th>Cantidad de Plantines</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($plantines as $index => $plantin)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $plantin }}
                                                                                    <input type="hidden" name="especie_plantin[]" value="{{ $plantin }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="cantidad_plantines[]" class="form-control" min="0">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif

                                                                @if(session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('success') }}
                                                                    </div>
                                                                @endif
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
<script src="{{ asset('js/formulario-add.js') }}"></script>
@stop
