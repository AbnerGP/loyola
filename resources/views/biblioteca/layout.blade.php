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
            <div class="nav-item">
                <a href="{{ Url($link->slug) }}" class="nav-link px-5 py-2 ">{{ $link->titulo }}</a>
            </div>
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


<div class="container-fluid footer-main ">
    <div class="row footer-top ">
        <div class="col-sm-4 col-xs-12 text-center">
            <img class="img-fluid" style="padding-top: 40px" src="{{ url('images/gobmorelos.png') }}">
        </div>

        <div class="col-sm-4">
            <h4 class="ft-text-title">Páginas de Interés</h4>
            <ul class="footer-list">
                <li><a href="http://iedm.morelos.gob.mx/" target="_blank">Instituto Estatal de Documentación</a></li>
                <li><a href="http://morelos.gob.mx" target="_blank">Gobierno del Estado de Morelos</a></li>
                <li><a href="http://turismoycultura.morelos.gob.mx" target="_blank">Secretaría de Turismo y Cultura</a></li>
            </ul>

        </div>
        <div class="col-sm-4 text-center">
            <img style="padding-top: 40px; padding-bottom: 30px" class="img-fluid" src="{{ url('images/logo-fonca.png') }}">
        </div>
    </div>
    <div class="row ft-copyright pt-2 pb-2" style="padding-left: 25px;">
        <div class="col-sm-4 text-pp-crt">Gobierno del Estado de Morelos 2018-2024</div>
        <div class="col-sm-4 text-pp-crt-rg">Instituto Estatal de Documentación</div>
        <div class="col-sm-4 developer">
            <a href="https://fonca.cultura.gob.mx/" target="_blank" class="text-pp-crt">FONCA</a>
        </div>
    </div>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.1/js/mdb.min.js"></script>
<script type="text/javascript">
    $('.carouselExampleControls').carousel({
        interval: 100
    })
</script>

</body>

</html>
