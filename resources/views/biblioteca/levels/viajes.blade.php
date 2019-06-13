@extends('biblioteca.layout')

@section('title', 'Language School')

@section('content')
    <section class="home-slider owl-carousel" style="height: 600px !important;">
        <div class="slider-item" style="background-image:url(/images/viajes/v2.jpg); height: 600px !important;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">
                        <h1 class="mb-4">Viajes</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image:url(/images/viajes/v3.jpg); height: 600px !important;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">
                        <h1 class="mb-4">Viajes</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image:url(/images/viajes/v7.jpg); height: 600px !important;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">
                        <h1 class="mb-4">Viajes</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-lg-12 text-justify heading-section ftco-animate">
                    <h2 class="mb-4"><span>Via</span>jes</h2>
                    <p>
                        En Loyola brindamos a nuestros alumnos la oportunidad de desarrollar una visión global a través de viajes internacionales, participando de una experiencia memorable de aprendizaje práctico y vivencial del manejo del idioma, podrán explorar nuevas culturas, órdenes sociales, economía, arquitectura y sistemas de gobierno diferentes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row">
                <h2 class="mb-4">UN EGRESADO LOYOLA HABRÁ VISITADO LOS SIGUIENTES DESTINOS:</h2>
                <div class="col-lg-12 wrap-about py-5 pr-md-4 ftco-animate">
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="services-3 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="icon-check"></span></div>
                                <div class="text">
                                    <h3>PRIMARIA.</h3>
                                    <p>
                                        ORLANDO, FLORIDA DISNEY WORLD.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="services-3 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="icon-check"></span></div>
                                <div class="text">
                                    <h3>SECUNDARIA.</h3>
                                    <p>
                                        CANADA, MONTREAL, TORONTO, QUEBEC Y OTTAWA.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="services-3 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="icon-check"></span></div>
                                <div class="text">
                                    <h3>PREPARATORIA.</h3>
                                    <p>
                                        SAN FRANCISCO, SILLICON VALLEY (FACEBOOK, APPLE, GOOGLE, TESLA MOTORS, YOUTUBE, TWITTER, ETC.), EUROPA: MADRID, PARIS, ROMA, BARCELONA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="/images/viajes/v1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(/images/viajes/v1.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="/images/viajes/v4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(/images/viajes/v4.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="/images/viajes/v5.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(/images/viajes/v5.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="/images/viajes/v6.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(/images/viajes/v6.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection