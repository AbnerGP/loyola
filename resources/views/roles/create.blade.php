@extends('layouts.panel')

@section('title', 'Crear Rol')

@section('extra_css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('var_content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Crear Rol</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('roles.store') }}" id="form_create_role">
                        {{ csrf_field() }}


                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                                <p class="text-danger" id="alert-name"></p>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Título</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                @if($errors->has('title'))
                                    <p>{{ $errors->first('title') }}</p>
                                @endif
                                <p class="text-danger" id="alert-title"></p>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" cols="100" rows="5" name="description"></textarea>
                                <span class="form-text m-b-none">Breve descripción del propósito del rol.</span>
                            </div>
                        </div>

                        @if(count($modelPermisos) > 0)
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Permisos por modelo<br/>
                                    <small class="text-navy"><small class="text-navy">Seleccione los permisos por modelo que tendrá el rol</small></label></small></label>

                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        @foreach($modelPermisos as $mp)
                                            <?php $i = 0; ?>

                                            <div class="row">
                                                @foreach($mp['permisos'] as $permiso)
                                                    <div class="col"><label> <input type="checkbox" name="permisos[]" value="{{ $mp['model'].'/'.$permiso }}"> <i></i> {{ $mp['model'] }} {{ $permiso }} </label></div>
                                                    <?php $i++; ?>
                                                @endforeach
                                                <?php while($i < 4){ ?>
                                                    <div class="col"></div>

                                                <?php $i++; } ?>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(count($funciones) > 0)
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Permisos por funciones<br/>
                                    <small class="text-navy"><small class="text-navy">Seleccione los permisos por funciones que tendrá el rol</small></label></small></label>

                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <?php $i = 0; ?>
                                        <div class="row"></div>
                                            @foreach($funciones as $funcion)
                                                <?php if($i%4 == 0){ ?>
                                                    <?php if($i > 0){ ?>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                <?php } ?>
                                                    <div class="col"><label> <input type="checkbox" name="funciones[]" value="{{ $funcion }}"> <i></i> {{ $funcion }} </label></div>
                                                <?php $i++;?>
                                            @endforeach
                                                    <?php while($i%4 != 0){ ?>
                                                    <div class="col"></div>

                                                    <?php $i++; } ?>
                                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                                <button class="btn btn-primary btn-sm" type="submit">Crear rol</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    @include('fragments.ajaxformv2')
    <script>
        ajaxform.ready('#form_create_role', {
            function_error: function(data, context) {
                var message = 'Errores: \n';
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
                context.disabled(context, false);
                return true;
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    window.location.href = data.redirect;
                } else {
                    alert('entraa');
                }
                return true;
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