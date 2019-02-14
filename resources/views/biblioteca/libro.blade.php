@extends('biblioteca.layout')




@section('title')
    {{ $libro->nombre }}
@endsection

@section('content')


    <a href="javascript:history.back(1);">Atras</a>

    <div class="row">

        <table class="table">
            <tr>
                <td><b>Nombre</b></td>
                <td><b>Autor</b></td>
                <td><b>Año</b></td>
            </tr>
            <tr>
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->autor  }}</td>
                <td>{{ $libro->year }}</td>
            </tr>

            <tr>
                <td><b>Decripción</b></td>
                <td><b>Ubicacion</b></td>
                <td><b>Edición</b></td>
            </tr>

            <tr>
                <td>{{ $libro->keywords }}</td>
                <td>{{ $libro->lugar_edicion }}</td>
                <td>{{ $libro->num_edicion }}</td>
            </tr>

            <tr>
                <td colspan="3">Contenido</td>
            </tr>
            <tr>
                <td colspan="3">
                    Libro1.pdf<br>
                    Libro2.pdf
                </td>
            </tr>

        </table>


    </div>

@endsection