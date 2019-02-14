@extends('layouts.panel')

@section('title', 'Consultar Libro')

@section('extra_css')
    <link href="{{ asset('css/plugins/jsTree/style.min.css') }}" rel="stylesheet">
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Consultar Libro</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group  row"><label class="col-sm-2 col-form-label font-bold">Nombre</label>

                        <div class="col-sm-10">
                            <p>{{ $libro->nombre }}</p>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label font-bold">Descripción</label>

                        <div class="col-sm-10">
                            <p>{{ $libro->descripcion }}</p>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-md-4">
                            <p class="font-bold">
                                Palabras clave
                            </p>

                            <div>
                                <p>{{ $libro->keywords }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Autor
                            </p>
                            <div>
                                <p>{{ $libro->autor }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Número de edición
                            </p>
                            <div>
                                <p>{{ $libro->num_edicion }}</p>
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
                                <p>{{ $libro->lugar_edicion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Colección
                            </p>
                            <div>
                                <p>{{ $libro->coleccion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Editorial
                            </p>
                            <div>
                                <p>{{ $libro->editorial }}</p>
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
                                <p>{{ $libro->num_libro }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Año
                            </p>
                            <div>
                                <p>{{ $libro->year }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="font-bold">
                                Tema
                            </p>
                            <div>
                                <p>{{ $libro->tema }}</p>
                            </div>
                        </div>
                    </div>

                    {{--<div class="hr-line-dashed"></div>
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
                    </div>--}}


                    @can('view', App\Models\Libro::class)
                        <div class="hr-line-dashed"></div>
                        <div class="float-right">
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a href="{{ route('libros.edit', $libro) }}" class="btn btn-primary btn-sm">Editar</a>
                                </div>
                            </div>
                        </div>
                    @endcan

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Archivos subidos.</h5>
                        </div>
                        <div class="ibox-content">


                            <div id="jstree1">
                                <ul>
                                    <li class="jstree-open">Archivos
                                        <ul>
                                            @if($items != '')
                                                {!! $items !!}
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>

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
    <script src="{{ asset('js/plugins/jsTree/jstree.min.js') }}"></script>

    <style>
        .jstree-open > .jstree-anchor > .fa-folder:before {
            content: "\f07c";
        }

        .jstree-default .jstree-icon.none {
            width: 0;
        }
    </style>

    <script>
        $(document).ready(function(){

            $('#jstree1').jstree({
                'core' : {
                    'check_callback' : true
                },
                'plugins' : [ 'types', 'dnd' ],
                'types' : {
                    'default' : {
                        'icon' : 'fa fa-folder'
                    },
                    'html' : {
                        'icon' : 'fa fa-file-code-o'
                    },
                    'svg' : {
                        'icon' : 'fa fa-file-picture-o'
                    },
                    'css' : {
                        'icon' : 'fa fa-file-code-o'
                    },
                    'img' : {
                        'icon' : 'fa fa-file-image-o'
                    },
                    'js' : {
                        'icon' : 'fa fa-file-text-o'
                    }

                }
            });
        });

        function descargarPdf(url){
            var a = document.createElement('A');
            a.href = url;
            a.download = url.substr(url.lastIndexOf('/') + 1);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
@endsection