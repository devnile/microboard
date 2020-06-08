<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This package created to decrease working time that spent on admin panels">
    <meta name="author" content="Mohamed Ibrahim, Devnile">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/@fortawesome/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
@stack('styles')
<!-- Argon CSS -->
    <link rel="stylesheet" href="{{ mix('css/argon.css', 'vendor/microboard') }}">

    <title>@lang('general.title', ['app' => config('app.name')]) — @yield('title')</title>
</head>
<body{!! isset($bodyClass) ? (' class="'. $bodyClass .'"') : '' !!}>
@yield('argon-content')

<!-- Argon Scripts -->
<!-- Core -->
<script src="{{ asset('vendor/microboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/jquery-scroll-lock/jquery-scrollLock.min.js') }}"></script>
<!-- Optional JS -->
@stack('scripts')
<!-- Argon JS -->
<script src="{{ mix('js/argon.js', 'vendor/microboard') }}"></script>
</body>
</html>
