@extends('layouts.panel')

@section('title', 'Modificar perfil')

@section('extra_css')
    <!-- Sweet Alert -->
    <link href="{{ templateRoute('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row" id="table_row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Modificar perfil</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('profile.update', $user) }}" id="form_update_user">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        @include('users._basic_fields')

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nueva contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" id="new_password" name="password" value="{{ old('password') }}">
                                <p class="text-danger alertas" id="alert-new_password"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Confirmar nueva contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Contraseña actual para efectuar cambios</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" name="password" value="{{ old('password') }}" >
                                <p class="text-danger alertas" id="alert-password"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm" type="submit">Modificar</button>
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
    <script src="{{ templateRoute('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @include('fragments.ajaxformv4')
    <script>
        ajaxform.ready('#form_update_user', {
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
    </script>
@endsection