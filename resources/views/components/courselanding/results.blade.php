@props(['landing', 'colors' => []])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->results_section ?? null);
    $items = \App\Support\CourseLandingPresenter::items($landing->results_section ?? null);
    $palette = collect($colors)->filter()->values();

    if ($palette->isEmpty()) {
        $palette = collect(\App\Support\CourseLandingPresenter::colors());
    }
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--soft erc-cl-results">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-check-circle" />

            @if ($items !== [])
                <div class="row justify-content-center">
                    @foreach ($items as $k => $item)
                        @php $color = $palette[$k % $palette->count()]; @endphp
                        <div class="col-md-6 col-lg-3" data-reveal data-reveal-delay="{{ 100 * ($k + 1) }}">
                            <article class="erc-card erc-cl-results__card" style="border-top-color: {{ $color }};">
                                <span class="erc-cl-results__icon"
                                    style="color: {{ $color }}; background-color: {{ \App\Support\CourseLandingPresenter::rgba($color, 0.12) }};">
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
            /* ============ ERIOS · Landing de curso · Resultados ============ */
            .erc-cl-results__card {
                border-top: 5px solid var(--erc-blue);
                text-align: center;
                margin-bottom: 26px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 14px;
            }
            .erc-cl-results__card:hover { border-top-color: var(--erc-yellow); }
            .erc-cl-results__card h3 { font-size: 17px; margin: 0; }
            .erc-cl-results__card p { font-size: 14.5px; line-height: 25px; }
            .erc-cl-results__icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 66px;
                height: 66px;
                border-radius: 50%;
                font-size: 25px;
                transition: transform .35s ease;
            }
            .erc-cl-results__card:hover .erc-cl-results__icon { transform: scale(1.08); }

            @media (max-width: 767px) {
                .erc-cl-results__card { padding: 26px 20px; }
            }
        </style>
    </section>
@endif
