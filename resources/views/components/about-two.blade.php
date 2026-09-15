<div>
    <section id="about-page" class="pt-70 pb-60">
        <div class="container">

            <div class="erc-about">
                {{-- ======== Columna visual ======== --}}
                <div class="erc-about__media">
                    <div class="erc-about__media-main">
                        <img src="{{ asset('storage/' . $about[5]->content) }}" alt="{{ $about[1]->content }}"
                            class="erc-about__img"
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-about__img--fallback');">
                    </div>
                    <div class="erc-about__media-accent"></div>
                    <div class="erc-about__badge">
                        <span class="erc-about__badge-num">+10</span>
                        <span class="erc-about__badge-label">años de<br>experiencia</span>
                    </div>
                </div>

                {{-- ======== Columna de contenido ======== --}}
                <div class="erc-about__content">
                    <span class="erc-about__eyebrow">{{ $about[0]->content }}</span>
                    <h2 class="erc-about__title">{{ $about[1]->content }}</h2>
                    <p class="erc-about__text">{{ $about[2]->content }}</p>
                    <p class="erc-about__text">{{ $about[3]->content }}</p>

                    <ul class="erc-about__feats">
                        <li>
                            <span class="erc-about__feat-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                            <span>Atención personalizada según la necesidad de cada cliente</span>
                        </li>
                        <li>
                            <span class="erc-about__feat-icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                            <span>Consultoría tributaria especializada y oportuna</span>
                        </li>
                        <li>
                            <span class="erc-about__feat-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            <span>Prevención de riesgos y contingencias ante SUNAT</span>
                        </li>
                    </ul>

                    <div class="erc-about__actions">
                        <a href="{{ route('web_services') }}" class="erc-btn-main">
                            Ver servicios <i class="fa fa-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('web_contact_us') }}" class="erc-btn-ghost">
                            Hablemos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
