<link href="{{ Url('css/plugins/dropzone/basic.css') }}" rel="stylesheet">
<link href="{{ Url('css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

<div class="modal inmodal fade" id="media-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">MediaController</h3>
            </div>
            <div class="modal-body" id="media-content">


                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active show" data-toggle="tab" href="#tab-1" onclick="load_files()"> Media en servidor</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-2">Subir nuevo</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-1" class="tab-pane active show">
                            <div class="panel-body" style="overflow: auto; height: 350px">
                                <div id="media_content">

                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <form action="{{ route('cms.media.store') }}" class="dropzone" id="dropzoneForm">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                    {{ csrf_field() }}
                                </form>

                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">

    function load_page(page) {
        $('#media_content').html('<h3>Cargando...<h3>');
        $.get('{{ route('cms.media.view-ajax') }}', { page: page }, function (data) {
            $('#media_content').html(data);
        });
    }

    function load_files() {
        load_page(1);
    }


</script>
