@extends('layouts.webpage')

@php
    // Título, portada, precio y texto los resuelve el controlador
    // (WebPageController::publicCourseData) a partir del curso y, si existe, de
    // su artículo de tienda: aquí solo se pintan.
    $whatsappLink = $public['whatsapp'];
    $title = $public['title'];
    $mainImage = $public['image'] ?: asset('themes/webpage/images/course/img-1.png');
    $hasImage = filled($public['image']);
    $fallbackImage = asset('themes/webpage/images/Logo_Web_Negativo.png');
    $hasPrice = $public['has_price'];
    $priceFormatted = $public['price'];
    $priceOld = $public['price_old'];
    $metaTitle = $public['meta_title'];
    $metaDescription = $public['meta_description'];

    // Docentes únicos (persona + reanudación académica)
    $teachersList = collect();
    foreach (($course?->teachers ?? collect()) as $tc) {
        $t = $tc->teacher;
        if (!$t || !$t->person) continue;
        $teachersList->push([
            'name' => $t->person->full_name ?: trim(($t->person->names ?? '') . ' ' . ($t->person->father_lastname ?? '')),
            'image' => $t->person->image,
            'profession' => $t->person->profession,
            'resumes' => $t->resumes->pluck('description')->filter()->take(3),
        ]);
    }
    $teachersList = $teachersList->unique('name')->values();

    // Fechas del curso (day/month/year)
    $startDate = null;
    if ($course && $course->course_year && $course->course_month && $course->course_day) {
        try { $startDate = \Carbon\Carbon::createFromDate((int) $course->course_year, (int) $course->course_month, (int) $course->course_day)->locale('es'); } catch (\Throwable $e) {}
    }

    $modality = optional($course?->modality)->description;
    $modalityIcon = match ($modality) {
        'Presencial' => 'fa-university',
        'E-learning' => 'fa-laptop',
        default => 'fa-video-camera',
    };

    $modules = collect($course?->modules ?? [])->sortBy('position')->values();
    $themesCount = $modules->sum(fn ($m) => $m->themes->count());

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Course',
        'name' => $title,
        'description' => $metaDescription,
        'url' => route('web_course_description', ['slug' => $slug]),
        'image' => $mainImage,
        'provider' => [
            '@type' => 'Organization',
            'name' => 'ERIOS CONSULTORES',
            'sameAs' => route('index_main'),
        ],
        ...(filled($modality) ? [
            'hasCourseInstance' => [
                '@type' => 'CourseInstance',
                'courseMode' => $modality === 'Presencial' ? 'onsite' : 'online',
                'courseWorkload' => 'PT' . ($course?->course_day ?? 1) . 'H',
                ...(filled($modality) && $modality !== 'Presencial' ? ['location' => ['@type' => 'VirtualLocation', 'url' => route('web_course_description', ['slug' => $slug])]] : []),
            ],
        ] : []),
        ...($hasPrice ? [
            'offers' => [
                '@type' => 'Offer',
                'price' => $public['price_value'],
                'priceCurrency' => 'PEN',
                'availability' => 'https://schema.org/InStock',
                'url' => route('web_course_description', ['slug' => $slug]),
            ],
        ] : []),
        ...(filled($modality) ? ['educationalLevel' => 'Formación continua'] : []),
    ];
@endphp

@section('meta_title', $metaTitle . ' — Curso')
@section('meta_description', $metaDescription)
@section('meta_robots', 'index, follow')

@section('page_styles')
<link rel="canonical" href="{{ route('web_course_description', ['slug' => $slug]) }}">
<meta property="og:image" content="{{ $mainImage }}">
<script type="application/ld+json">{{ json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</script>
<style>
    /* ============ ERIOS · Detalle de curso ============ */
    .erc-cd { padding: 70px 0 110px; background: #f4f7fb; }

    .erc-cd__card {
        background: #fff; border: 1px solid #eceff5; border-radius: 18px;
        overflow: hidden; box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
    }

    /* Media principal */
    .erc-cd__media { position: relative; aspect-ratio: 16 / 8; background: linear-gradient(135deg, #eef3fa, #e2ebf7); overflow: hidden; }
    .erc-cd__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .erc-cd__media img.erc-cd__img--fallback { object-fit: contain; padding: 60px; background: linear-gradient(135deg, #004aad, #4a86e8); }
    .erc-cd__modality {
        position: absolute; top: 18px; left: 18px;
        background: rgba(7, 41, 77, 0.88); color: #ffc600;
        font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700;
        padding: 8px 16px; border-radius: 50px;
        backdrop-filter: blur(4px);
    }

    /* Cuerpo */
    .erc-cd__body { padding: 30px 34px 8px; }
    .erc-cd__category {
        display: inline-block; font-family: 'Montserrat', sans-serif;
        font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
        color: #004aad; background: rgba(0, 74, 173, 0.08);
        padding: 5px 14px; border-radius: 50px; margin-bottom: 12px;
    }
    .erc-cd__title { font-family: 'Montserrat', sans-serif; font-size: 28px; font-weight: 800; color: #1d2025; margin: 0 0 8px; line-height: 1.35; }
    .erc-cd__summary { color: #6b7280; font-size: 15px; line-height: 1.75; }

    /* Metadatos */
    .erc-cd__meta { display: flex; flex-wrap: wrap; gap: 12px; padding: 22px 34px 6px; }
    .erc-cd__meta-item {
        display: inline-flex; align-items: center; gap: 9px;
        background: #f6f9fd; border: 1px solid #e3e9f2; border-radius: 50px;
        padding: 9px 16px; font-size: 13px; color: #07294d;
    }
    .erc-cd__meta-item i { color: #004aad; }

    /* Secciones */
    .erc-cd__section { padding: 26px 34px 4px; }
    .erc-cd__section h3 {
        font-family: 'Montserrat', sans-serif; font-size: 19px; font-weight: 800; color: #1d2025;
        margin: 0 0 16px; display: flex; align-items: center; gap: 10px;
    }
    .erc-cd__section h3::before { content: ''; width: 26px; height: 3px; border-radius: 3px; background: #ffc600; }
    .erc-cd__desc { color: #505050; font-size: 14.5px; line-height: 1.8; }
    .erc-cd__desc p { margin-bottom: 12px; }

    /* Temario */
    .erc-cd__module { margin-bottom: 14px; border: 1px solid #e3e9f2; border-radius: 12px; overflow: hidden; }
    .erc-cd__module-head {
        width: 100%; background: #f6f9fd; border: none; text-align: left;
        padding: 15px 18px; cursor: pointer; display: flex; align-items: center; gap: 12px;
        font-family: 'Montserrat', sans-serif; font-size: 14.5px; font-weight: 700; color: #07294d;
    }
    .erc-cd__module-head i { color: #004aad; transition: transform .3s ease; font-size: 12px; }
    .erc-cd__module-head[aria-expanded="true"] i { transform: rotate(90deg); }
    .erc-cd__module-badge {
        margin-left: auto; font-size: 11.5px; font-weight: 600; color: #004aad;
        background: rgba(0, 74, 173, 0.08); padding: 3px 10px; border-radius: 50px;
    }
    .erc-cd__themes { padding: 6px 20px 16px 46px; }
    .erc-cd__themes li { list-style: none; position: relative; padding: 6px 0 6px 20px; color: #505050; font-size: 14px; line-height: 1.6; }
    .erc-cd__themes li::before { content: '\f00c'; font-family: 'Font Awesome 5 Free'; font-weight: 900; position: absolute; left: 0; top: 7px; font-size: 11px; color: #ffc600; }

    /* Docentes */
    .erc-cd__teachers { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 14px; }
    .erc-cd__teacher {
        display: flex; gap: 14px; align-items: center;
        border: 1px solid #e3e9f2; border-radius: 14px; padding: 14px 16px;
        background: #fff; transition: all .3s ease;
    }
    .erc-cd__teacher:hover { border-color: #ffc600; box-shadow: 0 8px 20px rgba(14, 23, 38, 0.08); transform: translateY(-2px); }
    .erc-cd__teacher img { width: 54px; height: 54px; border-radius: 50%; object-fit: cover; flex: none; background: #e2ebf7; }
    .erc-cd__teacher img.erc-cd__timg--fallback { object-fit: contain; padding: 8px; background: linear-gradient(135deg, #004aad, #4a86e8); }
    .erc-cd__teacher b { display: block; font-size: 14px; color: #1d2025; font-family: 'Montserrat', sans-serif; }
    .erc-cd__teacher span { font-size: 12.5px; color: #6b7280; }

    /* Sidebar */
    .erc-cd__sidebar { position: sticky; top: 120px; }
    .erc-cd__price-card {
        background: #fff; border: 1px solid #eceff5; border-radius: 18px;
        padding: 28px; box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
    }
    .erc-cd__price-label { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
    .erc-cd__price { font-family: 'Montserrat', sans-serif; font-size: 34px; font-weight: 800; color: #004aad; line-height: 1.1; }
    .erc-cd__price--consult { font-size: 26px; }
    .erc-cd__price-old { font-size: 16px; color: #94a3b8; text-decoration: line-through; margin-left: 10px; font-weight: 600; }
    .erc-cd__price-note { display: inline-block; background: rgba(255, 198, 0, 0.14); color: #b58100; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 50px; margin-top: 10px; }
    .erc-cd__features { list-style: none; margin: 20px 0 22px; padding: 18px 0 0; border-top: 1px solid #eef2f7; }
    .erc-cd__features li { display: flex; align-items: flex-start; gap: 10px; font-size: 13.5px; color: #505050; margin-bottom: 11px; }
    .erc-cd__features li i { color: #00ab55; margin-top: 3px; }

    .erc-cd__btn {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; height: 50px; border-radius: 50px;
        font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700;
        text-decoration: none; transition: all .3s ease; border: none; cursor: pointer;
    }
    .erc-cd__btn--cart { background: #ffc600; color: #07294d; box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35); margin-bottom: 12px; }
    .erc-cd__btn--cart:hover { background: #004aad; color: #ffc600; transform: translateY(-2px); box-shadow: 0 12px 26px rgba(0, 74, 173, 0.3); text-decoration: none; }
    .erc-cd__btn--cart[disabled] { opacity: .55; cursor: not-allowed; transform: none; }
    .erc-cd__btn--wa { background: #fff; color: #25D366; border: 2px solid #25D366; }
    .erc-cd__btn--wa:hover { background: #25D366; color: #fff; text-decoration: none; transform: translateY(-2px); }

    /* Cursos relacionados */
    .erc-cd__related { margin-top: 56px; }
    .erc-cd__related-head { display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 24px; }
    .erc-cd__related-head h3 { font-family: 'Montserrat', sans-serif; font-size: 24px; font-weight: 800; color: #1d2025; margin: 0; }
    .erc-cd__related-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
    .erc-cd__rel-card {
        background: #fff; border: 1px solid #eceff5; border-radius: 14px; overflow: hidden;
        text-decoration: none; transition: all .3s ease; display: block;
    }
    .erc-cd__rel-card:hover { transform: translateY(-4px); box-shadow: 0 14px 30px rgba(0, 74, 173, 0.14); text-decoration: none; }
    .erc-cd__rel-media { aspect-ratio: 16 / 8; overflow: hidden; background: linear-gradient(135deg, #eef3fa, #e2ebf7); }
    .erc-cd__rel-media img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
    .erc-cd__rel-card:hover .erc-cd__rel-media img { transform: scale(1.05); }
    .erc-cd__rel-media img.erc-cd__rimg--fallback { object-fit: contain; padding: 26px; background: linear-gradient(135deg, #004aad, #4a86e8); }
    .erc-cd__rel-body { padding: 16px 18px 18px; }
    .erc-cd__rel-body span { font-size: 11.5px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #004aad; }
    .erc-cd__rel-body h4 { font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 700; color: #1d2025; margin: 6px 0 0; line-height: 1.45; }

    .erc-cd__404 { text-align: center; padding: 30px 0 10px; color: #6b7280; }

    @media (max-width: 991px) {
        .erc-cd__sidebar { position: static; margin-top: 26px; }
    }
    @media (max-width: 767px) {
        .erc-cd { padding: 46px 0 80px; }
        .erc-cd__body, .erc-cd__meta, .erc-cd__section { padding-left: 20px; padding-right: 20px; }
        .erc-cd__title { font-size: 22px; }
        .erc-cd__related-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero compartido ======== --}}
    <x-page-hero eyebrow="Formación ERIOS" title="{{ $title }}"
        subtitle="{{ filled($modality) ? 'Modalidad: ' . $modality . ($startDate ? ' · Inicia ' . $startDate->translatedFormat('d \d\e F \d\e Y') : '') : 'Capacitación especializada con certificación.' }}" />

    <section class="erc-cd">
        <div class="container">
            <div class="row">

                {{-- ======== Columna principal ======== --}}
                <div class="col-lg-8">
                    <div class="erc-cd__card" data-reveal>
                        <div class="erc-cd__media">
                            <img src="{{ $mainImage }}" alt="{{ $title }}"
                                class="erc-cd__img @unless ($hasImage) erc-cd__img--fallback @endunless"
                                onerror="this.onerror=null;this.src='{{ $fallbackImage }}';this.classList.add('erc-cd__img--fallback');">
                            @if (filled($modality))
                                <span class="erc-cd__modality"><i class="fa {{ $modalityIcon }}" aria-hidden="true"></i> {{ $modality }}</span>
                            @endif
                        </div>

                        <div class="erc-cd__body">
                            <span class="erc-cd__category">{{ $public['category'] }}</span>
                            <h1 class="erc-cd__title">{{ $title }}</h1>
                            @if (filled(optional($item)->scor))
                                <span class="erc-cd__price-note"><i class="fa fa-star" aria-hidden="true"></i> {{ $item->scor }}</span>
                            @endif
                        </div>

                        {{-- Metadatos --}}
                        <div class="erc-cd__meta">
                            @if ($startDate)
                                <span class="erc-cd__meta-item"><i class="fa fa-calendar" aria-hidden="true"></i> Inicia {{ $startDate->translatedFormat('d M Y') }}</span>
                            @endif
                            @if ($modules->count())
                                <span class="erc-cd__meta-item"><i class="fa fa-list-ul" aria-hidden="true"></i> {{ $modules->count() }} módulo{{ $modules->count() > 1 ? 's' : '' }} · {{ $themesCount }} temas</span>
                            @endif
                            @if ($teachersList->count())
                                <span class="erc-cd__meta-item"><i class="fa fa-user" aria-hidden="true"></i> {{ $teachersList->count() }} docente{{ $teachersList->count() > 1 ? 's' : '' }}</span>
                            @endif
                            @if (filled($course?->certificate_title))
                                <span class="erc-cd__meta-item"><i class="fa fa-certificate" aria-hidden="true"></i> Certificado</span>
                            @endif
                        </div>

                        {{-- Descripción --}}
                        @if (filled($public['description_html']) || filled($public['description']))
                            <div class="erc-cd__section">
                                <h3>Descripción</h3>
                                <div class="erc-cd__desc">
                                    {!! $public['description_html'] ?: nl2br(e($public['description'])) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Temario (módulos y temas) --}}
                        @if ($modules->count())
                            <div class="erc-cd__section">
                                <h3>Temario</h3>
                                @foreach ($modules as $module)
                                    <div class="erc-cd__module">
                                        <button type="button" class="erc-cd__module-head" data-toggle="collapse"
                                            data-target="#module-{{ $module->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                            {{ $module->description }}
                                            <span class="erc-cd__module-badge">{{ $module->themes->count() }} temas</span>
                                        </button>
                                        <div class="collapse {{ $loop->first ? 'show' : '' }}" id="module-{{ $module->id }}">
                                            @if ($module->themes->count())
                                                <ul class="erc-cd__themes">
                                                    @foreach ($module->themes->sortBy('position') as $theme)
                                                        <li>{{ $theme->description }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="erc-cd__themes" style="color:#94a3b8; font-size:13px;">Contenido en preparación.</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Docentes --}}
                        @if ($teachersList->count())
                            <div class="erc-cd__section pb-4">
                                <h3>Docentes del curso</h3>
                                <div class="erc-cd__teachers">
                                    @foreach ($teachersList as $teacher)
                                        <div class="erc-cd__teacher">
                                            <img src="{{ $teacher['image'] ? asset('storage/' . $teacher['image']) : asset('themes/webpage/images/logo-2.png') }}"
                                                alt="{{ $teacher['name'] }}"
                                                onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-cd__timg--fallback');">
                                            <div>
                                                <b>{{ $teacher['name'] }}</b>
                                                <span>{{ $teacher['profession'] ?: 'Docente ERIOS' }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ======== Sidebar ======== --}}
                <div class="col-lg-4">
                    <div class="erc-cd__sidebar" data-reveal data-reveal-delay="120">
                        <div class="erc-cd__price-card">
                            <span class="erc-cd__price-label">Inversión</span>
                            <div>
                                <span class="erc-cd__price {{ $hasPrice ? '' : 'erc-cd__price--consult' }}">{{ $priceFormatted }}</span>
                                @if ($priceOld)
                                    <span class="erc-cd__price-old">{{ $priceOld }}</span>
                                @endif
                            </div>
                            @if ($priceOld)
                                <span class="erc-cd__price-note"><i class="fa fa-tag" aria-hidden="true"></i> Precio promocional</span>
                            @endif

                            <ul class="erc-cd__features">
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Acceso al aula virtual</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Material descargable</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Certificado digital</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Soporte del docente</li>
                            </ul>

                            {{-- El carrito solo aparece cuando el curso tiene artículo de tienda publicado. --}}
                            @if ($item)
                                <button type="button" class="erc-cd__btn erc-cd__btn--cart" id="btn-add-cart"
                                    data-item-id="{{ $item->id }}" data-item-name="{{ $item->name }}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Agregar al carrito
                                </button>
                            @endif
                            <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="erc-cd__btn erc-cd__btn--wa">
                                <i class="fab fa-whatsapp" aria-hidden="true"></i> Consultar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ======== Relacionados ======== --}}
            @if ($related->count())
                <div class="erc-cd__related" data-reveal>
                    <div class="erc-cd__related-head">
                        <h3>Otros cursos que te pueden interesar</h3>
                        <a href="{{ route('web_courses') }}" class="erc-cd__404" style="color:#004aad; font-weight:600;">
                            Ver todos <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="erc-cd__related-grid">
                        @foreach ($related as $rel)
                            <a href="{{ route('web_course_description', ['slug' => $rel['slug']]) }}" class="erc-cd__rel-card">
                                <div class="erc-cd__rel-media">
                                    <img src="{{ $rel['image'] ?: $fallbackImage }}" alt="{{ $rel['title'] }}" loading="lazy"
                                        @unless ($rel['image']) class="erc-cd__rimg--fallback" @endunless
                                        onerror="this.onerror=null;this.src='{{ $fallbackImage }}';this.classList.add('erc-cd__rimg--fallback');">
                                </div>
                                <div class="erc-cd__rel-body">
                                    <span>{{ $rel['meta'] }}</span>
                                    <h4>{{ \Illuminate\Support\Str::limit($rel['title'], 70) }}</h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div> <!-- container -->
    </section>

    {{-- ======== JS: agregar al carrito (localStorage, mismo formato que /carrito) ======== --}}
    @if ($item)
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('btn-add-cart');
            if (!btn) return;
            btn.addEventListener('click', function () {
                var id = parseInt(btn.dataset.itemId);
                var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                if (carrito.some(function (i) { return parseInt(i.id) === id; })) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Ya está en tu carrito',
                        text: 'Este curso ya fue agregado anteriormente.',
                        confirmButtonColor: '#004aad',
                        customClass: { container: 'sweet-modal-zindex' }
                    });
                    return;
                }
                carrito.push({ id: id });
                localStorage.setItem('carrito', JSON.stringify(carrito));
                btn.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i> Agregado';
                btn.disabled = true;
                Swal.fire({
                    icon: 'success',
                    title: 'Curso agregado',
                    html: '«{{ \Illuminate\Support\Str::limit(\Illuminate\Support\Str::before($title, ':'), 60) }}» ya está en tu carrito.',
                    showCancelButton: true,
                    confirmButtonText: 'Ir al carrito',
                    cancelButtonText: 'Seguir viendo',
                    confirmButtonColor: '#004aad',
                    cancelButtonColor: '#6b7280',
                    customClass: { container: 'sweet-modal-zindex' }
                }).then(function (r) {
                    if (r.isConfirmed) window.location.href = '{{ route('web_carrito') }}';
                });
            });
        });
    </script>
    @endif
@endsection
