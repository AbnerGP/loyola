@extends('layouts.panel')

@section('title')
    Migración Item
@endsection

@section('var_content')
    @if(isset($_GET['execute']) && $_GET['execute'] == true)
        <div class="alert alert-success">
            Migración completa
        </div>
    @endif

<a href="{{ route('migracion.view', ['file' => $filename, 'execute' => true]) }}" class="btn btn-primary">Ejectuar Función</a>
    <a href="{{ route('migracion') }}" class="btn btn-primary">Atras</a>
    <br>
    Success: {{ $success }} - Failed: {{ $failed }}
    <table class="table">
        <thead>
        <tr>
            <td>Linea</td>
        </tr>
        </thead>
        <tbody>
        @foreach($item as $single)
            <tr>
                <td>
                    @foreach($single as $key => $collection)
                        {{ $key }} = {{ $collection }} <br>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection