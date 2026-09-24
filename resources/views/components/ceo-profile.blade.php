<div>
    <section id="ceo-part" class="erc-ceo" data-reveal>
        <div class="container">
            <div class="erc-ceo__grid">

                {{-- ======== Retrato ======== --}}
                <div class="erc-ceo__media">
                    <span class="erc-ceo__frame" aria-hidden="true"></span>
                    <img src="{{ $d['photo'] ? asset('storage/' . $d['photo']) : asset('themes/webpage/images/logo-2.png') }}"
                        alt="{{ $d['name'] }} — {{ $d['role'] }}" class="erc-ceo__photo"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-ceo__photo--fallback');">
                    <span class="erc-ceo__badge" aria-hidden="true"><i class="fa fa-award"></i></span>
                    <span class="erc-ceo__ring" aria-hidden="true"></span>
                </div>

                {{-- ======== Contenido ======== --}}
                <div class="erc-ceo__body">
                    <span class="erc-ceo__eyebrow">#Liderazgo</span>
                    <h2 class="erc-ceo__name">{{ $d['name'] }}</h2>
                    <span class="erc-ceo__role">{{ $d['role'] }}</span>
                    <p class="erc-ceo__summary">{{ $d['summary'] }}</p>
                    <p class="erc-ceo__text">{{ $d['body'] }}</p>

                    @if ($d['quote'])
                        <blockquote class="erc-ceo__quote">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <span>{{ $d['quote'] }}</span>
                        </blockquote>
                    @endif

                    @if ($d['stat1num'] || $d['stat2num'])
                        <div class="erc-ceo__stats">
                            @if ($d['stat1num'])
                                <div class="erc-ceo__stat">
                                    <b>{{ $d['stat1num'] }}</b>
                                    <span>{{ $d['stat1lbl'] }}</span>
                                </div>
                            @endif
                            @if ($d['stat2num'])
                                <div class="erc-ceo__stat">
                                    <b>{{ $d['stat2num'] }}</b>
                                    <span>{{ $d['stat2lbl'] }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($showLink)
                        <div class="erc-ceo__actions">
                            <a href="{{ route('web_about') }}" class="erc-ceo__btn">
                                Conócela en Nosotros <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    <style>
        /* ============ ERIOS · CEO Fundadora (autocontenido) ============ */
        .erc-ceo { padding: 90px 0; background: #f4f7fb; overflow: hidden; }

        .erc-ceo__grid {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
            gap: 56px;
            align-items: center;
            position: relative;
        }

        /* ---- Retrato ---- */
        .erc-ceo__media {
            position: relative;
            max-width: 420px;
            justify-self: center;
            width: 100%;
        }
        .erc-ceo__photo {
            width: 100%;
            aspect-ratio: 4 / 5;
            object-fit: cover;
            object-position: center top;
            border-radius: 22px;
            display: block;
            position: relative;
            z-index: 1;
            box-shadow: 0 24px 50px rgba(7, 41, 77, 0.22);
        }
        .erc-ceo__photo--fallback {
            object-fit: contain;
            background: linear-gradient(135deg, #004aad, #4a86e8);
            padding: 70px;
        }
        .erc-ceo__frame {
            position: absolute;
            inset: 26px -26px -26px 26px;
            border: 3px solid #ffc600;
            border-radius: 22px;
            z-index: 0;
            pointer-events: none;
        }
        .erc-ceo__ring {
            position: absolute;
            width: 130px; height: 130px;
            border: 2px dashed rgba(0, 74, 173, 0.35);
            border-radius: 50%;
            top: -46px; left: -46px;
            z-index: 0;
            pointer-events: none;
        }
        .erc-ceo__badge {
            position: absolute;
            right: -20px; top: 30px;
            width: 58px; height: 58px;
            border-radius: 50%;
            background: #ffc600;
            color: #07294d;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            box-shadow: 0 12px 26px rgba(255, 198, 0, 0.45);
            z-index: 2;
        }

        /* ---- Contenido ---- */
        .erc-ceo__body { position: relative; }
        .erc-ceo__eyebrow {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase; color: #004aad;
            margin-bottom: 10px;
        }
        .erc-ceo__name {
            font-family: 'Montserrat', sans-serif;
            font-size: 38px; font-weight: 800; color: #1d2025;
            margin: 0 0 6px;
        }
        .erc-ceo__role {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px; font-weight: 700;
            color: #07294d; background: #ffc600;
            padding: 6px 16px; border-radius: 50px;
            margin-bottom: 18px;
        }
        .erc-ceo__summary { color: #004aad; font-size: 16px; font-weight: 600; line-height: 1.65; margin: 0 0 14px; }
        .erc-ceo__text { color: #6b7280; font-size: 15px; line-height: 1.8; margin: 0 0 22px; }

        .erc-ceo__quote {
            display: flex; gap: 14px; align-items: flex-start;
            margin: 0 0 26px;
            background: #fff;
            border: 1px solid #eceff5;
            border-left: 4px solid #ffc600;
            border-radius: 14px;
            padding: 18px 22px;
            box-shadow: 0 8px 22px rgba(14, 23, 38, 0.06);
        }
        .erc-ceo__quote i { color: #ffc600; font-size: 20px; margin-top: 3px; }
        .erc-ceo__quote span { font-style: italic; color: #07294d; font-size: 15px; line-height: 1.7; font-weight: 500; }

        .erc-ceo__stats { display: flex; gap: 34px; }
        .erc-ceo__stat b {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 30px; font-weight: 800; color: #004aad;
            line-height: 1.1;
        }
        .erc-ceo__stat span { font-size: 13px; color: #6b7280; }

        .erc-ceo__actions { margin-top: 28px; }
        .erc-ceo__btn {
            display: inline-flex; align-items: center; gap: 10px;
            background: #ffc600; color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px; font-weight: 700;
            padding: 13px 26px; border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35);
            transition: all .35s ease;
        }
        .erc-ceo__btn:hover {
            background: #004aad; color: #ffc600;
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(0, 74, 173, 0.3);
            text-decoration: none;
        }

        /* ---- Responsivo ---- */
        @media (max-width: 991px) {
            .erc-ceo__grid { grid-template-columns: 1fr; gap: 48px; }
            .erc-ceo__media { max-width: 360px; }
        }
        @media (max-width: 575px) {
            .erc-ceo { padding: 60px 0; }
            .erc-ceo__name { font-size: 29px; }
            .erc-ceo__stats { gap: 24px; }
        }

        /* ---- Movimiento reducido ---- */
        @media (prefers-reduced-motion: reduce) {
            .erc-ceo__btn { transition: none !important; }
            .erc-ceo__btn:hover { transform: none; }
        }
    </style>
</div>
