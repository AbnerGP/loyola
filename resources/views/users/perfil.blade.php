@extends('layouts.panel')

@section('title', 'Modificar perfil')

@section('extra_css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('var_content')

    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Modificar perfil</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('perfil.update', $user) }}" id="form_update_user">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">

                                @if($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-name"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Nombre de usuario</label>
                            <div class="col-sm-10">
                                {{ $user->username }}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Correo electrónico</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">

                                @if($errors->has('email'))
                                    <p>{{ $errors->first('email') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-email"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Nueva contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" id="new_password" name="password" value="{{ old('password') }}">

                                @if($errors->has('new_password'))
                                    <p>{{ $errors->first('new_password') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-new_password"></p>
                            </div>
                        </div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Confirmar nueva contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Contraseña actual para efectuar cambios</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" name="password" value="{{ old('password') }}" >

                                @if($errors->has('password'))
                                    <p>{{ $errors->first('password') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-password"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
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
    @include('fragments.ajaxform')
    <script>
        ajaxform.ready('#form_update_user', {
            function_error: function(data, context) {
                $('.alertas').text('');
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    location.reload();
                } else {
                    alert('entraa');
                }
            },
            function_pre: function () {
                $('.alertas').text('');
            }
        });
    </script>
    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection