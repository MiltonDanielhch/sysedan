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
                                                <th>Población Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $dataPoints = [];
                                            @endphp
                                            @foreach($poblacionPorProvincia as $provincia)
                                                <tr>
                                                    <td>{{ $provincia->nombre_provincia }}</td>
                                                    <td>{{ number_format($provincia->poblacion_total, 3) }}</td>
                                                    @php
                                                        // Collecting data points for the chart
                                                        $dataPoints[] = [
                                                            "y" => $provincia->poblacion_total,
                                                            "label" => $provincia->nombre_provincia
                                                        ];
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Chart Tab Content -->
                                <div class="content-inner tab-content">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
                                            <h4 class="inner">Tabla 2</h4>
                                        </li>
                                        <li class="item-title">
                                            <h4 class="inner">Gráfico 1</h4>
                                        </li>
                                        <li class="item-title">
                                            <h4 class="inner">Gráfico 2</h4>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content-tab">
                                    <!-- Table Tab Content -->
                                    <div class="content-inner tab-content active">
                                        <h3 style="text-align: center;">Total Afectados por Provincia 1</h3>
                                        <!-- Table for Population Data -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Provincia</th>
                                                    <th>Total Afectados</th>
                                                    <th>Total Estudiantes</th>
                                                    <th>Total Infraestructuras Afectadas</th>
                                                    <th>Total Salud</th>
                                                    <th>Total Servicio Básico</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Inicializamos los totales fuera del bucle
                                                    $totales = [
                                                        'afectados' => 0,
                                                        'educacion' => 0,
                                                        'infraestructuras' => 0,
                                                        'salud' => 0,
                                                        'servicio_basico' => 0,
                                                        'sector_pecuario' => 0,
                                                        'sector_agricola' => 0,
                                                        'area_forestal' => 0,
                                                        'fauna_silvestre' => 0,
                                                        'reforestacion' => 0,
                                                    ];
                                                @endphp

                                                @foreach($datosPorProvincia as $dato)
                                                    @php
                                                        // Acumulamos los totales
                                                        $totales['afectados'] += $dato->total_afectados ?? 0;
                                                        $totales['educacion'] += $dato->total_educacion ?? 0;
                                                        $totales['infraestructuras'] += $dato->total_infraestructuras ?? 0;
                                                        $totales['salud'] += $dato->total_salud ?? 0;
                                                        $totales['servicio_basico'] += $dato->total_servicio_basicos ?? 0;
                                                        $totales['sector_pecuario'] += $dato->total_animales ?? 0;
                                                        $totales['sector_agricola'] += $dato->hectareas_afectados ?? 0;
                                                        $totales['area_forestal'] += $dato->total_hectareas_perdidas_forestales ?? 0;
                                                        $totales['fauna_silvestre'] += $dato->total_fauna_silvestre ?? 0;
                                                        $totales['reforestacion'] += $dato->total_cantidad_plantines ?? 0;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $dato->nombre_provincia }}</td>
                                                        <td>{{ $dato->total_afectados ?? 0 }}</td>
                                                        <td>{{ $dato->total_educacion ?? 0 }}</td>
                                                        <td>{{ $dato->total_infraestructuras ?? 0 }}</td>
                                                        <td>{{ $dato->total_salud ?? 0 }}</td>
                                                        <td>{{ $dato->total_servicio_basicos ?? 0 }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <th>Total General</th>
                                                    <td>{{ $totales['afectados'] }}</td>
                                                    <td>{{ $totales['educacion'] }}</td>
                                                    <td>{{ $totales['infraestructuras'] }}</td>
                                                    <td>{{ $totales['salud'] }}</td>
                                                    <td>{{ $totales['servicio_basico'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="content-inner tab-content active">
                                        <h3 style="text-align: center;">Total animales por Provincia 2</h3>
                                        <!-- Table for Population Data -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                        <th>Provincia</th>
                                                        <th>Total Animales</th>
                                                        <th>Total Fallecidos</th>
                                                        <th>Hectareas Afectados</th>
                                                        <th>Hectareas Perdidas</th>
                                                        <th>Total Hectareas Perdidas Forestales</th>
                                                        <th>Total Fauna Silvestre</th>
                                                        <th>Total Cantidad Plantines</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Inicializamos los totales fuera del bucle
                                                    $totales = [
                                                        'afectados' => 0,
                                                        'educacion' => 0,
                                                        'infraestructuras' => 0,
                                                        'salud' => 0,
                                                        'servicio_basico' => 0,
                                                        'sector_pecuario' => 0,
                                                        'sector_pecuario1' => 0,
                                                        'sector_agricola' => 0,
                                                        'sector_agricola1' => 0,
                                                        'area_forestal' => 0,
                                                        'fauna_silvestre' => 0,
                                                        'reforestacion' => 0,
                                                    ];
                                                @endphp

                                                @foreach($datosPorProvincia as $dato)
                                                    @php
                                                        // Acumulamos los totales
                                                        // $totales['afectados'] += $dato->total_afectados ?? 0;
                                                        // $totales['educacion'] += $dato->total_educacion ?? 0;
                                                        // $totales['infraestructuras'] += $dato->total_infraestructuras ?? 0;
                                                        // $totales['salud'] += $dato->total_salud ?? 0;
                                                        // $totales['servicio_basico'] += $dato->total_servicio_basicos ?? 0;
                                                        $totales['sector_pecuario'] += $dato->total_animales ?? 0;
                                                        $totales['sector_pecuario1'] += $dato->total_fallecidos ?? 0;
                                                        $totales['sector_agricola'] += $dato->hectareas_afectados ?? 0;
                                                        $totales['sector_agricola1'] += $dato->hectareas_perdidas ?? 0;
                                                        $totales['area_forestal'] += $dato->total_hectareas_perdidas_forestales ?? 0;
                                                        $totales['fauna_silvestre'] += $dato->total_fauna_silvestre ?? 0;
                                                        $totales['reforestacion'] += $dato->total_cantidad_plantines ?? 0;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $dato->nombre_provincia }}</td>
                                                        <td>{{ $dato->total_animales ?? 0 }}</td>
                                                        <td>{{ $dato->total_fallecidos ?? 0 }}</td>
                                                        <td>{{ $dato->hectareas_afectados ?? 0 }}</td>
                                                        <td>{{$dato->hectareas_perdidas ?? 0}}</td>
                                                        <td>{{ $dato->total_hectareas_perdidas_forestales ?? 0 }}</td>
                                                        <td>{{ $dato->total_fauna_silvestre ?? 0 }}</td>
                                                        <td>{{ $dato->total_cantidad_plantines ?? 0 }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <th>Total General</th>
                                                    <td>{{ $totales['sector_pecuario'] }}</td>
                                                    <td>{{ $totales['sector_pecuario1'] }}</td>
                                                    <td>{{ $totales['sector_agricola'] }}</td>
                                                    <td>{{ $totales['sector_agricola1'] }}</td>
                                                    <td>{{ $totales['area_forestal'] }}</td>
                                                    <td>{{ $totales['fauna_silvestre'] }}</td>
                                                    <td>{{ $totales['reforestacion'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Chart Tab Content -->
                                    <div class="content-inner tab-content">
                                        <h3 style="text-align: center;">Total Afectados por Provincia 1</h3>
                                        <div id="chartContainerAfectados" style="height: 400px; width: 100%;"></div>

                                    </div>
                                    <!-- Contenedor para el gráfico -->
                                    <div class="content-inner tab-content">
                                        <h3 style="text-align: center;">Total Afectados por Provincia 2</h3>
                                        <div id="chartContainerAnimales" style="height: 400px; width: 100%;"></div>
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
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Datos de Incendios y Familias Afectadas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Incendios Activos</strong></td>
                                                    <td>Total de Incendios Activos: <strong>{{ $totalIncendiosActivos }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Incendios Forestales</strong></td>
                                                    <td>Total de Incendios Registrados: <strong>{{ $totalIncendios }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Familias Afectadas</strong></td>
                                                    <td>Total de Familias Afectadas: <strong>{{ $totalNumFamiliasAfectadas }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Familias Damnificadas</strong></td>
                                                    <td>Total de Familias Damnificadas: <strong>{{ $totalNumFamiliasDamnificadas }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Chart Tab Content -->
                                    <div class="content-inner tab-content">
                                          <!-- Gráfico -->
                                          <div id="chartContainerFamilias" style="height: 370px; width: 100%;"></div>

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


<section class="flat-explore tf-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section center">
                    <h2>Explora los incendios forestales por provincias</h2>
                    <p class="text-color-4">Infórmate sobre los incendios forestales en cada provincia. Mantente al tanto de las áreas afectadas y las medidas preventivas que se están tomando.</p>
                    <h3>Incendios Activos</h3>
                    <p>Total de Incendios Activos: <strong>{{ $totalIncendiosActivos }}</strong></p>

                    <h3>Incendios Forestales</h3>
                    <p>Total de Incendios Registrados: <strong>{{ $totalIncendios }}</strong></p>


                    <h3>Numeros Familias Afectadas</h3>
                    <p>total Numeros de Familias Afectadas: <strong>{{ $totalNumFamiliasAfectadas }}</strong></p>

                    <h3>Numeros de Familias Damnificadas</h3>
                    <p>Total de Numeros Familias Damnificadas: <strong>{{ $totalNumFamiliasDamnificadas }}</strong></p>
                </div>



                {{-- <div class="swiper-container carousel-8">
                    <div class="swiper-wrapper ">
                        @foreach ($provincias as $provincia )
                        <div class="swiper-slide ">
                            <div class="box center hv-one">
                                <div class="images img-style s-one relative">
                                    <img class="img2" src="assets/images/img-box/explore-1.jpg" alt="images">
                                </div>
                                <div class="content link-style-1">
                                    <a href="properties-map-v1.html"><h3>{{ $provincia->nombre_provincia }}</h3></a>
                                    <p class="text-color-2">poblacion 123</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"> </div>
            </div> --}}

            {{-- <h3>Total Afectados por Incendios por Provincia</h3>

            @if($afectadosPorProvincia->isEmpty())
                <p>No hay datos disponibles.</p>
            @else
                <table border="1">
                    <thead>
                        <tr>
                            <th>Provincia</th>
                            <th>Total Afectados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($afectadosPorProvincia as $afectado)
                            <tr>
                                <td>{{ $afectado->nombre_provincia }}</td>
                                <td>{{ number_format($afectado->total_afectados, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h3>Total afectados en educacion por Incendios en Provincia</h3>
            @if($educacionsPorProvincia->isEmpty())
                <p>No hay datos disponibles.</p>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Provincias</th>
                        <th>Total educacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educacionsPorProvincia as $educacion)
                        <tr>
                            <td>{{ $educacion->nombre_provincia }}</td>
                            <td>{{ number_format($educacion->total_educacion, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <h3>total infraestructuras afectadas por provincias</h3>
            @if($infraestructurasPorProvincias->isEmpty())
                <p>No hay datos disponibles.</p>
             @else
                <table>
                    <thead>
                        <tr>
                            <th>Provincias</th>
                            <th>Total Infraestructuras</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($infraestructurasPorProvincias as $infraestructura)
                            <tr>
                                <td>{{ $infraestructura->nombre_provincia }}</td>
                                <td>{{ number_format($infraestructura->total_infraestructuras, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif --}}
        </div>
    </div>
</section>

<section class="flat-discover wg-dream home4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section center">
                    <h2>Descubre los últimos incendios forestales</h2>
                    <p class="text-color-4">Conoce los detalles sobre los incendios forestales más recientes y sus impactos en las comunidades.</p>
                </div>
                <div class="swiper-container2">
                    <div class="one-carousel owl-carousel owl-theme">

                        <div class="slide-item">
                            <div class="box box-dream hv-one">
                                <div class="image-group relative ">
                                    <span class="featured fs-12 fw-6">Destacado</span>
                                    <span class="featured style fs-12 fw-6">En curso</span>
                                    <span class="icon-bookmark"><i class="far fa-bookmark"></i></span>
                                    <div class="swiper-container noo carousel-2 img-style">
                                        <a href="incendio-detalle.html" class="icon-plus"><img src="assets/images/icon/plus.svg" alt="images"></a>
                                        <div class="swiper-wrapper ">
                                            <div class="swiper-slide"><img src="assets/images/house/featured-21.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-2.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-3.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-4.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-5.jpg" alt="images"></div>
                                        </div>
                                        <div class="pagi2"><div class="swiper-pagination2">  </div> </div>
                                        <div class="swiper-button-next2 "><i class="fal fa-arrow-right"></i></div>
                                        <div class="swiper-button-prev2 "><i class="fal fa-arrow-left"></i> </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3 class="link-style-1"><a href="incendio-detalle.html">Incendio forestal en San Lorenzo</a></h3>
                                    <div class="text-address"><p class="p-12">San Lorenzo, Provincia Cercado</p></div>
                                    <div class="money fs-18 fw-6 text-color-3"><a href="incendio-detalle.html">Daños estimados: $10,000</a></div>

                                    <div class="icon-box flex">
                                        <div class="icons icon-1 flex"><span>Afectados: </span><span class="fw-6">23 familias</span></div>
                                        <div class="icons icon-2 flex"><span>Área afectada: </span><span class="fw-6">73 hectáreas</span></div>
                                        {{-- <div class="icons icon-3 flex"><span>Incendios activos: </span><span class="fw-6">4</span></div> --}}
                                    </div>
                                    <div class="days-box flex justify-space align-center">
                                        <a class="compare flex align-center fw-6" href="#">Comparar</a>
                                        <div class="img-author hv-tool" data-tooltip="Juan Pérez"><img src="assets/images/author/author-1.jpg" alt="images"></div>
                                        <div class="days">8 de diciembre de 2024</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="slide-item">
                            <div class="box box-dream hv-one">
                                <div class="image-group relative ">
                                    <span class="featured fs-12 fw-6">Featured</span>
                                    <span class="featured style fs-12 fw-6">For sale</span>
                                    <span class="icon-bookmark"><i class="far fa-bookmark"></i></span>
                                    <div class="swiper-container noo carousel-2 img-style">
                                        <a href="property-detail-v1.html" class="icon-plus"><img src="assets/images/icon/plus.svg" alt="images"></a>
                                        <div class="swiper-wrapper ">
                                            <div class="swiper-slide"><img src="assets/images/house/featured-22.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-12.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-13.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-14.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-15.jpg" alt="images"></div>
                                        </div>
                                        <div class="pagi2"><div class="swiper-pagination2">  </div> </div>
                                        <div class="swiper-button-next2 "><i class="fal fa-arrow-right"></i></div>
                                        <div class="swiper-button-prev2 "><i class="fal fa-arrow-left"></i> </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3 class="link-style-1"><a href="property-detail-v1.html">Gorgeous Apartment Building</a> </h3>
                                    <div class="text-address"><p class="p-12">58 Hullbrook Road, Billesley, B13 0LA</p></div>
                                    <div class="money fs-18 fw-6 text-color-3"><a href="property-detail-v1.html">$7,500</a></div>
                                    <div class="icon-box flex">
                                        <div class="icons icon-1 flex"><span>Beds: </span><span class="fw-6">4</span></div>
                                        <div class="icons icon-2 flex"><span>Baths: </span><span class="fw-6">2</span></div>
                                        <div class="icons icon-3 flex"><span>Sqft: </span><span class="fw-6">1150</span></div>
                                    </div>
                                    <div class="days-box flex justify-space align-center">
                                        <a class="compare flex align-center fw-6" href="#">Compare</a>
                                        <div class="img-author hv-tool" data-tooltip="Kathryn Murphy"><img src="assets/images/author/author-2.jpg" alt="images"></div>
                                        <div class="days">3 years ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-item">
                            <div class="box box-dream hv-one">
                                <div class="image-group relative ">
                                    <span class="featured fs-12 fw-6">Featured</span>
                                    <span class="featured style fs-12 fw-6">For sale</span>
                                    <span class="icon-bookmark"><i class="far fa-bookmark"></i></span>
                                    <div class="swiper-container noo carousel-2 img-style">
                                        <a href="property-detail-v1.html" class="icon-plus"><img src="assets/images/icon/plus.svg" alt="images"></a>
                                        <div class="swiper-wrapper ">
                                            <div class="swiper-slide"><img src="assets/images/house/featured-23.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-7.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-8.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-9.jpg" alt="images"></div>
                                            <div class="swiper-slide"><img src="assets/images/house/featured-5.jpg" alt="images"></div>
                                        </div>
                                        <div class="pagi2"><div class="swiper-pagination2">  </div> </div>
                                        <div class="swiper-button-next2 "><i class="fal fa-arrow-right"></i></div>
                                        <div class="swiper-button-prev2 "><i class="fal fa-arrow-left"></i> </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3 class="link-style-1"><a href="property-detail-v1.html">Gorgeous Apartment Building</a> </h3>
                                    <div class="text-address"><p class="p-12">58 Hullbrook Road, Billesley, B13 0LA</p></div>
                                    <div class="money fs-18 fw-6 text-color-3"><a href="property-detail-v1.html">$7,500</a></div>
                                    <div class="icon-box flex">
                                        <div class="icons icon-1 flex"><span>Beds: </span><span class="fw-6">4</span></div>
                                        <div class="icons icon-2 flex"><span>Baths: </span><span class="fw-6">2</span></div>
                                        <div class="icons icon-3 flex"><span>Sqft: </span><span class="fw-6">1150</span></div>
                                    </div>
                                    <div class="days-box flex justify-space align-center">
                                        <a class="compare flex align-center fw-6" href="#">Compare</a>
                                        <div class="img-author hv-tool" data-tooltip="Kathryn Murphy"><img src="assets/images/author/author-3.jpg" alt="images"></div>
                                        <div class="days">3 years ago</div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="flat-blog tf-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section center">
                    <h2>Desde nuestro blog sobre incendios forestales</h2>
                    <p class="text-color-4">Descubre las últimas noticias, investigaciones y consejos sobre los incendios forestales. Cómo prevenirlos, su impacto en el medio ambiente y las comunidades afectadas.</p>
                </div>

            </div>
            <div class="col-lg-4 col-md-4">
                <div class="box hover-img">
                    <div class="images img-style relative ">
                        <a href="blog-detail.html"><img src="assets/images/img-box/blog-1.jpg" alt="images"></a>
                        <div class="sub-box flex align-center fs-13 fw-6">
                            <div class="title-1"></div><a class="title-2 text-color-3">Incendios</a>
                        </div>

                    </div>
                    <div class="content center">
                        <h3 class="link-style-1"><a href="blog-detail.html">Impacto de los incendios forestales en la biodiversidad y cómo prevenirlos</a></h3>
                        <div class="meta">
                            <a href="blog-detail.html" class="btn-button flex align-center justify-center fs-13 fw-6 text-color-3"><span>Leer más </span>
                                <svg width="13" height="12" viewbox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.875 6H12.125M12.125 6L7.0625 0.9375M12.125 6L7.0625 11.0625" stroke="#FFA920" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<script>
    window.onload = function () {
        // Primer gráfico: Comparación de Afectaciones por Provincia (General)
        var chartAfectados = new CanvasJS.Chart("chartContainerAfectados", {
            animationEnabled: true,
            title: {
                text: "Comparación de Afectaciones por Provincia"
            },
            axisY: {
                title: "Total",
                includeZero: true
            },
            axisX: {
                title: "Provincia",
                interval: 1
            },
            data: [
                {
                    type: "column",
                    name: "Total Afectados",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsAfectados, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Total Estudiantes",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsEstudiantes, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Total Infraestructuras Afectadas",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsInfraestructuras, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Total Salud",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsSalud, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Total Servicio Básico",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsServicioBasico, JSON_NUMERIC_CHECK) !!}
                }
            ]
        });

        // Segundo gráfico: Comparación de Afectaciones por Provincia (Animales, Hectáreas, Fauna, etc.)
        var chartAnimales = new CanvasJS.Chart("chartContainerAnimales", {
            animationEnabled: true,
            title: {
                text: "Comparación de Afectaciones por Provincia"
            },
            axisY: {
                title: "Total",
                includeZero: true
            },
            axisX: {
                title: "Provincia",
                interval: 1
            },
            data: [
                {
                    type: "column",
                    name: "Total Animales",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsAnimales, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Total Fallecidos",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsFallecidos, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Hectáreas Afectadas",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsHectareasAfectados, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Hectáreas Perdidas",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsHectareasPerdidas, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Hectáreas Perdidas Forestales",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsHectareasPerdidasForestales, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Fauna Silvestre",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsFaunaSilvestre, JSON_NUMERIC_CHECK) !!}
                },
                {
                    type: "column",
                    name: "Cantidad Plantines",
                    showInLegend: true,
                    dataPoints: {!! json_encode($dataPointsCantidadPlantines, JSON_NUMERIC_CHECK) !!}
                }
            ]
        });

        // Tercer gráfico: Población por Provincia
        var chartPoblacion = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Población por Provincia"
            },
            axisY: {
                title: "Población Total"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.##",
                dataPoints: {!! json_encode($dataPoints, JSON_NUMERIC_CHECK) !!}
            }]
        });


        var chartfamilias = new CanvasJS.Chart("chartContainerFamilias", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Estadísticas de Incendios y Familias Afectadas"
            },
            axisY: {
                title: "Cantidad"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                dataPoints: [
                    { label: "Incendios Activos", y: {{ $totalIncendiosActivos }} },
                    { label: "Incendios Forestales", y: {{ $totalIncendios }} },
                    { label: "Familias Afectadas", y: {{ $totalNumFamiliasAfectadas }} },
                    { label: "Familias Damnificadas", y: {{ $totalNumFamiliasDamnificadas }} }
                ]
            }]
        });

        // Renderizar todos los gráficos
        chartAfectados.render();
        chartAnimales.render();
        chartPoblacion.render();
        chartfamilias.render();
    }
</script>


{{-- busqueda desce el welcome a incendio  --}}
    <script>
    document.querySelectorAll('.nice-select .option').forEach(function(item) {
        item.addEventListener('click', function() {
            var selectedLocation = this.getAttribute('data-value');
            // Set the location value in the hidden input
            document.querySelector('[name="location"]').value = selectedLocation;
        });
    });
</script>


@endsection

