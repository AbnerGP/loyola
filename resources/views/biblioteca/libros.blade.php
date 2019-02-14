@extends('biblioteca.layout')


@section('title')
    Búsqueda de Libros
@endsection


@section('css')

<style>
    .bib-digital hr {
        margin: 0;
        background: #40210E;
        height: 5px;
        margin-bottom: 5px;
    }

    .bib-digital h3 {
        color: #42210B;
        font-size: 25px;
    }

    .bib-digital p {
        color: #ffffff;
    }
    .bgdigital {
        margin-right: 40px;
        padding-top: 10px;
        background-color:rgb(66,33,11, 0.6);
    }
    .bgdigital {
        font-family: Georgia, Times, "Times New Roman", serif;
    }
</style>

@endsection

@section('content')
<div class="row bib-digital">
    <div class="col-md-4 bgdigital">

        <h3>BIBLIOTECA DIGITAL</h3>
        <hr>
        <p>
            Esta sección está dedicada al patrimonio documental.
            Los Acervos electrónicos de la Biblioteca Digital son páginas
            que profundizan en el conocimiento de las colecciones
            bibliográficas.<br>
            Se ha reunido aquí los recursos de información electrónica
            y digital mediante los cuales podemos localizar textos
            completos de: libros, revistas, folletos y periodicos, que se
            encuentran disponibles, para ser consultados por el público
            en general.<br><br>
            100 Años de Cocina Mexicana y 150 Años de Historia de
            Morelos, tienen una selección de antigüedad, información
            iconográfica y documental que difícilmente se encuentran
            en la actualidad.
        </p>
        <h3>COLECCIÓN ROSARIO CASTRO QUINTERO</h3>
        <hr>
        <p>
            Nació en el municipio de Tlaltizapán, Morelos en el año de
            1945. Fue en el ámbito de la familia, del pueblo y del campo,
            donde se inició y desarrolló su vínculo estrecho con la cocina.
            Otros elementos más determinaron sus gustos y su carácter,
            tales como la religión, la pintura, las fiestas y los libros.
            Son su manera de compartir su gusto por la cocina y todo lo
            que ella significa en la vida cotidiana, que la hizo, compartirnos parte de su colección sobre Cocina Mexicana y la Historia
            de Morelos. La Colección Rosario Castro Quintero, se
            encuentra conformado por libros, revistas, folletos y
            periodicos.
        </p>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('libro.search') }}">
                    Buscar Libro: <input class="form-control" type="text" name="busqueda" value="{{ request()->get('busqueda') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>


            </div>
        </div>


        @if(isset($libros))
            <div class="row">

                <table class="table table-hover table-stripeds">
                    <thead>
                    <tr class="table-active">
                        <td>Nombre</td>
                        <td>Autor</td>
                        <td>Tema</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($libros as $libro)
                        <tr>
                            <td><a href="{{ Route('libro.single.view', ['id' => $libro->id, 'name' => str_slug($libro->nombre)]) }}">{{ $libro->nombre }}</a></td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->tema }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>




                {{ $libros->links() }}

            </div>
        @endif
    </div>
</div>
@endsection