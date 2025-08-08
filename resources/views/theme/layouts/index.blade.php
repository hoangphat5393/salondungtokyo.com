<!DOCTYPE html>

@php $lc = app()->getLocale();@endphp

<html lang="{{ $lc }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {{-- <title>{{ setting_option('company_name') }}</title> --}}
    {{-- <meta name="description" content="description"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ get_image(setting_option('favicon')) }}"> --}}

    <link rel="icon" type="image/png" sizes="16x16" href="{{ get_image(setting_option('favicon_16')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ get_image(setting_option('favicon_32')) }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ get_image(setting_option('favicon_48')) }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ get_image(setting_option('favicon_96')) }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ get_image(setting_option('favicon_192')) }}">

    {{-- <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png"> --}}
    <link rel="apple-touch-icon" sizes="72x72" href="{{ get_image(setting_option('favicon_72')) }}" />
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png"> --}}
    <link rel="apple-touch-icon" sizes="144x144" href="{{ get_image(setting_option('favicon_144')) }}">
    {{-- <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png"> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ get_image(setting_option('favicon_180')) }}">

    {{-- <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> --}}

    {{-- SEO meta --}}
    @yield('seo')

    {{-- Google Web Fonts --}}
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

    {{-- Customized Bootstrap Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    {{-- Font Awesome 6.4.2 --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome_pro/css/all.min.css') }}">

    {{-- Libraries Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('assets/plugin/swiper@11/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/animate/animate.min.css') }}">

    {{-- Libraries css --}}
    @stack('lib-style')

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css?ver=' . random_int(0, 100)) }}">

    @stack('head-style')
    @stack('head-script')

    {{-- Google Analytics --}}
    {!! htmlspecialchars_decode(setting_option('google_analytics')) !!}
</head>


<body>
    {{-- @include('theme.layouts.header') --}}

    <x-header />

    @yield('content')
    {{--
    <div id="fixed-social-network" class="d-none d-sm-block">
        <a href="https://zalo.me/0782534765" class="zalo-icon" target="_blank">
            <img alt="Icon-Zalo" class=" ls-is-cached lazyloaded" src="https://file.hstatic.net/200000259495/file/zalo_d9dc3417eb744b91a44643f29b8c7161.svg" data-src="https://file.hstatic.net/200000259495/file/zalo_d9dc3417eb744b91a44643f29b8c7161.svg">
            Zalo
        </a>

        <a href="https://www.facebook.com/agencysevent" class="messenger-icon" target="_blank">
            <img alt="Icon-Messager" class=" ls-is-cached lazyloaded" src="https://file.hstatic.net/200000259495/file/messager_208d7389c4ac46b5a01afad457684cd6.svg" data-src="https://file.hstatic.net/200000259495/file/messager_208d7389c4ac46b5a01afad457684cd6.svg">
            Messenger
        </a>

        <a href="https://www.instagram.com/sevent.agency" target="_blank">
            <img alt="Icon-Instagram" class=" ls-is-cached lazyloaded" src="https://file.hstatic.net/200000259495/file/instagram_81b9ae8829a940a7aa5b7926152ed378.svg" data-src="https://file.hstatic.net/200000259495/file/instagram_81b9ae8829a940a7aa5b7926152ed378.svg">
            Instagram
        </a>

        <a href="/collections/all" target="_blank">
            <img alt="Icon-Instagram" class=" ls-is-cached lazyloaded" src="https://file.hstatic.net/200000259495/file/tik-tok_b5d2fcfc430f4022b3af5051c2f54cfd.svg" data-src="https://file.hstatic.net/200000259495/file/tik-tok_b5d2fcfc430f4022b3af5051c2f54cfd.svg">
            Tiktok
        </a>
    </div> --}}

    <div class="back-to-top">
        <img src="https://file.hstatic.net/200000295028/file/up-arrow_29fc517a2b0b4a89a35dcd7084064fb7.svg" alt="back-to-top">
    </div>

    <x-footer />
    {{-- @include('theme.layouts.footer') --}}

    {{-- <a href="tel:{{ setting_option('phone') }}" class="call-now" rel="nofollow">
        <div class="mh-contact">
            <div class="animated infinite zoomIn mh-alo-ph-circle"></div>
            <div class="animated infinite pulse mh-alo-ph-circle-fill"></div>
            <div class="animated infinite tada mh-img-circle">
                <i class="fa-solid fa-phone"></i>
            </div>
        </div>
    </a> --}}

    {{-- Including Jquery --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/axios@1.7.2/axios.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/lodash@4.17/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/swiper@11/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('assets/plugin/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/plugin/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/sweetalert2@11/sweetalert2.all.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/plugin/gsap@3.12/minified/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/gsap@3.12/minified/Flip.min.js') }}"></script> --}}

    {{-- Libraries scripts --}}
    @stack('lib-scripts')

    <script src="{{ asset('assets/js/custom.js?ver=' . random_int(0, 100)) }}"></script>

    @stack('scripts')

</body>

</html>
