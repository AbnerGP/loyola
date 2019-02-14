@extends('layouts.app')

@section('title', 'Registro')

@section('class_login', 'gray-bg')

@section('content')

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">CU</h1>

        </div>
        <h3>Control de Usuarios</h3>
        <p>Crear cuenta</p>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Correo electrónico" id="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Confirmar contraseña" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Registrarme</button>

            <p class="text-muted text-center"><small>¿Ya tienes una cuenta?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
        </form>
        <p class="m-t"> <small>Control de usuarios &copy; 2018</small> </p>
    </div>
</div>
@endsection
