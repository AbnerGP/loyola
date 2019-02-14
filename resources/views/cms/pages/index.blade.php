@extends('layouts.panel')

@section('title', 'Páginas')

@section('extra_css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Listado de paginas</h5>
                </div>
                <div class="ibox-content">
                    <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                           placeholder="Buscar...">


                    @can('create', App\Models\Page::class)
                    <div class="float-right">
                        <input type="button" class="btn btn-primary" value="Crear página" onclick="location.href='{{ route('cms.page.create') }}'">
                    </div>
                    @endcan

                    <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Ruta</th>
                            <th data-hide="phone,tablet">Publicado</th>
                            <th data-hide="phone,tablet">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->titulo }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->status_str }}</td>
                                <td class="center">
                                    <form action="{{ route('cms.page.destroy', $page) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update', App\Models\Page::class)
                                            <a href="{{ route('cms.page.edit', $page) }}" ><span class="fa fa-pencil text-navy"></span></a>
                                        @endcan

                                        @can('delete', App\Models\Page::class)
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
                                <ul class="pagination float-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @include('fragments.ajaxform')
    <script>
        ajaxform.ready('#form_delete_role', {
            function_pre: function(data, context) {
                alert('entra');
                $('.delete-button').click(function () {
                    swal({
                        title: "¿Estás seguro?",
                        text: "Este rol se eliminará permanentemente.",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sí. Eliminar.",
                        closeOnConfirm: false
                    }, function () {
                        swal("Eliminado", "El rol ha sido eliminado.", "success");
                    });
                });
            },
            function_error: function(data, context) {
                var message = 'Errores: \n';
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    window.location.href = data.redirect;
                } else {
                    alert('entraa');
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

            /*$('.delete-button').click(function () {
             swal({
             title: "¿Estás seguro?",
             text: "Este rol se eliminará permanentemente.",
             type: "warning",
             showCancelButton: true,
             cancelButtonText: "Cancelar",
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Sí. Eliminar.",
             closeOnConfirm: false
             }, function () {
             swal("Eliminado", "El rol ha sido eliminado.", "success");
             });
             });*/

        });

    </script>
@endsection