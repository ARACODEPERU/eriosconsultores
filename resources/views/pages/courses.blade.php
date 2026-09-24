@extends('layouts.webpage')

@section('meta_title', 'Cursos')
@section('meta_description', 'Catálogo de cursos y diplomados de ERIOS CONSULTORES: modalidades En Vivo, Presencial y E-learning, horarios flexibles y certificación incluida. ¡Inscríbete ya!')

@section('page_styles')
<style>
    /* ============ ERIOS · Catálogo de cursos ============ */
    .erc-courses { padding: 80px 0 100px; background: #f4f7fb; }
    .erc-courses__head {
        text-align: center;
        max-width: 720px;
        margin: 0 auto 44px;
        padding: 0 15px;
    }
    .erc-courses__eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #004aad;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
    .erc-courses__eyebrow::before,
    .erc-courses__eyebrow::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-courses__eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
    .erc-courses__eyebrow::after { left: 50%; transform: translateX(8px); }
    .erc-courses__head h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 36px;
        font-weight: 700;
        color: #1d2025;
        margin: 0;
    }
    .erc-courses__head p {
        font-size: 16px;
        line-height: 28px;
        color: #505050;
        margin: 14px 0 0;
    }

    /* ---- Barra de filtros ---- */
    .erc-courses__bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 34px;
        box-shadow: 0 6px 24px rgba(14, 23, 38, 0.05);
    }
    .erc-courses__tabs { display: flex; flex-wrap: wrap; gap: 8px; }
    .erc-courses__tab {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 13.5px;
        color: #50607a;
        background: #f1f5fb;
        border: 1px solid transparent;
        border-radius: 50px;
        padding: 9px 20px;
        cursor: pointer;
        transition: all .3s ease;
        text-decoration: none;
    }
    .erc-courses__tab:hover { color: #004aad; border-color: rgba(0, 74, 173, 0.25); text-decoration: none; }
    .erc-courses__tab.is-active {
        background: #004aad;
        color: #fff;
        box-shadow: 0 6px 16px rgba(0, 74, 173, 0.28);
    }
    .erc-courses__tab.is-active:hover { color: #fff; }
    .erc-courses__count {
        font-size: 14px;
        color: #8a95a7;
        white-space: nowrap;
    }
    .erc-courses__count b { color: #004aad; }

    /* ---- Grid de tarjetas ---- */
    .erc-courses__grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }
    @media (max-width: 991px) { .erc-courses__grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 575px) { .erc-courses__grid { grid-template-columns: 1fr; } }

    .erc-course-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(14, 23, 38, 0.06);
        transition: transform .35s ease, box-shadow .35s ease;
        display: flex;
        flex-direction: column;
    }
    .erc-course-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0, 74, 173, 0.14);
    }
    .erc-course-card__media {
        position: relative;
        height: 180px;
        background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
        overflow: hidden;
    }
    .erc-course-card__img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }
    .erc-course-card:hover .erc-course-card__img { transform: scale(1.06); }
    .erc-course-card__img--fallback {
        width: auto;
        height: 92px;
        margin: 0 auto;
        object-fit: contain;
        filter: brightness(0) invert(1);
        opacity: .92;
        padding: 0 28px;
    }
    .erc-course-card__price {
        position: absolute;
        right: 14px;
        bottom: 14px;
        background: #ffc600;
        color: #07294d;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        padding: 7px 16px;
        border-radius: 50px;
        box-shadow: 0 8px 20px rgba(255, 198, 0, 0.4);
    }
    .erc-course-card__modality {
        position: absolute;
        left: 14px;
        top: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(7, 41, 77, 0.72);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .4px;
        padding: 6px 12px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.22);
    }
    .erc-course-card__modality i { color: #ffc600; font-size: 11px; }
    .erc-course-card__body {
        padding: 22px 24px 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .erc-course-card__category {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: #004aad;
        margin-bottom: 8px;
    }
    .erc-course-card__title {
        font-size: 18px;
        font-weight: 700;
        color: #1d2025;
        line-height: 1.4;
        margin: 0 0 10px;
    }
    .erc-course-card__text {
        font-size: 14px;
        line-height: 24px;
        color: #6a7688;
        margin: 0 0 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .erc-course-card__actions {
        margin-top: auto;
        padding-top: 6px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .erc-course-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 13.5px;
        padding: 11px 20px;
        border-radius: 5px;
        border: 2px solid transparent;
        cursor: pointer;
        text-decoration: none;
        transition: all .35s ease;
        line-height: 1;
    }
    .erc-course-btn:hover { text-decoration: none; transform: translateY(-2px); }
    .erc-course-btn--info {
        background: #ffc600;
        color: #07294d;
        box-shadow: 0 6px 18px rgba(255, 198, 0, 0.22);
    }
    .erc-course-btn--info:hover {
        background: #004aad;
        color: #ffc600;
        box-shadow: 0 10px 24px rgba(0, 74, 173, 0.4);
    }
    .erc-course-btn--info:hover .erc-anim-arrow { transform: translateX(6px); }
    .erc-course-btn--wa {
        border-color: rgba(37, 211, 102, 0.6);
        color: #25D366;
        background: transparent;
    }
    .erc-course-btn--wa:hover {
        background: #25D366;
        border-color: #25D366;
        color: #fff;
        box-shadow: 0 10px 24px rgba(37, 211, 102, 0.35);
    }

    /* ---- Estado vacío ---- */
    .erc-courses__empty {
        text-align: center;
        background: #fff;
        border: 1px dashed #cfd9e8;
        border-radius: 16px;
        padding: 70px 30px;
    }
    .erc-courses__empty i {
        font-size: 44px;
        color: #b9c6d8;
        margin-bottom: 18px;
    }
    .erc-courses__empty h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: #1d2025;
        margin: 0 0 8px;
    }
    .erc-courses__empty p { color: #6a7688; margin: 0 0 22px; }

    @media (max-width: 767px) {
        .erc-courses { padding: 55px 0 70px; }
        .erc-courses__head h2 { font-size: 27px; }
        .erc-courses__bar { flex-direction: column; align-items: stretch; }
        .erc-courses__count { text-align: center; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero de la página ======== --}}
    <x-page-hero eyebrow="Formación ERIOS" title="Catálogo de Cursos"
        subtitle="Capacítate con especialistas en materia tributaria, contable y empresarial: modalidades En Vivo, Presencial y E-learning, con certificación incluida."
        heroComponent="hero_cursos_15" />

    {{-- ======== Catálogo ======== --}}
    <section class="erc-courses">
        <div class="container">

            <div class="erc-courses__head" data-reveal>
                <span class="erc-courses__eyebrow">Nuestros cursos</span>
                <h2>Elige tu próximo curso</h2>
                <p>Programas prácticos dictados por docentes especializados, con horarios flexibles y certificado al
                    terminar.</p>
            </div>

            <div class="erc-courses__bar" data-reveal>
                <div class="erc-courses__tabs" id="ercCourseTabs">
                    <a href="#" class="erc-courses__tab is-active" data-category="all">
                        <i class="fa fa-th-large" aria-hidden="true"></i> Todos
                    </a>
                    @forelse ($categories as $cat)
                        <a href="#" class="erc-courses__tab" data-category="{{ $cat }}">
                            <i class="fa fa-tags" aria-hidden="true"></i> {{ $cat }}
                        </a>
                    @empty
                    @endforelse
                </div>
                <span class="erc-courses__count">Mostrando <b id="ercCoursesVisible">{{ $courses->count() }}</b> de
                    {{ $courses->count() }} cursos</span>
            </div>

            @if ($courses->isEmpty())
                <div class="erc-courses__empty" data-reveal>
                    <i class="fa fa-book-open" aria-hidden="true"></i>
                    <h3>Pronto nuevos cursos</h3>
                    <p>Estamos preparando nuestro catálogo. Mientras tanto, escríbenos y te informamos de las próximas
                        fechas.</p>
                    <a href="{{ route('web_contact_us') }}" class="erc-course-btn erc-course-btn--info">
                        Contáctanos <i class="fa fa-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                    </a>
                </div>
            @else
                <div class="erc-courses__grid" id="ercCoursesGrid">
                    @foreach ($courses as $course)
                        @php
                            $aca = $course->course;
                            $category = ($course->category_description ?: optional(optional($aca)->category)->description) ?: 'General';
                            $modality = $aca && $aca->modality ? $aca->modality->description : null;
                            $price = $course->discount > 0 && $course->discount < $course->price ? $course->discount : $course->price;
                            $price = $price > 0 ? 'S/ ' . number_format($price, 0) : 'Consultar';
                            $desc = trim(strip_tags($course->description ?? ''));
                            $modalityIcon = match ($modality) {
                                'Presencial' => 'fa-university',
                                'E-learning' => 'fa-laptop',
                                default => 'fa-video-camera',
                            };
                        @endphp
                        <article class="erc-course-card" data-category="{{ $category }}" data-reveal
                            data-reveal-delay="{{ ($loop->index % 3) * 110 }}">
                            <div class="erc-course-card__media">
                                <img src="{{ $course->image }}" alt="{{ $course->name }}" class="erc-course-card__img"
                                    onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-course-card__img--fallback');">
                                <span class="erc-course-card__modality">
                                    <i class="fa {{ $modalityIcon }}" aria-hidden="true"></i> {{ $modality ?? 'A distancia' }}
                                </span>
                                <span class="erc-course-card__price">{{ $price }}</span>
                            </div>
                            <div class="erc-course-card__body">
                                <span class="erc-course-card__category">{{ $category }}</span>
                                <h3 class="erc-course-card__title">{{ $course->name }}</h3>
                                @if ($desc)
                                    <p class="erc-course-card__text">{{ $desc }}</p>
                                @endif
                                <div class="erc-course-card__actions">
                                    <a href="{{ route('web_course_description') }}" class="erc-course-btn erc-course-btn--info">
                                        Ver curso <i class="fa fa-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                                    </a>
                                    <a href="https://wa.link/9q9g9v" target="_blank" rel="noopener"
                                        class="erc-course-btn erc-course-btn--wa">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i> Consultar
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div> <!-- container -->
    </section>

    <script>
        (function () {
            var tabs = document.querySelectorAll('#ercCourseTabs .erc-courses__tab');
            var cards = document.querySelectorAll('#ercCoursesGrid .erc-course-card');
            var counter = document.getElementById('ercCoursesVisible');
            if (!tabs.length || !cards.length) return;

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    tabs.forEach(function (t) { t.classList.remove('is-active'); });
                    tab.classList.add('is-active');
                    var cat = tab.getAttribute('data-category');
                    var visible = 0;
                    cards.forEach(function (card) {
                        var match = cat === 'all' || card.getAttribute('data-category') === cat;
                        card.style.display = match ? '' : 'none';
                        if (match) visible++;
                    });
                    if (counter) counter.textContent = visible;
                });
            });
        })();
    </script>

@endsection
