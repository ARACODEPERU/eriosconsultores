@props(['landing'])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->professional_section ?? null);
    $items = array_slice(\App\Support\CourseLandingPresenter::items($landing->professional_section ?? null), 0, 2);
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--white erc-cl-pro">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                :icon="$items[0]['icon'] ?? 'fa-graduation-cap'" />

            @if ($items !== [])
                <div class="row justify-content-center">
                    @foreach ($items as $k => $item)
                        <div class="col-md-6 col-lg-5" data-reveal data-reveal-delay="{{ 90 * ($k + 1) }}">
                            <article class="erc-card erc-cl-pro__card">
                                <span class="erc-chip-icon erc-chip-icon--lg">
                                    <i class="fa {{ \App\Support\CourseLandingPresenter::icon($item['icon'] ?? null, 'fa-check') }}"
                                        aria-hidden="true"></i>
                                </span>

                                <h3>{{ $item['title'] ?? '' }}</h3>

                                @if (filled($item['description'] ?? null))
                                    <p>{{ $item['description'] }}</p>
                                @endif
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <style>
            /* ============ ERIOS · Landing de curso · Desarrollo profesional ============ */
            .erc-cl-pro__card {
                display: flex;
                flex-direction: column;
                gap: 16px;
                margin-bottom: 26px;
                border-top: 4px solid var(--erc-blue);
            }
            .erc-cl-pro__card:hover { border-top-color: var(--erc-yellow); }
            .erc-cl-pro__card h3 { font-size: 19px; margin: 0; }
            .erc-cl-pro__card p { font-size: 15px; line-height: 26px; color: var(--erc-text); }
        </style>
    </section>
@endif
