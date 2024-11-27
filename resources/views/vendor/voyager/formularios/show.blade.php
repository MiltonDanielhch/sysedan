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
                                                                    @foreach ($personasAfectadas as $personaAfectada)
                                                                        <tr>
                                                                            <td>{{ $personaAfectada->grupoEtario->nombre_grupo_etario }}</td>
                                                                            <td>{{ $personaAfectada->cantidad_afectados_por_incendios }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
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
                                                            foreach ($educacions as $educacion) {
                                                                $educacionData[$educacion->institucion_id][$educacion->modalidad_educacion_id] = $educacion->numero_estudiantes;
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
                                                                            <td>{{ $educacionData[$institucionId][$modalidadEducacion->id] ?? 'N/A' }}</td>
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
                                                    <div class="panel-heading"><b>Salud</b></div>
                                                    <div class="panel-body">
                                                        <h4>INFORMACIÓN DE SALUD</h4>
                                                        @php
                                                            $saludData = [];
                                                            foreach ($saluds as $salud){
                                                                $saludData[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] = $salud->cantidad_grupo_enfermos;
                                                            }
                                                        @endphp
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
                                                                @foreach ($infraestructuras->groupBy('tipo_infraestructura_id') as $tipoInfraestructuraId => $infraestructura)
                                                                    <tr>
                                                                        <td>{{ $infraestructura->first()->tipoInfraestructura->nombre_tipo_infraestructura }}</td>
                                                                        <td>{{ $infraestructura->first()->numeros_infraestructuras_afectadas }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
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
                                                                @foreach ($servicioBasicos->groupBy('tipo_servicio_basico_id') as $tipoServicioBasicoId => $servicioBasico)
                                                                    <tr>
                                                                        <td>{{ $servicioBasico->first()->tipoServicioBasico->nombre_servicio_basico }}</td>
                                                                        <td>{{ $servicioBasico->first()->informacion_tipo_dano }}</td>
                                                                        <td>{{ $servicioBasico->first()->numero_comunidades_afectadas }}</td>
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
                                                                @foreach ($sectorPecuarios->groupBy('tipo_especie_id') as $tipoEspecieId => $SectorPecuario)
                                                                    <tr>
                                                                        <td>{{ $SectorPecuario->first()->tipoEspecie->nombre_tipo_especie }}</td>
                                                                        <td>{{ $SectorPecuario->first()->numero_animales_afectados }}</td>
                                                                        <td>{{ $SectorPecuario->first()->numero_animales_fallecidos }}</td>
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
                                                                @foreach ($sectorAgricolas->groupBy('tipo_cultivo_id') as $tipoCultivoId => $sectorAgricola)
                                                                    <tr>
                                                                        <td>{{ $sectorAgricola->first()->tipoCultivo->nombre_tipo_cultivo }}</td>
                                                                        <td>{{ $sectorAgricola->first()->hectareas_afectados }}</td>
                                                                        <td>{{ $sectorAgricola->first()->hectareas_perdidas }}</td>
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
                                                                    <th>Areas Forestales</th>
                                                                    <th>Hectáreas Perdidas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($areaForestals->groupBy('detalle_area_forestal_id') as $detalleAreaForestalId => $areaForestal)
                                                                    <tr>
                                                                        <td>{{ $areaForestal->first()->detalleAreaForestal->nombre_detalle_area_forestal }}</td>
                                                                        <td>{{ $areaForestal->first()->hectareas_perdidas_forestales }}</td>
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
                                                        @php
                                                        $faunaSilvestreData = [];
                                                        foreach ($faunaSilvestres as $faunaSilvestre) {
                                                            $faunaSilvestreData[$faunaSilvestre->detalle_fauna_silvestre_id][$faunaSilvestre->tipo_especie_id] = $faunaSilvestre->numero_fauna_silvestre;
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
@stop
