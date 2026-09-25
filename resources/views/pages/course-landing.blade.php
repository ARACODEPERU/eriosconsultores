@extends('layouts.webpage')

{{--
    Landing de curso.

    La comparten las dos rutas, con el mismo payload (WebPageController::landingViewData):
      - /curso/{slug}          publica   (meta_robots: index, follow)
      - /landing_preview/{id}  interna   (meta_robots: noindex, nofollow)

    El orden de las secciones vive en config/course_landing.php y el diseno en
    resources/views/components/courselanding/* (tokens en styles.blade.php).
    El header y el footer los pinta el layout: no se repiten aqui.
--}}

@php
    $previewCourse = $landing?->course ?? null;
    $previewCourseName = $previewCourse?->description ?: ($previewCourse?->name ?? 'Curso de especialización');
    $previewDescription = \Illuminate\Support\Str::limit(
        trim(strip_tags((string) ($previewCourse?->description ?: $previewCourse?->name ?? ''))),
        155
    );
@endphp

@section('meta_title', $previewCourseName)
@section('meta_description', $previewDescription ?: 'Curso de especialización de ERIOS CONSULTORES: temario, plana docente, modalidad e inversión.')
@section('meta_robots', $meta_robots ?? null)

@section('page_styles')
    <x-courselanding.styles />
@endsection

@section('content')

    <div class="erc-cl">

        @if (! isset($landing) || empty($landing) || ! isset($landing->course) || empty($landing->course))
            <div class="container">
                <div class="erc-cl-empty">
                    <h2>Landing o curso no encontrado</h2>
                    <p>
                        No encontramos una landing publicada para esta dirección.
                        Revisa el enlace o vuelve al listado de
                        <a href="{{ route('web_courses') }}">cursos</a>.
                    </p>
                </div>
            </div>
        @else
            <x-courselanding.sections
                :landing="$landing"
                :teachers-premium="$teachers_premium ?? []"
                :colors="$colors ?? []"
                :onli-item-id="$onli_item_id ?? null"
                :course-testimonials="$course_testimonials ?? []"
                :course-schema="$course_schema ?? null" />
        @endif

    </div>

@endsection
