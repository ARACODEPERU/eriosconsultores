<div>
    <section id="services-page" class="pt-70 pb-60">
        <div class="container">

            {{-- ======== Encabezado de sección ======== --}}
            <div class="erc-services-head">
                <span class="erc-eyebrow">Lo que hacemos</span>
                <h2>Servicios pensados para el crecimiento de tu empresa</h2>
                <p>Asesoría tributaria especializada, defensa ante SUNAT y auditoría preventiva con un equipo de profesionales con amplia trayectoria.</p>
            </div>

            {{-- ======== Grid de tarjetas grandes ======== --}}
            <div class="erc-services-grid">
                @foreach ($services as $service)
                    @php
                        $image = $service->item->items[0]->content ?? '';
                        $title = $service->item->items[1]->content ?? '';
                        $intro = trim($service->item->items[2]->content ?? '');
                        $details = trim($service->item->items[3]->content ?? '');
                        $link = trim($service->item->items[4]->content ?? '');
                        $num = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                        // Separar el intro del detalle: si el detalle empieza con "➢" es la lista; si no, es párrafo continuación
                        $detailsIsList = str_starts_with($details, '➢');
                        $icon = match ($loop->iteration) {
                            1 => 'fa-calculator',
                            2 => 'fa-search',
                            3 => 'fa-balance-scale',
                            4 => 'fa-gavel',
                            default => 'fa-briefcase',
                        };
                    @endphp
                    <article class="erc-service-card">
                        <div class="erc-service-card__media">
                            <img src="{{ $image ? asset('storage/' . $image) : asset('themes/webpage/images/logo-2.png') }}"
                                alt="{{ $title }}" class="erc-service-card__img"
                                onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-service-card__img--fallback');">
                        </div>

                        <div class="erc-service-card__body">
                            <div class="erc-service-card__head">
                                <span class="erc-service-card__icon"><i class="fa {{ $icon }}" aria-hidden="true"></i></span>
                                <span class="erc-service-card__num">{{ $num }}</span>
                            </div>

                            <h3 class="erc-service-card__title">{{ $title }}</h3>

                            @if ($intro)
                                <p class="erc-service-card__text">{{ $intro }}</p>
                            @endif

                            @if ($detailsIsList)
                                @php
                                    $bullets = array_values(array_filter(array_map('trim', explode('➢', $details))));
                                @endphp
                                <ul class="erc-service-card__list">
                                    @foreach ($bullets as $bullet)
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>{{ $bullet }}</span></li>
                                    @endforeach
                                </ul>
                            @elseif ($details)
                                <p class="erc-service-card__text">{{ $details }}</p>
                            @endif

                            <a href="{{ $link ?: route('web_contact_us') }}" class="erc-service-card__link" target="_blank" rel="noopener">
                                {{ $link ? 'Más información' : 'Solicitar este servicio' }}
                                <i class="fa fa-long-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======== Banda CTA final ======== --}}
    <section class="erc-cta-band">
        <div class="container">
            <div class="erc-cta-band__inner">
                <div class="erc-cta-band__text">
                    <h3>¿Necesitas asesoría tributaria para tu empresa?</h3>
                    <p>Agenda una reunión con nuestros especialistas y recibe una propuesta a la medida de tu negocio.</p>
                </div>
                <a href="{{ route('web_contact_us') }}" class="erc-cta-band__btn">
                    Contáctanos <i class="fa fa-long-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</div>
