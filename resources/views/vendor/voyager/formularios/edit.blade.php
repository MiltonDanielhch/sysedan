@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Actualizar registro del Formulario')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-people"></i>
        Actualizar registro del Formulario
    </h1>
@stop

@section('content')
<div class="page-content edit-add container-fluid">
    <div class="row">
        <form action="{{route('formularios.update', $formulario->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
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
                                                            <div class="form-group">
                                                                <label for="provincia"><b>Provincia</b></label>
                                                                <select name="provincia_id" id="provincia_id" class="form-control" required>
                                                                    <option value="">-- Selecciona Provincia --</option>
                                                                    @foreach ($provincias as $provincia)
                                                                        <option value="{{ $provincia->id }}" {{ $provincia->id === $provinciaId ? 'selected' : '' }}>
                                                                            {{ $provincia->nombre_provincia }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="municipio"><b>Municipio</b></label>
                                                                <div id="respuesta_provincia">
                                                                    <select name="municipio_id" id="select_municipio" class="form-control" required>
                                                                        <option value="" disabled selected>-- Selecciona un Municipio --</option>
                                                                        @foreach ($municipios as $municipio)
                                                                            <option value="{{ $municipio->id }}" {{ $municipio->id === $municipioId ? 'selected' : '' }}>
                                                                                {{ $municipio->nombre_municipio }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="nombre_alcalde"><b>Nombre del Alcalde</b></label>
                                                                <input type="text" id="nombre_alcalde" name="nombre_alcalde" placeholder="Nombre Alcalde" class="form-control" value="{{ $formulario->comunidad->municipio->nombre_alcalde }}" readonly placeholder="No editable">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="poblacion_total"><b>Población Total</b></label>
                                                                <input type="number" id="poblacion_total" name="poblacion_total" placeholder="Población Total" class="form-control" value="{{ $formulario->comunidad->municipio->poblacion_total }}" readonly placeholder="No editable">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Detalles de la Comunidad</b></div>
                                                        <div class="panel-body"><br>
                                                            <div class="form-group">
                                                                <label for="fecha_llenado"><b>Fecha de Llenado</b></label>
                                                                <input type="date" id="fecha_llenado" name="fecha_llenado" class="form-control" value="{{ $formulario->fecha_llenado }}" required>
                                                            </div>

                                                            {{-- <div class="form-group">
                                                                <label for="nombre_comunidad">Nombre Comunidad</label>
                                                                <div id="respuesta_municipio">
                                                                    <div class="loading-indicator">Cargando...</div>
                                                                </div>
                                                            </div> --}}

                                                            <div class="form-group">
                                                                <label for="nombre_comunidad"><b>Nombre Comunidad</b></label>
                                                                <input type="text" name="nombre_comunidad" class="form-control" value="{{ $formulario->comunidad->nombre_comunidad }}" required aria-label="Nombre de la comunidad">
                                                            </div>

                                                            @php
                                                                $tipo_comunidades = [
                                                                    'INDÍGENA' => 'INDÍGENA',
                                                                    'CAMPESINA' => 'CAMPESINA',
                                                                    'INTERCULTURAL' => 'INTERCULTURAL',
                                                                ];
                                                            @endphp
                                                            <div class="form-group">
                                                                <label for="tipo_comunidad"><b>Tipo de Comunidad</b></label>
                                                                <select name="tipo_comunidad" id="tipo_comunidad" class="form-control" required>
                                                                    @foreach ($tipo_comunidades as $key => $value)
                                                                        <option value="{{ $key }}" {{$key == $formulario->comunidad->tipo_comunidad ? 'selected' : ''}}>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="actividades"><b>Actividades</b></label>
                                                                    @foreach($asistencias as $asistencia)
                                                                        <textarea id="actividades" name="actividades[{{ $asistencia->id }}]" placeholder="Actividades" class="form-control">{{ old('actividades.' . $asistencia->id, $asistencia->actividades) }}</textarea>
                                                                    @endforeach
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="cantidad_beneficiarios"><b>Cantidad de Beneficiarios</b></label>
                                                                @foreach($asistencias as $asistencia)
                                                                    <!-- Set unique name for each input -->
                                                                    <input type="number"
                                                                           id="cantidad_beneficiarios_{{ $asistencia->id }}"
                                                                           name="cantidad_beneficiarios[{{ $asistencia->id }}]"
                                                                           placeholder="Introducir Cantidad Beneficiarios"
                                                                           class="form-control"
                                                                           value="{{ old('cantidad_beneficiarios.' . $asistencia->id, $asistencia->cantidad_beneficiarios) }}"
                                                                           required>
                                                                @endforeach
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="fecha_asistencia"><b>Fecha de la Actividad</b></label>
                                                                @foreach($asistencias as $asistencia)
                                                                    <!-- Set a unique name for each input field based on Asistencia ID -->
                                                                    <input type="date"
                                                                        id="fecha_asistencia_{{ $asistencia->id }}"
                                                                        name="fecha_asistencia[{{ $asistencia->id }}]"
                                                                        class="form-control"
                                                                        value="{{ old('fecha_asistencia.' . $asistencia->id, $asistencia->fecha_asistencia->toDateString()) }}"
                                                                        required>
                                                                @endforeach
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
                                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required
                                                                       value="{{ old('fecha_inicio', $formulario->incendio->fecha_inicio) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="causas_probables"><b>Causas Probables</b></label>
                                                                <input type="text" id="causas_probables" name="causas_probables" placeholder="Introducir Probables"
                                                                       class="form-control" required
                                                                       value="{{ old('causas_probables', $formulario->incendio->causas_probables) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="estado"><b>Estado</b></label>
                                                                <input type="text" id="estado" name="estado" placeholder="Introducir estado del incendio"
                                                                       class="form-control" required
                                                                       value="{{ old('estado', $formulario->incendio->estado) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Incendios en la comunidad --}}
                                                <div class="form-group col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de los Afectados en el Incendios en la Comunidad</b></div>
                                                        <div class="panel-body"><br>
                                                            <div class="form-group">
                                                                <label for="incendios_registrados"><b>Incendios Registrados</b></label>
                                                                <input type="number" id="incendios_registrados" name="incendios_registrados"
                                                                       placeholder="Introducir Incendios Registrados" class="form-control" required
                                                                       value="{{ old('incendios_registrados', $formulario->comunidad->incendios->first()->pivot->incendios_registrados) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="incendios_activos"><b>Incendios Activos</b></label>
                                                                <input type="number" id="incendios_activos" name="incendios_activos"
                                                                       placeholder="Introducir Incendios Activos" class="form-control" required
                                                                       value="{{ old('incendios_activos', $formulario->comunidad->incendios->first()->pivot->incendios_activos) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="necesidades"><b>Necesidades</b></label>
                                                                <input type="text" id="necesidades" name="necesidades" placeholder="Introducir necesidades"
                                                                       class="form-control"
                                                                       value="{{ old('necesidades', $formulario->comunidad->incendios->first()->pivot->necesidades) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="num_familias_afectadas"><b>Familias Afectadas</b></label>
                                                                <input type="number" id="num_familias_afectadas" name="num_familias_afectadas"
                                                                       placeholder="Introducir Numero" class="form-control" required
                                                                       value="{{ old('num_familias_afectadas', $formulario->comunidad->incendios->first()->pivot->num_familias_afectadas) }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="num_familias_damnificadas"><b>Familias Damnificadas</b></label>
                                                                <input type="number" id="num_familias_damnificadas" name="num_familias_damnificadas"
                                                                       placeholder="Introducir Numero" class="form-control" required
                                                                       value="{{ old('num_familias_damnificadas', $formulario->comunidad->incendios->first()->pivot->num_familias_damnificadas) }}">
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
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePersonaAfectada"
                                                   aria-expanded="true" aria-controls="collapsePersonaAfectada">
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
                                                            <h4> PERSONAS AFECTADAS</h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Grupo Etario</th>
                                                                            <th>N° Afectados por Incendios</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $totalAfectados = 0; // Variable para acumular el total
                                                                        @endphp
                                                                        @foreach ($personasAfectadas->groupBy('grupo_etario_id') as $grupoEtarioId => $personaAfectada)
                                                                            <tr>
                                                                                <td>{{ $personaAfectada->first()->grupoEtario->nombre_grupo_etario }}</td>
                                                                                <td>
                                                                                    <input type="number" name="cantidad_afectados_por_incendios[{{ $grupoEtarioId }}]"
                                                                                    class="form-control cantidad_afectados" value="{{ old('cantidad_afectados_por_incendios.' . $grupoEtarioId, $personaAfectada->first()->cantidad_afectados_por_incendios) }}"
                                                                                    data-grupo-id="{{ $grupoEtarioId }}" onchange="actualizarTotalPersonaAfectada()">
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                // Sumar la cantidad de afectados por incendios
                                                                                $totalAfectados += $personaAfectada->first()->cantidad_afectados_por_incendios;
                                                                            @endphp
                                                                        @endforeach
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <!-- Mostrar el total de afectados -->
                                                                            <th><strong>Total Personas Afectados por Incendios: </strong></th>
                                                                            <th><span id="totalAfectados"><b>{{ $totalAfectados }}</b></span></th>
                                                                    </tfoot>
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

                                                            @php
                                                                $educacionData = [];
                                                                foreach ($educacions as $educacion) {
                                                                    $educacionData[$educacion->institucion_id][$educacion->modalidad_educacion_id] = $educacion->numero_estudiantes;
                                                                }

                                                                $totales = [];
                                                                foreach ($educacions as $educacion) {
                                                                    $totales[$educacion->modalidadEducacion->id] = ($totales[$educacion->modalidadEducacion->id] ?? 0) + $educacion->numero_estudiantes;
                                                                }

                                                                $totalGeneral = array_sum($totales);
                                                            @endphp

                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Institución</th>
                                                                            @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                                <th>{{ $modalidadEducacion->nombre_modalidad_educacion }}</th>
                                                                            @endforeach
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($educacions->groupBy('institucion_id') as $institucionId => $educacion)
                                                                            <tr>
                                                                                <td>{{ $educacion->first()->institucion->nombre_institucion }}</td>
                                                                                @foreach ($educacion as $edu)
                                                                                    <td>
                                                                                        <input type="number" 
                                                                                            name="num_estudiantes[{{ $institucionId }}][{{ $edu->modalidadEducacion->id }}]" 
                                                                                            class="form-control num-estudiantes"
                                                                                            value="{{ old('num_estudiantes.' . $institucionId, $educacionData[$institucionId][$edu->modalidadEducacion->id] ?? $edu->num_estudiantes) }}"
                                                                                            min="0" 
                                                                                            data-modalidad-id="{{ $edu->modalidadEducacion->id }}" 
                                                                                            data-institucion-id="{{ $institucionId }}"
                                                                                            onchange="actualizarTotalesEducacion()">
                                                                                    </td>
                                                                                @endforeach
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th><strong>Total</strong></th>
                                                                            @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                                <th>
                                                                                    <strong id="total-modalidad-{{ $modalidadEducacion->id }}">
                                                                                        {{ old('totales.' . $modalidadEducacion->id, $totales[$modalidadEducacion->id] ?? 0) }}
                                                                                    </strong>
                                                                                </th>
                                                                            @endforeach
                                                                            <th>
                                                                                <strong id="total-general">{{ $totalGeneral }}</strong>
                                                                            </th>
                                                                        </tr>
                                                                    </tfoot>
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
                                                <a role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseSalud"
                                                   aria-expanded="true" aria-controls="collapseSalud">
                                                    INFORMACIÓN DE SALUD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSalud" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSalud">
                                            <div class="panel-body">
                                                <div class="form-group col-md-10">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><b>Datos de Salud por Grupo Etario y Enfermedad</b></div>
                                                            <div class="panel-body"><br>
                                                                <h4> INFORMACIÓN DE SALUD</h4>

                                                                @php
                                                                    $saludData = [];
                                                                    $totales = []; // Array para guardar los totales
                                                                    foreach ($saluds as $salud) {
                                                                        // Guardamos los datos de salud
                                                                        $saludData[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] = $salud->cantidad_grupo_enfermos;

                                                                        // Calculamos los totales por enfermedad y grupo etario
                                                                        if (!isset($totales[$salud->detalle_enfermedad_id])) {
                                                                            $totales[$salud->detalle_enfermedad_id] = array_fill_keys(array_keys($grupoEtarios->pluck('id')->toArray()), 0);
                                                                        }
                                                                        $totales[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] += $salud->cantidad_grupo_enfermos;
                                                                    }
                                                                @endphp

                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Grupo Etario</th>
                                                                                @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                                    <th>{{ $detalleEnfermedad->nombre_detalle_enfermedad }}</th>
                                                                                @endforeach
                                                                                <th>Total</th> <!-- Columna para total por grupo etario -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($saluds->groupBy('grupo_etario_id') as $grupoEtarioId => $Salud)
                                                                                <tr class="grupo-etario-row" data-grupo-etario-id="{{ $grupoEtarioId }}">
                                                                                    <td>{{ $Salud->first()->grupoEtario->nombre_grupo_etario }}</td>
                                                                                    @foreach ($Salud as $salu)
                                                                                        <td>
                                                                                            <input type="number" class="form-control cantidad_grupo_enfermos"
                                                                                            name="cantidad_grupo_enfermos[{{ $salu->detalleEnfermedad->id }}][{{ $grupoEtarioId }}]" min="0"
                                                                                            value="{{ old('cantidad_grupo_enfermos.' . $grupoEtarioId, $saludData[$salu->detalleEnfermedad->id][$grupoEtarioId] ?? $salu->cantidad_grupo_enfermos) }}"
                                                                                            onchange="actualizarTotalesSalud()">

                                                                                        </td>
                                                                                    @endforeach
                                                                                     <!-- Total por grupo etario para todas las enfermedades -->
                                                                                    <td class="total-grupo-etario" id="total-grupo-etario-{{ $grupoEtarioId }}">
                                                                                        0 <!-- Inicializa el total por grupo etario en 0 -->
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>Total</th>
                                                                                @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                                    <th class="total-enfermedad" id="total-enfermedad-{{ $detalleEnfermedad->id }}">
                                                                                        <!-- Aquí van los totales de las enfermedades -->
                                                                                    </th>
                                                                                @endforeach
                                                                                <th id="cantidad_grupo_enfermos_total-global">0</th> <!-- Total global -->
                                                                            </tr>
                                                                        </tfoot>
                                                                        
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
                                                        <h4>DAÑOS A INFRAESTRUCTURAS AFECTADAS</h4>

                                                        @php
                                                            $infraestructuraData = [];
                                                            $totalAfectados = 0; // Variable para calcular el total de infraestructuras afectadas
                                                        @endphp

                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tipo Infraestructura</th>
                                                                        <th>N° de infraestructuras afectadas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($infraestructuras->groupBy('tipo_infraestructura_id') as $tipoInfraestructuraId => $infraestructura)
                                                                        <tr>
                                                                            <td>{{ $infraestructura->first()->tipoInfraestructura->nombre_tipo_infraestructura }}</td>
                                                                            @foreach ($infraestructura as $infra)
                                                                                <td>
                                                                                    <input type="number" 
                                                                                        name="numeros_infraestructuras_afectadas[{{ $tipoInfraestructuraId }}]"
                                                                                        class="form-control infraestructra-afectadas" min="0"
                                                                                        value="{{ old('numeros_infraestructuras_afectadas.' . $tipoInfraestructuraId, $infraestructuraData[$tipoInfraestructuraId] ?? $infra->numeros_infraestructuras_afectadas) }}"
                                                                                        onchange="actualizarTotalesInfraestructuras()">
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td><strong>Total Infraestructuras Afectadas</strong></td>
                                                                        <td>
                                                                            <span id="total-infraestructuras"></span> <!-- Aquí se mostrará el total -->
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
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
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Servicios Básicos</th>
                                                                    <th>Información/Tipo de Daño</th>
                                                                    <th>N° de Comunidades Afectadas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $totalComunidadAfectada = 0; // Inicializamos el total
                                                                @endphp
                                                        
                                                                @foreach ($servicioBasicos->groupBy('tipo_servicio_basico_id') as $tipoServicioBasicoId => $servicioBasicoGroup)
                                                                    <tr>
                                                                        <td>{{ $servicioBasicoGroup->first()->tipoServicioBasico->nombre_servicio_basico ?? 'N/A' }}</td>
                                                                        <td>{{ $servicioBasicoGroup->first()->informacion_tipo_dano }}</td>
                                                                        <td>
                                                                            <input type="number" name="numero_comunidades_afectadas[{{ $tipoServicioBasicoId }}]"
                                                                                   class="form-control numero_comunidades_afectadas" min="0"
                                                                                   value="{{ old('numero_comunidades_afectadas.' . $tipoServicioBasicoId, $servicioBasicoGroup->first()->numero_comunidades_afectadas ?? 0) }}">
                                                                        </td>
                                                                        @php
                                                                            // Sumar el número de comunidades afectadas por cada tipo de servicio básico
                                                                            $totalComunidadAfectada += $servicioBasicoGroup->first()->numero_comunidades_afectadas ?? 0;
                                                                        @endphp
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td><strong>Total Comunidades Afectadas</strong></td>
                                                                    <td></td>
                                                                    <td colspan="2" id="total-comunidades-afectadas">{{ $totalComunidadAfectada }}</td> <!-- Muestra el total -->
                                                                </tr>
                                                            </tfoot>
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
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Especies</th>
                                                                    <th>Nro de animales Afectados</th>
                                                                    <th>Nro de Animales Fallecidos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($sectorPecuarios->groupBy('tipo_especie_id') as $tipoEspecieId => $SectorPecuario)
                                                                    <tr>
                                                                        <td>{{ $SectorPecuario->first()->tipoEspecie->nombre_tipo_especie }}</td>
                                                                        <td>
                                                                            <input type="number" name="numero_animales_afectados[{{ $tipoEspecieId }}]"
                                                                                   value="{{ old('numero_animales_afectados.' . $tipoEspecieId, $SectorPecuario->first()->numero_animales_afectados ?? 0) }}"
                                                                                   class="form-control numero-animales-afectados" min="0">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="numero_animales_fallecidos[{{ $tipoEspecieId }}]"
                                                                                   value="{{ old('numero_animales_fallecidos.' . $tipoEspecieId, $SectorPecuario->first()->numero_animales_fallecidos ?? 0) }}"
                                                                                   class="form-control numero-animales-fallecidos"  min="0">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><span id="total-animales-afectados">0</span></td> <!-- Mostrar el total de animales afectados -->
                                                                    <td><span id="total-animales-fallecidos">0</span></td> <!-- Mostrar el total de animales fallecidos -->
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Información sobre Daños Agrícolas</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>DAÑOS AGRÍCOLAS</h4>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Agrícola</th>
                                                                    <th>Hectáreas Afectadas</th>
                                                                    <th>Hectáreas Perdidas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($sectorAgricolas->groupBy('tipo_cultivo_id') as $tipoCultivoId => $sectorAgricola)
                                                                    <tr>
                                                                        <td>{{ $sectorAgricola->first()->tipoCultivo->nombre_tipo_cultivo }}</td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_afectados[{{ $tipoCultivoId }}]"
                                                                                   value="{{ old('hectareas_afectados.' . $tipoCultivoId, $sectorAgricola->first()->hectareas_afectados ?? 0) }}"
                                                                                   class="form-control hectareas-afectadas">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_perdidas[{{ $tipoCultivoId }}]"
                                                                                   value="{{ old('hectareas_perdidas.' . $tipoCultivoId, $sectorAgricola->first()->hectareas_perdidas ?? 0) }}"
                                                                                   class="form-control hectareas-perdidas">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><span id="total-hectareas-afectadas">0</span></td> <!-- Total de hectáreas afectadas -->
                                                                    <td><span id="total-hectareas-perdidas">0</span></td> <!-- Total de hectáreas perdidas -->
                                                                </tr>
                                                            </tfoot>
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
                                                        <h4>ÁREAS FORESTALES PERDIDAS</h4>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Áreas Forestales</th>
                                                                    <th>Hectáreas Perdidas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($areaForestals->groupBy('detalle_area_forestal_id') as $detalleAreaForestalId => $areaForestal)
                                                                    <tr>
                                                                        <td>{{ $areaForestal->first()->detalleAreaForestal->nombre_detalle_area_forestal }}</td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_perdidas_forestales[{{ $detalleAreaForestalId }}]"
                                                                                value="{{ old('hectareas_perdidas_forestales.' . $detalleAreaForestalId, $areaForestal->first()->hectareas_perdidas_forestales ?? 0) }}"
                                                                                class="form-control hectareas-perdidas-forestales">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td><strong>Total Hectáreas Perdidas Forestales</strong></td>
                                                                    <td><span id="total-hectareas-perdidas-forestales">0</span></td> <!-- Mostrar el total -->
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                           

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Datos de Fauna Silvestre Afectada por incendios</b></div>
                                                    <div class="panel-body"><br>
                                                        <<h4>FAUNA SILVESTRE AFECTADA</h4>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Detalle</th>
                                                                    @foreach ($faunaSilvestres->groupBy('tipo_especie_id') as $detalleFaunaSilvestre => $faunaSilvestre)
                                                                        <th>{{ $faunaSilvestre->first()->tipoEspecie->nombre_tipo_especie }}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($faunaSilvestres->groupBy('detalle_fauna_silvestre_id') as $detalleFaunaSilvestreId => $faunaSilvestre)
                                                                    <tr>
                                                                        <td>{{ $faunaSilvestre->first()->detalleFaunaSilvestre->nombre_detalle_fauna_silvestre }}</td>
                                                                        @foreach ($faunaSilvestre as $fauna)
                                                                            <td>
                                                                                <input type="number" name="numero_fauna_silvestre[{{ $detalleFaunaSilvestreId }}][{{ $fauna->tipoEspecie->id }}]"
                                                                                       class="form-control fauna-silvestre" 
                                                                                       value="{{ old('numero_fauna_silvestre.' . $detalleFaunaSilvestreId, $fauna->numero_fauna_silvestre) }}">
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td><strong>Total Fauna Silvestre Afectada</strong></td>
                                                                    <td><span id="total-fauna-silvestre">0</span></td> <!-- Mostrar el total -->
                                                                </tr>
                                                            </tfoot>
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
                        {{-- ASISTENCIA Y REFORESTACION --}}
                        {{-- Mostrar mensajes de error y éxito --}}
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
                                                        <div class="table-responsive">
                                                            <table class="table" role="table" aria-labelledby="reforestacionTable">
                                                                <caption></caption>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Plantín</th>
                                                                        <th>Cantidad de Plantines</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($reforestacions as $index => $plantin)
                                                                        <tr>
                                                                            <td>
                                                                                {{ $plantin->especie_plantin }}
                                                                                <input type="hidden" name="id_plantins[]" value="{{ $plantin->id }}">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" name="cantidad_plantines[]" class="form-control cantidad-plantines" min="0" value="{{ old('cantidad_plantines.' . $index, $plantin->cantidad_plantines) }}" data-index="{{ $index }}">
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td><strong>Total de Plantines:</strong></td>
                                                                        <td> <span id="totalPlantines">0</span></td>
                                                                    </tr>
                                                                </tfoot>
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

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

    </div>
</div>
@stop
@section('javascript')

<script>
    // Asignamos la URL de la ruta directamente a una variable de JavaScript
    const actualizarTotalAfectadosUrl = "{{ route('actualizarTotalAfectados') }}";
    const actualizarTotalEducacionUrl = "{{ route('actualizarTotalEducacion') }}";
    const actualizarTotalSaludUrl = "{{ route('actualizarTotalSalud') }}";
    const actualizarInfraestructurasUrl = '{{ route('actualizarInfraestructuras') }}';
    const actualizarComunidadesAfectadasUrl = '{{ route('actualizarComunidadesAfectadas')}}';
    const actualizarPecuariosUrl = '{{ route('actualizarPecuarios') }}';
    const actualizarAgricolasUrl = '{{route('actualizarAgricolas')}}';
    const actualizarForestalesUrl = '{{route('actualizarForestales')}}';
    const actualizarFaunaSilvestreUrl = '{{route('actualizarFaunaSilvestre')}}';

    const actualizarReforestacionUrl = '{{route('actualizarReforestacion')}}';
    const token = "{{ csrf_token() }}";

</script>

<script src="{{ asset('js/formulario-edit.js') }}"></script>

@stop
