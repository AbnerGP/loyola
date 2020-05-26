@extends('layouts.panel')

@section('title', 'Crear Usuario')

@section('extra_css')
    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('var_content')

    <div class="row" id="table_row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Crear Usuario</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('users.store') }}" id="form_create_user">
                        {{ csrf_field() }}

                        @include('users._basic_fields')

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Comentarios</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="5">{{ old('comentarios') }}</textarea>
                                <p class="text-danger alertas" id="alert-comentarios"></p>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" name="password" value="{{ old('password') }}" required>
                                <p class="text-danger alertas" id="alert-password"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Confirmar contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Asignar un rol</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="role" id="role" required="">
                                    <option disabled selected value> -- Seleccionar --</option>
                                    @foreach($roles as $role)
                                        @if($role->name == 'superadmin')
                                            @if(currentUser()->isSuperadmin())
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <p class="text-danger alertas" id="alert-role"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm" type="submit">Crear usuario</button>
                            </div>
                        </div>
                    </form>
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
        ajaxform.ready('#form_create_user', {
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
                        overlay($('#table_row'));
                        window.location.href = data.redirect;
                    });
                } else {
                    alert('entraa');
                }
            },
            function_pre: function () {
                $('.alertas').text('');
            }
        });
    </script>
@endsection