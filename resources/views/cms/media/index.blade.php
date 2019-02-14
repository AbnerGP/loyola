@extends('layouts.panel')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Media')

@section('extra_css')
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">

    <style>
        /* property images */
        #links {
            z-index:10;
        }

        #links .property-image {
            display:block;
            width: 110px;
            height:130px;
            float:left;
            position:relative;
            margin-bottom:15px;
            margin-right:15px;
        }

        #links .property-image a.image {
            display:block;
            width: 110px;
            height:130px;
            background-color:#cccccc;
            float:left;
            text-align:center;
        }

        #links .property-image a.btn {
            display:block;
            width:110px;
            background-color:#d2322d;
            position:absolute;
            bottom:0;
            text-align:center;
            font-family: "proxima-nova";
            font-size: 0.688em;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            margin-top:2px;
            padding: 6px 0px;
            z-index:1000;
        }
    </style>
@endsection

@section('var_content')
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif


                <h2>Media - Galería</h2>

                <div class="lightBoxGallery" id="links">
                    @foreach($images as $image)
                        <div class="property-image">
                            <a class="image" href="/{{ $image->ruta }}" data-gallery="" title="{{ $image->ruta }}">
                                <img src="/{{ $image->ruta }}" width="100" height="100">
                            </a>
                            <a class="btn btn-danger delete-confirm-ajax" data-ajax="true" data-id="{{ $image->id }}" href="#">Borrar</a>
                        </div>
                    @endforeach

                    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                    <div id="blueimp-gallery" class="blueimp-gallery">
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev">‹</a>
                        <a class="next">›</a>
                        <a class="close">×</a>
                        <a class="play-pause"></a>
                        <ol class="indicator"></ol>
                    </div>

                </div>

            </div>

        </div>
@endsection

@section('extra_js')
    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- blueimp gallery -->
    <script src="{{ asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#links a.image').on('click', function(event){
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target.parentNode,
                    options = { index: link, event: event },
                    links = $(this);
                blueimp.Gallery(links, options);
            });

            $('#links a.delete-confirm-ajax').on('click',function(){
                var id = $(this).attr('data-id');
                console.log(id);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "DELETE",
                    url: 'media/' + id,
                    success:function(data){
                        location.reload();
                    },
                    error:function(data, context){
                        console.log('falla');
                    }
                });
            });


        });
    </script>

    @include('fragments.ajaxform')
    <script>
        ajaxform.ready('#form_delete_role', {
            function_pre: function(data, context) {
                alert('entra');
                $('.delete-button').click(function () {
                    swal({
                        title: "¿Estás seguro?",
                        text: "Este rol se eliminará permanentemente.",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sí. Eliminar.",
                        closeOnConfirm: false
                    }, function () {
                        swal("Eliminado", "El rol ha sido eliminado.", "success");
                    });
                });
            },
            function_error: function(data, context) {
                var message = 'Errores: \n';
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
            }
        });
    </script>
@endsection