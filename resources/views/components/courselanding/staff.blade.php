@props(['landing', 'teachersPremium' => []])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->staff_section ?? null);

    $teachers = collect($teachersPremium)
        ->filter(fn ($teacher) => filled($teacher['name'] ?? null))
        ->unique('name')
        ->values();

    $count = $teachers->count();
    $fallbackLogo = asset('themes/webpage/images/logo-2.png');

    // Si hay pocos docentes se duplica la lista para que el marquee no quede vacio.
    $carousel = ($count > 0 && $count < 6)
        ? $teachers->concat($teachers)->values()
        : $teachers;
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--white erc-cl-staff">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-users" />
        </div>

        @if ($count > 0)
            <div class="erc-cl-staff__viewport">
                <div class="erc-cl-staff__track">
                    @foreach ($carousel as $teacher)
                        @php $modalIndex = $loop->index % $count; @endphp
                        <button type="button" class="erc-card erc-cl-staff__card" data-toggle="modal"
                            data-target="#erc-cl-staff-modal-{{ $modalIndex }}"
                            aria-label="Ver perfil de {{ $teacher['name'] }}">
                            <span class="erc-cl-staff__media">
                                <img src="{{ $teacher['img'] }}" alt="{{ $teacher['name'] }}" loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';this.classList.add('erc-cl-staff__img--fallback');">
                            </span>

                            <span class="erc-cl-staff__body">
                                <strong>{{ $teacher['name'] }}</strong>
                                @if (filled($teacher['role'] ?? null))
                                    <small>{{ $teacher['role'] }}</small>
                                @endif
                                <span class="erc-cl-staff__hint">
                                    Ver perfil <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </span>
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    @foreach ($teachers as $k => $teacher)
        @php
            $resumes = collect($teacher['resumes'] ?? []);
            $experiences = $resumes->filter(fn ($r) => ($r['type'] ?? null) === 'work experience');
            $visible = $experiences->isNotEmpty() ? $experiences : $resumes;
        @endphp
        <div class="modal fade erc-cl-staff__modal" id="erc-cl-staff-modal-{{ $k }}" tabindex="-1" role="dialog"
            aria-labelledby="erc-cl-staff-modal-title-{{ $k }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="erc-cl-staff__close" data-dismiss="modal" aria-label="Cerrar">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>

                    <div class="erc-cl-staff__modal-body">
                        <div class="erc-cl-staff__modal-head">
                            <img src="{{ $teacher['img'] }}" alt="{{ $teacher['name'] }}"
                                class="erc-cl-staff__modal-img"
                                onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';this.classList.add('erc-cl-staff__img--fallback');">
                            <h3 class="erc-cl-staff__modal-name" id="erc-cl-staff-modal-title-{{ $k }}">
                                {{ $teacher['name'] }}</h3>
                            @if (filled($teacher['role'] ?? null))
                                <span class="erc-cl-staff__modal-role">{{ $teacher['role'] }}</span>
                            @endif
                        </div>

                        <div class="erc-cl-staff__modal-resumes">
                            @if ($visible->isNotEmpty())
                                <ul class="erc-checklist">
                                    @foreach ($visible as $resume)
                                        <li>
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            <span>{!! $resume['description'] !!}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="erc-cl-staff__empty">No hay información disponible.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        /* ============ ERIOS · Landing de curso · Docentes ============ */
        .erc-cl-staff__viewport { overflow: hidden; padding: 6px 0 40px; position: relative; width: 100%; }
        .erc-cl-staff__track {
            display: flex;
            gap: 30px;
            width: max-content;
            padding: 0 15px;
            animation: erc-cl-staff-scroll 50s linear infinite;
        }
        .erc-cl-staff__track:hover { animation-play-state: paused; }
        .erc-cl-staff__track.is-centered { width: 100%; justify-content: center; animation: none; }
        @keyframes erc-cl-staff-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-50% - 15px)); }
        }

        .erc-cl-staff__card {
            flex: none;
            width: 272px;
            padding: 0;
            overflow: hidden;
            text-align: center;
            cursor: pointer;
            font: inherit;
            color: inherit;
        }
        .erc-cl-staff__media { display: block; height: 236px; overflow: hidden; background: var(--erc-chip); }
        .erc-cl-staff__media img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s ease; }
        .erc-cl-staff__card:hover .erc-cl-staff__media img { transform: scale(1.05); }
        .erc-cl-staff__img--fallback {
            object-fit: contain;
            padding: 30px;
            background: linear-gradient(135deg, var(--erc-navy), var(--erc-blue-mid));
        }

        .erc-cl-staff__body { display: block; padding: 20px 18px 22px; }
        .erc-cl-staff__body strong {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--erc-ink);
            line-height: 1.4;
        }
        .erc-cl-staff__body small { display: block; margin-top: 4px; font-size: 13.5px; color: var(--erc-yellow-dark); font-weight: 600; }
        .erc-cl-staff__hint {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 14px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--erc-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .erc-cl-staff__card:hover .erc-cl-staff__hint { color: var(--erc-yellow-dark); }

        /* ---- Modal ---- */
        .erc-cl-staff__modal .modal-dialog { max-width: 780px; }
        .erc-cl-staff__modal .modal-content {
            border: none;
            border-radius: var(--erc-radius);
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(7, 41, 77, 0.35);
        }
        .erc-cl-staff__close {
            position: absolute;
            top: 14px;
            right: 16px;
            z-index: 2;
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: rgba(7, 41, 77, 0.08);
            color: var(--erc-navy);
            font-size: 16px;
            line-height: 1;
            cursor: pointer;
            transition: all .25s ease;
        }
        .erc-cl-staff__close:hover { background: var(--erc-blue); color: #fff; }
        .erc-cl-staff__modal-body { display: flex; flex-wrap: wrap; }
        .erc-cl-staff__modal-head {
            flex: 1 1 260px;
            background: var(--erc-soft);
            padding: 34px 26px;
            text-align: center;
        }
        .erc-cl-staff__modal-img {
            width: 168px;
            height: 168px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 12px 30px rgba(7, 41, 77, 0.18);
        }
        .erc-cl-staff__modal-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 21px;
            font-weight: 700;
            color: var(--erc-ink);
            margin: 18px 0 4px;
        }
        .erc-cl-staff__modal-role { display: block; font-size: 14px; font-weight: 600; color: var(--erc-yellow-dark); }
        .erc-cl-staff__modal-resumes { flex: 1 1 380px; padding: 34px 30px; max-height: 70vh; overflow-y: auto; }
        .erc-cl-staff__modal-resumes .erc-checklist li {
            background: var(--erc-soft);
            border: 1px solid var(--erc-line);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 12px;
        }
        .erc-cl-staff__modal-resumes .erc-checklist li i { color: var(--erc-blue); }
        .erc-cl-staff__empty { font-style: italic; color: var(--erc-muted); }

        @media (max-width: 767px) {
            .erc-cl-staff__card { width: 236px; }
            .erc-cl-staff__media { height: 198px; }
            .erc-cl-staff__modal-resumes { max-height: none; }
        }
    </style>

    @if ($count > 0 && $count < 6)
        <script>
            (function () {
                function fit(track) {
                    if (!track) return;
                    var viewport = track.parentElement;
                    if (!viewport) return;
                    if (track.scrollWidth <= viewport.offsetWidth) {
                        track.classList.add('is-centered');
                    } else {
                        track.classList.remove('is-centered');
                    }
                }

                function fitAll() {
                    document.querySelectorAll('.erc-cl-staff__track').forEach(fit);
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', fitAll);
                } else {
                    fitAll();
                }

                window.addEventListener('resize', fitAll);
            })();
        </script>
    @endif
@endif
