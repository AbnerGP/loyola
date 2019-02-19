<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_SITENAME') }} |  @yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.1/css/mdb.min.css" rel="stylesheet">
    <link href="{{ asset('css/style_frontend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">



    @yield('css')

</head>

<body>

<header id="page-top">
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
</nav>


@if(url()->current() == url('/'))
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
@endif

<div class="bib-container container jumbotron clearfix my-lg-4" style="padding: 2rem 2rem">
   @yield('content')
</div>

@include('biblioteca.footer')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.1/js/mdb.min.js"></script>
<!-- blueimp gallery -->
<script src="{{ asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
<script type="text/javascript">
    $('.carouselExampleControls').carousel({
        interval: 100
    })
</script>


</body>

</html>
