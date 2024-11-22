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
                                                            <div class="form-group">
                                                                <label for="provincia"><b>Provincia</b></label>
                                                                <select name="provincia_id" id="provincia_id" class="form-control">
                                                                    <option value="">-- Selecciona Provincia --</option>
                                                                    @foreach ($provincias as $provincia)
                                                                        <option value="{{ $provincia->id }}" {{ $provincia->id === $provinciaId ? 'selected' : '' }}>
                                                                            {{ $provincia->nombre_provincia }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="municipio">Municipio</label>
                                                                <div id="respuesta_provincia">
                                                                    <select name="municipio_id" id="select_municipio" class="form-control" required readonly>
                                                                        <option value="" disabled selected>-- Selecciona un Municipio --</option>
                                                                        @foreach ($municipios as $municipio)
                                                                        <option value="{{ $municipio->id }}" {{ $municipio->id === $municipioId ? 'selected' : '' }}>{{ $municipio->nombre_municipio }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="nombre_alcalde">Nombre del Alcalde</label>
                                                                <input type="text" id="nombre_alcalde" name="nombre_alcalde"
                                                                    placeholder="Nombre Alcalde" class="form-control" value="{{ $formulario->comunidad->municipio->nombre_alcalde }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="poblacion_total">Población Total</label>
                                                                <input type="number" id="poblacion_total"
                                                                    name="poblacion_total" placeholder="Población Total"
                                                                    class="form-control" value="{{ $formulario->comunidad->municipio->poblacion_total }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Detalles de la Comunidad</b></div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="fecha_llenado">Fecha de Llenado</label>
                                                            <input type="date" id="fecha_llenado" name="fecha_llenado" class="form-control" value="{{ $formulario->fecha_llenado }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_comunidad">Nombre Comunidad</label>
                                                            <input type="text" name="nombre_comunidad" class="form-control" value="{{ $formulario->comunidad->nombre_comunidad }}" required>
                                                        </div>

                                                        @php
                                                            $tipo_comunidades = [
                                                                'INDÍGENA' => 'INDÍGENA',
                                                                'CAMPESINA' => 'CAMPESINA',
                                                                'INTERCULTURAL' => 'INTERCULTURAL',
                                                            ];
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="tipo_comunidad">Tipo de Comunidad</label>
                                                            <select name="tipo_comunidad" id="tipo_comunidad" class="form-control" required>
                                                                @foreach ($tipo_comunidades as $key => $value)
                                                                    <option value="{{ $key }}" {{$key == $formulario->comunidad->tipo_comunidad ? 'selected' : ''}}>{{ $value }}</option>
                                                                @endforeach
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
                                                              <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required value="{{ old('fecha_inicio', $formulario->incendio->fecha_inicio) }}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="causas_probables">Causas Probables</label>
                                                              <input type="text" id="causas_probables" name="causas_probables" placeholder="Introducir Probables"
                                                                  class="form-control" required value="{{ old('causas_probables', $formulario->incendio->causas_probables) }}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="estado">Estado</label>
                                                              <input type="text" id="estado" name="estado" placeholder="Introducir estado del incendio"
                                                                  class="form-control" required value="{{ old('estado', $formulario->incendio->estado) }}">
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
                                                                  placeholder="Introducir Incendios Registrados" class="form-control" required value="{{ old('incendios_registrados', $formulario->comunidad->incendios->first()->pivot->incendios_registrados) }}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="incendios_activos">Incendios Activos</label>
                                                              <input type="number" id="incendios_activos" name="incendios_activos"
                                                                  placeholder="Introducir Incendios Activos" class="form-control" required value="{{ old('incendios_activos', $formulario->comunidad->incendios->first()->pivot->incendios_activos) }}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="necesidades">Necesidades</label>
                                                              <input type="text" id="necesidades" name="necesidades" placeholder="Introducir necesidades"
                                                                  class="form-control" value="{{ old('necesidades', $formulario->comunidad->incendios->first()->pivot->necesidades) }}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="num_familias_afectadas">Familias Afectadas</label>
                                                              <input type="number" id="num_familias_afectadas" name="num_familias_afectadas"
                                                                  placeholder="Introducir Numero" class="form-control" required value="{{old('num_familias_afectadas', $formulario->comunidad->incendios->first()->pivot->num_familias_afectadas)}}">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="num_familias_damnificadas">Familias Damnificadas</label>
                                                              <input type="number" id="num_familias_damnificadas" name="num_familias_damnificadas"
                                                                  placeholder="Introducir Numero" class="form-control" required value="{{ old('num_familias_damnificadas', $formulario->comunidad->incendios->first()->pivot->num_familias_damnificadas) }}">
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
                                                            <h4> PERSONAS AFECTADAS</h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Grupo Etario</th>
                                                                        <th>N° Afectados por Incendios</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($personasAfectadas->groupBy('grupo_etario_id') as $grupoEtarioId => $personaAfectada)
                                                                        <tr>
                                                                            <td>{{ $personaAfectada->first()->grupoEtario->nombre_grupo_etario }}</td>
                                                                            <td>
                                                                                <input type="number" name="cantidad_afectados_por_incendios[{{ $grupoEtarioId }}]"
                                                                                class="form-control" value="{{ old('cantidad_afectados_por_incendios.' . $grupoEtarioId, $personaAfectada->first()->cantidad_afectados_por_incendios) }}">
                                                                             </td>
                                                                        </tr>
                                                                        {{-- @dump($personaAfectada); --}}
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
                                                                    @foreach ($educacions->groupBy('institucion_id') as $institucionId => $educacion)
                                                                        <tr>
                                                                            <td>{{ $educacion->first()->institucion->nombre_institucion }}</td>
                                                                            @foreach ($educacion as $edu)
                                                                                <td>
                                                                                    <input type="number" name="num_estudiantes[{{ $institucionId }}][{{ $edu->modalidadEducacion->id }}]" class="form-control"
                                                                                        value="{{ old('num_estudiantes.' . $institucionId, $educacionData[$institucionId][$edu->modalidadEducacion->id] ?? $edu->num_estudiantes) }}"
                                                                                        required>
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
                                                            <h4> INFORMACIÓN DE SALUD</h4>

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
                                                                    @foreach ($saluds->groupBy('grupo_etario_id') as $grupoEtarioId => $Salud)
                                                                        <tr>
                                                                            <td>{{ $Salud->first()->grupoEtario->nombre_grupo_etario }}</td>
                                                                            @foreach ($Salud as $salu)
                                                                                <td>
                                                                                    <input type="number" name="cantidad_grupo_enfermos[{{  $salu->detalleEnfermedad->id }}][{{ $grupoEtarioId }}]" class="form-control"
                                                                                    value="{{ old('cantidad_grupo_enfermos.' . $grupoEtarioId, $saludData[$salu->detalleEnfermedad->id][$grupoEtarioId] ?? $salu->cantidad_grupo_enfermos) }}">
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
                                                          @php
                                                              $infraestructuraData = [];
                                                              foreach ($infraestructuras as $infraestructura){
                                                                  $infraestructuraData[$infraestructura->tipo_infraestructura_id] = $infraestructura->numeros_infraestructuras_afectadas;
                                                              }
                                                          @endphp
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
                                                                              <input type="number" name="numeros_infraestructuras_afectadas[{{ $tipoInfraestructuraId }}]" class="form-control" value="{{ old('numeros_infraestructuras_afectadas.' . $tipoInfraestructuraId, $infraestructuraData[$tipoInfraestructuraId] ?? $infra->numeros_infraestructuras_afectadas) }}">
                                                                             </td>
                                                                          @endforeach

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
                                                                @foreach ($servicioBasicos->groupBy('tipo_servicio_basico_id') as $tipoServicioBasicoId => $servicioBasicoGroup)
                                                                    <tr>
                                                                        <td>{{ $servicioBasicoGroup->first()->tipoServicioBasico->nombre_servicio_basico ?? 'N/A' }}</td>
                                                                        <td>{{ $servicioBasicoGroup->first()->informacion_tipo_dano }}
                                                                        <td>
                                                                            <input type="number" name="numero_comunidades_afectadas[{{ $tipoServicioBasicoId }}]"
                                                                                class="form-control" min="0"
                                                                                value="{{ old('numero_comunidades_afectadas.' . $tipoServicioBasicoId, $servicioBasicoGroup->first()->numero_comunidades_afectadas ?? 0) }}">
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
                                                                    <td>
                                                                        <input type="number" name="numero_animales_afectados[{{ $tipoEspecieId }}]" value="{{ old('numero_animales_afectados.' . $tipoEspecieId, $SectorPecuario->first()->numero_animales_afectados ?? 0) }}" class="form-control"  min="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="numero_animales_fallecidos[{{ $tipoEspecieId }}]" class="form-control" value="{{ old('numero_animales_fallecidos.' . $tipoEspecieId, $SectorPecuario->first()->numero_animales_fallecidos ?? 0) }}">
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
                                                                @foreach ($sectorAgricolas->groupBy('tipo_cultivo_id') as $tipoCultivoId => $sectorAgricola)
                                                                    <tr>
                                                                        <td>{{ $sectorAgricola->first()->tipoCultivo->nombre_tipo_cultivo }}</td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_afectados[{{ $tipoCultivoId }}]" class="form-control" value="{{ old('hectareas_afectados.' . $tipoCultivoId, $sectorAgricola->first()->hectareas_afectados ?? 0) }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="hectareas_perdidas[{{ $tipoCultivoId }}]" class="form-control" value="{{ old('hectareas_perdidas.' . $tipoCultivoId, $sectorAgricola->first()->hectareas_perdidas ?? 0) }}">
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
                                                                    <td>
                                                                        {{ $areaForestal->first()->detalleAreaForestal->nombre_detalle_area_forestal }}


                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="hectareas_perdidas_forestales[{{ $detalleAreaForestalId }}]"
                                                                        class="form-control" value="{{ old('hectareas_perdidas_forestales.' . $detalleAreaForestalId, $areaForestal->first()->hectareas_perdidas_forestales ?? 0) }}">

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
                                                                            <td>
                                                                                <input type="number" name="numero_fauna_silvestre[{{ $detalleFaunaSilvestreId }}][{{ $fauna->tipoEspecie->id }}]" class="form-control" value="{{ old('numero_fauna_silvestre.' . $detalleFaunaSilvestreId, $faunaSilvestreData[$detalleFaunaSilvestreId][$fauna->tipo_especie_id] ?? $fauna->numero_fauna_silvestre)}}">
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>

</div>
@stop
