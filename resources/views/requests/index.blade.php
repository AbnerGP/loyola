@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Solicitudes de inscripción y reinscripción')

@section('extra_css')
    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12" id="requests_content">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Listado de solicitudes</h5>
                </div>
                <div class="ibox-content">
                    {{--<div class="float-right">
                        @can('create', App\Models\Request::class)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" id="da_create">
                                <span class="fa fa-plus"></span> Crear Acceso Directo
                            </button>
                        @endcan
                    </div>--}}

                    @if(count($requests) > 0)
                        <table>
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($requests as $request)
                                <tr id="row_{{ $d->id }}">
                                    <td><div id="dv_name_{{ $d->id }}">{{ $d->name }}</div></td>
                                    <td><div id="dv_description_{{ $d->id }}">{{ $d->description }}</div></td>
                                    <td class="center tooltip-demo">
                                        @can('update', App\Models\DirectAccess::class)
                                            <button type="button"
                                                    class="btn btn-sm btn-link text-navy"
                                                    title="Editar acceso directo"
                                                    data-toggle="modal" data-target="#modal"
                                                    onclick="loadModal('{{ $d->name }}', '{{ $d->description }}', '{{ $d->icon }}', '{{ $d->route }}', '{{ $d->url }}', '{{ route('d_access.update', $d) }}')"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete', App\Models\DirectAccess::class)
                                            <button type="button" class="btn btn-link delete-button" data-toggle="tooltip" data-placement="left" title="Eliminar acceso directo" onclick="return ConfirmDelete('{{ $d->id }}', '{{ route('d_access.destroy', $d) }}')"><span class="fa fa-trash text-danger"></span></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>

                                <td colspan="6">
                                    {!! $paginate !!}
                                    <ul class="pagination float-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>No se encontró ningún acceso directo.</p>
                    @endif

                    @include('direct_access.modal')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @include('fragments.ajaxformv4')

    <script type="text/javascript">
        var content = '#d_access_content';

        ajaxform.ready('#form', {
            function_pre: function () {
                $('.alertas').html('');
            },
            function_success: function (r, c) {
                window.location.reload();
                return true;
            },
            function_error: function (r, c) {
                $.each(r.errors, function (k, v) {
                    $('#alert-' + k).html(v);
                });
                c.disabled(false);
                return true;
            }
        });

        function loadModal(name, description, icon, route, url, r_update) {
            $('#form').attr('action', r_update);
            $('#name').val(name);
            $('#description').val(description);
            $('#icon').val(icon);
            $('#route').val(route);
            $('#url').val(url);
            $('#method').val('PUT');
        }

        $('#da_create').on('click', function () {
            $('#name').val('');
            $('#description').val('');
            $('#icon').val('');
            $('#route').val('');
            $('#url').val('');
            $('#form').attr('action', '{{ route('d_access.store') }}');
            $('#method').val('POST');
        });
    </script>
@endsection