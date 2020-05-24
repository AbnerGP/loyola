@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Usuarios')

@section('extra_css')
    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row" id="users_content">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Listado de usuarios</h5>
                </div>
                <div class="ibox-content">
                    <div class="float-right">
                        @can('create', App\Models\User::class)
                            <input type="button" class="btn btn-primary" value="Crear usuario" onclick="location.href='{{ route('users.create') }}'">
                        @endcan
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa fa-database fa-fw" aria-hidden="true"></i>
                                #
                            </th>
                            <th>
                                <i class="fa fa-address-card fa-fw" aria-hidden="true"></i>
                                Nombre
                            </th>
                            <th>
                                <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
                                Usuario
                            </th>
                            <th data-hide="phone,tablet">
                                <i class="fa fa-envelope fa-fw" aria-hidden="true"></i>
                                E-mail
                            </th>
                            <th>
                                <i class="fa fa-pied-piper-alt fa-fw" aria-hidden="true"></i>
                                Rol
                            </th>
                            <th>
                                <i class="fa fa-lock fa-fw" aria-hidden="true"></i>
                                Estado
                            </th>
                            <th data-hide="phone,tablet">
                                <i class="fa fa-gears fa-fw" aria-hidden="true"></i>
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr id="row_{{ $user->id }}">
                                <th>{{ $user->id }}</th>
                                <td>
                                    <div id="dv_name_{{ $user->id }}">{{ $user->name }}</div>
                                </td>
                                <td>
                                    <div id="dv_username_{{ $user->id }}">{{ $user->username }}</div>
                                </td>
                                <td>
                                    <div id="dv_email_{{ $user->id }}">{{ $user->email }}</div>
                                </td>
                                <td class="center">
                                    <div id="dv_role_{{ $user->id }}">{{ $user->roles()->first()->title }}</div>
                                </td>
                                <td>
                                    <div id="active_{{ $user->id }}" class="text-center
                                    @if($user->active == 1) bg-primary @else bg-danger @endif p-xs b-r-xl">
                                        @if($user->active == 1) Activo @else Inactivo @endif
                                    </div>
                                </td>
                                <td class="center tooltip-demo">
                                    @if($user->roles()->first()->name == 'superadmin')
                                        @if(currentUser()->isSuperadmin())
                                            @if($user->id != currentUser()->id)
                                                <button type="button"
                                                        class="btn btn-link"
                                                        data-toggle="modal" data-target="#editUser"
                                                        onclick="loadModalEdit('{{ $user->name }}', '{{ $user->username }}', '{{ $user->email }}', '{{ $user->comentarios }}', '{{ $user->roles()->first()->id }}', '{{ route('users.update', $user) }}')"
                                                >
                                                    <i class="fa fa-pencil text-navy" data-toggle="tooltip" data-placement="left" title="Editar Usuario"></i>
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        @can('update', App\Models\User::class)
                                            <button type="button"
                                                    class="btn btn-link"
                                                    data-toggle="modal" data-target="#editUser"
                                                    onclick="loadModalEdit('{{ $user->name }}', '{{ $user->username }}', '{{ $user->email }}', '{{ $user->comentarios }}', '{{ $user->roles()->first()->id }}', '{{ route('users.update', $user) }}')"
                                            >
                                                <i class="fa fa-pencil text-navy" data-toggle="tooltip" data-placement="left" title="Editar Usuario"></i>
                                            </button>

                                            <a href="javascript: change_status('{{ $user->id }}', '{{ route('users.status', $user) }}')" data-toggle="tooltip" data-placement="left"
                                               title="Desactivar Usuario" id="disable_{{ $user->id }}" style="@if($user->active == 1) display: inline @else display: none @endif">
                                                <span class="fa fa-ban text-warning"></span>
                                            </a>

                                            <a href="javascript: change_status('{{ $user->id }}', '{{ route('users.status', $user) }}')" data-toggle="tooltip" data-placement="left"
                                               title="Activar Usuario" id="enable_{{ $user->id }}" style="@if($user->active == 1) display: none @else display: inline @endif">
                                                <span class="fa fa-check text-navy"></span>
                                            </a>

                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal_password" onclick="loadModal('{{ $user->username }}', '{{ route('users.password', $user) }}')">
                                                <span class="fa fa-keyboard-o text-primary" data-toggle="tooltip" data-placement="left" title="Cambiar contraseña"></span>
                                            </button>
                                        @endcan

                                        @can('delete', App\Models\User::class)
                                            @if(currentUser()->id != $user->id)
                                                <button type="button" class="btn btn-link delete-button" data-toggle="tooltip" data-placement="left" title="Eliminar Usuario" onclick="return ConfirmDelete('{{ $user->id }}', '{{ route('users.destroy', $user) }}')"><span class="fa fa-trash text-danger"></span></button>
                                            @endif
                                        @endcan
                                    @endif
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

                    @include('users.modal_password')
                    @include('users.modal_edit')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @include('fragments.ajaxformv4')

    <script>
        var content = '#users_content';

        ajaxform.ready('#form_user', {
            function_error: function(data, context) {
                $('.alertas').text('');
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
                context.disabled(false);
                return true;
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    swal({
                        title: 'Hecho',
                        text: data.message,
                        type: 'success'
                    }, function () {
                        overlay(content);
                        location.reload();
                    });
                } else {
                    alert('entraa');
                }
            },
            function_pre: function () {
                $('.alertas').text('');
            }
        });

        ajaxform.ready('#form_password', {
            function_error: function(data, context) {
                $('.alertas').text('');
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
                context.disabled(false);
                return true;
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    swal({
                        title: 'Hecho',
                        text: data.message,
                        type: 'success'
                    }, function () {
                        overlay(content);
                        location.reload();
                    });
                } else {
                    alert('entraa');
                }
            },
            function_pre: function () {
                $('.alertas').text('');
            }
        });

        function loadModalEdit(name, username, email, comments, role, route) {
            $('#form_user').attr('action', route);
            $('#name').val(name);
            $('#username').val(username);
            $('#email').val(email);
            $('#comments').val(comments);
            $('#role').val(role);
        }

        function loadModal(username, route) {
            $('#form_password').attr('action', route);
            $('#modal_title').html('Usuario ' + username);
            $('#password').val('');
            $('#password_confirmation').val('');
        }

        function change_status(id, route) {
            overlay(content);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: route,
                success:function(data){
                    if(data.success) {
                        overlay(content, 'hide');
                        if (data.active == 1) {
                            $('#active_' + id).html('Activo');
                            $('#active_' + id).removeClass('bg-danger');
                            $('#active_' + id).addClass('bg-primary');
                            $('#disable_' + id).show();
                            $('#enable_' + id).hide();
                        } else {
                            $('#active_' + id).html('Inactivo');
                            $('#active_' + id).removeClass('bg-primary');
                            $('#active_' + id).addClass('bg-danger');
                            $('#disable_' + id).hide();
                            $('#enable_' + id).show();
                        }
                    }else{
                        overlay(content, 'hide');
                        console.log('Error');
                    }
                },
                error:function(data, context){
                    console.log('Error');
                }
            });
        }
    </script>
@endsection