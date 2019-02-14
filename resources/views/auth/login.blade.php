@extends('layouts.app')

@section('title', 'Login')

@section('class_login', 'gray-bg')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">CU</h1>

        </div>
        <h3>Control de Usuarios</h3>
        <p>Iniciar sesión</p>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Nombre de usuario" id="email" name="email" value="{{ old('email') }}" required autofocus>
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

            <button type="submit" class="btn btn-primary block full-width m-b">Iniciar sesión</button>

            <a href="{{ route('password.request') }}"><small>Olvidé mi contraseña</small></a>
            {{--<a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Registrarme</a>--}}
        </form>
        <p class="m-t"> <small>Control de usuarios &copy; 2018</small> </p>
    </div>
</div>
@endsection