<div>
    <section id="about-part" class="pt-80 pb-60">
        <div class="container">
            <div class="erc-habout">
                {{-- ======== Columna visual ======== --}}
                <div class="erc-habout__media" data-reveal>
                    <div class="erc-habout__imgwrap">
                        <img src="{{ asset('storage/' . $about[5]->content) }}" alt="{{ $about[1]->content }}"
                            class="erc-habout__img"
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-habout__img--fallback');">
                    </div>
                    <div class="erc-habout__accent"></div>
                </div>

                {{-- ======== Columna de contenido ======== --}}
                <div data-reveal data-reveal-delay="120">
                    <span class="erc-sec-eyebrow">{{ $about[0]->content }}</span>
                    <h2 class="erc-habout__title">{{ $about[1]->content }}</h2>
                    <p class="erc-habout__text">{{ $about[2]->content }}</p>

                    <div class="erc-habout__actions">
                        <a href="{{ route('web_about') }}" class="erc-btn erc-btn--yellow">
                            Conócenos <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('web_services') }}" class="erc-btn erc-btn--outline">
                            Ver servicios
                        </a>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </section>
</div>
