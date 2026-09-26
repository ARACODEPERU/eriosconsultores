@extends('layouts.webpage')

@section('page_styles')
<style>
    /* ============ ERIOS · Detalle de curso (lenguaje visual erc-) ============ */
    .erc-cd { padding: 70px 0 100px; background: #f4f7fb; font-family: 'Montserrat', sans-serif; }

    .erc-cd__card {
        background: #fff; border: 1px solid #eceff5; border-radius: 18px;
        padding: 34px 36px 26px;
        box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
        margin-bottom: 28px;
    }

    /* Chips de metadatos */
    .erc-cd__chips { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; }
    .erc-cd__chip {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 12.5px; font-weight: 700; letter-spacing: .3px;
        padding: 7px 15px; border-radius: 50px;
    }
    .erc-cd__chip--cat { background: rgba(0, 74, 173, 0.08); color: #004aad; }
    .erc-cd__chip--mod { background: rgba(7, 41, 77, 0.06); color: #07294d; }
    .erc-cd__chip i { font-size: 12px; }

    .erc-cd__title { font-family: 'Montserrat', sans-serif; font-size: 28px; font-weight: 800; color: #1d2025; margin: 0 0 20px; line-height: 1.35; }

    /* Imagen principal */
    .erc-cd__media {
        border-radius: 14px; overflow: hidden;
        aspect-ratio: 16 / 8; max-height: 380px; width: 100%;
        background: linear-gradient(135deg, #eef3fa, #e2ebf7);
        margin-bottom: 6px;
    }
    .erc-cd__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .erc-cd__media img.erc-cd__img--fallback { object-fit: contain; padding: 50px; background: linear-gradient(135deg, #004aad, #4a86e8); }

    /* Secciones internas */
    .erc-cd__section-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px; font-weight: 800; color: #1d2025;
        margin: 30px 0 12px; padding-top: 24px;
        border-top: 1px solid #eef2f7;
        display: flex; align-items: center; gap: 10px;
    }
    .erc-cd__section-title::before { content: ''; width: 26px; height: 3px; border-radius: 3px; background: #ffc600; flex: none; }
    .erc-cd__section-title:first-of-type { margin-top: 8px; padding-top: 0; border-top: none; }
    .erc-cd__text { color: #6b7280; font-size: 14.5px; line-height: 1.8; margin: 0 0 10px; }
    .erc-cd__text b { color: #07294d; }

    /* Certificación como tarjeta destacada */
    .erc-cd__cert {
        display: flex; gap: 14px; align-items: flex-start;
        background: #f6f9fd; border: 1px solid #e3e9f2; border-left: 4px solid #ffc600;
        border-radius: 12px; padding: 16px 20px; margin-top: 4px;
    }
    .erc-cd__cert i { color: #ffc600; font-size: 20px; margin-top: 2px; }
    .erc-cd__cert b { display: block; color: #07294d; font-size: 14.5px; margin-bottom: 2px; }
    .erc-cd__cert span { color: #6b7280; font-size: 13.5px; line-height: 1.65; }

    /* Temario */
    .erc-cd__modules { list-style: none; margin: 0; padding: 0; }
    .erc-cd__modules li {
        display: flex; gap: 12px; align-items: flex-start;
        padding: 11px 0; border-bottom: 1px dashed #e8edf4;
        color: #505050; font-size: 14px; line-height: 1.65;
    }
    .erc-cd__modules li:last-child { border-bottom: none; }
    .erc-cd__modules .erc-cd__mod-num {
        flex: none; width: 26px; height: 26px; border-radius: 50%;
        background: rgba(0, 74, 173, 0.08); color: #004aad;
        font-size: 12px; font-weight: 700;
        display: inline-flex; align-items: center; justify-content: center;
        margin-top: 1px;
    }

    /* Docentes */
    .erc-cd__teachers { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 14px; }
    .erc-cd__teacher {
        display: flex; gap: 13px; align-items: center;
        border: 1px solid #e3e9f2; border-radius: 14px; padding: 13px 16px;
        background: #fff; transition: all .3s ease;
    }
    .erc-cd__teacher:hover { border-color: #ffc600; box-shadow: 0 8px 20px rgba(14, 23, 38, 0.08); transform: translateY(-2px); }
    .erc-cd__teacher img { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; flex: none; background: #e2ebf7; }
    .erc-cd__teacher img.erc-cd__timg--fallback { object-fit: contain; padding: 8px; background: linear-gradient(135deg, #004aad, #4a86e8); }
    .erc-cd__teacher b { display: block; font-size: 14px; color: #1d2025; }
    .erc-cd__teacher span { font-size: 12.5px; color: #6b7280; }

    /* ===== Sidebar de precio ===== */
    .erc-cd__sidebar { position: sticky; top: 120px; }
    .erc-cd__price-card {
        background: #fff; border: 1px solid #eceff5; border-radius: 18px;
        padding: 28px; box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
        position: relative; overflow: hidden;
    }
    .erc-cd__price-card::after {
        content: ''; position: absolute; width: 150px; height: 150px; border-radius: 50%;
        border: 2px dashed rgba(255, 198, 0, 0.25); right: -55px; top: -55px;
        pointer-events: none;
    }
    .erc-cd__price-label { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
    .erc-cd__price { font-family: 'Montserrat', sans-serif; font-size: 34px; font-weight: 800; color: #004aad; line-height: 1.1; }
    .erc-cd__price-note { display: inline-block; font-size: 12px; font-weight: 700; padding: 5px 13px; border-radius: 50px; margin-top: 12px; }
    .erc-cd__price-note--off { background: rgba(0, 171, 85, 0.1); color: #00ab55; }
    .erc-cd__price-note--single { background: rgba(255, 198, 0, 0.14); color: #b58100; }

    .erc-cd__features { list-style: none; margin: 20px 0 22px; padding: 18px 0 0; border-top: 1px solid #eef2f7; }
    .erc-cd__features li { display: flex; align-items: flex-start; gap: 10px; font-size: 13.5px; color: #505050; margin-bottom: 11px; }
    .erc-cd__features li i { color: #00ab55; margin-top: 3px; }

    .erc-cd__brochure {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; height: 48px; margin-bottom: 12px;
        background: #fff; color: #004aad;
        border: 2px solid #004aad; border-radius: 50px;
        font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700;
        text-decoration: none; transition: all .3s ease;
    }
    .erc-cd__brochure:hover { background: #004aad; color: #fff; text-decoration: none; transform: translateY(-2px); }

    .erc-wa-cta {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; height: 50px;
        background: #ffc600; color: #07294d;
        border-radius: 50px;
        font-family: 'Montserrat', sans-serif;
        font-size: 14.5px; font-weight: 700;
        text-decoration: none;
        box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35);
        transition: all .3s ease;
    }
    .erc-wa-cta .fab.fa-whatsapp { font-size: 18px; }
    .erc-wa-cta:hover {
        background: #004aad; color: #ffc600;
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(0, 74, 173, 0.3);
        text-decoration: none;
    }
    .erc-wa-cta:focus-visible { outline: 3px solid #004aad; outline-offset: 3px; }

    /* ===== Relacionados ===== */
    .erc-cd__related { margin-top: 46px; }
    .erc-cd__related-head { display: flex; align-items: baseline; justify-content: space-between; gap: 14px; flex-wrap: wrap; margin-bottom: 22px; }
    .erc-cd__related-title {
        font-family: 'Montserrat', sans-serif; font-size: 24px; font-weight: 800; color: #1d2025; margin: 0;
        display: flex; align-items: center; gap: 12px;
    }
    .erc-cd__related-title::before { content: ''; width: 30px; height: 3px; border-radius: 3px; background: #ffc600; }
    .erc-cd__related-link { color: #004aad; font-size: 13.5px; font-weight: 700; text-decoration: none; }
    .erc-cd__related-link:hover { color: #07294d; text-decoration: none; }

    .erc-cd__rel-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
    .erc-cd__rel-card {
        background: #fff; border: 1px solid #eceff5; border-radius: 16px; overflow: hidden;
        text-decoration: none; display: flex; flex-direction: column;
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .erc-cd__rel-card:hover { transform: translateY(-5px); box-shadow: 0 16px 34px rgba(0, 74, 173, 0.14); text-decoration: none; }
    .erc-cd__rel-media { aspect-ratio: 16 / 8; overflow: hidden; background: linear-gradient(135deg, #eef3fa, #e2ebf7); }
    .erc-cd__rel-media img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
    .erc-cd__rel-card:hover .erc-cd__rel-media img { transform: scale(1.05); }
    .erc-cd__rel-media img.erc-cd__rimg--fallback { object-fit: contain; padding: 26px; background: linear-gradient(135deg, #004aad, #4a86e8); }
    .erc-cd__rel-body { padding: 16px 18px 18px; display: flex; flex-direction: column; flex: 1; }
    .erc-cd__rel-body span { font-size: 11.5px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #004aad; }
    .erc-cd__rel-body h3 { font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 700; color: #1d2025; margin: 6px 0 0; line-height: 1.45; }

    /* Responsivo */
    @media (max-width: 991px) {
        .erc-cd__sidebar { position: static; margin-bottom: 26px; }
    }
    @media (max-width: 767px) {
        .erc-cd { padding: 46px 0 70px; }
        .erc-cd__card { padding: 24px 20px 18px; }
        .erc-cd__title { font-size: 22px; }
        .erc-cd__rel-grid { grid-template-columns: 1fr; }
    }

    /* Movimiento reducido */
    @media (prefers-reduced-motion: reduce) {
        .erc-cd__teacher, .erc-cd__rel-card, .erc-cd__rel-media img,
        .erc-wa-cta, .erc-cd__brochure { transition: none !important; }
        .erc-cd__rel-card:hover, .erc-cd__teacher:hover { transform: none; }
        .erc-cd__rel-card:hover .erc-cd__rel-media img { transform: none; }
        .erc-wa-cta:hover, .erc-cd__brochure:hover { transform: none; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero compartido del sitio (mismo estilo que el resto de páginas internas) ======== --}}
    <x-page-hero
        eyebrow="Formación ERIOS"
        :title="$course?->description ?: ($item?->name ?: 'Curso')"
        :subtitle="\Illuminate\Support\Str::limit(trim(strip_tags($item?->description ?? '')), 120) ?: 'Capacitación especializada con certificación.'"
        heroComponent="hero_servicios_13"
        crumbLabel="Cursos"
        :crumbUrl="route('web_courses')" />

    <section class="erc-cd">
        <div class="container">
            <div class="row g-4">

                {{-- ======== Columna principal ======== --}}
                <div class="col-lg-8">
                    <article class="erc-cd__card" data-reveal>
                        <div class="erc-cd__chips">
                            <span class="erc-cd__chip erc-cd__chip--cat">
                                <i class="fa fa-tag" aria-hidden="true"></i> {{ $course?->category?->description ?? 'Curso' }}
                            </span>
                            @if ($course?->modality?->description)
                                <span class="erc-cd__chip erc-cd__chip--mod">
                                    <i class="fa fa-video-camera" aria-hidden="true"></i> {{ $course->modality->description }}
                                </span>
                            @endif
                            @if ($course?->type_description)
                                <span class="erc-cd__chip erc-cd__chip--mod">
                                    <i class="fa fa-folder-open-o" aria-hidden="true"></i> {{ $course->type_description }}
                                </span>
                            @endif
                        </div>

                        {{-- El H1 vive en el hero; aquí va h2 para no duplicarlo (SEO) --}}
                        <h2 class="erc-cd__title">{{ $course?->description }}</h2>

                        @if($course?->image)
                            <div class="erc-cd__media">
                                <img src="{{ asset('storage/' . $course->image) }}"
                                    alt="{{ $course->description }}"
                                    onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-cd__img--fallback');">
                            </div>
                        @endif

                        <h3 class="erc-cd__section-title">Sobre el curso</h3>
                        <p class="erc-cd__text">{{ $course?->description }}</p>

                        @if($course?->sector_description)
                            <p class="erc-cd__text"><b>Sector:</b> {{ $course->sector_description }}</p>
                        @endif

                        @if($course?->certificate_description || $course?->certificate_title)
                            <h3 class="erc-cd__section-title">Certificación</h3>
                            <div class="erc-cd__cert">
                                <i class="fa fa-certificate" aria-hidden="true"></i>
                                <div>
                                    <b>{{ $course->certificate_title }}</b>
                                    @if($course->certificate_description)
                                        <span>{{ $course->certificate_description }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($course && $course->modules->count() > 0)
                            <h3 class="erc-cd__section-title">Temario</h3>
                            <ol class="erc-cd__modules">
                                @foreach($course->modules as $module)
                                    <li>
                                        <span class="erc-cd__mod-num">{{ $loop->iteration }}</span>
                                        <span>{{ $module->description ?? 'Módulo ' . $loop->iteration }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        @endif

                        @if($course && $course->teachers->count() > 0)
                            <h3 class="erc-cd__section-title">Docentes</h3>
                            <div class="erc-cd__teachers">
                                @foreach($course->teachers as $teacherCourse)
                                    @php
                                        $person = $teacherCourse?->teacher?->person;
                                        $teacherName = $teacherCourse?->teacher?->person?->formatted_name ?? 'Docente ERIOS';
                                    @endphp
                                    <div class="erc-cd__teacher">
                                        <img src="{{ $person?->image ? asset('storage/' . $person->image) : asset('themes/webpage/images/logo-2.png') }}"
                                            alt="{{ $teacherName }}"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-cd__timg--fallback');">
                                        <div>
                                            <b>{{ $teacherName }}</b>
                                            <span>{{ $person?->profession ?: 'Docente' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </article>
                </div>

                {{-- ======== Sidebar: precio, brochure e inscripción ======== --}}
                <div class="col-lg-4">
                    <div class="erc-cd__sidebar" data-reveal data-reveal-delay="120">
                        <div class="erc-cd__price-card">
                            <span class="erc-cd__price-label">Inversión</span>
                            <div class="erc-cd__price">S/ {{ number_format((float) ($course?->price ?? 0), 2, '.', '') }}</div>

                            @if($course?->discount && $course->discount_applies)
                                <span class="erc-cd__price-note erc-cd__price-note--off">
                                    <i class="fa fa-tag" aria-hidden="true"></i> Incluye descuento ({{ $course->discount }}%)
                                </span>
                            @else
                                <span class="erc-cd__price-note erc-cd__price-note--single">Pago único</span>
                            @endif

                            <ul class="erc-cd__features">
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Acceso al aula virtual</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Material descargable</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Certificado digital</li>
                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> Soporte del docente</li>
                            </ul>

                            @if($course?->brochure && $course->brochure->path_file)
                                <a href="{{ asset('storage/' . $course->brochure->path_file) }}"
                                    target="_blank" class="erc-cd__brochure">
                                    <i class="fa fa-download" aria-hidden="true"></i> Descargar brochure
                                </a>
                            @endif

                            {{-- Botón de carrito desactivado por ahora — reactivar cuando se use el flujo de compra (agrega al carrito y redirige) --}}
                            {{--
                            <button type="button" class="btn btn-primary w-100" onclick="procederInscripcionDesc()">
                                Inscribirme ahora
                            </button>
                            --}}

                            {{-- CTA de WhatsApp: mismo estilo visual del sitio, mensaje prellenado con el título del curso --}}
                            @php
                                $courseTitle = $course?->description ?: ($item?->name ?: 'Curso');
                                $waBuyLink = 'https://wa.me/51933435823?text=' . rawurlencode('¡Hola! Deseo comprar el curso: ' . $courseTitle);
                            @endphp
                            <a href="{{ $waBuyLink }}" target="_blank" rel="noopener" class="erc-wa-cta">
                                <i class="fab fa-whatsapp" aria-hidden="true"></i> Escríbeme ahora
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ======== Otros cursos ======== --}}
            @if(isset($latest_courses) && count($latest_courses) > 0)
                <div class="erc-cd__related" data-reveal>
                    <div class="erc-cd__related-head">
                        <h2 class="erc-cd__related-title">Otros cursos que te pueden interesar</h2>
                        <a href="{{ route('web_courses') }}" class="erc-cd__related-link">
                            Ver todos los cursos <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="erc-cd__rel-grid">
                        @foreach($latest_courses as $latest)
                            <a href="{{ route('web_curso_descripcion', $latest->course?->slug ?? $latest->id) }}" class="erc-cd__rel-card">
                                <div class="erc-cd__rel-media">
                                    @if($latest->course?->image)
                                        <img src="{{ asset('storage/' . $latest->course->image) }}"
                                            alt="{{ $latest->course?->description }}" loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-cd__rimg--fallback');">
                                    @else
                                        <img src="{{ asset('themes/webpage/images/logo-2.png') }}" alt="{{ $latest->course?->description }}" loading="lazy"
                                            class="erc-cd__rimg--fallback">
                                    @endif
                                </div>
                                <div class="erc-cd__rel-body">
                                    <span>{{ $latest->course?->category?->description ?? 'Curso ERIOS' }}</span>
                                    <h3>{{ \Illuminate\Support\Str::limit($latest->course?->description ?? 'Curso', 70) }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div> <!-- container -->
    </section>
@endsection

@section('javascripts')
    <script>
        function procederInscripcionDesc() {
            if (window.Swal === undefined) {
                console.error("SweetAlert2 (Swal) no está cargado.");
                return;
            }

            Swal.fire({
                title: '¿Inscribirte en este curso?',
                text: 'Se agregará al carrito para completar tu compra.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar',
                padding: '2em',
                customClass: 'sweet-alerts',
            }).then((result) => {
                if (result.isConfirmed) {
                    // 1. Limpiar el carrito (mismo flujo que la landing)
                    localStorage.removeItem('carrito');

                    // 2. Crear el producto con el item del curso
                    var producto = {
                        id: @json($onli_item_id ?? 0),
                        nombre: @json($course?->description ?? 'Curso'),
                        precio: @json($course?->price ?? 0),
                        image: "{{ $course?->image ?? '' }}"
                    };

                    // 3. Agregar al localStorage
                    var carrito = [];
                    carrito.push(producto);
                    localStorage.setItem('carrito', JSON.stringify(carrito));

                    // 4. Redireccionar al carrito
                    window.location.href = "{{ route('web_carrito') }}";
                }
            });
        }
    </script>
@endsection
