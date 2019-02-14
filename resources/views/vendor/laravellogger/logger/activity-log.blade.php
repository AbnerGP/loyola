@section('title', 'Actividad')

@extends(config('LaravelLogger.loggerBladeExtended'))

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @section(config('LaravelLogger.bladePlacementCss'))
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @push(config('LaravelLogger.bladePlacementCss'))
@endif

    @include('vendor.laravellogger.partials.styles')

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @endsection
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @endpush
@endif

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @section(config('LaravelLogger.bladePlacementJs'))
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @push(config('LaravelLogger.bladePlacementJs'))
@endif

    @include('vendor.laravellogger.partials.scripts', ['activities' => $activities])
    @include('vendor.laravellogger.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])

    @if(config('LaravelLogger.enableDrillDown'))
        @include('vendor.laravellogger.scripts.clickable-row')
        @include('vendor.laravellogger.scripts.tooltip')
    @endif

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @endsection
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @endpush
@endif

@section('template_title')
    {{ trans('vendor.laravellogger.laravel-logger.dashboard.title') }}
@endsection

@php
    switch (config('LaravelLogger.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('LaravelLogger.bootstrapCardClasses')) ? '' : config('LaravelLogger.bootstrapCardClasses'));
@endphp

@section('var_content')

    <div class="container-fluid">
        @if(config('LaravelLogger.enablePackageFlashMessageBlade'))
            @include('vendor.laravellogger.partials.form-status')
        @endif
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Filtros</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="GET" action="{{ route('activity') }}" id="form_create_user">
                            <div class="row">
                                <div class="col-md-4">

                                    <p class="font-bold">
                                        Método
                                    </p>

                                    <div class="form-group">
                                        <select class="form-control" name="method" id="method">
                                            <option value="">Todos</option>
                                            <option value="POST" @if(app('request')->input('method') == 'POST') selected @endif>Creación</option>
                                            <option value="PUT" @if(app('request')->input('method') == 'PUT') selected @endif>Modificación</option>
                                            <option value="DELETE" @if(app('request')->input('method') == 'DELETE') selected @endif>Eliminación</option>
                                            <option value="AUTH" @if(app('request')->input('method') == 'AUTH') selected @endif>AUTH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-bold">
                                        Fecha
                                    </p>
                                    <div>
                                        <input class="form-control" type="text" name="daterange" value="{{ $daterange }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <p class="font-bold">
                                        Usuario
                                    </p>
                                    <div>
                                        <select class="form-control" name="user" id="user">
                                            <option value="">Todos</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" @if(app('request')->input('user') == $user->id) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                                    <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            @if(config('LaravelLogger.enableSubMenu'))

                                <span>
                                    {!! trans('LaravelLogger::laravel-logger.dashboard.title') !!}
                                    <small>
                                        <sup class="label label-default">
                                            {{ $totalActivities }} {!! trans('LaravelLogger::laravel-logger.dashboard.subtitle') !!}
                                        </sup>
                                    </small>
                                </span>

                                <div class="btn-group pull-right btn-group-xs">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">
                                            {!! trans('LaravelLogger::laravel-logger.dashboard.menu.alt') !!}
                                        </span>
                                    </button>
                                    @if(config('LaravelLogger.bootstapVersion') == '4')
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @include('vendor.laravellogger.forms.clear-activity-log')
                                            <a href="{{route('cleared')}}" class="dropdown-item">
                                                <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                                                {!! trans('LaravelLogger::laravel-logger.dashboard.menu.show') !!}
                                            </a>
                                        </div>
                                    @else
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                @include('vendor.laravellogger.forms.clear-activity-log')
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{route('cleared')}}">
                                                    <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                                                    {!! trans('LaravelLogger::laravel-logger.dashboard.menu.show') !!}
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>

                            @else
                                {!! trans('LaravelLogger::laravel-logger.dashboard.title') !!}
                                <span class="pull-right label label-default">
                                    {{ $totalActivities }}
                                    <span class="hidden-sms">
                                        {!! trans('LaravelLogger::laravel-logger.dashboard.subtitle') !!}
                                    </span>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        @include('vendor.laravellogger.logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('vendor.laravellogger.modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'])

    <script>
        $('#confirmdanger').click(function () {
            $('#formClear').submit();
        });
    </script>

@endsection