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
    <style>

        html {
            min-height: 100%;
            position: relative;
        }
        body {
            margin: 0;
            background: url('{{ url('images/background.png') }}');
            /*font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;*/
            margin-bottom: 230px;
        }

        @media (max-width: 700px) {
            body {
                margin-bottom: 500px;
            }
        }

        .bib-container {
            background-color:rgb(255,255,255, 0.4);
        }


        .navbar a {
            color: #FFFFFF;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar a:hover {
            color: #7f5700;
        }

        .ft-copyright {
            background-color: #000000;
            border-top: 0px solid #121d6d;
            display: flex;
        }

        .pb-2,
        .py-2 {
            padding-bottom: .5rem !important;
            padding-top: .5rem !important;
        }

        .footer-top {
            background-color: #7E5700;
            border-bottom: 0px solid #FFFFFF;
        }

        .text-center {
            text-align: center !important;
        }

        h4.ft-text-title {
            color: #fff;
            margin: 20px 0 10px;
            font-weight: 700;
            text-align: center;
        }

        h4 {
            display: block;
            -webkit-margin-before: 1.33em;
            -webkit-margin-after: 1.33em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            font-weight: bold;
            font-size: 1.3em;
        }

        h6.ft-desp {
            color: #FFF;
            padding: 2px;
        }

        h6 {
            font-size: 15px;
        }
        h1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        h1.heading-title a{
            color: #012061 !important;
            text-decoration: none;
        }
        h1 {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.4;
            color: #000;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            position: relative;
            padding-bottom: 10px;
        }
        a.contact,
        a.mail {
            border: 1px solid yellow;
            border-bottom-right-radius: 15px;
            border-bottom-left-radius: 15px;
            color: #fff;
            padding: 5px;
            font-size: 15px;
            text-decoration: none;
        }

        a.contact:hover,
        a.mail:hover {
            background: #900;
        }

        i.fa-phone,
        i.fa-envelope-o {
            padding: 3px;
        }

        i.fa-envelope-o {
            padding: 4px;
        }

        .border-left {
            border-left: dotted #ddd 1px;
        }

        .pspt-dtls {
            margin-top: 20px !important;
        }

        .pspt-dtls a {
            margin: 8px !important;
        }

        a.about,
        a.team,
        a.advertise {
            padding: 8px;
            border: 1px yellow solid;
            padding-left: 15px;
            padding-right: 15px;
            border-radius: 5px;
            color: #FFF;
            text-decoration: none;
            font-size: 15px;
        }

        a.about:hover,
        a.team:hover,
        a.advertise:hover {
            background: #900;
        }

        footer p {
            color: #fff;
            margin-bottom: 10px;
        }

        .text-pp-crt,
        .text-pp-crt-rg {
            color: #FFFFFF;
        }

        .developer {
            text-align: center;
        }
        p.member{
            color:#FFF;
        }
        i.develop {
            border: 1px red dotted;
        }

        .developer b {
            color: red;
        }


        .footer-list a {
            color: #FFFFFF;
            font-weight: bold;
        }

        .footer-list a:hover {
            text-decoration: underline;
        }


        .footer-list li {
            list-style: none;
        }

        .footer-list li::before {
            content: "\2022";
            color: white;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .footer-main {
            position: absolute;
            bottom: 0;
        }


    </style>

    @yield('css')

</head>

<body>


<nav class="navbar navbar-expand-lg navbar-dar " style="background: #621A47; padding-bottom: 0">
    <a href="{{ url('') }}" class="navbar-brand">
        <img src="{{ url('images/bibliotecalogo.png') }}" width="90px">
    </a>
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
            <div class="nav-item">
                <a class="nav-link px-5 py-2 " href="{{ route('libro.search') }}">Biblioteca Digital</a>
            </div>
        </div>
    </div>

        <form class="form-inline my-2 my-lg-0 navbar-collapse" action="{{ route('libro.search') }}" method="get">
            <input name="busqueda" class="form-control mr-sm-2" type="search" placeholder="Buscar Libro" aria-label="Buscar Libro"
            value="{{ request()->get('busqueda') }}"
            >
                <button class="btn btn-primary" type="submit">Ir</button>
        </form>


</nav>


@if(url()->current() == url('/'))
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
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
