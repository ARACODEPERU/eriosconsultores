@props(['landing'])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->problem_section ?? null);
    $items = array_slice(\App\Support\CourseLandingPresenter::items($landing->problem_section ?? null), 0, 3);
@endphp

@if ($section !== [])
    <section class="erc-cl-sec erc-cl-sec--dark erc-cl-problem">
        <div class="container">
            <x-courselanding.head
                :eyebrow="$section['name'] ?? null"
                :title="$section['title'] ?? null"
                :description="$section['description'] ?? null"
                icon="fa-exclamation-triangle"
                tone="dark" />

            @if ($items !== [])
                <div class="row justify-content-center">
                    @foreach ($items as $k => $item)
                        <div class="col-md-6 col-lg-4" data-reveal data-reveal-delay="{{ 100 * ($k + 1) }}">
                            <article class="erc-card erc-card--dark erc-cl-problem__card">
                                <div class="erc-cl-problem__top">
                                    <span class="erc-chip-icon erc-chip-icon--dark">
                                        <i class="fa {{ \App\Support\CourseLandingPresenter::icon($item['icon'] ?? null, 'fa-exclamation') }}"
                                            aria-hidden="true"></i>
                                    </span>
                                    <span class="erc-ghost-num">{{ str_pad((string) ($k + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                </div>

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
            /* ============ ERIOS · Landing de curso · El problema ============ */
            .erc-cl-problem__card {
                display: flex;
                flex-direction: column;
                gap: 14px;
                margin-bottom: 26px;
            }
            .erc-cl-problem__top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }
            .erc-cl-problem__card h3 { font-size: 18px; margin: 0; }
            .erc-cl-problem__card p { font-size: 14.5px; line-height: 25px; }
        </style>
    </section>
@endif
