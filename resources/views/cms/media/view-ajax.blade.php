<div style="align-items: center; justify-content: center; display: flex">
    {{ $files->links('cms.media.paginate-ajax') }}
</div>
@if(count($files) == 0)
    No hay medios.
@endif
@foreach($files as $media)
    <a href="javascript: insert_media('{{ url($media->ruta) }}')"><img src="{{ url($media->ruta) }}" width="100px"></a>
@endforeach

