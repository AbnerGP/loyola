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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Nivel</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($requests as $request)
                                <tr id="row_{{ $request->id }}">
                                    <td>{{ $request->id }}</td>
                                    <td><div id="dv_name_{{ $request->id }}">{{ $request->full_name() }}</div></td>
                                    <td><div id="dv_level_{{ $request->id }}">{{ $request->get_level() }}</div></td>
                                    <td><div id="dv_type_{{ $request->id }}">{{ $request->get_type() }}</div></td>
                                    <td class="center tooltip-demo">
                                        @can('delete', App\Models\Request::class)
                                            <button type="button" class="btn btn-link delete-button" data-toggle="tooltip" data-placement="left" title="Eliminar solicitud" onclick="return ConfirmDelete('{{ $request->id }}', '{{ route('request.destroy', $request) }}')"><span class="fa fa-trash text-danger"></span></button>
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
                        <p>No se encontró ninguna solicitud.</p>
                    @endif
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
    </script>
@endsection