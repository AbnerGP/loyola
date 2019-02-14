@extends('biblioteca.layout')


@section('title')
    {{ $page->titulo }}
@endsection

@section('content')
        {!! $page->contenido !!}
@endsection