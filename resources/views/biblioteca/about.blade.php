@extends('biblioteca.layout')

@section('title', '¿Quiénes somos?')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/instalaciones/n8.jpg');">
        {{--<div class="overlay"></div>--}}
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">¿Quiénes somos?</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('site.index') }}">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>quienes-somos <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-md-last wrap-about py-5 wrap-about bg-light">
                    <div class="text px-4 ftco-animate">
                        <h2 class="mb-4">Grupo Educativo Loyola</h2>
                        <p>
                            Una tradición en educación que ha trascendido de generación a generación.
                        </p>
                        <p>
                            Desde su fundación, el Grupo Educativo Loyola ha tenido por norma adecuar sus programas académicos a la dinámica social para estar al día en el campo de la enseñanza, lo cual nos ha permitido mantenernos a la vanguardia en la preparación y la formación de nuestros alumnos, lo que a su vez les permite a ellos responder adecuadamente a las expectativas de una sociedad globalizada altamente competitiva.
                        </p>
                        <p>
                            Nuestra calidad académica nos ha convertido en una institución de prestigio y calidad, con importantes logros académicos y deportivos que motivan a nuestros alumnos a superarse y ser mejores.
                        </p>
                    </div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">¿Quiénes somos?</h2>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-reading"></span></div>
                                <div class="text">
                                    <h3>Misión</h3>
                                    <p>
                                        Formar personas capaces de realizarse y de contribuir a la realización de la sociedad, con una visión comprehensiva orientada por la armonía, la verdad y la humildad.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-education"></span></div>
                                <div class="text">
                                    <h3>Nuestra visión filosófica</h3>
                                    <p>
                                        El Colegio Loyola define su filosofía educativa como una Filosofía Comprehensiva, en tanto que:
                                    </p>
                                    <ol>
                                        <li>Concibe la existencia humana como incardinada en una totalidad incluyente y dinámica.</li>
                                        <li>Se plantea el desarrollo de la persona y de la colectividad, dentro de un proceso posible y necesario de armonización positiva, “de” y “con” dicha totalidad.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-kids"></span></div>
                                <div class="text">
                                    <h3>El Colegio Loyola y la dimensión humana</h3>
                                    <p>
                                        La dimensión humana, ingrediente esencial de la Filosofía Comprehensiva del Colegio Loyola, plantea, entre sus valores fundamentales los siguientes:
                                    </p>
                                    <ul>
                                        <li>Amor y compromiso hacia nuestros semejantes, en un marco de justicia y apertura a la diferencia.</li>
                                        <li>Búsqueda de la verdad, proceso en el cual la ciencia, el autoconocimiento y el pensamiento creativo cumplen funciones clave.</li>
                                        <li>Búsqueda de la realización exitosa de individuos y sociedad, como proyectos en permanente construcción y reconstrucción y en un marco de libertad responsable.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span class="flaticon-jigsaw"></span></div>
                                <div class="text">
                                    <h3>Nuestros valores</h3>
                                    <p>
                                        Los siguientes principios clave orientan a nuestro proyecto educativo en todos sus ámbitos:
                                    </p>
                                    <ol>
                                        <li>Amor.</li>
                                        <li>Humildad.</li>
                                        <li>Verdad.</li>
                                        <li>Libertad.</li>
                                        <li>Justicia.</li>
                                        <li>Respeto.</li>
                                        <li>Responsabilidad.</li>
                                        <li>Lealtad.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro" style="background-image: url(images/instalaciones/n9.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2>Educación de calidad</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <div class="img" style="background-image: url(images/instalaciones/n3.jpg);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="#">Principios pedagógicos</a></h3>
                        <p>
                            La labor educativa del Colegio Loyola está cimentada firmemente en tres referentes pedagógicos, el tercero de los cuales es una expresión derivada de nuestra Filosofía Comprehensiva:
                        </p>
                        <ol>
                            <li>El Aprendizaje Significativo.</li>
                            <li>El Aprendizaje Basado en Competencias.</li>
                            <li>Una Educación Comprehensiva.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <div class="img" style="background-image: url(images/kinder/k1.jpg);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="#">El Aprendizaje Significativo</a></h3>
                        <p>
                            Este principio pedagógico, congruente con el paradigma constructivista, nos pide promover activamente aquellas experiencias de aprendizaje en las que los participantes:
                        </p>
                        <ol>
                            <li>Valoran lo que aprenden.</li>
                            <li>Comprenden lo que aprenden.</li>
                            <li>Aplican lo que aprenden.</li>
                            <li>Mejoran lo que aprenden.</li>
                            <li>Aprenden a aprender.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <div class="img" style="background-image: url(images/primaria/p13.jpg);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="#">El Aprendizaje Basado en Competencias</a></h3>
                        <p>
                            Este principio pedagógico nos pide hacer todo lo posible para asegurarnos de que:
                        </p>
                        <ol>
                            <li>El aprendizaje escolar sea una vía efectiva para el desarrollo integral.</li>
                            <li>Nuestros alumnos pueden desempeñarse exitosamente en escenarios reales y complejos, acordes a su etapa de desarrollo y a los desafíos del mundo actual.</li>
                            <li>Nuestros alumnos puedan contribuir de manera efectiva a la transformación de sí mismos y de su entorno inmediato, mediato y global.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 course d-lg-flex ftco-animate">
                    <div class="img" style="background-image: url(images/secundaria/s14.jpg);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="#">Una Educación Comprehensiva</a></h3>
                        <p>Desde este principio nos planteamos:</p>
                        <ol>
                            <li>Concebir la educación como un acto de amor.</li>
                            <li>Contribuir de manera efectiva al desarrollo completo del ser del alumno, en armonía con el planeta y el universo.</li>
                            <li>Educar en atención a las etapas de desarrollo de los alumnos, en donde la integración neuropsicológica, la introspección y la integración a la vida, son algunos de los vectores clave.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-12 course d-lg-flex ftco-animate">
                    <div class="img" style="background-image: url(images/preparatoria/h3.jpg);"></div>
                    <div class="text bg-light p-4">
                        <h3><a href="#">Recursos metodológicos</a></h3>
                        <p>
                            El modelo educativo del Colegio Loyola se ve enriquecido por plataformas teórico-metodológicas diversas, en permanente actualización y congruentes con nuestra filosofía educativa y nuestra visión pedagógica, entre las que destacan:
                        </p>
                        <ol>
                            <li>El aprendizaje activo.</li>
                            <li>El aprendizaje situado.</li>
                            <li>Inteligencias múltiples.</li>
                            <li>Disciplina inteligente.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="images/plus.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection