@props(['landing'])

@php
    use Illuminate\Support\Str;

    $course = $landing->course ?? null;

    $category = $course?->category?->description ?: 'Curso de especialización';
    $title = $course?->description ?: ($course?->name ?: 'Curso de especialización');
    $modality = $course?->modality?->description;

    $languageLabel = \Modules\Academic\Entities\AcaCourseLanding::getLanguageOptions()[$landing->banner_language ?? 'es']
        ?? ($landing->banner_language ?: null);

    $startDate = $landing->banner_start_date ? \Carbon\Carbon::parse($landing->banner_start_date) : null;
    $endDate = $landing->banner_end_date ? \Carbon\Carbon::parse($landing->banner_end_date) : null;

    // Duracion: mismo criterio que la landing de referencia (dias / meses / años).
    $duration = null;
    if ($startDate && $endDate) {
        $totalDays = $startDate->diffInDays($endDate) + 1;
        if ($totalDays < 30) {
            $duration = ceil($totalDays) . ' día(s)';
        } elseif ($totalDays < 365) {
            $duration = ceil($startDate->diffInMonths($endDate)) . ' mes(es)';
        } else {
            $years = floor($totalDays / 365);
            $months = floor(($totalDays % 365) / 30);
            $duration = $years . ' año(s)' . ($months > 0 ? ' ' . $months . ' mes(es)' : '');
        }
    } elseif (filled($landing->banner_duration)) {
        $duration = (int) $landing->banner_duration . ' día(s)';
    }

    $video = filled($landing->banner_video_link ?? null) ? $landing->banner_video_link : null;

    $fallbackLogo = asset('themes/webpage/images/logo-2.png');
    $image = filled($course?->image ?? null)
        ? \App\Support\CourseLandingPresenter::image($course->image)
        : $fallbackLogo;

    $whatsappLink = $landing->whatsapp_link ?: null;

    // Ancla al bloque de inversion (mismo id que genera la seccion investment).
    $investmentAnchor = 'erc-cl-inv-' . ($landing->id ?: Str::slug($landing->url_slug ?: 'curso'));

    $meta = array_values(array_filter([
        $startDate ? ['icon' => 'fa-calendar', 'text' => 'Inicio: ' . $startDate->locale('es')->isoFormat('D [de] MMMM')] : null,
        filled($duration) ? ['icon' => 'fa-clock-o', 'text' => 'Duración: ' . $duration] : null,
        filled($modality) ? ['icon' => 'fa-video-camera', 'text' => 'Modalidad: ' . $modality] : null,
        filled($languageLabel) ? ['icon' => 'fa-globe', 'text' => $languageLabel] : null,
    ]));
@endphp

<section class="erc-cl-hero">
    <div class="erc-cl-hero__overlay" aria-hidden="true"></div>
    <span class="erc-cl-hero__ring erc-cl-hero__ring--a" aria-hidden="true"></span>
    <span class="erc-cl-hero__ring erc-cl-hero__ring--b" aria-hidden="true"></span>

    <div class="container erc-cl-hero__container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="erc-cl-hero__body">
                    <nav class="erc-cl-hero__crumbs" aria-label="breadcrumb">
                        <ol>
                            <li><a href="{{ route('index_main') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
                            <li><a href="{{ route('web_courses') }}">Cursos</a></li>
                            <li class="erc-cl-hero__crumb-current" aria-current="page">{{ Str::limit($title, 52) }}</li>
                        </ol>
                    </nav>

                    <span class="erc-cl-hero__badge">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        {{ $category }}
                    </span>

                    <h1 class="erc-cl-hero__title">{{ $title }}</h1>

                    <p class="erc-cl-hero__text">
                        Programa de ERIOS CONSULTORES con plana docente especializada, material
                        actualizado y certificación al finalizar.
                    </p>

                    @if ($meta !== [])
                        <ul class="erc-cl-hero__meta">
                            @foreach ($meta as $item)
                                <li>
                                    <i class="fa {{ $item['icon'] }}" aria-hidden="true"></i>
                                    {{ $item['text'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="erc-cl-hero__actions">
                        <a href="#{{ $investmentAnchor }}" class="erc-btn erc-btn--yellow erc-btn--lg">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Inscribirme ahora
                        </a>

                        @if ($whatsappLink)
                            <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer"
                                class="erc-btn erc-btn--ghost erc-btn--lg">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                Hablar con un asesor
                            </a>
                        @else
                            <a href="#{{ $investmentAnchor }}" class="erc-btn erc-btn--ghost erc-btn--lg">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                Ver inversión
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="erc-cl-hero__media" data-reveal data-reveal-delay="120">
                    @if ($video)
                        <div class="erc-cl-ratio erc-cl-hero__ratio">{!! $video !!}</div>
                    @else
                        <img src="{{ $image }}" alt="{{ $title }}" class="erc-cl-hero__img"
                            onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';this.classList.add('erc-cl-hero__img--fallback');">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ============ ERIOS · Landing de curso · Hero ============ */
        .erc-cl-hero {
            position: relative;
            overflow: hidden;
            padding: 62px 0 70px;
            background: linear-gradient(135deg, #051d38 0%, #07294d 48%, #0b3a6b 100%);
            font-family: 'Montserrat', sans-serif;
        }
        .erc-cl-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg, rgba(5, 29, 56, 0.96) 0%, rgba(7, 41, 77, 0.88) 45%, rgba(11, 58, 107, 0.5) 100%);
        }
        .erc-cl-hero__overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 198, 0, 0.06), transparent 42%);
        }
        .erc-cl-hero__ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 198, 0, 0.16);
            pointer-events: none;
        }
        .erc-cl-hero__ring--a { width: 300px; height: 300px; top: -110px; right: -70px; }
        .erc-cl-hero__ring--b { width: 400px; height: 400px; bottom: -190px; left: -120px; }

        .erc-cl-hero__container { position: relative; z-index: 2; }
        .erc-cl-hero__body { max-width: 640px; }

        .erc-cl-hero__crumbs { margin-bottom: 20px; }
        .erc-cl-hero__crumbs ol {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin: 0;
            padding: 0;
        }
        .erc-cl-hero__crumbs li { font-size: 13.5px; font-weight: 500; color: rgba(255, 255, 255, 0.85); }
        .erc-cl-hero__crumbs a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #ffc600;
            text-decoration: none;
            transition: color .3s ease;
        }
        .erc-cl-hero__crumbs a:hover { color: #fff; text-decoration: none; }
        .erc-cl-hero__crumb-current { position: relative; padding-left: 16px; }
        .erc-cl-hero__crumb-current::before {
            content: '/';
            position: absolute;
            left: 0;
            color: rgba(255, 255, 255, 0.4);
        }

        .erc-cl-hero__badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            color: #fff;
            font-weight: 600;
            font-size: 12.5px;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            padding: 8px 18px;
            border-radius: 50px;
            margin-bottom: 20px;
        }
        .erc-cl-hero__badge i { color: #ffc600; }

        .erc-cl-hero__title {
            color: #fff;
            font-size: 42px;
            font-weight: 700;
            line-height: 1.16;
            margin: 0 0 16px;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.32);
        }
        .erc-cl-hero__text {
            color: rgba(255, 255, 255, 0.82);
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 28px;
            margin: 0 0 22px;
            max-width: 560px;
        }

        .erc-cl-hero__meta {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0 0 26px;
            padding: 0;
        }
        .erc-cl-hero__meta li {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: rgba(255, 255, 255, 0.92);
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            padding: 8px 15px;
            border-radius: 50px;
        }
        .erc-cl-hero__meta li i { color: #ffc600; }

        .erc-cl-hero__actions { display: flex; flex-wrap: wrap; gap: 14px; }

        .erc-cl-hero__media { padding-left: 20px; }
        .erc-cl-hero__img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
            border-radius: 16px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        }
        .erc-cl-hero__img--fallback {
            object-fit: contain;
            padding: 44px;
            background: rgba(255, 255, 255, 0.06);
        }
        .erc-cl-hero__ratio { border: 4px solid rgba(255, 255, 255, 0.1); box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35); }

        @media (max-width: 991px) {
            .erc-cl-hero { padding: 48px 0 54px; text-align: center; }
            .erc-cl-hero__body { margin: 0 auto; }
            .erc-cl-hero__crumbs ol,
            .erc-cl-hero__meta,
            .erc-cl-hero__actions { justify-content: center; }
            .erc-cl-hero__text { margin-left: auto; margin-right: auto; }
            .erc-cl-hero__title { font-size: 32px; }
            .erc-cl-hero__media { padding: 34px 0 0; }
        }
        @media (max-width: 575px) {
            .erc-cl-hero__title { font-size: 26px; }
            .erc-cl-hero__text { font-size: 15px; line-height: 26px; }
            .erc-cl-hero__meta li { font-size: 12.5px; }
            .erc-cl-hero__actions .erc-btn { width: 100%; }
        }
    </style>
</section>
