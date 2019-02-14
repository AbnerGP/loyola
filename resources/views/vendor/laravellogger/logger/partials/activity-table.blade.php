@php

$drilldownStatus = config('LaravelLogger.enableDrillDown');
$prependUrl = '/activity/log/';

if (isset($hoverable) && $hoverable === true) {
    $hoverable = true;
} else {
    $hoverable = false;
}

if (Request::is('activity/cleared')) {
    $prependUrl = '/activity/cleared/log/';
}

@endphp

@section('extra_css')
    <!-- FooTable -->
    <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

@section('extra_js')
    <!-- FooTable -->
    <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ asset('js/plugins/fullcalendar/moment.min.js') }}"></script>

    <!-- Date range picker -->
    <script src="{{ asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable({paginate:false});
            $('.footable2').footable();

        });

    </script>
    <script>
        $('#confirmdanger').click(function () {
            if($('#formClear').length > 0)
                $('#formClear').submit();

            if($('#formDelete').length > 0)
                $('#formDelete').submit();
        });

        $('#confirmsuccess').click(function () {
            $('#formRestore').submit();
        });


        $('input[name="daterange"]').daterangepicker();
    </script>


@endsection

<div class="table-responsive activity-table">
    <table class="footable table table-stripped toggle-arrow-tiny">
        <thead>
        <tr>
            <th>
                <i class="fa fa-database fa-fw" aria-hidden="true"></i>
                <span class="hidden-sm hidden-xs">
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.id') !!}
                    </span>
            </th>
            <th>
                <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
                {!! trans('LaravelLogger::laravel-logger.dashboard.labels.time') !!}
            </th>
            <th>
                <i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>
                {!! trans('LaravelLogger::laravel-logger.dashboard.labels.description') !!}
            </th>
            <th>
                <i class="fa fa-user-o fa-fw" aria-hidden="true"></i>
                {!! trans('LaravelLogger::laravel-logger.dashboard.labels.user') !!}
            </th>
            <th>
                <i class="fa fa-truck fa-fw" aria-hidden="true"></i>
                <span class="hidden-sm hidden-xs">
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.method') !!}
                    </span>
            </th>
            <th>
                <i class="fa fa-map-o fa-fw" aria-hidden="true"></i>
                {!! trans('LaravelLogger::laravel-logger.dashboard.labels.route') !!}
            </th>
            <th>
                <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                {!! trans('LaravelLogger::laravel-logger.dashboard.labels.ipAddress') !!}
            </th>
            <th>
                <i class="fa fa-laptop fa-fw" aria-hidden="true"></i>
                Clase
                {{--{!! trans('LaravelLogger::laravel-logger.dashboard.labels.agent') !!}--}}
            </th>
            <th data-hide="all">
                Datos
            </th>
            @can('restore-activity')
                <th>
                        <i class="fa fa-undo fa-fw" aria-hidden="true"></i>
                        Restablecer
                </th>
            @endcan
            @if(Request::is('activity/cleared'))
                <th>
                    <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.deleteDate') !!}
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
            {{--@if(strtolower($activity->methodType) != 'get')--}}
                <tr>
                    <td>
                        <small>
                            {{ $activity->id }}
                        </small>
                    </td>
                    <td>
                        {{ $activity->timePassed }}
                    </td>
                    <td>
                        {{ $activity->description }}
                    </td>
                    <td>
                        @php
                            switch ($activity->userType) {
                                case trans('LaravelLogger::laravel-logger.userTypes.registered'):
                                    $userTypeClass = 'success';
                                    $userLabel = $activity->userDetails['name'];
                                    break;

                                case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
                                    $userTypeClass = 'danger';
                                    $userLabel = $activity->userType;
                                    break;

                                case trans('LaravelLogger::laravel-logger.userTypes.guest'):
                                default:
                                    $userTypeClass = 'warning';
                                    $userLabel = $activity->userType;
                                    break;
                            }

                        @endphp
                        <span class="badge badge-{{$userTypeClass}}">
                                {{$userLabel}}
                            </span>
                    </td>
                    <td>
                        @php
                            switch (strtolower($activity->methodType)) {
                                case 'get':
                                    $methodText = 'Visualización';
                                    $methodClass = 'info';
                                    break;

                                case 'auth':
                                    $methodText = 'Auth';
                                    $methodClass = 'info';
                                    break;

                                case 'post':
                                    $methodText = 'Creación';
                                    $methodClass = 'success';
                                    break;

                                case 'put':
                                    $methodText = 'Modificación';
                                    $methodClass = 'warning';
                                    break;

                                case 'delete':
                                    $methodText = 'Eliminación';
                                    $methodClass = 'danger';
                                    break;

                                default:
                                    $methodText = '';
                                    $methodClass = 'info';
                                    break;
                            }

                            /*if(end($ruta) == 'login' || end($ruta) == 'logout'){
                                $methodClass = 'info';
                                $methodText = 'Auth';
                            }*/
                        @endphp
                        <span class="badge badge-{{ $methodClass }}">
                                {{ $methodText }}
                            </span>
                    </td>
                    <td class="ellipsis">
                        @if($hoverable)
                            {{ showCleanRoutUrl($activity->route) }}
                        @else
                            <a href="{{ $activity->route }}">
                                {{$activity->route}}
                            </a>
                        @endif
                    </td>
                    <td>
                        {{ $activity->ipAddress }}
                    </td>
                    <td>
                        {{ $activity->entity }}
                        {{--@php
                            $platform       = $activity->userAgentDetails['platform'];
                            $browser        = $activity->userAgentDetails['browser'];
                            $browserVersion = $activity->userAgentDetails['version'];

                            switch ($platform) {

                                case 'Windows':
                                    $platformIcon = 'fa-windows';
                                    break;

                                case 'iPad':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'iPhone':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'Macintosh':
                                    $platformIcon = 'fa-apple';
                                    break;

                                case 'Android':
                                    $platformIcon = 'fa-android';
                                    break;

                                case 'BlackBerry':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'Unix':
                                case 'Linux':
                                    $platformIcon = 'fa-linux';
                                    break;

                                default:
                                    $platformIcon = 'fa-';
                                    break;
                            }

                            switch ($browser) {

                                case 'Chrome':
                                    $browserIcon  = 'fa-chrome';
                                    break;

                                case 'Firefox':
                                    $browserIcon  = 'fa-';
                                    break;

                                case 'Opera':
                                    $browserIcon  = 'fa-opera';
                                    break;

                                case 'Safari':
                                    $browserIcon  = 'fa-safari';
                                    break;

                                case 'Internet Explorer':
                                    $browserIcon  = 'fa-edge';
                                    break;

                                default:
                                    $browserIcon  = 'fa-';
                                    break;
                            }
                        @endphp
                        <i class="fa {{ $browserIcon }} fa-fw" aria-hidden="true">
                                <span class="sr-only">
                                    {{ $browser }}
                                </span>
                        </i>
                        <sup>
                            <small>
                                {{ $browserVersion }}
                            </small>
                        </sup>
                        <i class="fa {{ $platformIcon }} fa-fw" aria-hidden="true">
                                <span class="sr-only">
                                    {{ $platform }}
                                </span>
                        </i>
                        <sup>
                            <small>
                                {{ $activity->langDetails }}
                            </small>
                        </sup>--}}
                    </td>
                    <td>
                        @php
                            $flag = 0;
                        @endphp

                        @if($activity->data_save != null)
                            @php
                                $datos = unserialize($activity->data_save);
                            @endphp
                            @foreach($datos as $key => $dato)
                                <p><strong>{{ $key }}:</strong> {{ $dato }}</p>
                                @if($key == 'relation')
                                    @php
                                        $flag = $dato;
                                    @endphp
                                @endif
                            @endforeach
                        @else
                            No hay datos para mostrar.
                        @endif
                    </td>
                    <td>
                        @can('restore-activity')
                            @if($activity->entity)
                                @if(!isset($activity->entity::$noRestablecer))
                                    @if($activity->methodType != 'AUTH' && $activity->methodType != 'GET' && $flag != 1)
                                        <form action="{{ route('activity.restablecer', $activity) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button type="submit" class="btn btn-link"><span class="fa fa-undo text-navy"></span></button>
                                        </form>
                                    @endif
                                @endif
                            @endif
                        @endcan
                    </td>
                    @if(Request::is('activity/cleared'))
                        <td>
                            {{ $activity->deleted_at }}
                        </td>
                    @endif
                </tr>
            {{--@endif--}}
        @endforeach

        </tbody>

    </table>

</div>

@if(config('LaravelLogger.loggerPaginationEnabled'))
    <div class="text-center">
        <div>
            {!! $activities->render() !!}
        </div>
        <p>
            {!! trans('LaravelLogger::laravel-logger.pagination.countText', ['firstItem' => $activities->firstItem(), 'lastItem' => $activities->lastItem(), 'total' => $activities->total(), 'perPage' => $activities->perPage()]) !!}
        </p>
    </div>
@endif
