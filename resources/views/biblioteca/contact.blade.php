@extends('biblioteca.layout')

@section('title', 'Contacto')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/instalaciones/n6.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">Contáctanos</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('site.index') }}">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>Contacto <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-3 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">Dirección</h3>
                        <p>Zapote No. 2
                            Col. Las Palmas
                            Cuernavaca, Morelos.</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">Teléfono</h3>
                        <p>(777) 318-1359</p>
                        <p>(777) 318-4471</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="bg-light align-self-stretch box p-4 text-center">
                        <h3 class="mb-4">Correo electrónico</h3>
                        <p>majomkting@hotmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
        <div class="container">
            <div class="row d-flex align-items-stretch no-gutters">
                <div class="col-lg-12 order-md-last bg-light">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Asunto">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Enviar mensaje" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h5>Primaria Loyola</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1887.2237391299295!2d-99.23438018811257!3d18.9115774212637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce75660847efa7%3A0xbdd209bd35b91b13!2sLoyola+Grupo+Educativo!5e0!3m2!1ses-419!2smx!4v1550595885614" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h5>Kinder, Secundaria y Preparatoria</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1887.2581867028205!2d-99.23337664127806!3d18.908524599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cddf006ae91261%3A0x1c11b84cdb46e86f!2sGrupo+Educativo+Loyola!5e0!3m2!1ses-419!2smx!4v1550595999361" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection