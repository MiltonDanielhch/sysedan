@extends('frontend.index')

@section('content')
<!-- slider -->
<section class="slider home4">
    <div class="slider-item">
        <div class="container relative">
            <div class="row">
                <div class="col-lg-7">
                    <div class="heading">
                        <h1 class="text-color-1 wow fadeInUp js-letters" data-wow-delay="0ms" data-wow-duration="1000ms">Actúa ahora para proteger nuestros bosques</h1>
                        <p class="fs-16 lh-24 fw-6 text-color-1">Descubre cómo puedes contribuir a la prevención de incendios forestales y la protección del medio ambiente. Juntos, podemos reducir los riesgos y salvar la vida de miles de especies.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="content po-content-two">
                        <div class="flat-tabs ">
                            <div class="box-tab center">
                                <ul class="menu-tab tab-title flex ">
                                    <li class="item-title active">
                                        <h4 class="inner">Rent</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="content-tab">
                                <div class="content-inner tab-content">
                                    <div class="form-sl">
                                        <form action="{{ route('incencio') }}" method="GET">
                                            <div class="wd-find-select">
                                                <div class="form-group form-group-1 search-form">
                                                    <input type="search" class="search-field" placeholder="Escribe la palabra clave..." name="search" title="Buscar">
                                                </div>
                                                <div class="form-group form-group-3">
                                                    <div class="group-select">
                                                        <div class="nice-select" tabindex="0">
                                                            <span class="current">Ubicación</span>
                                                            <ul class="list">
                                                                <li data-value="" class="option selected">Ubicación</li>
                                                                <li data-value="Cercado" class="option">Cercado</li>
                                                                <li data-value="Yacuma" class="option">Yacuma</li>
                                                                <li data-value="Moxos" class="option">Moxos</li>
                                                                <li data-value="Ballivián" class="option">Ballivián</li>
                                                                <li data-value="Marbán" class="option">Marbán</li>
                                                                <li data-value="Iténez" class="option">Iténez</li>
                                                                <li data-value="Vaca Díez" class="option">Vaca Díez</li>
                                                                <li data-value="Mamoré" class="option">Mamoré</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group flex">
                                                    <div class="button-search sc-btn-top center no-absolute">
                                                        <button type="submit" class="sc-button">
                                                            <span>Buscar ahora</span>
                                                            <i class="far fa-search text-color-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Hidden location input -->
                                                <input type="hidden" name="location" value="">
                                            </div>
                                        </form>
                                        <!-- End Job  Search Form-->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="wrap-icon flex align-center justify-center link-style-3">
                            <div class="icon-box fs-13"><span class="icons-house icon-house-1"></span><a href="#">Prevención de Incendios</a></div>
                            <div class="icon-box fs-13"><span class="icons-house icon-house-2"></span><a href="#">Áreas Afectadas</a></div>
                            <div class="icon-box fs-13"><span class="icons-house icon-house-3"></span><a href="#">Recursos y Ayuda</a></div>
                            <div class="icon-box fs-13"><span class="icons-house icon-house-4"></span><a href="#">Noticias y Alertas</a></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
<div class="slider">
    <div class="slider-item">
        <div class="container relative">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content po-content-two">
                        <div class="flat-tabs">
                            <div class="box-tab center">
                                <!-- Tab Navigation -->
                                <ul class="menu-tab tab-title flex">
                                    <li class="item-title active">
                                        <h4 class="inner">Tabla</h4>
                                    </li>
                                    <li class="item-title">
                                        <h4 class="inner">Gráfico</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="content-tab">
                                <!-- Table Tab Content -->
                                <div class="content-inner tab-content active">
                                    <h3 style="text-align: center;">Población Total por Provincia</h3>
                                    <!-- Table for Population Data -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Provincia</th>
                                                <th>Municipio</th>
                                                <th>Población Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($poblacionPorMunicipio as $provinciaData)
                                                @foreach($provinciaData as $nombreProvincia => $municipios)
                                                    @php $isProvinciaShown = false; @endphp
                                                    @foreach($municipios as $municipio)
                                                        <tr>
                                                            @if (!$isProvinciaShown)
                                                                <td rowspan="{{ count($municipios) }}">{{ $nombreProvincia }}</td>
                                                                @php $isProvinciaShown = true; @endphp
                                                            @endif
                                                            <td>{{ $municipio[0] }}</td>  <!-- Nombre del municipio -->
                                                            <td>{{ $municipio[1] }}</td>  <!-- Población del municipio -->
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Chart Tab Content -->
                                <div class="content-inner tab-content">
                                    <div id="chartContainerMunicipio" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<section>
    <div class="slider">
        <div class="slider-item">
            <div class="container relative">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content po-content-two">
                            <div class="flat-tabs">
                                <div class="box-tab center">
                                    <!-- Tab Navigation -->
                                    <ul class="menu-tab tab-title flex">
                                        <li class="item-title active">
                                            <h4 class="inner">Tabla 1</h4>
                                        </li>
                                        <li class="item-title">
                                            <h4 class="inner">Gráfico 1</h4>
                                        </li>

                                    </ul>
                                </div>
                                <div class="content-tab">
                                    <!-- Table Tab Content -->
                                    <div class="content-inner tab-content active">
                                        <h3 style="text-align: center;">Total Afectados por Provincia 1</h3>
                                        <!-- Table for Population Data -->
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Municipio</th>
                                                    <th>Total Afectados</th>
                                                    <th>Total Estudiantes</th>
                                                    <th>Total Infraestructuras</th>
                                                    <th>Total Salud</th>
                                                    <th>Total Servicio Básicos</th>
                                                    <th>Total Animales</th>
                                                    <th>Total Fallecidos</th>
                                                    <th>Hectáreas Afectadas</th>
                                                    <th>Hectáreas Perdidas</th>
                                                    <th>Total Hectáreas Perdidas Forestales</th>
                                                    <th>Total Fauna Silvestre</th>
                                                    <th>Total Plantines</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datosPorMunicipio as $municipio)
                                                <tr>
                                                    <td>{{ $municipio->nombre_municipio }}</td>
                                                    <td>{{ number_format($municipio->total_afectados, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_educacion, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_infraestructuras, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_salud, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_servicio_basicos, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_animales, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_fallecidos, 0) }}</td>
                                                    <td>{{ number_format($municipio->hectareas_afectados, 0) }}</td>
                                                    <td>{{ number_format($municipio->hectareas_perdidas, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_hectareas_perdidas_forestales, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_fauna_silvestre, 0) }}</td>
                                                    <td>{{ number_format($municipio->total_cantidad_plantines, 0) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- Chart Tab Content -->
                                    <div class="content-inner tab-content">
                                        <h3 style="text-align: center;">Total Afectados por Provincia 1</h3>
                                        <!-- Gráfico de CanvasJS -->
                                        <div id="graficoMunicipio" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="slider">
        <div class="slider-item">
            <div class="container relative">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content po-content-two">
                            <div class="flat-tabs">
                                <div class="box-tab center">
                                    <!-- Tab Navigation -->
                                    <ul class="menu-tab tab-title flex">
                                        <li class="item-title active">
                                            <h4 class="inner">Tabla</h4>
                                        </li>
                                        <li class="item-title">
                                            <h4 class="inner">Gráfico</h4>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content-tab">
                                    <!-- Table Tab Content -->
                                    <div class="content-inner tab-content active">
                                        <h3 style="text-align: center;">Población Total por Provincia</h3>
                                        <!-- Table for Population Data -->
                                        {{-- <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Municipio</th>
                                                    <th>Grupo Etario</th>
                                                    <th>Total Afectados</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datosPorMunicipioTrinidad as $dato)
                                                    <tr>
                                                        <td>{{ $dato->nombre_municipio }}</td>
                                                        <td>{{ $dato->nombre_grupo_etario }}</td>
                                                        <td>{{ $dato->total_afectados }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> --}}


                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Municipio</th>
                                                        <th>NNyA</th>
                                                        <th>Hombres</th>
                                                        <th>Mujeres</th>
                                                        <th>Tercera Edad</th>
                                                        <th>Persona con Discapacidad</th>
                                                        <th>Total Afectados</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($datosPorMunicipioTrinidad as $dato)
                                                        <tr>
                                                            <td>{{ $dato->nombre_municipio }}</td>
                                                            <td>{{ $dato->nnya_afectados }}</td>
                                                            <td>{{ $dato->hombres_afectados }}</td>
                                                            <td>{{ $dato->mujeres_afectados }}</td>
                                                            <td>{{ $dato->tercera_edad_afectados }}</td>
                                                            <td>{{ $dato->discapacidad_afectados }}</td>
                                                            <td>{{ $dato->total_afectados }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>



                                    </div>

                                    <!-- Chart Tab Content -->
                                    <div class="content-inner tab-content">
                                        <div id="chartContainerTrinidad" style="height: 370px; width: 100%;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainerMunicipio", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Población Total por Municipio"
            },
            axisY: {
                title: "Población Total",
                includeZero: false
            },
            data: [
                {
                    type: "column", // tipo de gráfico (barra)
                    name: "Población",
                    showInLegend: true,
                    dataPoints: [
                        @foreach($poblacionPorMunicipio as $provinciaData)
                            @foreach($provinciaData as $nombreProvincia => $municipios)
                                @foreach($municipios as $municipio)
                                    {
                                        label: "{{ $municipio[0] }}",  // Nombre del municipio
                                        y: {{ $municipio[1] }}         // Población total
                                    },
                                @endforeach
                            @endforeach
                        @endforeach
                    ]
                }
            ]
        });

        var graficoMunicipio = new CanvasJS.Chart("graficoMunicipio", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Total Afectados por Municipio"
            },
            axisY: {
                title: "Total Afectados"
            },
            data: [{
                type: "column",
                name: "Total Afectados",
                showInLegend: true,
                dataPoints: [
                    @foreach($datosPorMunicipio as $municipio)
                    { label: "{{ $municipio->nombre_municipio }}", y: {{ $municipio->total_afectados }} },
                    @endforeach
                ]
            }]
        });


        var trinidad = new CanvasJS.Chart("chartContainerTrinidad", {
            animationEnabled: true,
            title: {
                text: "Total de Afectados por Municipio"
            },
            axisY: {
                title: "Total Afectados",
                includeZero: true
            },
            data: [{
                type: "bar",
                name: "Total Afectados",
                showInLegend: true,
                dataPoints: [
                    @foreach ($datosPorMunicipioTrinidad as $dato)
                        {
                            label: "{{ $dato->nombre_municipio }}",
                            y: {{ $dato->total_afectados }},
                        },
                    @endforeach
                ]
            }]
        });

        chart.render();
        graficoMunicipio.render();
        trinidad.render();
    }
</script>

@endsection

