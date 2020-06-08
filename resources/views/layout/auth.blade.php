@extends('microboard::layout.argon', [
    'bodyClass' => 'bg-default'
])

@section('argon-content')
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light text-center">
        <div class="mt-4 mx-auto">
            @include('microboard::layout.partials.logo')
        </div>
    </nav>

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Welcome!</h1>
                            <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
                        </div>
                    </div>

                    @component('microboard::layout.partials.alerts')@endcomponent
                </div>
            </div>

            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            @include('microboard::layout.partials.footer')
        </div>
    </footer>
@endsection
