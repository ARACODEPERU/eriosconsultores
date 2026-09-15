<div>
    <section id="testimonial" class="erc-testi-band">
        <div class="container">

            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">{{ $testimonial_presentation[0]->content }}</span>
                <h2>{{ $testimonial_presentation[1]->content }}</h2>
            </div>

            <div class="erc-testi-grid">
                @foreach ($testimonial_information as $k => $testimonial)
                    @php
                        $photo = $testimonial->item->items[0]->content ?? '';
                        $text = $testimonial->item->items[1]->content ?? '';
                        $name = $testimonial->item->items[2]->content ?? '';
                        $place = $testimonial->item->items[3]->content ?? '';
                    @endphp
                    <article class="erc-testi-card" data-reveal data-reveal-delay="{{ $k * 120 }}">
                        <span class="erc-testi-card__quote"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
                        <p class="erc-testi-card__text">“{{ $text }}”</p>
                        <div class="erc-testi-card__author">
                            <img src="{{ $photo ? asset('storage/' . $photo) : asset('themes/webpage/images/logo-2.png') }}"
                                alt="{{ $name }}" class="erc-testi-card__avatar"
                                onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-testi-card__avatar--fallback');">
                            <div>
                                <h6 class="erc-testi-card__name">{{ $name }}</h6>
                                <p class="erc-testi-card__place">{{ $place }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div> <!-- container -->
    </section>
</div>
