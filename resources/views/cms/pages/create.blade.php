@extends('layouts.panel')

@section('title', 'Crear Página')

@section('extra_css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <form method="POST" action="{{ route('cms.page.store') }}" id="form_create_page">

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Crear Página</h5>
                </div>
                <div class="ibox-content">
                        {{ csrf_field() }}

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Título</label>

                            <div class="col-sm-10"><input type="text" class="form-control" id="titulo" name="titulo"></div>
                            <p class="text-danger alertas" id="alert-titulo"></p>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Ruta de la página</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ruta_view" id="ruta_view" disabled>
                                <input type="hidden" class="form-control" name="ruta" id="ruta">
                            </div>
                            <div class="col-sm-2 checkbox checkbox-success"><input type="checkbox" id="slug_manual"> <label for="slug_manual">Manual</label> </div>
                            <p class="text-danger alertas" id="alert-ruta"></p>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Contenido</label>
                            <div class="col-sm-10">
                                <textarea cols="100" rows="5" name="contenido" class="form-control" id="editor"></textarea>
                                <span class="form-text m-b-none">Contenido de la pagina web.</span>
                                <p class="text-danger alertas" id="alert-contenido"></p>

                            </div>

                        </div>


                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h4>Configuración</h4>
                </div>
                <div class="ibox-content">
                Publicado: <select class="form-control" name="status">
                        <option value="1">Publicado</option>
                        <option value="2">Sin Publicar</option>
                    </select>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                            <button class="btn btn-primary btn-block" type="submit">Crear pagina</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>
    @include('cms.media.media-modal')

@endsection

@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>

        function string_to_slug (str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }

        var mediabutton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="fa fa-child"/> Media',
                tooltip: 'Insertar Imagen',
                click: function () {
                    $('#media-modal').modal('show');
                    load_files();
                }
            });

            return button.render();
        };

        $(document).ready(function(){

            $('#editor').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height', 'codeview', 'mediacustom']]
                ],

                buttons: {
                    mediacustom: mediabutton
                }
            });


            function is_manual() {
                if($('#slug_manual').is(':checked')) {
                    return true;
                }
                return false;
            }

            $('#ruta_view').keyup(function () {
                $('#ruta').val($(this).val())
            });

            $('#ruta_view').keydown(function () {
                $('#ruta').val($(this).val())
            });


            $('#titulo').keyup(function() {
                if(!is_manual()) {
                    $('#ruta').val(string_to_slug($(this).val()));
                    $('#ruta_view').val(string_to_slug($(this).val()));
                }
            });
            $('#titulo').keydown(function() {
                if(!is_manual()) {
                    $('#ruta').val(string_to_slug($(this).val()));
                    $('#ruta_view').val(string_to_slug($(this).val()));
                }
            });

            $('#slug_manual').click(function() {
                if(is_manual()) {
                    $('#ruta_view').attr('disabled', false);
                }
                else {
                    $('#ruta_view').attr('disabled', true);
                    $('#ruta').val(string_to_slug($('#titulo').val()));
                    $('#ruta_view').val(string_to_slug($('#titulo').val()));
                }
            });

        });

        function insert_media(url) {
            $('#editor').summernote('insertImage', url);
            $('#media-modal').modal('hide');
        }


    </script>




    @include('fragments.ajaxformv3')
    <script>
        ajaxform.ready('#form_create_page', {
            function_error: function(data, context) {
                $.each(data.errors, function(key, value) {
                    $('#alert-'+key).text(value);
                });
                if($('#slug_manual').is(':checked'))  {
                    context.disabled(false);
                }
                else {
                    context.disabled(false, ['ruta_view']);
                }
                return true;
            },
            function_success: function(data, context) {
                if(data.status === true) {
                    window.location.href = data.redirect;
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
    <script src="{{ Url('js/plugins/dropzone/dropzone.js') }}"></script>

    <script>
        Dropzone.options.dropzoneForm = {
            /*paramName: "file", // The name that will be used to transfer the file*/
            renameFilename: function (filename) {
                return filename.toLowerCase();
            },
            dictDefaultMessage: "<strong>Arrastre aquí sus imágenes para subir. </strong>",
            acceptedFiles: "image/*"
        };

        $('#dropzoneForm').on("sending", function(file, xhr, formData) {
            console.log('entra');
            // Will send the filesize along with the file as POST data.
            formData.append("fileName", "myName");
        });
    </script>
@endsection