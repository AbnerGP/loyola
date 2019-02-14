@extends('layouts.panel')

@section('title')
    Migración
@endsection

@section('var_content')
    <input type="button" id="migrate_all_files" value="Migrar todo" class="btn btn-primary" onclick="migrate_all()">
    <span style="font-weight: bold" id="migrate_count"></span> <span style="display: none; font-weight: bold; padding-left: 5px" id="migrate_status">Completas: <span id="migrate_status_success" style="color:green">0</span> Error <span id="migrate_status_error" style="color: red">0</span> - Registros: <span id="migrate_status_records"></span></span></span>
    <br><br>
    <div class="ibox">
        <div class="ibox-title">Lista de archivos</div>
        <div class="ibox-content">
            <table class="table table-hover">
                <thead class="success">
                <tr class="success">
                    <td>Nombre del archivo</td>
                    <td>Funcion</td>
                    <td>Resultado</td>
                    <td>Accion</td>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr id="table_{{ $item->name }}" class="">
                        <td>{{ $item->file }}</td>
                        <td>{{ $item->funcion }}</td>
                        <td><span style="" id="table_result_{{ $item->name }}"></span></td>
                        <td>
                            <form action="{{ route('migracion.ready', ['file' => $item->file]) }}" method="post"  id="migrate_{{ $item->name }}" style="float: left; padding-right: 5px">
                                <input type="hidden" name="file" value="{{ $item->file }}">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Migrar</button>
                            </form>

                            <a class="btn btn-success" target="_blank" href="{{ route('migracion.view', ['file' => $item->file]) }}">Revisar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('extra_js')
    <script type="text/javascript" src="http://creativecouple.github.com/jquery-timing/jquery-timing.min.js"></script>


    <script>

        var success = 0;
        var failed = 0;
        var total_records = 0;

        function view_status(context) {
            $('#migrate_status').show();
            $('#migrate_status_success').text(success);
            $('#migrate_status_error').text(failed);
            $('#migrate_status_records').text(total_records);
        }

        @php
        $data = collect($items)->pluck('name');
        @endphp
        function migrate_all() {
            $('#migrate_all_files').attr('disabled', true);
            data = {!! $data !!};
            var actual = 0;
            var time = 0
            $.each(data, function(key, value) {
                setTimeout(function() {
                    $('#migrate_'+value).submit();
                    actual += 1;
                    $('#migrate_count').text('Migración enviada: '+actual+'/'+data.length);
                }, time)
                time += 1000;
            });
        }
    </script>

    @include('fragments.ajaxform')
    <script>

        @foreach($items as $item)
            ajaxform.ready('#migrate_{{ $item->name }}', {
                function_pre: function(context) {
                    $('#'+context.form_id+' button').attr('disabled', true);
                    return true;
                },
                function_success: function(response, context) {
                    if(response.status === true) {
                        $('#table_{{ $item->name }}').addClass('table-success');
                        $('#table_result_{{ $item->name }}').text('Records: '+response.records+ ' Cols:'+response.lines);
                        success += 1;
                        total_records += response.records;
                        context.opt.view_status_function(context);
                    }
                    return true;
                },
                function_error: function(response, context) {
                    failed += 1;
                    context.opt.view_status_function(context);
                    $('#table_{{ $item->name }}').addClass('table-danger');
                    return true;
                },
                view_status_function: view_status,
        });
        @endforeach

    </script>
@endsection