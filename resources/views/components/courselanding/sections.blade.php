{{--
    Iterador de secciones de la landing de curso.

    El ORDEN vive en config/course_landing.php ('sections'), no en la vista: para
    reordenar la landing se edita ese archivo. Cada seccion recibe aqui sus props
    porque cada componente declara @props distintos (landing, teachersPremium,
    colors, onliItemId...).

    Las props adicionales permiten reutilizarlo desde la ruta de revision
    /curso-landing-preview/{slug}, que filtra secciones con ?solo=hero,faq.
--}}
@props([
    'landing',
    'teachersPremium' => [],
    'colors' => [],
    'onliItemId' => null,
    'courseTestimonials' => [],
    'courseSchema' => null,
    'only' => null,
])

@php
    $defaultOrder = array_values((array) config('course_landing.sections', []));

    // Override por curso (si el modelo expone `sections_order`): lo listado va
    // primero y el resto se agrega al final respetando el orden por defecto.
    $override = $landing->sections_order ?? null;

    if (is_array($override) && $override !== []) {
        $requested = array_values(array_intersect($override, $defaultOrder));
        $order = array_values(array_unique(array_merge($requested, $defaultOrder)));
    } else {
        $order = $defaultOrder;
    }

    $show = fn (string $section): bool => $only === null || in_array($section, $only, true);
@endphp

@foreach ($order as $section)
    @continue(! $show($section))

    @switch($section)
        @case('hero')
            <x-courselanding.hero :landing="$landing" />
            @break

        @case('professional-development-info')
            <x-courselanding.professional-development-info :landing="$landing" />
            @break

        @case('the-problem')
            <x-courselanding.the-problem :landing="$landing" />
            @break

        @case('study-plan')
            <x-courselanding.study-plan :landing="$landing" />
            @break

        @case('staff')
            <x-courselanding.staff :landing="$landing" :teachers-premium="$teachersPremium" />
            @break

        @case('results')
            <x-courselanding.results :landing="$landing" :colors="$colors" />
            @break

        @case('investment')
            <x-courselanding.investment :landing="$landing" :onli-item-id="$onliItemId" />
            @break

        @case('testimonials')
            <x-courselanding.testimonials :landing="$landing" />
            @break

        @case('faq')
            <x-courselanding.faq :landing="$landing" />
            @break

        @case('professional-development-form')
            <x-courselanding.professional-development-form :landing="$landing" />
            @break

        @case('certificate-template')
            <x-courselanding.certificate-template />
            @break

        @case('course-testimonials')
            <x-courselanding.course-testimonials
                :testimonials="$courseTestimonials"
                :course="$landing->course ?? null"
                :schema="$courseSchema" />
            @break
    @endswitch
@endforeach
