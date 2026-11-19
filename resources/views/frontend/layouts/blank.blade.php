<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <title>{{ setting_option('company_name') }}</title>
    <meta name="description" content="description"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ get_image(setting_option('favicon')) }}" />

    {{-- SEO meta --}}
    @yield('seo')

    {{-- Google Web Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">

    {{-- Customized Bootstrap Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    {{-- Icon Font Stylesheet --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    {{-- Libraries Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('plugin/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/swiper@11/swiper-bundle.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugin/datetimepicker/jquery.datetimepicker.min.css') }}">

    {{-- Main Style CSS --}}
    <link rel="stylesheet" href="{{ asset('css/theme.css?ver=' . random_int(0, 100)) }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/style.css?ver=' . random_int(0, 100)) }}"> --}}

    {!! htmlspecialchars_decode(setting_option('header')) !!}

    @stack('head-style')
    @stack('head-script')
</head>

<body>

    {{-- @include($templateFile . '.layouts.header') --}}

    @yield('content')

    {{-- @include($templateFile . '.layouts.footer') --}}

    {{-- Including Jquery --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    {{-- <script src="{{ asset('plugin/mdb/js/mdb.umd.min.js') }} "></script> --}}
    <script src="{{ asset('plugin/axios.min.js') }}"></script>
    <script src="{{ asset('plugin/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugin/swiper@11/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('plugin/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>

    <script src="{{ asset('plugin/aos/aos.js') }}"></script>
    <script src="{{ asset('plugin/wow/wow.min.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2@11/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('plugin/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('plugin/counterup/counterup.min.js') }}"></script>

    {{-- <script src="{{ asset('js/main.js?ver=' . random_int(0, 100)) }}"></script> --}}
    <script src="{{ asset('js/custom.js?ver=' . random_int(0, 100)) }}"></script>

    @stack('scripts')

</body>

</html>
