@props(['landing'])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->faq_section ?? null);
    $items = collect(\App\Support\CourseLandingPresenter::items($landing->faq_section ?? null))
        ->filter(fn ($item) => ($item['visible'] ?? true) && filled($item['question'] ?? null))
        ->values();

    $whatsappLink = $landing->whatsapp_link ?: null;
    $uid = 'erc-cl-faq-' . ($landing->id ?: \Illuminate\Support\Str::slug($landing->url_slug ?: 'curso'));
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--white erc-cl-faq">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-question-circle" />

            @if ($items->isNotEmpty())
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="erc-cl-faq__list" id="{{ $uid }}" role="tablist">
                            @foreach ($items as $item)
                                @php $panelId = $uid . '-panel-' . $loop->index; @endphp
                                <div class="erc-cl-faq__item" data-reveal data-reveal-delay="{{ 60 * $loop->index }}">
                                    <button class="erc-cl-faq__question" type="button" data-toggle="collapse"
                                        data-target="#{{ $panelId }}" aria-expanded="false"
                                        aria-controls="{{ $panelId }}">
                                        <span>{{ $item['question'] }}</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="collapse" id="{{ $panelId }}">
                                        <div class="erc-cl-faq__answer">{!! $item['answer'] ?? '' !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($whatsappLink)
                            <div class="erc-cl-faq__cta" data-reveal>
                                <div>
                                    <strong>¿Aún tienes dudas específicas?</strong>
                                    <p>Un asesor de ERIOS CONSULTORES te responde por WhatsApp.</p>
                                </div>
                                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer"
                                    class="erc-btn erc-btn--yellow">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    Hablar con un asesor
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <style>
            /* ============ ERIOS · Landing de curso · Preguntas frecuentes ============ */
            .erc-cl-faq__list { margin-bottom: 34px; }
            .erc-cl-faq__item {
                background: #fff;
                border: 1px solid var(--erc-line);
                border-radius: 14px;
                margin-bottom: 14px;
                overflow: hidden;
                transition: all .3s ease;
            }
            .erc-cl-faq__item:hover { border-color: rgba(0, 74, 173, 0.28); box-shadow: var(--erc-shadow); }
            .erc-cl-faq__question {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                background: #fff;
                border: none;
                text-align: left;
                padding: 20px 24px;
                cursor: pointer;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                font-weight: 700;
                color: var(--erc-navy);
                transition: all .25s ease;
            }
            .erc-cl-faq__question:hover { color: var(--erc-blue); }
            .erc-cl-faq__question:focus { outline: none; box-shadow: inset 0 0 0 2px rgba(0, 74, 173, 0.35); }
            .erc-cl-faq__question i { color: var(--erc-yellow); font-size: 13px; transition: transform .3s ease; }
            .erc-cl-faq__question[aria-expanded="true"] i { transform: rotate(180deg); }
            .erc-cl-faq__answer {
                padding: 18px 24px 22px;
                font-family: 'Roboto', sans-serif;
                font-size: 14.5px;
                line-height: 26px;
                color: var(--erc-text);
                border-top: 1px solid #f1f5fb;
            }
            .erc-cl-faq__answer p:last-child { margin-bottom: 0; }

            .erc-cl-faq__cta {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                background: linear-gradient(135deg, var(--erc-navy) 0%, #0b3a6b 60%, var(--erc-blue-mid) 100%);
                border-radius: var(--erc-radius);
                padding: 28px 30px;
                box-shadow: 0 16px 40px rgba(7, 41, 77, 0.22);
            }
            .erc-cl-faq__cta strong {
                display: block;
                font-family: 'Montserrat', sans-serif;
                font-size: 19px;
                font-weight: 700;
                color: #fff;
                margin-bottom: 4px;
            }
            .erc-cl-faq__cta p { color: rgba(255, 255, 255, 0.78); font-size: 14.5px; margin: 0; }

            @media (max-width: 767px) {
                .erc-cl-faq__question { font-size: 15px; padding: 16px 18px; }
                .erc-cl-faq__answer { padding: 16px 18px 18px; }
                .erc-cl-faq__cta { padding: 24px 22px; text-align: center; justify-content: center; }
                .erc-cl-faq__cta .erc-btn { width: 100%; }
            }
        </style>
    </section>
@endif
