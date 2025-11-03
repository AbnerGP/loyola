<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ env('APP_SITENAME') }} |  @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate_loy.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_loy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_frontend.css') }}">



    @yield('css')

</head>

<body>
<div class="py-2 bg-loyola-blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img src="{{ url('images/banner.png') }}" width="100%">
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('site.index') }}">Instituto Cultural Loyola</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto text-center">
                {{--<li class="nav-item {{ request()->is('/') ? 'active bg-loyola-blue' : '' }}"><a href="{{ route('site.index') }}" class="nav-link">Inicio</a></li>--}}
                <li class="nav-item {{ request()->is('quienes-somos') ? 'text-white bg-loyola-gold' : '' }}"><a href="{{ route('site.about') }}" class="nav-link">¿Quiénes somos?</a></li>
                @php
                    $nivelActivo = '';
                    if (request()->is('niveles-educativos')) {
                        $nivelActivo = 'bg-loyola-red';
                    } elseif (
                        request()->is('niveles-educativos/kinder') ||
                        request()->is('niveles-educativos/primaria') ||
                        request()->is('niveles-educativos/secundaria') ||
                        request()->is('niveles-educativos/preparatoria')
                    ) {
                        $nivelActivo = 'active';
                    }
                @endphp

                <li class="nav-item {{ $nivelActivo }}">
                    <a href="{{ route('site.levels') }}" class="nav-link">Niveles Educativos</a>
                </li>
                <li class="nav-item {{ request()->is('language-school') ? 'bg-loyola-yellow' : '' }}"><a href="{{ route('site.language') }}" class="nav-link">Idiomas</a></li>
                <li class="nav-item {{ request()->is('viajes') ? 'active bg-loyola-blue' : '' }}"><a href="{{ route('site.viajes') }}" class="nav-link">Viajes</a></li>
                <li class="nav-item {{ request()->is('logros') ? 'text-white bg-loyola-gold' : '' }}"><a href="{{ route('site.logros') }}" class="nav-link">Logros</a></li>
                <li class="nav-item {{ request()->is('instalaciones') ? 'text-white bg-loyola-red' : '' }}"><a href="{{ route('site.instalaciones') }}" class="nav-link">Instalaciones</a></li>
                <li class="nav-item {{ request()->is('contacto') ? 'bg-loyola-yellow' : '' }}"><a href="{{ route('site.contact') }}" class="nav-link">Contacto</a></li>
<!--                <li class="nav-item {{ request()->is('inscripcion') ? 'active bg-loyola-blue' : '' }}"><a href="{{ route('request.new') }}" class="nav-link">Solicitud de inscripción</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
{{--<header id="page-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img src="{{ url('images/banner.png') }}" width="100%">
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-dar " style="background: #022852; padding-bottom: 0">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#is">
        <i style="color: #FFFFFF" class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse " id="is">
        <div class="navbar-nav w-100 justify-content-lg-center flex-md-wrap">
            @foreach($links as $link)
                @if($link->slug != 'directorio' && $link->slug != 'ubicacion' && $link->slug != 'kinder' && $link->slug != 'primaria' && $link->slug != 'secundaria' && $link->slug != 'preparatoria' && $link->slug != 'language-school' && $link->slug != 'viajes' && $link->slug != 'academicos')
                    @if($link->slug == 'quienes-somos')
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $link->titulo }}</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ Url($link->slug) }}">{{ $link->titulo }}</a>
                                <a class="dropdown-item" href="{{ Url('directorio') }}">Directorio</a>
                                <a class="dropdown-item" href="{{ Url('ubicacion') }}">Ubicación</a>
                            </div>
                        </div>
                    @elseif($link->slug == 'niveles-educativos')
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $link->titulo }}</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ Url($link->slug) }}">{{ $link->titulo }}</a>
                                <a class="dropdown-item" href="{{ Url('kinder') }}">Kinder</a>
                                <a class="dropdown-item" href="{{ Url('primaria') }}">Primaria</a>
                                <a class="dropdown-item" href="{{ Url('secundaria') }}">Secundaria</a>
                                <a class="dropdown-item" href="{{ Url('preparatoria') }}">Preparatoria</a>
                                <a class="dropdown-item" href="http://universidadloyola.edu.mx/">Universidad</a>
                                <a class="dropdown-item" href="{{ Url('language-school') }}">Language school</a>
                                <a class="dropdown-item" href="{{ Url('viajes') }}">Viajes</a>
                            </div>
                        </div>
                    @elseif($link->slug == 'logros')
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $link->titulo }}</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ Url($link->slug) }}">{{ $link->titulo }}</a>
                                <a class="dropdown-item" href="{{ Url('academicos') }}">Académicos</a>
                            </div>
                        </div>
                    @else
                        <div class="nav-item">
                            <a href="{{ Url($link->slug) }}" class="nav-link px-5 py-2 ">{{ $link->titulo }}</a>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</nav>--}}


{{--@if(url()->current() == url('/'))
<div id="carouselExampleControls" class="container carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ url('images/banner1.jpg') }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/banner2.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/banner3.jpg') }}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" ></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" ></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif--}}

<div>
   @yield('content')
</div>

@include('biblioteca.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('js/google-map.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- Loader -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js" rel="stylesheet"></script>
<script>
    function overlay(el, action = 'show') {
        $(el).LoadingOverlay(action);
    }
</script>

@yield('js')

</body>

</html>
