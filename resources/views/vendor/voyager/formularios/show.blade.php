@extends('voyager::master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
{{-- @section('page_title', 'Vista formulario'); --}}
@section('page_title', isset($form) ? 'Ver formulario' : 'Crear formulario')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-people"></i>
    Ver formulario
</h1>
@stop

@section('content')
<div class="page-content edit-add container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">

                    <div class="form-group">
                        {{-- INCENDIOS FORESTALES --}}
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
                                                            <p>{{ $form->comunidad->municipio->provincia->nombre_provincia }} </p>
                                                        </div>

                                                        {{-- Select Municipio --}}
                                                        <div class="form-group">
                                                            <label for="municipio">Municipio</label>
                                                            <p>{{ $form->comunidad->municipio->nombre_municipio }}</p>
                                                        </div>

                                                        {{-- Nombre del Alcalde --}}
                                                        <div class="form-group">
                                                            <label for="nombre_alcalde">Nombre del Alcalde</label>
                                                            <p>{{ $form->comunidad->municipio->nombre_alcalde }}</p>
                                                        </div>

                                                        {{-- Población Total --}}
                                                        <div class="form-group">
                                                            <label for="poblacion_total">Población Total</label>
                                                            <p>{{ $form->comunidad->municipio->poblacion_total }}</p>
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
                                                            <p> {{ $form->fecha_llenado }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_comunidad">Nombre Comunidad</label>
                                                            <p> {{ $form->comunidad->nombre_comunidad }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipo_comunidad">Tipo de Comunidad</label>
                                                            <p> {{ $form->comunidad->tipo_comunidad }}</p>
                                                        </div>

                                                        {{-- Actividad --}}
                                                        <div class="form-group">
                                                            <label for="actividades">Actividades</label>
                                                            @foreach($asistencias as $asistencia)
                                                                <p>{{ $asistencia->actividades }}</p>
                                                            @endforeach

                                                            {{-- @dump($asistencias); --}}
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="cantidad_beneficiarios">cantidad beneficiarios</label>
                                                            @foreach($asistencias as $asistencia)
                                                                <p>{{ $asistencia->cantidad_beneficiarios }}</p>
                                                            @endforeach
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fecha_asistencia">Fecha de la Actividad</label>
                                                            @foreach($asistencias as $asistencia)
                                                                <p>{{ $asistencia->fecha_asistencia }}</p>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of Accordion Lugar -->
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
                                                PERSONAS AFECTADAS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsePersonaAfectada" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingPersonaAfectada">
                                        <div class="panel-body">

                                            <div class="form-group col-md-7">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Personas</b></div>
                                                    <div class="panel-body">
                                                        <h4>PERSONAS AFECTADAS</h4>
                                                        @isset($personasAfectadas)
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Grupo Etario</th>
                                                                        <th>Número de Afectados</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $totalAfectados = 0;  // Inicializamos la variable para el total
                                                                    @endphp
                                                                    @foreach ($personasAfectadas as $personaAfectada)
                                                                        <tr>
                                                                            <td>{{ $personaAfectada->grupoEtario->nombre_grupo_etario }}</td>
                                                                            <td>{{ $personaAfectada->cantidad_afectados_por_incendios }}</td>
                                                                            @php
                                                                                // Sumar al total de afectados
                                                                                $totalAfectados += $personaAfectada->cantidad_afectados_por_incendios;
                                                                            @endphp
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th><strong>Total Afectados</strong></th>
                                                                        <th><strong>{{ $totalAfectados }}</strong></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        @else
                                                            <p>No se encontraron personas afectadas para este formulario.</p>
                                                        @endisset

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Personas</b></div>
                                                    <div class="panel-body">
                                                        <h4>INFORMACIÓN EN EDUCACIÓN</h4>
                                                            @php
                                                                $educacionData = [];
                                                                $totalesModalidades = []; // Inicializamos un array para los totales por modalidad
                                                                foreach ($educacions as $educacion) {
                                                                    $educacionData[$educacion->institucion_id][$educacion->modalidad_educacion_id] = $educacion->numero_estudiantes;

                                                                    // Sumar el total de estudiantes por modalidad
                                                                    if (!isset($totalesModalidades[$educacion->modalidad_educacion_id])) {
                                                                        $totalesModalidades[$educacion->modalidad_educacion_id] = 0;
                                                                    }
                                                                    $totalesModalidades[$educacion->modalidad_educacion_id] += $educacion->numero_estudiantes;
                                                                }
                                                            @endphp

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
                                                                    @foreach ($educacions->groupBy('institucion_id') as $institucionId => $institucionEducacions)
                                                                        <tr>
                                                                            <td>{{ $institucionEducacions->first()->institucion->nombre_institucion }}</td>
                                                                            @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                                <td>{{ $educacionData[$institucionId][$modalidadEducacion->id] ?? 0 }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th><strong>Total Estudiantes</strong></th>
                                                                        @foreach ($modalidadEducacions as $modalidadEducacion)
                                                                            <th><strong>{{ $totalesModalidades[$modalidadEducacion->id] ?? 0 }}</strong></th>
                                                                        @endforeach
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
                                                    <div class="panel-heading"><b>Salud</b></div>
                                                        <div class="panel-body">
                                                            <h4> INFORMACIÓN DE SALUD</h4>

                                                            @php
                                                            $saludData = [];
                                                            $totales = [];
                                                            foreach ($saluds as $salud) {
                                                                $saludData[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] = $salud->cantidad_grupo_enfermos;

                                                                // Sumar la cantidad de enfermos por enfermedad
                                                                if (!isset($totales[$salud->detalle_enfermedad_id])) {
                                                                    $totales[$salud->detalle_enfermedad_id] = [];
                                                                }
                                                                if (!isset($totales[$salud->detalle_enfermedad_id][$salud->grupo_etario_id])) {
                                                                    $totales[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] = 0;
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
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($saluds->groupBy('grupo_etario_id') as $grupoEtarioId => $grupoEtarioSaluds)
                                                                        <tr>
                                                                            <td>{{ $grupoEtarioSaluds->first()->grupoEtario->nombre_grupo_etario }}</td>
                                                                            @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                                <td>
                                                                                    @if (isset($saludData[$detalleEnfermedad->id][$grupoEtarioId]))
                                                                                        {{ $saludData[$detalleEnfermedad->id][$grupoEtarioId] }}
                                                                                    @else
                                                                                        0
                                                                                    @endif
                                                                                </td>
                                                                            @endforeach
                                                                            <td class="row-total">
                                                                                {{ array_sum(array_column($grupoEtarioSaluds->toArray(), 'cantidad_grupo_enfermos')) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Total</th>
                                                                        @foreach ($detalleEnfermedades as $detalleEnfermedad)
                                                                            <th class="total-enfermedad" data-enfermedad-id="{{ $detalleEnfermedad->id }}">
                                                                                {{ array_sum(array_column($totales[$detalleEnfermedad->id], null)) }}
                                                                            </th>
                                                                        @endforeach
                                                                        <th id="total-global">
                                                                            {{ array_sum(array_map('array_sum', $totales)) }}
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
                                                DAÑOS A INFRAESTRUCTURAS AFECTADAS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseInfraestructura" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingInfraestructura">
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
                                                                @php
                                                                    $totalInfraestructurasAfectadas = 0; // Inicializamos la variable para el total
                                                                @endphp
                                                                @foreach ($infraestructuras->groupBy('tipo_infraestructura_id') as $tipoInfraestructuraId => $infraestructura)
                                                                    @php
                                                                        // Sumar las infraestructuras afectadas
                                                                        $totalInfraestructurasAfectadas += $infraestructura->first()->numeros_infraestructuras_afectadas;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $infraestructura->first()->tipoInfraestructura->nombre_tipo_infraestructura }}</td>
                                                                        <td>{{ $infraestructura->first()->numeros_infraestructuras_afectadas }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>{{ $totalInfraestructurasAfectadas }}</th> <!-- Mostrar el total -->
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
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
                                                                @php
                                                                    $totalComunidadesAfectadas = 0; // Inicializamos la variable para el total
                                                                @endphp
                                                                @foreach ($servicioBasicos->groupBy('tipo_servicio_basico_id') as $tipoServicioBasicoId => $servicioBasico)
                                                                    @php
                                                                        // Sumar las comunidades afectadas
                                                                        $totalComunidadesAfectadas += $servicioBasico->first()->numero_comunidades_afectadas;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $servicioBasico->first()->tipoServicioBasico->nombre_servicio_basico }}</td>
                                                                        <td>{{ $servicioBasico->first()->informacion_tipo_dano }}</td>
                                                                        <td>{{ $servicioBasico->first()->numero_comunidades_afectadas }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th></th> <!-- Dejar en blanco o colocar un texto si es necesario -->
                                                                    <th>{{ $totalComunidadesAfectadas }}</th> <!-- Mostrar el total de comunidades afectadas -->
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
                                                DAÑOS PECUARIOS POR INCENDIOS FORESTALES
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsePecuario" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingPecuario">
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
                                                                @php
                                                                    $totalAnimalesAfectados = 0;  // Inicializamos el total de animales afectados
                                                                    $totalAnimalesFallecidos = 0; // Inicializamos el total de animales fallecidos
                                                                @endphp
                                                                @foreach ($sectorPecuarios->groupBy('tipo_especie_id') as $tipoEspecieId => $SectorPecuario)
                                                                    @php
                                                                        // Sumar los valores de los animales afectados y fallecidos
                                                                        $totalAnimalesAfectados += $SectorPecuario->first()->numero_animales_afectados;
                                                                        $totalAnimalesFallecidos += $SectorPecuario->first()->numero_animales_fallecidos;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $SectorPecuario->first()->tipoEspecie->nombre_tipo_especie }}</td>
                                                                        <td>{{ $SectorPecuario->first()->numero_animales_afectados }}</td>
                                                                        <td>{{ $SectorPecuario->first()->numero_animales_fallecidos }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>{{ $totalAnimalesAfectados }}</th> <!-- Mostrar el total de animales afectados -->
                                                                    <th>{{ $totalAnimalesFallecidos }}</th> <!-- Mostrar el total de animales fallecidos -->
                                                                </tr>
                                                            </tfoot>
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
                                                                @php
                                                                    $totalHectareasAfectadas = 0;  // Inicializamos el total de hectáreas afectadas
                                                                    $totalHectareasPerdidas = 0;   // Inicializamos el total de hectáreas perdidas
                                                                @endphp
                                                                @foreach ($sectorAgricolas->groupBy('tipo_cultivo_id') as $tipoCultivoId => $sectorAgricola)
                                                                    @php
                                                                        // Sumar los valores de hectáreas afectadas y hectáreas perdidas
                                                                        $totalHectareasAfectadas += $sectorAgricola->first()->hectareas_afectados;
                                                                        $totalHectareasPerdidas += $sectorAgricola->first()->hectareas_perdidas;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $sectorAgricola->first()->tipoCultivo->nombre_tipo_cultivo }}</td>
                                                                        <td>{{ $sectorAgricola->first()->hectareas_afectados }}</td>
                                                                        <td>{{ $sectorAgricola->first()->hectareas_perdidas }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>{{ $totalHectareasAfectadas }}</th> <!-- Mostrar el total de hectáreas afectadas -->
                                                                    <th>{{ $totalHectareasPerdidas }}</th> <!-- Mostrar el total de hectáreas perdidas -->
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
                                                ÁREAS FORESTALES PERDIDAS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseForestales" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingForestales">
                                        <div class="panel-body">
                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Areas</b></div>
                                                    <div class="panel-body">
                                                        <h4> ÁREAS FORESTALES PERDIDAS</h4>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Áreas Forestales</th>
                                                                    <th>Hectáreas Perdidas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $totalHectareasPerdidasForestales = 0;  // Inicializamos el total de hectáreas perdidas forestales
                                                                @endphp
                                                                @foreach ($areaForestals->groupBy('detalle_area_forestal_id') as $detalleAreaForestalId => $areaForestal)
                                                                    @php
                                                                        // Sumar las hectáreas perdidas forestales de cada área forestal
                                                                        $totalHectareasPerdidasForestales += $areaForestal->first()->hectareas_perdidas_forestales;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $areaForestal->first()->detalleAreaForestal->nombre_detalle_area_forestal }}</td>
                                                                        <td>{{ $areaForestal->first()->hectareas_perdidas_forestales }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>{{ $totalHectareasPerdidasForestales }}</th> <!-- Mostrar el total de hectáreas perdidas forestales -->
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Fauna Silvestre</b></div>
                                                    <div class="panel-body">
                                                        <h4>FAUNA SILVESTRE AFECTADA POR INCENDIOS FORESTALES</h4>
                                                        @php
                                                            $faunaSilvestreData = [];
                                                            $totalFaunaSilvestre = 0;  // Variable para almacenar el total de fauna silvestre
                                                            foreach ($faunaSilvestres as $faunaSilvestre) {
                                                                $faunaSilvestreData[$faunaSilvestre->detalle_fauna_silvestre_id][$faunaSilvestre->tipo_especie_id] = $faunaSilvestre->numero_fauna_silvestre;
                                                                // Sumar el número de fauna silvestre al total
                                                                $totalFaunaSilvestre += $faunaSilvestre->numero_fauna_silvestre;
                                                            }
                                                        @endphp

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
                                                                            <td>{{ $faunaSilvestreData[$detalleFaunaSilvestreId][$fauna->tipo_especie_id] }}</td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th colspan="{{ $faunaSilvestres->groupBy('tipo_especie_id')->count() }}">
                                                                        {{ $totalFaunaSilvestre }} <!-- Mostrar el total de fauna silvestre -->
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
                    <div class="form-group">
                        {{-- ASISTENCIA Y REFORESTACION --}}
                        <div class="row">
                            <div class="panel-group" id="accordionReforestacion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingReforestacion">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordionReforestacion"
                                                href="#collapseReforestacion" aria-expanded="true" aria-controls="collapseReforestacion">
                                                REFORESTACIONES
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseReforestacion" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingReforestacion">
                                        <div class="panel-body">

                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Reforestacion</b></div>
                                                    <div class="panel-body">
                                                        <h4>REFORESTACION</h4>
                                                        <div class="table-responsive">
                                                            <table class="table" role="table" aria-labelledby="reforestacionTable">
                                                                <caption>Información sobre la Reforestación</caption>
                                                                @php
                                                                    $totalReforestacion = $reforestacions->sum('cantidad_plantines');
                                                                @endphp
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
                                                                            </td>
                                                                            <td>
                                                                               {{ $plantin->cantidad_plantines }}
                                                                            </td>
                                                                        </tr>
                                                                        {{-- @dump($plantin); --}}
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Total</th>
                                                                        <th>
                                                                            {{$totalReforestacion}}
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
                </div>
            </div>
        </div>
    </div>
</div>
@stop
