@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('class_login', 'gray-bg')

@section('content')
    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Restablecer contraseña</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        Ingresa tu correo electrónico y se te enviará una dirección para restablecer tu contraseña.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required="">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Enviar</button>

                                <a href="{{ route('login') }}"><small>Ir al inicio</small></a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Control de usuarios
            </div>
            <div class="col-md-6 text-right">
                <small>© 2018</small>
            </div>
        </div>
    </div>
@endsection
