@props(['testimonials' => [], 'course' => null, 'schema' => null])

@php
    $items = collect($testimonials)->filter(fn ($item) => filled($item['quote'] ?? null))->values();
    $courseName = $course?->description ?: ($course?->name ?? 'este programa');
    $fallbackLogo = asset('themes/webpage/images/logo-2.png');
@endphp

{{-- Schema markup (JSON-LD) del curso, con su valoración agregada y reseñas --}}
@if (!empty($schema))
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
    </script>
@endif

@if ($items->isNotEmpty())
    <section class="erc-cl-sec erc-cl-sec--white erc-cl-ct">
        <div class="container">
            <x-courselanding.head
                eyebrow="Opiniones de alumnos"
                title="Lo que dicen de este curso"
                :description="'Testimonios reales de alumnos que ya llevaron ' . $courseName . '.'"
                icon="fa-star" />

            <div class="row">
                @foreach ($items as $testimonial)
                    @php
                        $quote = (string) ($testimonial['quote'] ?? '');
                        $limit = 260;
                        $isLong = mb_strlen($quote) > $limit;
                        $quoteShort = $isLong ? \Illuminate\Support\Str::substr($quote, 0, $limit) : $quote;
                        $quoteRest = $isLong ? \Illuminate\Support\Str::substr($quote, $limit) : '';
                        $collapseId = 'erc-cl-ct-quote-' . ($testimonial['id'] ?? $loop->index);
                        $videoModalId = 'erc-cl-ct-video-' . ($testimonial['id'] ?? $loop->index);
                        $rating = (int) ($testimonial['rating'] ?? 5);
                    @endphp

                    <div class="col-md-6 col-lg-4" data-reveal data-reveal-delay="{{ 80 * ($loop->index % 3 + 1) }}">
                        <article class="erc-card erc-cl-ct__card">
                            <span class="erc-cl-ct__stars" aria-label="{{ $rating }} de 5 estrellas">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star{{ $i <= $rating ? '' : '-o' }}" aria-hidden="true"></i>
                                @endfor
                            </span>

                            <span class="erc-cl-ct__mark" aria-hidden="true">&ldquo;</span>

                            <p class="erc-cl-ct__text">
                                {{ $quoteShort }}@if ($isLong)<span class="collapse" id="{{ $collapseId }}">{{ $quoteRest }}</span>@endif
                            </p>

                            @if ($isLong)
                                <button type="button" class="erc-cl-ct__more" data-toggle="collapse"
                                    data-target="#{{ $collapseId }}" aria-expanded="false"
                                    aria-controls="{{ $collapseId }}">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i> Leer más
                                </button>
                            @endif

                            <footer class="erc-cl-ct__author">
                                <img src="{{ ($testimonial['photo'] ?? null) ?: ($testimonial['avatar'] ?? $fallbackLogo) }}"
                                    alt="{{ $testimonial['author'] ?? 'Alumno' }}" class="erc-cl-ct__avatar" loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ $fallbackLogo }}';">
                                <div>
                                    <p class="erc-cl-ct__name">{{ $testimonial['author'] ?? '' }}</p>
                                    @if (filled($testimonial['role'] ?? null))
                                        <p class="erc-cl-ct__role">{{ $testimonial['role'] }}</p>
                                    @endif
                                </div>
                            </footer>

                            @if (!empty($testimonial['video']))
                                <button type="button" class="erc-cl-ct__video" data-toggle="modal"
                                    data-target="#{{ $videoModalId }}">
                                    <i class="fa fa-play" aria-hidden="true"></i> Ver video
                                </button>
                            @endif
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Modales con el video del testimonio --}}
        @foreach ($items as $testimonial)
            @if (!empty($testimonial['video']))
                @php $videoModalId = 'erc-cl-ct-video-' . ($testimonial['id'] ?? $loop->index); @endphp
                <div class="modal fade erc-cl-ct__modal" id="{{ $videoModalId }}" tabindex="-1" role="dialog"
                    aria-labelledby="{{ $videoModalId }}-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="{{ $videoModalId }}-title">
                                    {{ $testimonial['author'] ?? '' }} ·
                                    {{ \Illuminate\Support\Str::limit((string) ($testimonial['program'] ?? ''), 70) }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="erc-cl-ratio">{!! $testimonial['video'] !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <style>
            /* ============ ERIOS · Landing de curso · Testimonios de alumnos ============ */
            .erc-cl-ct__card {
                display: flex;
                flex-direction: column;
                margin-bottom: 26px;
                border-top: 4px solid var(--erc-blue);
            }
            .erc-cl-ct__card:hover { border-top-color: var(--erc-yellow); }
            .erc-cl-ct__stars { color: var(--erc-yellow); font-size: 13px; letter-spacing: 2px; margin-bottom: 10px; }
            .erc-cl-ct__mark {
                font-family: Georgia, serif;
                font-size: 32px;
                line-height: .8;
                color: var(--erc-blue);
                margin-bottom: 6px;
            }
            .erc-cl-ct__text {
                flex: 1;
                font-family: 'Roboto', sans-serif;
                font-size: 14.5px;
                line-height: 26px;
                font-style: italic;
                color: #4b5563;
                margin: 0;
            }
            .erc-cl-ct__more {
                align-self: flex-start;
                background: none;
                border: none;
                padding: 0;
                margin-top: 10px;
                color: var(--erc-blue);
                font-size: 12.5px;
                font-weight: 700;
                cursor: pointer;
            }
            .erc-cl-ct__more:hover { color: var(--erc-yellow-dark); }

            .erc-cl-ct__author {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-top: 20px;
                padding-top: 18px;
                border-top: 1px dashed #d8e0ea;
            }
            .erc-cl-ct__avatar {
                width: 52px;
                height: 52px;
                flex: none;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid var(--erc-blue);
                background: var(--erc-chip);
            }
            .erc-cl-ct__name {
                font-family: 'Montserrat', sans-serif;
                font-size: 15px;
                font-weight: 700;
                color: var(--erc-ink);
                margin: 0 0 2px;
            }
            .erc-cl-ct__role { font-size: 13px; color: var(--erc-muted); margin: 0; }

            .erc-cl-ct__video {
                align-self: flex-start;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: 16px;
                background: var(--erc-blue);
                color: #fff;
                font-family: 'Montserrat', sans-serif;
                font-size: 12.5px;
                font-weight: 700;
                border: none;
                border-radius: 50px;
                padding: 9px 20px;
                cursor: pointer;
                transition: all .3s ease;
            }
            .erc-cl-ct__video:hover { background: var(--erc-yellow); color: var(--erc-navy); }

            /* ---- Modal de video ---- */
            .erc-cl-ct__modal .modal-content {
                border: none;
                border-radius: var(--erc-radius);
                overflow: hidden;
                box-shadow: 0 24px 70px rgba(7, 41, 77, 0.3);
            }
            .erc-cl-ct__modal .modal-header {
                background: var(--erc-navy);
                color: #fff;
                border-bottom: none;
                padding: 18px 22px;
            }
            .erc-cl-ct__modal .modal-header .modal-title {
                font-family: 'Montserrat', sans-serif;
                font-size: 15px;
                font-weight: 700;
            }
            .erc-cl-ct__modal .modal-header .close { color: #fff; opacity: .85; text-shadow: none; }
            .erc-cl-ct__modal .modal-body { padding: 0; background: #000; }

            @media (max-width: 767px) {
                .erc-cl-ct__card { padding: 22px 20px; }
            }
        </style>
    </section>
@endif
