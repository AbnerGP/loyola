@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Usuarios')

@section('extra_css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Listado de usuarios</h5>
                </div>
                <div class="ibox-content">
                    {{--<input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                           placeholder="Buscar...">--}}
                    <div class="float-right">
                        @can('create', App\Models\User::class)
                            <input type="button" class="btn btn-primary" value="Crear usuario" onclick="location.href='{{ route('usuarios.create') }}'">
                        @endcan
                    </div>

                    <table class="footable table table-stripped" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th data-hide="phone,tablet">E-mail</th>
                            <th>Rol</th>
                            <th data-hide="phone,tablet">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr id="show_{{ $user->id }}">
                                <th>{{ $user->id }}</th>
                                <td><div id="dv_name_{{ $user->id }}">{{ $user->name }}</div></td>
                                <td><div id="dv_username_{{ $user->id }}">{{ $user->username }}</div></td>
                                <td><div id="dv_email_{{ $user->id }}">{{ $user->email }}</div></td>
                                <td class="center"><div id="dv_role_{{ $user->id }}">{{ $user->roles()->first()->title }}</div></td>
                                <td class="center">
                                    @if($user->roles()->first()->name == 'superadmin')
                                        @if(auth()->user()->isSuperadmin())
                                            <a href="javascript: mostrar('{{ $user->id }}')" ><span class="fa fa-pencil text-navy"></span></a>
                                        @endif
                                    @else
                                        <form action="{{ route('usuarios.destroy', $user) }}" method="POST" id="form_delete_{{ $user->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            @can('update', App\Models\User::class)
                                                <a href="javascript: mostrar('{{ $user->id }}')" ><span class="fa fa-pencil text-navy"></span></a>
                                            @endcan

                                            @can('delete', App\Models\User::class)
                                                @if(auth()->user()->id != $user->id)
                                                    <button type="button" class="btn btn-link delete-button" onclick="eliminar({{ $user->id }})"><span class="fa fa-trash text-danger"></span></button>
                                                @endif
                                            @endcan
                                        </form>
                                    @endif
                                </td>
                            </tr>

                            <tr style="display: none;" id="edit_{{ $user->id }}">
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    <input id="name_{{ $user->id }}" type="text" class="form-control" value="{{ $user->name }}">
                                    <p class="text-danger alertas" id="alert_name_{{ $user->id }}"></p>
                                </td>
                                <td>
                                    <input id="username_{{ $user->id }}" type="text" class="form-control" value="{{ $user->username }}">
                                    <p class="text-danger alertas" id="alert_username_{{ $user->id }}"></p>
                                </td>
                                <td>
                                    <input id="email_{{ $user->id }}" type="text" class="form-control" value="{{ $user->email }}">
                                    <p class="text-danger alertas" id="alert_email_{{ $user->id }}"></p>
                                </td>
                                <td>
                                    @if($user->roles()->first()->name == 'superadmin' && ($user->id == auth()->user()->id))
                                        {{ $user->roles()->first()->title }}
                                        <input type="hidden" id="role_id_{{ $user->id }}" value="{{ $user->roles()->first()->id }}">
                                    @else
                                        <select id="role_id_{{ $user->id }}" class="form-control">
                                            {!! $select[$user->id] !!}
                                        </select>
                                    @endif
                                        <p class="text-danger alertas" id="alert_role_{{ $user->id }}"></p>
                                </td>
                                <td></td>
                            </tr>
                            <tr style="display: none;" id="edit2_{{ $user->id }}">
                                <td><strong>Comentarios:</strong></td>
                                <td colspan="4">
                                    <textarea id="comentarios_{{ $user->id }}" class="form-control">{{ $user->comentarios }}</textarea>
                                </td>
                                <td>
                                    @if($user->roles()->first()->name == 'superadmin')
                                        @if(auth()->user()->isSuperadmin())
                                            <input type="button" onclick="javascript: guardar('{{ $user->id }}', '{{ route('usuarios.update', $user) }}')" class="btn btn-success" id="guardar_{{ $user->id }}" value="Guardar">
                                            <input type="button" onclick="javascript: cancelar('{{ $user->id }}')" class="btn btn-danger" id="cancelar_{{ $user->id }}" value="Cancelar">
                                        @endif
                                    @else
                                        <input type="button" onclick="javascript: guardar('{{ $user->id }}', '{{ route('usuarios.update', $user) }}')" class="btn btn-success" id="guardar_{{ $user->id }}" value="Guardar">
                                        <input type="button" onclick="javascript: cancelar('{{ $user->id }}')" class="btn btn-danger" id="cancelar_{{ $user->id }}" value="Cancelar">
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
            $('#edit2_'+id).show();
            $('#show_'+id).hide();
        }

        function cancelar(id) {
            $('#show_'+id).show();
            $('#edit_'+id).hide();
            $('#edit2_'+id).hide();
        }

        function habilitar(id){
            //$('input, select').attr('disabled', false);
            $('#guardar_'+id).prop('disabled', false);
            $('#cancelar_'+id).prop('disabled', false);
            $('#name_'+id).prop('disabled', false);
            $('#username_'+id).prop('disabled', false);
            $('#email_'+id).prop('disabled', false);
            $('#comentarios_'+id).prop('disabled', false);
            $('#role_id_'+id).prop('disabled', false);
        }

        function inhabilitar(id){
            //$('input, select').attr('disabled', true);
            $('#guardar_'+id).prop('disabled', true);
            $('#cancelar_'+id).prop('disabled', true);
            $('#name_'+id).prop('disabled', true);
            $('#username_'+id).prop('disabled', true);
            $('#email_'+id).prop('disabled', true);
            $('#comentarios_'+id).prop('disabled', true);
            $('#role_id_'+id).prop('disabled', true);
        }

        function guardar(id, route) {
            inhabilitar(id);

            var name = $('#name_'+id).val();
            var username = $('#username_'+id).val();
            var email = $('#email_'+id).val();
            var comentarios = $('#comentarios_'+id).val();
            var role_id = $('#role_id_'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                url: route,
                data: {
                    id: id,
                    name: name,
                    username: username,
                    email: email,
                    comentarios: comentarios,
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
                        $('#dv_comentarios_'+id).text(comentarios);
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
        }

    </script>
@endsection