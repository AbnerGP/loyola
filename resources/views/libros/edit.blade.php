@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Editar Libro')

@section('extra_css')
    <link href="{{ asset('css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Editar Libro</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('libros.update', $libro) }}" id="form_update_libro">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group  row"><label class="col-sm-2 col-form-label font-bold">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $libro->nombre) }}">

                                @if($errors->has('nombre'))
                                    <p>{{ $errors->first('nombre') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-nombre"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label font-bold">Descripción</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="5">{{ old('descripcion', $libro->descripcion) }}</textarea>
                                {{--<input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ old('descripcion', $libro->descripcion) }}">--}}

                                @if($errors->has('descripcion'))
                                    <p>{{ $errors->first('descripcion') }}</p>
                                @endif
                                <p class="text-danger alertas" id="alert-descripcion"></p>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Palabras clave
                                </p>

                                <div>
                                    <input type="text" class="form-control" name="keywords" id="keywords" value="{{ old('keywords', $libro->keywords) }}">

                                    @if($errors->has('keywords'))
                                        <p>{{ $errors->first('keywords') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-keywords"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="font-bold">
                                    Autor
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="autor" id="autor" value="{{ old('autor', $libro->autor) }}">

                                    @if($errors->has('autor'))
                                        <p>{{ $errors->first('autor') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-autor"></p>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Número de edición
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="num_edicion" id="num_edicion" value="{{ old('num_edicion', $libro->num_edicion) }}">

                                    @if($errors->has('num_edicion'))
                                        <p>{{ $errors->first('num_edicion') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-num_edicion"></p>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Lugar de edición
                                </p>

                                <div>
                                    <input type="text" class="form-control" name="lugar_edicion" id="lugar_edicion" value="{{ old('lugar_edicion', $libro->lugar_edicion) }}">

                                    @if($errors->has('lugar_edicion'))
                                        <p>{{ $errors->first('lugar_edicion') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-lugar_edicion"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="font-bold">
                                    Colección
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="coleccion" id="coleccion" value="{{ old('coleccion', $libro->coleccion) }}">

                                    @if($errors->has('coleccion'))
                                        <p>{{ $errors->first('coleccion') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-coleccion"></p>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Editorial
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="editorial" id="editorial" value="{{ old('editorial', $libro->editorial) }}">

                                    @if($errors->has('editorial'))
                                        <p>{{ $errors->first('editorial') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-editorial"></p>
                                </div>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Número de libro
                                </p>

                                <div>
                                    <input type="text" class="form-control" name="num_libro" id="num_libro" value="{{ old('num_libro', $libro->num_libro) }}">

                                    @if($errors->has('num_libro'))
                                        <p>{{ $errors->first('num_libro') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-num_libro"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="font-bold">
                                    Año
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="year" id="year" value="{{ old('year', $libro->year) }}">

                                    @if($errors->has('year'))
                                        <p>{{ $errors->first('year') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-year"></p>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <p class="font-bold">
                                    Tema
                                </p>
                                <div>
                                    <input type="text" class="form-control" name="tema" id="tema" value="{{ old('tema', $libro->tema) }}">

                                    @if($errors->has('tema'))
                                        <p>{{ $errors->first('tema') }}</p>
                                    @endif
                                    <p class="text-danger alertas" id="alert-tema"></p>
                                </div>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="font-bold">
                                    ¿Multipágina?
                                </p>

                                <div>
                                    <div class="">
                                        <label> <input class="icheckbox_square-green" type="checkbox" id="multipagina" value="activo"> <i></i> Activar </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="div_num_pag">
                                <p class="font-bold">
                                    Digite el número de páginas por archivo
                                </p>
                                <div>
                                    <input type="number" id="num_pag" value="" onchange="update_numpages(this.value)">
                                </div>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Añadir valores</label>

                            <div class="col-sm-10">
                                <a href="javascript:" onclick="add_keypair();">Añadir nuevo Key/Value</a>
                                <div id="keypair">
                                    @php
                                    $iniciar = 1;
                                    @endphp
                                    @foreach($libro->getAllMeta() as $key => $value)
                                            <div class="row" style="padding-bottom: 5px" id="keypair_{{ $iniciar }}">
                                            <div class="col-md-6"><input name="clave[]" type="text" class="form-control" placeholder="Clave" value="{{ $key }}"></div>
                                            <div class="col-md-5"><input name="valor[]" type="text" class="form-control" placeholder="Valor" value="{{ $value }}"></div>
                                            <div class="col-md-1"><a href="javascript:" onclick="del_keypair('+keyvalue_id+')">Eliminar</a></div>
                                            </div>
                                        @php
                                        $iniciar++;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="float-right">
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit" id="sb_libro">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row"></div>
                    <div class="form-group row"></div>
                    <div class="form-group row"></div>
                    <div id="carga_archivos">
                        <div class="ibox-content">
                            <form action="subir_archivos" class="dropzone" id="dropzoneForm">
                                {{ csrf_field() }}
                                <input type="hidden" id="id" name="id" value="{{ $libro->id }}">
                                <input type="hidden" id="dividir" name="dividir" value="">
                                <div class="fallback">

                                    <input name="file" type="file" id="file" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <input type="button" class="btn btn-primary" value="Terminar" onclick="location.href='{{ route('libros.view') }}'">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    @include('fragments.ajaxform')
    <script>
        ajaxform.ready('#form_update_libro', {
            function_error: function(data, context) {
                $('.alertas').text('');
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
            },
            function_success: function(data, context) {
                if(data.status == 'ok') {
                    //$('#id').val(data.id);
                    //$('#form_update_libro input,textarea,select,button').attr('disabled', true);
                } else {
                    alert('entraa');
                }
            },
            function_pre: function () {
                $('.alertas').text('');
            }
        });


        var keyvalue_id = {{ $iniciar }};

        function add_keypair() {
            keypair = '<div class="row" style="padding-bottom: 5px" id="keypair_'+keyvalue_id+'">';
            keypair += '<div class="col-md-6"><input name="clave[]" type="text" class="form-control" placeholder="Clave"></div>';
            keypair += '<div class="col-md-5"><input name="valor[]" type="text" class="form-control" placeholder="Valor"></div>';
            keypair += '<div class="col-md-1"><a href="javascript:" onclick="del_keypair('+keyvalue_id+')">Eliminar</a></div>';
            keypair += '</div>';
            keyvalue_id++;
            $('#keypair').append(keypair);
        }

        function del_keypair(id) {
            $('#keypair_'+id).remove();
        }

        $('#div_num_pag').hide();
        $('#num_pag').attr('disabled', true);
        $('#dividir').attr('disabled', true);

    </script>

    <!-- DROPZONE -->
    <script src="{{ asset('js/plugins/dropzone/dropzone.js') }}"></script>

    <script>
        Dropzone.options.dropzoneForm = {
            init: function() {
                $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');
                this.on("addedfile", function(file) {
                    console.log('test');

                    // Create the remove button
                    var removeButton = Dropzone.createElement("<a class='btn btn-danger dz-remove' style='color: white'><span class='fa fa-trash'></span> Eliminar</button></a>");

                    // Capture the Dropzone instance as closure.
                    var _this = this;

                    // Listen to the click event
                    removeButton.addEventListener("click", function(e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);

                        if(file.status == 'success'){
                            var respuesta = jQuery.parseJSON(file.xhr.response);
                            if(respuesta.success){
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    method: "PUT",
                                    url: '/libros/archivos/'+ respuesta.id,
                                    data: {
                                        path: respuesta.path,
                                        archivo: respuesta.archivo,
                                    },
                                    beforeSend:function(data){
                                        $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');
                                    },
                                    success:function(data){
                                        $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');
                                        toastr.success('Archivo(s) eliminado(s) con éxito.','Hecho');
                                    },
                                    error:function(data, context){
                                        toastr.error('Hubo un problema al intentar eliminar el archivo.','Error');
                                    }
                                });
                            }
                        }

                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.

                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });

                var thisDropzone = this;

                $.getJSON('archivos/{{ $libro->id }}', function(data) { // get the json response

                    $.each(data, function(key,value){ //loop through it

                        var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response

                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.emit('complete', mockFile);

                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a class='btn btn-danger dz-remove' style='color: white'><span class='fa fa-trash'></span> Eliminar</button></a>");

                        // Capture the Dropzone instance as closure.
                        var _this = thisDropzone;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            _this.removeFile(mockFile);


                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "PUT",
                                url: '/admin/libros/archivos/{{ $libro->id }}',
                                data: {
                                    path: 'uploads/libros/{{ $libro->id }}/',
                                    archivo: mockFile.name,
                                },
                                beforeSend:function(data){
                                    $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');
                                },
                                success:function(data){
                                    $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');
                                    toastr.success('Archivo(s) eliminado(s) con éxito.','Hecho');
                                },
                                error:function(data, context){
                                    toastr.error('Hubo un problema al intentar eliminar el archivo.','Error');
                                }
                            });
                        });

                        // Add the button to the file preview element.
                        mockFile.previewElement.appendChild(removeButton);

                        //thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "uploadsfolder/"+value.name);//uploadsfolder is the folder where you have all those uploaded files

                    });

                    $('#carga_archivos').children('.ibox-content').toggleClass('sk-loading');

                });
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 30, // MB
            dictDefaultMessage: "<strong>Coloque los archivos aquí o haga clic para subir. </strong></br> (Máximo 5 MB)",
            acceptedFiles: 'application/pdf',

        };
    </script>

    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        /*$(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });*/

        $('#multipagina').click( function(){
            if( $(this).is(':checked') ) {
                $('#div_num_pag').show();
                $('#num_pag').attr('disabled', false);
                $('#dividir').attr('disabled', false);
            }else {
                $('#div_num_pag').hide();
                $('#num_pag').attr('disabled', true);
                $('#dividir').attr('disabled', true);
            }
        });

        function update_numpages(val) {
            $('#dividir').val(val);
        }
    </script>
@endsection