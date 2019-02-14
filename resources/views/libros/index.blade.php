@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Libros')

@section('extra_css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Filtro</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="GET" action="{{ route('libros.view') }}" id="form_create_user">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" name="filtro" value="{{ app('request')->input('filtro') }}" class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                                            <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Listado de libros</h5>
                </div>
                <div class="ibox-content">
                    <div class="float-right">
                        @can('create', App\Models\Libro::class)
                            <input type="button" class="btn btn-primary" value="Crear libro" onclick="location.href='{{ route('libros.create') }}'">
                        @endcan
                    </div>

                    @if(count($libros) == 0)
                        No hay libros registrados.
                    @else
                        <table class="footable table table-stripped" data-filter=#filter>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th data-hide="phone,tablet">Palabras clave</th>
                                <th>Autor</th>
                                <th data-hide="phone,tablet">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($libros as $libro)
                                <tr id="show_{{ $libro->id }}">
                                    <td>{{ $libro->id }}</td>
                                    <td><div id="dv_name_{{ $libro->id }}">{{ $libro->nombre }}</div></td>
                                    <td><div id="dv_descripcion_{{ $libro->id }}">{{ $libro->descripcion }}</div></td>
                                    <td><div id="dv_keywords_{{ $libro->id }}">{{ $libro->keywords }}</div></td>
                                    <td><div id="dv_autor_{{ $libro->id }}">{{ $libro->autor }}</div></td>
                                    <td class="center">



                                        <form action="{{ route('libros.destroy', $libro) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            @can('view', App\Models\Libro::class)
                                                <a href="{{ route('libros.show', $libro) }}" ><span class="fa fa-search text-navy"></span></a>
                                            @endcan
                                            @can('update', App\Models\Libro::class)
                                                <a href="{{ route('libros.edit', $libro) }}" ><span class="fa fa-pencil text-navy"></span></a>
                                            @endcan
                                            @can('delete', App\Models\Libro::class)
                                                <button type="submit" class="btn btn-link delete-button"><span class="fa fa-trash text-danger"></span></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>

                                <td colspan="5">
                                    {!! $paginate !!}
                                    {{--<ul class="pagination float-right"></ul>--}}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>

    <script>
        /*$(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });*/

    </script>

    <script>
        function mostrar(id) {
            habilitar(id);
            $('#edit_'+id).show();
            $('#show_'+id).hide();
        }

        function cancelar(id) {
            $('#show_'+id).show();
            $('#edit_'+id).hide();
        }

        function habilitar(id){
            //$('input, select').attr('disabled', false);
            $('#guardar_'+id).prop('disabled', false);
            $('#cancelar_'+id).prop('disabled', false);
            $('#name_'+id).prop('disabled', false);
            $('#username_'+id).prop('disabled', false);
            $('#email_'+id).prop('disabled', false);
            $('#role_id_'+id).prop('disabled', false);
        }

        function inhabilitar(id){
            //$('input, select').attr('disabled', true);
            $('#guardar_'+id).prop('disabled', true);
            $('#cancelar_'+id).prop('disabled', true);
            $('#name_'+id).prop('disabled', true);
            $('#username_'+id).prop('disabled', true);
            $('#email_'+id).prop('disabled', true);
            $('#role_id_'+id).prop('disabled', true);
        }

        /*function guardar(id) {
            inhabilitar(id);

            var name = $('#name_'+id).val();
            var username = $('#username_'+id).val();
            var email = $('#email_'+id).val();
            var role_id = $('#role_id_'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: '/usuarios/'+id,
                data: {
                    id: id,
                    name: name,
                    username: username,
                    email: email,
                    role: role_id
                },
                success:function(data){
                    $('.alertas').text('');
                    if(data.cambioRol)
                        location.reload();
                    else{
                        $('#dv_name_'+id).text(name);
                        $('#dv_username_'+id).text(username);
                        $('#dv_email_'+id).text(email);
                        $('#dv_role_'+id).text(data['role']);
                        cancelar(id);
                    }
                },
                error:function(data, context){
                    $('.alertas').text('');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#alert_'+key+'_'+id).text(value);
                    });
                    habilitar(id);
                }
            });
        }*/

    </script>
@endsection