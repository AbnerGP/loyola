@extends('layouts.panel')

@section('title', 'Crear Categoría')

@section('extra_css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('var_content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Crear Categoría</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('categorias.store') }}" id="form_create_categoria">
                        {{ csrf_field() }}

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Descripción</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">

                                @if($errors->has('descripcion'))
                                    <p>{{ $errors->first('descripcion') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-descripcion"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Asignar un usuario</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="user_id" id="user_id" required="">
                                    <option disabled selected value> -- Seleccionar --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('user_id'))
                                    <p>{{ $errors->first('user_id') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-user_id"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Status</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="status" id="status" value="{{ old('status') }}">

                                @if($errors->has('status'))
                                    <p>{{ $errors->first('status') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-status"></p>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm" type="submit">Crear categoría</button>
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
        ajaxform.ready('#form_create_categoria', {
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
@endsection