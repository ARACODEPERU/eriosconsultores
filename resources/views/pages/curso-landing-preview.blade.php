@extends('layouts.webpage')

{{--
    Vista aislada para revisar las secciones de la landing de curso
    (resources/views/components/courselanding/*) sin tocar /curso/{slug}.

    Usa el mismo iterador y el mismo sistema de diseno que pages/course-landing,
    asi que lo que se ve aqui es exactamente lo que se publica en la landing.
    Admite ?solo=hero,faq para aislar secciones.
--}}

@php
    $previewCourse = $landing?->course ?? null;
    $courseName = $previewCourse?->description ?: ($previewCourse?->name ?? 'Curso');
@endphp

@section('meta_title', 'Preview de landing · ' . $courseName)
@section('meta_description', 'Vista de revisión de las secciones de landing de curso. No indexable.')
@section('meta_robots', 'noindex, nofollow')

@section('page_styles')
    <x-courselanding.styles />
    <style>
        /* ============ ERIOS · Aviso de contexto del preview ============ */
        .erc-cl-preview { padding: 26px 0 0; }
        .erc-cl-preview__bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: #fff;
            border: 1px dashed rgba(0, 74, 173, 0.35);
            border-radius: 14px;
            padding: 16px 22px;
            box-shadow: 0 8px 26px rgba(14, 23, 38, 0.05);
        }
        .erc-cl-preview__bar strong {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #004aad;
        }
        .erc-cl-preview__bar p { margin: 4px 0 0; font-size: 15px; color: #1d2025; }
        .erc-cl-preview__bar ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin: 0;
            padding: 0;
            font-size: 13px;
            color: #6b7280;
        }
        .erc-cl-preview__bar ul i { color: #004aad; margin-right: 4px; }
        .erc-cl-preview__bar code { color: #1d2025; background: #f4f7fb; padding: 2px 7px; border-radius: 6px; }
        .erc-cl-preview__order { margin: 14px 0 0; font-size: 13px; color: #6b7280; }
        .erc-cl-preview__order code { color: #004aad; background: #f4f7fb; padding: 2px 7px; border-radius: 6px; }
    </style>
@endsection

@section('content')

    <div class="erc-cl">

        {{-- Aviso de contexto: esta vista es solo para revisar los componentes --}}
        <div class="erc-cl-preview">
            <div class="container">
                <div class="erc-cl-preview__bar">
                    <div>
                        <strong>Preview de secciones de landing</strong>
                        <p>{{ $courseName }}</p>
                    </div>
                    <ul>
                        <li><i class="fa fa-link" aria-hidden="true"></i> slug: <code>{{ $landing->url_slug }}</code></li>
                        <li>
                            <i class="fa {{ $landing->is_published ? 'fa-check' : 'fa-times' }}" aria-hidden="true"></i>
                            {{ $landing->is_published ? 'publicada' : 'sin publicar' }}
                        </li>
                        <li>
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                            {{ $only ? implode(', ', $only) : 'todas las secciones' }}
                        </li>
                    </ul>
                </div>

                @unless ($only)
                    <p class="erc-cl-preview__order">
                        Orden (config/course_landing.php):
                        <code>{{ implode(' → ', (array) config('course_landing.sections', [])) }}</code>
                    </p>
                @endunless
            </div>
        </div>

        <x-courselanding.sections
            :landing="$landing"
            :teachers-premium="$teachers_premium ?? []"
            :colors="$colors ?? []"
            :onli-item-id="$onli_item_id ?? null"
            :course-testimonials="$course_testimonials ?? []"
            :course-schema="$course_schema ?? null"
            :only="$only ?? null" />

    </div>

@endsection
