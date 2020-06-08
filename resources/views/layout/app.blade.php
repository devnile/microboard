@extends('microboard::layout.argon')

@section('argon-content')
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                @include('microboard::layout.partials.logo')

                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                         data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        @include('microboard::layout.partials.navbar-links')
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @includeWhen(config('microboard.view.enable_global_search'), 'microboard::layout.partials.search')

                <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin"
                                 data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>

                        @includeWhen(
                            config('microboard.view.enable_notifications', true),
                            'microboard::layout.partials.notifications'
                        )
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="John Snow" src="/">
                                </span>

                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold">John Snow</span>
                                    </div>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>

                                @include ('microboard::layout.partials.user')
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0 text-white">@yield ('title')</h6>

                            @includeWhen(config('microboard.view.enable_breadcrumbs', true), 'microboard::layout.partials.breadcrumb')
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            @yield ('actions')
                        </div>
                    </div>

                    <div class="row">
                        @yield('state')
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--6">
            @component('microboard::layout.partials.alerts')@endcomponent

            @yield('content')

            <footer class="footer pt-0">
                @include('microboard::layout.partials.footer')
            </footer>
        </div>
    </div>
@endsection
