@php
    $lc = app()->getLocale();
    // $seo_image = $seo_image ?? setting_option('og-image');
    // $seo_image = $seo_image ?? '';

    $seo_image = $seo_image ?? '';
    if (!$seo_image) {
        $seo_image = setting_option('logo_' . $lc);
    }
@endphp

<title>{{ $seo_title ?? setting_option('seo-title-add') }}</title>
<link rel="canonical" href="{{ url()->current() }}" />

<meta name="robots" content="index, follow">
<meta name="description" content="{{ $seo_description ?? strip_tags(setting_option('seo-description-add')) }}">

<meta name="author" content="{{ setting_option('author') }}" />
<meta name="copyright" content="{{ setting_option('copyright') }}" />

<meta property="og:title" content="{{ $seo_title ?? setting_option('og:title') }}" />
<meta property="og:site_name" content="{{ setting_option('og:site_name') }}" />
<meta property="og:description" content="{{ $seo_description ?? strip_tags(setting_option('og:description')) }}" />
<meta property="og:image" content="{{ $seo_image }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="{{ $seo_type ?? 'website' }}" />
