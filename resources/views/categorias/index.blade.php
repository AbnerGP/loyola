@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Categorías')

@section('extra_css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Listado de categorías</h5>
                </div>
                <div class="ibox-content">
                    {{--<input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                           placeholder="Buscar...">--}}
                    <div class="float-right">
                        @can('create', App\Models\Categoria::class)
                            <input type="button" class="btn btn-primary" value="Crear categoría" onclick="location.href='{{ route('categorias.create') }}'">
                        @endcan
                    </div>

                    @if(count($categorias) > 0)
                        <table class="footable table table-stripped" data-filter=#filter>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Usuario</th>
                                <th data-hide="phone,tablet">Status</th>
                                <th data-hide="phone,tablet">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorias as $categoria)
                                <tr id="show_{{ $categoria->id }}">
                                    <td>{{ $categoria->id }}</td>
                                    <td><div id="dv_descripcion_{{ $categoria->id }}">{{ $categoria->descripcion }}</div></td>
                                    <td class="center"><div id="dv_user_{{ $categoria->id }}">{{ $categoria->user->name }}</div></td>
                                    <td><div id="dv_status_{{ $categoria->id }}">{{ $categoria->status }}</div></td>
                                    <td class="center">
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" id="form_delete_{{ $categoria->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            @can('update', App\Models\Categoria::class)
                                                <a href="javascript: mostrar('{{ $categoria->id }}')" ><span class="fa fa-pencil text-navy"></span></a>
                                            @endcan

                                            @can('delete', App\Models\Categoria::class)
                                                <button type="button" class="btn btn-link delete-button" onclick="eliminar({{ $categoria->id }})"><span class="fa fa-trash text-danger"></span></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>

                                <tr style="display: none;" id="edit_{{ $categoria->id }}">
                                    <th scope="row">{{ $categoria->id }}</th>
                                    <td>
                                        <input id="descripcion_{{ $categoria->id }}" type="text" class="form-control" value="{{ $categoria->descripcion }}">
                                        <p class="text-danger alertas" id="alert_descripcion_{{ $categoria->id }}"></p>
                                    </td>
                                    <td>
                                        <select id="user_id_{{ $categoria->id }}" class="form-control">
                                            {!! $select[$categoria->id] !!}
                                        </select>
                                        <p class="text-danger alertas" id="alert_user_id_{{ $categoria->id }}"></p>
                                    </td>
                                    <td>
                                        <input id="status_{{ $categoria->id }}" type="text" class="form-control" value="{{ $categoria->status }}">
                                        <p class="text-danger alertas" id="alert_username_{{ $categoria->id }}"></p>
                                    </td>
                                    <td>
                                        <input type="button" onclick="javascript: guardar('{{ $categoria->id }}', '{{ route('categorias.update', $categoria) }}')" class="btn btn-success" id="guardar_{{ $categoria->id }}" value="Guardar">
                                        <input type="button" onclick="javascript: cancelar('{{ $categoria->id }}')" class="btn btn-danger" id="cancelar_{{ $categoria->id }}" value="Cancelar">
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
                    @else
                        No hay resultados para mostrar.
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>

    <script>
        function eliminar(id) {
            if(confirm('¿Estás seguro?')){
                $('#form_delete_' + id).submit();
            }
        }
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
            $('#descripcion_'+id).prop('disabled', false);
            $('#user_id_'+id).prop('disabled', false);
            $('#status_'+id).prop('disabled', false);
        }

        function inhabilitar(id){
            //$('input, select').attr('disabled', true);
            $('#guardar_'+id).prop('disabled', true);
            $('#cancelar_'+id).prop('disabled', true);
            $('#descripcion_'+id).prop('disabled', true);
            $('#user_id_'+id).prop('disabled', true);
            $('#status_'+id).prop('disabled', true);
        }

        function guardar(id, route) {
            inhabilitar(id);

            var descripcion = $('#descripcion_'+id).val();
            var user_id = $('#user_id_'+id).val();
            var status = $('#status_'+id).val();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: route,
                data: {
                    id: id,
                    descripcion: descripcion,
                    user_id: user_id,
                    status: status
                },
                success:function(data){
                    $('.alertas').text('');
                    $('#dv_descripcion_'+id).text(descripcion);
                    $('#dv_user_'+id).text(data['user']);
                    $('#dv_status_'+id).text(status);

                    cancelar(id);

                },
                error:function(data, context){
                    $('.alertas').text('');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#alert_'+key+'_'+id).text(value);
                    });
                    habilitar(id);
                }
            });
        }

    </script>
@endsection