<div>
    <section id="testimonial" class="erc-testi-band">
        <span class="erc-testi-band__circle erc-testi-band__circle--a" aria-hidden="true"></span>
        <span class="erc-testi-band__circle erc-testi-band__circle--b" aria-hidden="true"></span>
        <div class="container erc-testi-band__inner">

            <div class="erc-testi-head" data-reveal>
                <span class="erc-testi-head__eyebrow">{{ $testimonial_presentation[0]->content }}</span>
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

    <style>
        /* ============ ERIOS · Testimonios (autocontenido: funciona en Home y Nosotros) ============ */
        .erc-testi-band {
            position: relative;
            background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
            padding: 90px 0;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
        }
        .erc-testi-band__circle {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.15);
            pointer-events: none;
        }
        .erc-testi-band__circle--a { width: 380px; height: 380px; top: -140px; left: -100px; }
        .erc-testi-band__circle--b { width: 300px; height: 300px; bottom: -130px; right: -90px; border-style: dashed; opacity: .6; }
        .erc-testi-band__inner { position: relative; z-index: 1; }

        /* ---- Encabezado de sección (propio del componente) ---- */
        .erc-testi-head { text-align: center; max-width: 720px; margin: 0 auto 46px; padding: 0 15px; }
        .erc-testi-head__eyebrow {
            display: inline-block;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #ffc600;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .erc-testi-head__eyebrow::before,
        .erc-testi-head__eyebrow::after {
            content: '';
            position: absolute;
            bottom: 0;
            width: 35px;
            height: 2px;
            background: #ffc600;
        }
        .erc-testi-head__eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
        .erc-testi-head__eyebrow::after { left: 50%; transform: translateX(8px); }
        .erc-testi-head h2 {
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            line-height: 1.3;
            margin: 0;
        }

        /* ---- Grid y tarjetas ---- */
        .erc-testi-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 26px;
        }
        @media (max-width: 991px) { .erc-testi-grid { grid-template-columns: 1fr; } }
        .erc-testi-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 28px 26px;
            position: relative;
            display: flex;
            flex-direction: column;
            transition: all .35s ease;
        }
        .erc-testi-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.11);
            border-color: rgba(255, 198, 0, 0.5);
        }
        .erc-testi-card__quote {
            position: absolute;
            top: -18px;
            right: 24px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffc600;
            color: #07294d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 8px 20px rgba(255, 198, 0, 0.4);
        }
        .erc-testi-card__text {
            color: #fff;
            font-size: 14.5px;
            line-height: 25px;
            margin: 0 0 18px;
            font-style: italic;
        }
        .erc-testi-card__author { display: flex; align-items: center; gap: 12px; margin-top: auto; }
        .erc-testi-card__avatar {
            flex: none;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }
        .erc-testi-card__avatar--fallback { padding: 12px; filter: brightness(0) invert(1); background: rgba(255, 255, 255, 0.15); }
        .erc-testi-card__name { color: #fff; font-size: 15px; font-weight: 700; margin: 0; }
        .erc-testi-card__place { color: rgba(255, 255, 255, 0.7); font-size: 13px; margin: 0; }

        @media (max-width: 575px) {
            .erc-testi-band { padding: 64px 0; }
            .erc-testi-head h2 { font-size: 27px; }
        }
    </style>
</div>
