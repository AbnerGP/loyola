@extends('biblioteca.layout')

@section('title', 'Inicio')

@section('css')
    {{--<style>
        video {
            width: 100%;
            height: auto;
        }
    </style>--}}
@endsection

@section('content')
    <div class="container-wrap">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <img src="/images/portada.jpg" alt="" width="100%">
            </div>
        </div>
    </div>

    <section class="ftco-services ftco-no-pb">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-loyola-blue">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-teacher"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Maestros certificados</h3>
                            <p>Tenemos los mejores maestros para impartir las clases.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-loyola-gold">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-reading"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Principios pedagógicos</h3>
                            <p>Aprendizaje significativo, Aprendizaje basado en competencias y una Educación comprensiva.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-loyola-red">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-books"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Recursos metodológicos</h3>
                            <p>El modelo educativo del Colegio Loyola se ve enriquecido por plataformas teórico-metodológicas diversas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-loyola-yellow">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-education"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Calidad académica</h3>
                            <p>Contamos con importantes logros académicos y deportivos que motivan a nuestros alumnos a superarse y ser mejores.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Niveles -->
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span>Niveles</span> Educativos</h2>
                    <p>Tenemos la mejor oferta educativa en todos los niveles.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image: url(images/index/kinder.jpg);"></div>
                        </div>
                        <div class="text pt-3 text-center">
                            <h3>Kinder</h3>
                            <span class="position mb-2">Kindergarten</span>
                            <div class="faded">
                                <p>
                                    Porque sabemos de la enorme importancia que para los pequeños tienen sus primeras experiencias educativas, nos ocupamos de desarrollar sus competencias con métodos y valores. Clave de Incorporación a la SEP: 17PJN0007E / 1 de Octubre 2013.
                                </p>
                                <ul class="ftco-social text-center">
                                    <li class="ftco-animate"><a href="{{ route('site.levels.kinder') }}"><span class="flaticon-reading"></span> Leer más</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image: url(images/index/primaria.jpg);"></div>
                        </div>
                        <div class="text pt-3 text-center">
                            <h3>Primaria</h3>
                            <span class="position mb-2">Primary</span>
                            <div class="faded">
                                <p>
                                    En primaria nuestra misión se dirige a lograr que esta etapa de crecimiento del niño fortalezca su desarrollo integral y formativo, inculcándole a la vez hábitos y valores que habrán de acompañarlo. Clave de Incorporación a la SEP: 17PPR0191I / 08 de octubre de 2013.
                                </p>
                                <ul class="ftco-social text-center">
                                    <li class="ftco-animate"><a href="{{ route('site.levels.primaria') }}"><span class="flaticon-reading"></span> Leer más</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image: url(images/index/secundaria.jpg);"></div>
                        </div>
                        <div class="text pt-3 text-center">
                            <h3>Secundaria</h3>
                            <span class="position mb-2">High School</span>
                            <div class="faded">
                                <p>
                                    En Secundaria, nuestros alumnos aprenden bajo un contexto dinámico y participativo en un ambiente propicio que les permite la expresión libre de sus ideas en un marco de convivencia. Nuestra Clave de incorporación a la SEP es: 17PES0128Z / 20 de noviembre 2013.
                                </p>
                                <ul class="ftco-social text-center">
                                    <li class="ftco-animate"><a href="{{ route('site.levels.secundaria') }}"><span class="flaticon-reading"></span> Leer más</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image: url(images/index/prepa.jpg);"></div>
                        </div>
                        <div class="text pt-3 text-center">
                            <h3>Preparatoria</h3>
                            <span class="position mb-2">High School</span>
                            <div class="faded">
                                <p>
                                    La Preparatoria Loyola es una Institución educativa que promueve Planes y Programas de Estudio en Ciencias y Humanidades. Nuestra estrategia educativa fomenta el desarrollo personal de valores. Clave de Incorporación a la UAEM: 73/LXII/12.P / 1973.
                                </p>
                                <ul class="ftco-social text-center">
                                    <li class="ftco-animate"><a href="{{ route('site.levels.prepa') }}"><span class="flaticon-reading"></span> Leer más</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <video controls>
                        <source src="/media/video.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            </div>
        </div>
    </section>

@endsection