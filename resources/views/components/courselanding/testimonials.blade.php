@props(['landing'])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->testimonials_section ?? null);
    $items = collect(\App\Support\CourseLandingPresenter::items($landing->testimonials_section ?? null))
        ->filter(fn ($item) => filled($item['description'] ?? null))
        ->values();

    $carousel = $items->isNotEmpty() ? $items->concat($items) : $items;
    $fallbackLogo = asset('themes/webpage/images/logo-2.png');
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--soft erc-cl-testi">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-quote-right" />
        </div>

        @if ($items->isNotEmpty())
            <div class="erc-cl-testi__viewport">
                <div class="erc-cl-testi__track">
                    @foreach ($carousel as $testimonial)
                        <figure class="erc-cl-testi__card">
                            <span class="erc-cl-testi__mark" aria-hidden="true">&ldquo;</span>

                            <blockquote class="erc-cl-testi__quote">{{ $testimonial['description'] }}</blockquote>

                            <figcaption class="erc-cl-testi__author">
                                @if (filled($testimonial['image'] ?? null))
                                    <img src="{{ \App\Support\CourseLandingPresenter::image($testimonial['image']) }}"
                                        alt="{{ $testimonial['name'] ?? 'Testimonio' }}" loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';">
                                @endif
                                <span>
                                    <strong>{{ $testimonial['name'] ?? '' }}</strong>
                                    @if (filled($testimonial['presentation'] ?? null))
                                        <small>{{ $testimonial['presentation'] }}</small>
                                    @endif
                                </span>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        @endif

        <style>
            /* ============ ERIOS · Landing de curso · Testimonios ============ */
            .erc-cl-testi__viewport { overflow: hidden; padding: 8px 0 40px; position: relative; width: 100%; }
            .erc-cl-testi__track {
                display: flex;
                gap: 30px;
                width: max-content;
                padding: 0 15px;
                animation: erc-cl-testi-scroll 60s linear infinite;
            }
            .erc-cl-testi__track:hover { animation-play-state: paused; }
            @keyframes erc-cl-testi-scroll {
                0% { transform: translateX(0); }
                50% { transform: translateX(-50%); }
                100% { transform: translateX(0); }
            }

            .erc-cl-testi__card {
                flex: none;
                width: 350px;
                min-height: 250px;
                margin: 0;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background: #fff;
                border: 1px solid var(--erc-line);
                border-radius: var(--erc-radius);
                padding: 28px 26px 26px;
                box-shadow: var(--erc-shadow);
                transition: all .3s ease;
            }
            .erc-cl-testi__card:hover {
                transform: translateY(-8px);
                border-color: rgba(255, 198, 0, 0.6);
                box-shadow: var(--erc-shadow-hover);
            }
            .erc-cl-testi__mark {
                display: block;
                font-family: Georgia, serif;
                font-size: 44px;
                line-height: .8;
                color: var(--erc-yellow);
                margin-bottom: 10px;
            }
            .erc-cl-testi__quote {
                flex: 1;
                font-family: 'Roboto', sans-serif;
                font-size: 15px;
                line-height: 26px;
                font-style: italic;
                color: #343a40;
                margin: 0 0 20px;
            }
            .erc-cl-testi__author { display: flex; align-items: center; gap: 14px; }
            .erc-cl-testi__author img {
                width: 56px;
                height: 56px;
                flex: none;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid var(--erc-blue);
                background: var(--erc-chip);
            }
            .erc-cl-testi__author strong {
                display: block;
                font-family: 'Montserrat', sans-serif;
                font-size: 15px;
                font-weight: 700;
                color: var(--erc-ink);
            }
            .erc-cl-testi__author small { display: block; font-size: 13px; color: var(--erc-muted); }

            @media (max-width: 767px) {
                .erc-cl-testi__card { width: 290px; padding: 24px 20px; }
            }
        </style>
    </section>
@endif
