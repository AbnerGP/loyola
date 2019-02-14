@extends('layouts.panel')

@section('title', 'Inicio')

@section('var_content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <h1>Bienvenido</h1>

    @can('comentar')
        ¡Genial! Tú tienes permisos para comentar.
    @endcan
@endsection
