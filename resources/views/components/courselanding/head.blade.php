{{--
    Cabecera de seccion de la landing (eyebrow + titulo + descripcion).

    Usa las clases .erc-sec-head / .erc-sec-eyebrow definidas en
    components/courselanding/styles.blade.php, que son las mismas de la home:
    asi las 12 secciones comparten exactamente la misma jerarquia visual.

    tone="dark" para las bandas navy (texto blanco y eyebrow amarillo).
--}}
@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'icon' => null,
    'tone' => 'light',
    'align' => 'center',
])

@php
    $iconName = \App\Support\CourseLandingPresenter::icon($icon, 'fa-star');
    $isDark = $tone === 'dark';
@endphp

@if (filled($eyebrow) || filled($title) || filled($description))
    <div class="erc-sec-head {{ $isDark ? 'erc-sec-head--dark' : '' }} {{ $align === 'left' ? 'erc-sec-head--left' : '' }}"
        data-reveal>
        @if (filled($eyebrow))
            <span class="erc-sec-eyebrow">
                <i class="fa {{ $iconName }}" aria-hidden="true"></i>
                {{ $eyebrow }}
            </span>
        @endif

        @if (filled($title))
            <h2>{{ $title }}</h2>
        @endif

        @if (filled($description))
            <p>{{ $description }}</p>
        @endif
    </div>
@endif
