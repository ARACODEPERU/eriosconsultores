@props(['landing'])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->study_plan_section ?? null);
    $items = \App\Support\CourseLandingPresenter::items($landing->study_plan_section ?? null);
    $image = filled($section['image'] ?? null)
        ? \App\Support\CourseLandingPresenter::image($section['image'])
        : null;
    $fallbackLogo = asset('themes/webpage/images/logo-2.png');
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--soft erc-cl-plan">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-list-ul" />

            <div class="row align-items-center">
                @if ($image)
                    <div class="col-lg-5" data-reveal>
                        <div class="erc-cl-plan__media">
                            <img src="{{ $image }}" alt="{{ $section['title'] ?? 'Temario del curso' }}"
                                class="erc-media erc-cl-plan__img" loading="lazy"
                                onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';this.classList.add('erc-media--fallback');">
                            <span class="erc-cl-plan__badge">Módulos 100% actualizados</span>
                        </div>
                    </div>
                @endif

                @if ($items !== [])
                    <div class="{{ $image ? 'col-lg-7' : 'col-lg-10 offset-lg-1' }}" data-reveal data-reveal-delay="120">
                        <ol class="erc-cl-plan__list">
                            @foreach ($items as $item)
                                <li class="erc-cl-plan__item">
                                    <span class="erc-cl-plan__num">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                                    <div class="erc-cl-plan__text">
                                        <h3>{{ $item['title'] ?? '' }}</h3>
                                        @if (filled($item['description'] ?? null))
                                            <p>{{ $item['description'] }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
        </div>

        <style>
            /* ============ ERIOS · Landing de curso · Plan de estudios ============ */
            .erc-cl-plan__media { position: relative; margin-bottom: 26px; }
            .erc-cl-plan__img { border: 8px solid #fff; }
            .erc-cl-plan__badge {
                position: absolute;
                left: 24px;
                bottom: 24px;
                background: var(--erc-yellow);
                color: var(--erc-navy);
                font-family: 'Montserrat', sans-serif;
                font-size: 13px;
                font-weight: 700;
                padding: 10px 18px;
                border-radius: 10px;
                box-shadow: 0 10px 24px rgba(255, 198, 0, 0.4);
            }

            .erc-cl-plan__list {
                list-style: none;
                margin: 0;
                padding: 0;
                position: relative;
            }
            .erc-cl-plan__item {
                position: relative;
                display: flex;
                align-items: flex-start;
                gap: 18px;
                padding-bottom: 26px;
            }
            .erc-cl-plan__item:last-child { padding-bottom: 0; }
            /* Linea vertical que une los modulos */
            .erc-cl-plan__item:not(:last-child)::before {
                content: '';
                position: absolute;
                left: 23px;
                top: 48px;
                bottom: 4px;
                width: 2px;
                background: linear-gradient(180deg, rgba(0, 74, 173, 0.25), rgba(255, 198, 0, 0.35));
            }
            .erc-cl-plan__num {
                position: relative;
                z-index: 1;
                flex: none;
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--erc-blue);
                color: #fff;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                font-weight: 700;
                box-shadow: 0 8px 18px rgba(0, 74, 173, 0.28);
                transition: all .35s ease;
            }
            .erc-cl-plan__item:hover .erc-cl-plan__num { background: var(--erc-yellow); color: var(--erc-navy); }

            .erc-cl-plan__text {
                background: #fff;
                border: 1px solid var(--erc-line);
                border-radius: 14px;
                padding: 18px 22px;
                flex: 1;
                box-shadow: 0 6px 20px rgba(14, 23, 38, 0.04);
                transition: all .3s ease;
            }
            .erc-cl-plan__item:hover .erc-cl-plan__text {
                border-color: rgba(255, 198, 0, 0.6);
                transform: translateX(4px);
            }
            .erc-cl-plan__text h3 {
                font-family: 'Montserrat', sans-serif;
                font-size: 17px;
                font-weight: 700;
                color: var(--erc-ink);
                margin: 0 0 6px;
            }
            .erc-cl-plan__text p { font-size: 14.5px; line-height: 25px; color: var(--erc-muted); margin: 0; }

            @media (max-width: 767px) {
                .erc-cl-plan__item { gap: 14px; }
                .erc-cl-plan__num { width: 42px; height: 42px; font-size: 14px; }
                .erc-cl-plan__item:not(:last-child)::before { left: 20px; top: 42px; }
                .erc-cl-plan__text { padding: 16px 18px; }
            }
        </style>
    </section>
@endif
