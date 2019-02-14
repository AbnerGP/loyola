@extends('layouts.panel')

@section('title', 'Crear Usuario')

@section('extra_css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('var_content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Crear Usuario</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('usuarios.store') }}" id="form_create_user">
                        {{ csrf_field() }}


                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">

                                @if($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-name"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Nombre de usuario</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">

                                @if($errors->has('username'))
                                    <p>{{ $errors->first('username') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-username"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Correo electrónico</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">

                                @if($errors->has('email'))
                                    <p>{{ $errors->first('email') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-email"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Comentarios</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="5">{{ old('comentarios') }}</textarea>

                                @if($errors->has('comentarios'))
                                    <p>{{ $errors->first('comentarios') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-comentarios"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" name="password" value="{{ old('password') }}" required>

                                @if($errors->has('password'))
                                    <p>{{ $errors->first('password') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-password"></p>
                            </div>
                        </div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Confirmar contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Asignar un rol</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="role" id="role" required="">
                                    <option disabled selected value> -- Seleccionar --</option>
                                    @foreach($roles as $role)
                                        @if($role->name == 'superadmin')
                                            @if(auth()->user()->isSuperadmin())
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if($errors->has('role'))
                                    <p>{{ $errors->first('role') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-role"></p>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
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
    @include('fragments.ajaxform')
    <script>
        ajaxform.ready('#form_create_user', {
            function_error: function(data, context) {
                $('.alertas').text('');
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