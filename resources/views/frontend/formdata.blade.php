@extends('frontend.index')
@section('content')
    <section class="flat-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-inner">
                        <div class="title-group fs-12">
                            <a class="home fw-6 text-color-3" href="index.html">Inicio</a><span>Formulario de Incendio</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="flat-property-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrap-house wg-dream flex">
                        <div class="box-1">
                            <div class="title-heading fs-30 fw-7 lh-45">Incendio en {{ $form->comunidad->nombre_comunidad }}</div>
                            <div class="inner flex">
                                {{-- <div class="sales fs-12 fw-7 font-2 text-color-1">En curso</div> --}}
                                <div class="text-address"><p>{{ $form->comunidad->municipio->provincia->nombre_provincia }}, {{ $form->comunidad->municipio->nombre_municipio }}, Bolivia</p></div>
                                <div class="icon-inner flex">
                                    <div class="years-icon flex align-center">
                                        <i class="fal fa-calendar"></i>
                                        {{-- <li class="flex"><span class="one fw-6">Fecha de Inicio</span><span class="two">{{ $form->incendio->fecha_inicio }}</span></li> --}}
                                        <p class="text-color-2">Iniciado el {{ \Carbon\Carbon::parse($form->incendio->fecha_inicio)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</p>

                                    </div>
                                    {{-- <div class="view-icon flex align-center">
                                        <i class="far fa-eye"></i>
                                        <p class="text-color-2">4,529 Vistas</p>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="icon-box flex">
                                <div class="icons icon-1 flex"><span>Familias afectadas: </span><span class="fw-6">{{ $form->comunidad->incendios->first()->pivot->num_familias_afectadas }}</span></div>
                                <div class="icons icon-2 flex"><span>Familias damnificadas: </span><span class="fw-6">{{ $form->comunidad->incendios->first()->pivot->num_familias_damnificadas }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post">
                        {{-- <div class="wrap-map wrap-property wrap-style">
                                <h3 class="titles">Ubicación en el mapa</h3>
                                <div class="box flex">
                                    <ul>
                                        <li class="flex"><span class="one fw-6">Dirección</span><span class="two">150 sqft</span></li>
                                        <li class="flex"><span class="one fw-6">Ciudad</span><span class="two">#1234</span></li>
                                        <li class="flex"><span class="one fw-6">Estado/condado</span><span class="two">$7,500</span></li>
                                    </ul>
                                    <ul>
                                        <li class="flex"><span class="one fw-6">Código postal</span><span class="two">7.328</span></li>
                                        <li class="flex"><span class="one fw-6">Área</span><span class="two">7.328</span></li>
                                        <li class="flex"><span class="one fw-6">País</span><span class="two">2022</span></li>
                                    </ul>
                                </div>
                                <br><br><br>
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header">
                                            Buscar dirección
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Dirección </label><b>*</b>
                                                        <input id="pac-input" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                                        <br>
                                                        <div id="map" style="width: 100%;height: 400px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    'use strict';

                                    const map = L.map('map', {
                                        center: [-14.8795, -66.2419],
                                        zoom: 7,
                                    });

                                    const osm = L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '© <a href="//www.openstreetmap.org/">OpenStreetMap</a> contributors, CC BY-SA license'
                                    }).addTo(map);

                                    const addressSearchResults = new L.LayerGroup().addTo(map);

                                    const osmGeocoder = new L.Control.geocoder({
                                        collapsed: false,
                                        position: 'topright',
                                        text: 'Address Search',
                                        placeholder: 'Enter street address',
                                        defaultMarkGeocode: false
                                    }).addTo(map);

                                    osmGeocoder.on('markgeocode', e => {
                                        const coords = [e.geocode.center.lat, e.geocode.center.lng];
                                        map.setView(coords, 16);
                                        const resultMarker = L.marker(coords).addTo(map);
                                        resultMarker.bindPopup(e.geocode.name).openPopup();
                                    });
                                </script>



                        </div> --}}

                        <div class="wrap-text wrap-style">
                            <h3 class="titles">Descripción del incendio forestal</h3>
                            <p class="text-1 text-color-2">Un incendio forestal es un evento de gran magnitud en el cual se produce una combustión no controlada en áreas naturales, como bosques, selvas, matorrales o áreas de vegetación. Este tipo de incendio puede ser causado por factores naturales, como rayos, o por actividades humanas, como fogatas mal apagadas, quemas agrícolas o chispas de maquinaria.</p>

                            <!-- Este es el texto que se ocultará inicialmente -->
                            <div id="more-text" class="text-more text-color-2" style="display: none;">
                                <p class="text-1 text-color-2">Los incendios forestales tienen un impacto devastador sobre el medio ambiente, la biodiversidad y las comunidades cercanas. Durante el incendio, se destruyen grandes extensiones de vegetación, afectando tanto la flora como la fauna del área. Esto puede llevar a la pérdida de hábitats, la disminución de especies y la alteración de ecosistemas.</p>
                                <p class="text-1 text-color-2">Además, los incendios forestales representan una grave amenaza para la seguridad humana, ya que pueden desplazarse rápidamente, poniendo en riesgo la vida de las personas y sus propiedades. Las condiciones climáticas extremas, como sequías y altas temperaturas, pueden empeorar la situación, creando condiciones ideales para que los incendios se propaguen rápidamente.</p>
                                <p class="text-1 text-color-2">La prevención, control y manejo adecuado de incendios forestales son fundamentales para mitigar estos riesgos. Las estrategias incluyen la educación sobre el uso responsable del fuego, la creación de cortafuegos, la monitorización de áreas vulnerables y la rápida respuesta por parte de brigadas especializadas para combatir el fuego.</p>
                            </div>

                            <a href="javascript:void(0);" class="fw-6" id="toggleText">Ver más</a>
                        </div>

                        <script>
                            document.getElementById("toggleText").addEventListener("click", function() {
                                var moreText = document.getElementById("more-text");
                                var linkText = document.getElementById("toggleText");

                                if (moreText.style.display === "none") {
                                    moreText.style.display = "block"; // Muestra el contenido
                                    linkText.innerHTML = "Ver menos"; // Cambia el texto del enlace
                                } else {
                                    moreText.style.display = "none"; // Oculta el contenido
                                    linkText.innerHTML = "Ver más"; // Vuelve a mostrar "Ver más"
                                }
                            });
                        </script>

                        <div class="wrap-property wrap-style">
                            <h3 class="titles">Detalles del incendio forestal</h3>
                            <div class="box flex">
                                <ul>
                                    <li class="flex"><span class="one fw-6">Provincia</span><span class="two">{{ $form->comunidad->municipio->provincia->nombre_provincia }}</span></li>
                                    <li class="flex"><span class="one fw-6">Municipio</span><span class="two">{{ $form->comunidad->municipio->nombre_municipio }}</span></li>
                                    <li class="flex"><span class="one fw-6">Nombre del Alcalde</span><span class="two">{{ $form->comunidad->municipio->nombre_alcalde }}</span></li>
                                    <li class="flex"><span class="one fw-6">Población Total</span><span class="two">{{ $form->comunidad->municipio->poblacion_total }}</span></li>
                                    {{-- <a href="{{ route('map') }}" class="ver-mapa-link">Ver mapa</a> --}}
                                    <a href="{{ route('map', ['provincia' => $form->comunidad->municipio->provincia->nombre_provincia, 'municipio' => $form->comunidad->municipio->nombre_municipio, 'comunidad' => $form->comunidad->nombre_comunidad]) }}" class="ver-mapa-link">Ver mapa</a>

                                </ul>
                                <style>
                                    .ver-mapa-link {
                                        text-decoration: none; /* Elimina el subrayado predeterminado */
                                        color: #fff; /* Color del texto */
                                        background-color: #007bff; /* Fondo azul */
                                        padding: 10px 20px; /* Espaciado alrededor del texto */
                                        border-radius: 5px; /* Bordes redondeados */
                                        font-size: 16px; /* Tamaño de fuente */
                                        transition: background-color 0.3s ease, transform 0.3s ease; /* Transición suave para el cambio de color y efecto hover */
                                    }

                                    .ver-mapa-link:hover {
                                        background-color: #0056b3; /* Color de fondo al pasar el mouse */
                                        transform: translateY(-2px); /* Efecto de levantamiento al pasar el mouse */
                                    }

                                    .ver-mapa-link:focus {
                                        outline: none; /* Elimina el contorno cuando se hace foco en el enlace */
                                        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Añade un sombreado cuando está enfocado */
                                    }

                                </style>
                                <ul>
                                    <li class="flex"><span class="one fw-6">Fecha de Llenado</span><span class="two">{{ $form->fecha_llenado }}</span></li>
                                    <li class="flex"><span class="one fw-6">Nombre Comunidad</span><span class="two">{{ $form->comunidad->nombre_comunidad }}</span></li>
                                    <li class="flex"><span class="one fw-6">Tipo de Comunidad</span><span class="two">{{ $form->comunidad->tipo_comunidad }}</span></li>
                                    <li class="flex"><span class="one fw-6">Actividades</span><span class="two">
                                        @foreach($asistencias as $asistencia)
                                            {{ $asistencia->actividades }}
                                        @endforeach
                                    </span></li>
                                    <li class="flex"><span class="one fw-6">cantidad beneficiarios</span><span class="two">
                                        @foreach($asistencias as $asistencia)
                                            {{ $asistencia->cantidad_beneficiarios }}
                                        @endforeach
                                    </span></li>
                                    <li class="flex"><span class="one fw-6">Fecha de la Actividad</span><span class="two">
                                        @foreach($asistencias as $asistencia)
                                        {{ \Carbon\Carbon::parse($asistencia->fecha_asistencia)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                                        @endforeach
                                    </span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="wrap-property wrap-style">
                            <h3 class="titles">Detalles del incendio forestal</h3>
                            <div class="box flex">
                                <ul>
                                    <li class="flex"><span class="one fw-6">Fecha de Inicio</span><span class="two">{{ $form->incendio->fecha_inicio }}</span></li>
                                    <li class="flex"><span class="one fw-6">Causas Probables</span><span class="two">{{ $form->incendio->causas_probables }}</span></li>
                                    <li class="flex"><span class="one fw-6">Estado</span><span class="two">{{ $form->incendio->estado }}</span></li>
                                    <li class="flex"><span class="one fw-6">Incendios Registrados</span><span class="two">{{ $form->comunidad->incendios->first()->pivot->incendios_registrados }}</span></li>
                                    <li class="flex"><span class="one fw-6">Incendios Activos</span><span class="two">{{ $form->comunidad->incendios->first()->pivot->incendios_activos }}</span></li>
                                </ul>
                                <ul>
                                    <li class="flex"><span class="one fw-6">Necesidades</span><span class="two">{{ $form->comunidad->incendios->first()->pivot->necesidades }}</span></li>
                                    <li class="flex"><span class="one fw-6">Familias Afectadas</span><span class="two">{{ $form->comunidad->incendios->first()->pivot->num_familias_afectadas }}</span></li>
                                    <li class="flex"><span class="one fw-6">Familias Damnificadas</span><span class="two">{{ $form->comunidad->incendios->first()->pivot->num_familias_damnificadas }}</span></li>
                                </ul>
                            </div>
                        </div>

                        {{-- <div class="wrap-property wrap-style">
                            <h3 class="titles">Detalles del incendio forestal</h3>
                            <div class="box flex">
                                <ul>
                                    <li class="flex"><span class="one fw-6">Fecha de Inicio</span><span class="two">{{ $form->incendio->fecha_inicio }}</span></li>
                                    <li class="flex"><span class="one fw-6">Causas Probables</span><span class="two">{{ $form->incendio->causas_probables }}</span></li>
                                    <li class="flex"><span class="one fw-6">Ubicación</span><span class="two">Bosque de la Sierra</span></li>
                                    <li class="flex"><span class="one fw-6">Tamaño afectado</span><span class="two">150 hectáreas</span></li>
                                    <li class="flex"><span class="one fw-6">Fuerzas de control</span><span class="two">Bomberos locales</span></li>
                                </ul>
                                <ul>
                                    <li class="flex"><span class="one fw-6">Nivel de amenaza</span><span class="two">Alto</span></li>
                                    <li class="flex"><span class="one fw-6">Tipo de incendio</span><span class="two">Superficial</span></li>
                                    <li class="flex"><span class="one fw-6">Condiciones climáticas</span><span class="two">Viento moderado</span></li>
                                    <li class="flex"><span class="one fw-6">Estado del incendio</span><span class="two">En progreso</span></li>
                                    <li class="flex"><span class="one fw-6">Fecha estimada de control</span><span class="two">17/12/2024</span></li>
                                </ul>
                            </div>
                        </div> --}}


                        <div class="wrap-floor wrap-property wrap-style">
                            <h3 class="titles">Planes de evacuación</h3>
                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Datos de Personas afectadas en la Comunidad</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>PERSONAS AFECTADAS</h4>
                                                        @isset($personasAfectadas)
                                                            <table class="table table-bordered table-striped">
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
                                                    <div class="panel-heading"><b>Datos de afectados en Educación en la Comunidad</b></div>
                                                    <div class="panel-body"><br>
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

                                                            <table class="table table-bordered table-striped">
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
                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                        <div class="form-group col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><b>Datos de Salud por Grupo Etario y Enfermedad</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4> INFORMACIÓN DE SALUD</h4>

                                                    @php
                                                        $saludData = [];
                                                        $totales = [];
                                                        foreach ($saluds as $salud) {
                                                            $saludData[$salud->detalle_enfermedad_id][$salud->grupo_etario_id] = isset($salud->cantidad_grupo_enfermos) ? $salud->cantidad_grupo_enfermos : 0;


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
                                                        <table class="table table-bordered table-striped">
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
                                                                                    {{-- {{ $saludData[$detalleEnfermedad->id][$grupoEtarioId] }} --}}
                                                                                    {{ isset($saludData[$detalleEnfermedad->id][$grupoEtarioId]) ? $saludData[$detalleEnfermedad->id][$grupoEtarioId] : 0 }}
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
                        <div class="wrap-floor wrap-property wrap-style">
                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Información sobre Daños a Infraestructuras</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>INFRAESTRUCTURAS AFECTADAS</h4>
                                                        <table class="table table-bordered table-striped">
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
                                                    <div class="panel-heading"><b>Datos de Daños a Servicios Básicos</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>SERVICIOS BÁSICOS</h4>
                                                        <table class="table table-bordered table-striped">
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

                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Información sobre Daños Pecuarios</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>DAÑOS PECUARIOS</h4>
                                                        <table class="table table-bordered table-striped">
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
                                                    <div class="panel-heading"><b>Información sobre Daños Agrícolas</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>DAÑOS AGRÍCOLAS</h4>
                                                        <table class="table table-bordered table-striped">
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

                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                       <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Datos de Áreas Forestales Perdidas por Incendio</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4> ÁREAS FORESTALES PERDIDAS</h4>
                                                         <table class="table table-bordered table-striped">
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
                                                    <div class="panel-heading"><b>Datos de Fauna Silvestre Afectada por incendios</b></div>
                                                    <div class="panel-body"><br>
                                                        <h4>FAUNA SILVESTRE AFECTADA</h4>
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

                            <div class="flat-accordion fl-faq-content">
                                <div class="flat-toggle">
                                    <div class="toggle-title active flex justify-space">
                                        <div class="btn-toggle"></div><div class="fw-6">Primera zona de evacuación</div>
                                    </div>
                                    <div class="toggle-content section-desc">
                                        <div class="form-group col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><b>Información sobre la Reforestación</b></div>
                                                <div class="panel-body"><br>
                                                    <h4>REFORESTACION</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="table" aria-labelledby="reforestacionTable">
                                                            <caption></caption>
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
            </div><br>
        </div>
    </section>
@endsection

