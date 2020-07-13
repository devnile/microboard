@php
    $locale = new \Microboard\Foundations\Localization
@endphp<!--
=========================================================
* Microboard - 2.3.0
=========================================================
* Created by Mohamed Ibrahim
* Devnile https://devnile.com
=========================================================
*
--><!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ $locale->getDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This package created to decrease working time that spent on admin panels">
    <meta name="author" content="Mohamed Ibrahim, Devnile">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/@fortawesome/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/sweetalert2/sweetalert2.min.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ mix('css/argon.css', 'vendor/microboard') }}">

    <title>@lang('microboard::pages.title', ['app' => config('app.name')]) — @yield('title')</title>
</head>
@php
    $bodyClasses = [];
    if ($locale->isRTL()) {
        $bodyClasses[] = 'rtl';
    }
    if (isset($bodyClass)) {
        $bodyClasses[] = $bodyClass;
    }
@endphp
<body class="{{ implode(' ', $bodyClasses) }}">
@yield('argon-content')

<!-- Argon Scripts -->
<script src="{{ asset('vendor/microboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/microboard/vendor/jquery-scroll-lock/jquery-scrollLock.min.js') }}"></script>
<!-- Optional JS -->
<script src="{{ asset('vendor/microboard/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
@stack('scripts')
<!-- Argon JS -->
<script src="{{ mix('js/argon.js', 'vendor/microboard') }}"></script>
@include('microboard::layouts.partials.notify')
</body>
</html>
