@props([
    'title' => null,
    'description' => '',
    'canonical' => null,
    'robots' => '',
    'ogImage' => 'themes/webpage/images/Logo_Web.jpg',
    'ogType' => 'website',
    'ogLocale' => 'es_PE',
    'siteName' => 'ERIOS CONSULTORES',
])

@php
    $defaultDescription = 'ERIOS CONSULTORES: capacitaciones, cursos y consultoría profesional. Conoce nuestros servicios e inscríbete hoy.';

    $fullTitle = filled($title) ? trim($title) . ' | ' . $siteName : $siteName;
    $description = filled($description) ? trim($description) : $defaultDescription;
    $robots = filled($robots) ? trim($robots) : 'index, follow';
    $canonicalUrl = $canonical ?? url()->current();
    $ogImageUrl = url(asset($ogImage));
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta name="robots" content="{{ $robots }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $ogLocale }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImageUrl }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

{{-- Twitter Cards --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
