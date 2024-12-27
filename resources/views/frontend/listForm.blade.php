@extends('frontend.index')

@section('content')
<!-- title page -->
<section class="flat-title-page inner style3">
    <div class="overlay2"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <div class="heading-inner">
                        <div class="heading"><span>Informe de Incendio Forestal en las Comunidades</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flat-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="index.html">Home</a><span>Incendio Forestal en las Comunidades</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class=" flat-property flat-property-list flat-properties-rent tf-section2 wg-dream style">
    <div class="container">
        <div class="row flex">
            <div class="col-lg-10">
                <div class="post">
                <div class="category-filter flex justify-space">
                    <div class="box-1">
                        <div class="heading-listing fs-30 lh-45 fw-7">Informe de Incendio Forestal</div>
                        {{-- <div class="">Actualmente hay 2 incendios registrados en la Comunidad</div> --}}
                    </div>

                    <div class="box-2 flex">
                        <a href="#" class="btn-view grid active">
                            <svg width="25" height="25" viewbox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.04883 6.40508C5.04883 5.6222 5.67272 5 6.41981 5C7.16686 5 7.7908 5.62221 7.7908 6.40508C7.7908 7.18801 7.16722 7.8101 6.41981 7.8101C5.67241 7.8101 5.04883 7.18801 5.04883 6.40508Z" stroke="#8E8E93"></path>
                                <path d="M11.1045 6.40508C11.1045 5.62221 11.7284 5 12.4755 5C13.2229 5 13.8466 5.6222 13.8466 6.40508C13.8466 7.18789 13.2227 7.8101 12.4755 7.8101C11.7284 7.8101 11.1045 7.18794 11.1045 6.40508Z" stroke="#8E8E93"></path>
                                <path d="M19.9998 6.40514C19.9998 7.18797 19.3757 7.81016 18.6288 7.81016C17.8818 7.81016 17.2578 7.18794 17.2578 6.40508C17.2578 5.62211 17.8813 5 18.6288 5C19.3763 5 19.9998 5.62215 19.9998 6.40514Z" stroke="#8E8E93"></path>
                                <path d="M7.74249 12.5097C7.74249 13.2926 7.11849 13.9147 6.37133 13.9147C5.62411 13.9147 5 13.2926 5 12.5097C5 11.7267 5.62419 11.1044 6.37133 11.1044C7.11842 11.1044 7.74249 11.7266 7.74249 12.5097Z" stroke="#8E8E93"></path>
                                <path d="M13.7976 12.5097C13.7976 13.2927 13.1736 13.9147 12.4266 13.9147C11.6795 13.9147 11.0557 13.2927 11.0557 12.5097C11.0557 11.7265 11.6793 11.1044 12.4266 11.1044C13.1741 11.1044 13.7976 11.7265 13.7976 12.5097Z" stroke="#8E8E93"></path>
                                <path d="M19.9516 12.5097C19.9516 13.2927 19.328 13.9147 18.5807 13.9147C17.8329 13.9147 17.209 13.2925 17.209 12.5097C17.209 11.7268 17.8332 11.1044 18.5807 11.1044C19.3279 11.1044 19.9516 11.7265 19.9516 12.5097Z" stroke="#8E8E93"></path>
                                <path d="M5.04297 18.5947C5.04297 17.8118 5.66709 17.1896 6.4143 17.1896C7.16137 17.1896 7.78523 17.8116 7.78523 18.5947C7.78523 19.3778 7.16139 19.9997 6.4143 19.9997C5.66714 19.9997 5.04297 19.3773 5.04297 18.5947Z" stroke="#8E8E93"></path>
                                <path d="M11.0986 18.5947C11.0986 17.8118 11.7227 17.1896 12.47 17.1896C13.2169 17.1896 13.8409 17.8117 13.8409 18.5947C13.8409 19.3778 13.2169 19.9997 12.47 19.9997C11.7225 19.9997 11.0986 19.3774 11.0986 18.5947Z" stroke="#8E8E93"></path>
                                <path d="M17.252 18.5947C17.252 17.8117 17.876 17.1896 18.6229 17.1896C19.3699 17.1896 19.9939 17.8117 19.9939 18.5947C19.9939 19.3778 19.3702 19.9997 18.6229 19.9997C17.876 19.9997 17.252 19.3774 17.252 18.5947Z" stroke="#8E8E93"></path>
                            </svg>
                        </a>
                        <a href="#" class="btn-view list">
                            <svg width="25" height="25" viewbox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.7016 18.3317H9.00246C8.5615 18.3317 8.2041 17.9743 8.2041 17.5333C8.2041 17.0923 8.5615 16.7349 9.00246 16.7349H19.7013C20.1423 16.7349 20.4997 17.0923 20.4997 17.5333C20.4997 17.9743 20.1426 18.3317 19.7016 18.3317Z" fill="#8E8E93"></path>
                                <path d="M19.7016 13.3203H9.00246C8.5615 13.3203 8.2041 12.9629 8.2041 12.5219C8.2041 12.081 8.5615 11.7236 9.00246 11.7236H19.7013C20.1423 11.7236 20.4997 12.081 20.4997 12.5219C20.5 12.9629 20.1426 13.3203 19.7016 13.3203Z" fill="#8E8E93"></path>
                                <path d="M19.7016 8.30919H9.00246C8.5615 8.30919 8.2041 7.95179 8.2041 7.51083C8.2041 7.06986 8.5615 6.71246 9.00246 6.71246H19.7013C20.1423 6.71246 20.4997 7.06986 20.4997 7.51083C20.4997 7.95179 20.1426 8.30919 19.7016 8.30919Z" fill="#8E8E93"></path>
                                <path d="M5.5722 8.64465C6.16436 8.64465 6.6444 8.16461 6.6444 7.57245C6.6444 6.98029 6.16436 6.50024 5.5722 6.50024C4.98004 6.50024 4.5 6.98029 4.5 7.57245C4.5 8.16461 4.98004 8.64465 5.5722 8.64465Z" fill="#8E8E93"></path>
                                <path d="M5.5722 13.5942C6.16436 13.5942 6.6444 13.1141 6.6444 12.522C6.6444 11.9298 6.16436 11.4498 5.5722 11.4498C4.98004 11.4498 4.5 11.9298 4.5 12.522C4.5 13.1141 4.98004 13.5942 5.5722 13.5942Z" fill="#8E8E93"></path>
                                <path d="M5.5722 18.5438C6.16436 18.5438 6.6444 18.0637 6.6444 17.4716C6.6444 16.8794 6.16436 16.3994 5.5722 16.3994C4.98004 16.3994 4.5 16.8794 4.5 17.4716C4.5 18.0637 4.98004 18.5438 5.5722 18.5438Z" fill="#8E8E93"></path>
                            </svg>
                        </a>
                        <div class="wd-find-select flex">
                            <div class="group-select">
                                <div class="nice-select" tabindex="0">
                                    <span class="current">Orden predeterminado</span>
                                    <ul class="list style">
                                        <li data-value="" class="option selected">Orden predeterminado</li>
                                        <li data-value="by-latest" class="option">Todos</li>
                                        <li data-value="low-to-high" class="option">por Provincia</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @foreach ($data as $formulario)
                <div class="wrap-list ">
                    <div class="box box-dream flex hv-one">
                        <div class="image-group relative">
                            <span class="featured fs-12 fw-6">Incendio Registrado</span>
                            <span class="featured style fs-12 fw-6">Estado: {{ $formulario->incendio->estado }}</span>
                            <span class="icon-bookmark"><i class="far fa-bookmark"></i></span>
                            <div class="swiper-container noo carousel-2 img-style">
                                <a href="{{ route('formdata', $formulario->id) }}" class="icon-plus"><img src="assets/images/icon/plus.svg" alt="images"></a>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="{{asset('assets/images/house/fotoincendio.jpg')}}" alt="images"></div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                                <h3 class="link-style-1"><a href="incendio-detalle.html">Incendio en la Comunidad  {{ $formulario->comunidad->nombre_comunidad }}</a></h3>
                                <div class="text-address"><p class="p-12">
                                    <span class="fw-6">Provincia:  </span>{{ $formulario->comunidad->municipio->provincia->nombre_provincia }}
                                    <span class="fw-6">Municipio: </span>{{ $formulario->comunidad->municipio->nombre_municipio }}


                                        {{-- <div class="money fs-20 fw-8 font-2 text-color-3"><a href="incendio-detalle.html">1 Incendio Activo</a></div> --}}
                                        <div class="money"></div>
                                        <div class="icon-box">
                                            @php
                                                $incendio = $formulario->comunidad->incendios->first();
                                            @endphp

                                            <div class="left-column">
                                                @if($incendio)
                                                    <div class="icons icon-3 flex"><span class="fw-6">Incendios Registrados: </span>{{ $incendio->pivot->incendios_activos }}</div>
                                                    <div class="icons icon-3 flex"><span class="fw-6">Incendios Activos:</span> {{ $incendio->pivot->incendios_activos }}</div>
                                                    <div class="icons icon-3 flex"><span class="fw-6">Necesidades: </span>{{ $incendio->pivot->necesidades }} </div>
                                                @else
                                                    <p>Incendios NO registrados</p>
                                                @endif
                                            </div>

                                            <div class="right-column">
                                                @if($formulario->asistencias->isEmpty())
                                                    <p>No hay asistencias registradas</p>
                                                @else
                                                    @foreach ($formulario->asistencias as $asistencia)
                                                        <div class="asistencia">
                                                            <div class="icons icon-3 flex"><span class="fw-6">Actividades: </span>{{ $asistencia->actividades }}</div>
                                                            <div class="icons icon-3 flex"><span class="fw-6">Cantidad Beneficiarios:  </span>{{ $asistencia->cantidad_beneficiarios }}</div>
                                                            <p>{{ \Carbon\Carbon::parse($asistencia->fecha_asistencia)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>


                                </div>
                                <div class="img-box flex justify-space align-center">
                                    <div class="img-author flex align-center">
                                        {{-- <img src="assets/images/author/author-list-1.jpg" alt="images"> --}}
                                        <div class="fs-13 fw-6 link-style-1"><a href="#">Alcalde:</a></div>
                                         {{ $formulario->comunidad->municipio->nombre_alcalde }}
                                    </div>
                                    <div class="icons  flex"><span class="fw-6">Causa Probable: </span>{{ $formulario->incendio->causas_probables }} </div>
                                    <a class="icon-repeat">
                                        <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 14L2 11M2 11L5 8M2 11H11M11 2L14 5M14 5L11 8M14 5H5" stroke="#1C1C1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>

                        </div>
                    </div>
                </div>
                @endforeach
                <div class="themesflat-pagination clearfix center">
                    <ul>
                        <!-- Paginación de Laravel -->
                        @if ($data->onFirstPage())
                            <li><a href="#" class="page-numbers style disabled"><i class="far fa-angle-left"></i></a></li>
                        @else
                            <li><a href="{{ $data->previousPageUrl() }}" class="page-numbers style"><i class="far fa-angle-left"></i></a></li>
                        @endif

                        <!-- Páginas numeradas -->
                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if ($page == $data->currentPage())
                                <li><a href="#" class="page-numbers current">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}" class="page-numbers">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <!-- Paginación de Laravel (si no es la última página) -->
                        @if ($data->hasMorePages())
                            <li><a href="{{ $data->nextPageUrl() }}" class="page-numbers style"><i class="far fa-angle-right"></i></a></li>
                        @else
                            <li><a href="#" class="page-numbers style disabled"><i class="far fa-angle-right"></i></a></li>
                        @endif
                    </ul>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .icon-box {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .left-column, .right-column {
        width: 45%; /* Controla el ancho de cada columna */
    }

    .left-column p, .right-column p {
        margin: 10px 0;
    }

    .asistencia {
        margin-bottom: 15px;
    }
</style>
@endsection


