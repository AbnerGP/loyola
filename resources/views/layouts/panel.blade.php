@extends('layouts.app')



@section('content')
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{ auth()->user()->name }}</span>
                            </a>
                        </div>
                        <div class="logo-element">
                            CU
                        </div>
                    </li>

                    @can('view-activity')
                        <li>
                            <a href="{{ route('activity') }}"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Registro de Actividad</span></a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('profile.edit') }}"><i class="fa fa-address-card"></i> <span class="nav-label">Editar perfil</span></a>
                    </li>

                    @can('view', App\Models\User::class)
                        <li>
                            <a href="{{ route('users.view') }}"><i class="fa fa-user"></i> <span class="nav-label">Usuarios</span></a>
                        </li>
                    @endcan
                    @can('view', App\Models\Role::class)
                        <li>
                            <a href="{{ route('roles.view') }}"><i class="fa fa-pied-piper-alt"></i> <span class="nav-label">Roles</span></a>
                        </li>
                    @endcan

                    @if(auth()->user()->can('view', App\Models\Page::class) OR auth()->user()->can('view', App\Models\Media::class))

                    <li>
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Gestor de Contenido</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('view', App\Models\Page::class)
                            <li><a href="{{ route('cms.page.index') }}">Paginas</a></li>
                            @endcan
                            @can('view', App\Models\Media::class)
                            <li><a href="{{ route('cms.media.index') }}">Media</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->can('view', App\Models\Libro::class) || auth()->user()->can('migrate-biblioteca'))
                    <li>
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Biblioteca</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('view', App\Models\Libro::class)
                                <li><a href="{{ route('libros.view') }}">Libros</a></li>
                            @endcan
                            @can('migrate-biblioteca')
                            <li><a href="{{ route('migracion') }}">Migración de Biblioteca</a></li>
                            @endcan
                        </ul>
                    </li>

                    @endif
                    @can('view', App\Models\Categoria::class)
                        <li>
                            <a href="{{ route('categorias.view') }}"><i class="fa fa-folder"></i> <span class="nav-label">Categorías</span></a>
                        </li>
                    @endcan

                    @can('view', App\Models\Request::class)
                        <li>
                            <a href="{{ route('request.view') }}"><i class="fa fa-pencil"></i> <span class="nav-label">Solicitudes de inscripción</span></a>
                        </li>
                    @endcan

                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Cerrar sesión') }} ({{ auth()->user()->name }})
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="wrapper wrapper-content animated fadeIn">
                @yield('var_content')
            </div>

            <div class="footer">
                <div class="float-right">
                    Control de usuarios
                </div>
            </div>
        </div>
    </div>
@endsection

@section('panel_scripts')
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.time.js') }}"></script>

    <!-- Loader -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js" rel="stylesheet"></script>
    <script>
        function overlay(el, action = 'show') {
            $(el).LoadingOverlay(action);
        }
    </script>

    @yield('extra_js')

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

    <!-- Toastr script -->
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
@endsection