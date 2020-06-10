<!--
=========================================================
* Microboard - 2.3.0
=========================================================
* Created by Mohamed Ibrahim
* Devnile https://devnile.com
=========================================================
*
--><!doctype html>
<html lang="{{ $locale = config('app.locale') }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This package created to decrease working time that spent on admin panels">
    <meta name="author" content="Mohamed Ibrahim, Devnile">
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/@fortawesome/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    @stack('styles')
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ mix('css/argon.css', 'vendor/microboard') }}">

    <title>@lang('microboard::pages.title', ['app' => config('app.name')]) — @yield('title')</title>
</head>
@php
    /** @var string $locale */
    $bodyClasses = [];

    if ($locale === 'ar') {
        $bodyClasses[] = 'rtl';
    }

    if (isset($bodyClass)) {
        $bodyClasses[] = $bodyClass;
    }
@endphp
<body class="{{ implode(' ', $bodyClasses) }}">
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
