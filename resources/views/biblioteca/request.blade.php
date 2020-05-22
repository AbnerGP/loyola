@extends('biblioteca.layout')

@section('title', 'Inicio')

@section('css')
    <style>
        select option {
            color: black !important;
        }
    </style>
@endsection
@section('content')
    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb" style="background-image: url(images/instalaciones/n8.jpg);" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 py-5 px-md-5 bg-dark">
                    <div class="heading-section heading-section-white ftco-animate mb-5">
                        <h2 class="mb-4">Solicitud de inscripción</h2>
                        <p class="text-center">Ciclo Escolar 2020 - 2021</p>
                        <p>Por favor, llene los campos solicitados.</p>
                    </div>
                    <form action="{{ route('request.store') }}" class="appointment-form ftco-animate" id="form" method="POST">
                        {{ csrf_field() }}
                        <h5 class="text-white text-center">DATOS DEL ALUMNO</h5>
                        <div class="d-md-flex text-center">
                            <div class="form-control">
                                <input class="form-check-input" type="radio" name="type" id="t_inscription" value="1">
                                <label class="form-check-label" for="t_inscription">
                                    Inscripción
                                </label>
                                <small id="alert-type" class="text-danger alertas"></small>
                            </div>
                            <div class="form-control">
                                <input class="form-check-input" type="radio" name="type" id="t_reinscription" value="2">
                                <label class="form-check-label" for="t_reinscription">
                                    Renscripción
                                </label>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <select name="level" id="level" class="form-control">
                                    <option value="">Seleccione nivel educativo</option>
                                    {!! $levels !!}
                                </select>
                                <small id="alert-level" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del alumno" value="{{ old('name') }}">
                                <small id="alert-name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellido paterno" value="{{ old('last_name') }}">
                                <small id="alert-last_name" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="mat_last_name" id="mat_last_name" class="form-control" placeholder="Apellido materno" value="{{ old('mat_last_name') }}">
                                <small id="alert-mat_last_name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="curp" id="curp" class="form-control" placeholder="CURP" value="{{ old('curp') }}">
                                <small id="alert-curp" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="grade" id="grade" class="form-control" placeholder="Grado y grupo" value="{{ old('grade') }}">
                                <small id="alert-grade" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="sanguine" id="sanguine" class="form-control" placeholder="Grupo sanguíneo" value="{{ old('sanguine') }}">
                                <small id="alert-sanguine" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="place_birth" id="place_birth" class="form-control" placeholder="Lugar de nacimiento" value="{{ old('place_birth') }}">
                                <small id="alert-place_birth" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <label for="birthday" class="text-white">Fecha de nacimiento:</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" value="{{ old('birthday') }}">
                                <small id="alert-birthday" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="age" id="age" class="form-control" placeholder="Edad" value="{{ old('age') }}">
                                <small id="alert-age" class="text-danger alertas"></small>
                            </div>
                        </div>

                        <h5 class="text-white text-center">Domicilio</h5>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="street" id="street" class="form-control" placeholder="Calle" value="{{ old('street') }}">
                                <small id="alert-street" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="number" id="number" class="form-control" placeholder="Número" value="{{ old('number') }}">
                                <small id="alert-number" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="colony" id="colony" class="form-control" placeholder="Colonia" value="{{ old('colony') }}">
                                <small id="alert-colony" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="town" id="town" class="form-control" placeholder="Municipio" value="{{ old('town') }}">
                                <small id="alert-town" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Código postal" value="{{ old('zip_code') }}">
                                <small id="alert-zip_code" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="origin_school" id="origin_school" class="form-control" placeholder="Escuela de procedencia" value="{{ old('origin_school') }}">
                                <small id="alert-origin_school" class="text-danger alertas"></small>
                            </div>
                        </div>


                        <h5 class="text-white text-center">DATOS DE LOS PADRES</h5>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="f_name" id="f_name" class="form-control" placeholder="Nombre del padre" value="{{ old('f_name') }}">
                                <small id="alert-f_name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="f_last_name" id="f_last_name" class="form-control" placeholder="Apellido paterno" value="{{ old('f_last_name') }}">
                                <small id="alert-f_last_name" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="f_mat_last_name" id="f_mat_last_name" class="form-control" placeholder="Apellido materno" value="{{ old('f_mat_last_name') }}">
                                <small id="alert-f_mat_last_name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="f_company" id="f_company" class="form-control" placeholder="Empresa donde labora" value="{{ old('f_company') }}">
                                <small id="alert-f_company" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="f_position" id="f_position" class="form-control" placeholder="Cargo" value="{{ old('f_position') }}">
                                <small id="alert-f_position" class="text-danger alertas"></small>
                            </div>
                        </div>

                        <h5 class="text-white text-center">Teléfonos del padre</h5>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="f_office_phone" id="f_office_phone" class="form-control" placeholder="Oficina" value="{{ old('f_office_phone') }}">
                                <small id="alert-f_office_phone" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="f_home_phone" id="f_home_phone" class="form-control" placeholder="Casa" value="{{ old('f_home_phone') }}">
                                <small id="alert-f_home_phone" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="f_cellphone" id="f_cellphone" class="form-control" placeholder="Celular" value="{{ old('f_cellphone') }}">
                                <small id="alert-f_cellphone" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="f_email" id="f_email" class="form-control" placeholder="Correo electrónico" value="{{ old('f_email') }}">
                                <small id="alert-f_email" class="text-danger alertas"></small>
                            </div>
                        </div>

                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="m_name" id="m_name" class="form-control" placeholder="Nombre de la madre" value="{{ old('m_name') }}">
                                <small id="alert-m_name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="m_last_name" id="m_last_name" class="form-control" placeholder="Apellido paterno" value="{{ old('m_last_name') }}">
                                <small id="alert-m_last_name" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="m_mat_last_name" id="m_mat_last_name" class="form-control" placeholder="Apellido materno" value="{{ old('m_mat_last_name') }}">
                                <small id="alert-m_mat_last_name" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="m_company" id="m_company" class="form-control" placeholder="Empresa donde labora" value="{{ old('m_company') }}">
                                <small id="alert-m_company" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="m_position" id="m_position" class="form-control" placeholder="Cargo" value="{{ old('m_position') }}">
                                <small id="alert-m_position" class="text-danger alertas"></small>
                            </div>
                        </div>

                        <h5 class="text-white text-center">Teléfonos de la madre</h5>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="m_office_phone" id="m_office_phone" class="form-control" placeholder="Oficina" value="{{ old('m_office_phone') }}">
                                <small id="alert-m_office_phone" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="m_home_phone" id="m_home_phone" class="form-control" placeholder="Casa" value="{{ old('m_home_phone') }}">
                                <small id="alert-m_home_phone" class="text-danger alertas"></small>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="m_cellphone" id="m_cellphone" class="form-control" placeholder="Celular" value="{{ old('m_cellphone') }}">
                                <small id="alert-m_cellphone" class="text-danger alertas"></small>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="m_email" id="m_email" class="form-control" placeholder="Correo electrónico" value="{{ old('m_email') }}">
                                <small id="alert-m_email" class="text-danger alertas"></small>
                            </div>
                        </div>







                        <div class="d-md-flex">
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="Observaciones de salud, legales y otras que debamos tener conocimiento con relación a su hijo (a)"></textarea>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group ml-md-4">
                                <input type="submit" value="Enviar solicitud" class="btn btn-secondary py-3 px-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @include('fragments.ajaxformv4')

    <script type="text/javascript">
        var content = '#form';

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