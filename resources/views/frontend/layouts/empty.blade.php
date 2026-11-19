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
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

    {{-- Customized Bootstrap Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    {{-- Font Awesome 6.4.2 --}}
    <link rel="stylesheet" href="{{ asset('fontawesome_pro/css/all.min.css') }}">

    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">

    {{-- Libraries Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('plugin/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/swiper@11/swiper-bundle.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugin/datetimepicker/jquery.datetimepicker.min.css') }}">

    {{-- Main Style CSS --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/theme.css?ver=' . random_int(0, 100)) }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css?ver=' . random_int(0, 100)) }}"> --}}

    {{-- {!! htmlspecialchars_decode(setting_option('header')) !!} --}}

    @stack('head-style')

    @stack('head-script')
</head>

<body>

    @yield('content')


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
