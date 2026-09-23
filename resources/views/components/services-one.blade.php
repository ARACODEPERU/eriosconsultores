<div>
    <section id="apply-part" class="erc-hs">
        <div class="container">

            {{-- ======== Encabezado de sección ======== --}}
            <div class="erc-hs-head" data-reveal>
                <span class="erc-hs-eyebrow">Nuestros servicios</span>
                <h2>Soluciones tributarias para el crecimiento de tu empresa</h2>
                <p>Asesoría especializada, defensa ante SUNAT y auditoría preventiva con un equipo de amplia trayectoria.</p>
            </div>

            {{-- ======== Grid de tarjetas ======== --}}
            <div class="erc-hs-grid">
                @foreach ($services as $service)
                    @php
                        $title = $service->item->items[1]->content ?? '';
                        $intro = trim($service->item->items[2]->content ?? '');
                        $link = trim($service->item->items[4]->content ?? '');
                        $num = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                        $icon = match ($loop->iteration) {
                            1 => 'fa-calculator',
                            2 => 'fa-search',
                            3 => 'fa-balance-scale',
                            4 => 'fa-gavel',
                            default => 'fa-briefcase',
                        };
                    @endphp
                    <article class="erc-hs-card" data-reveal data-reveal-delay="{{ ($loop->index % 2) * 120 }}">
                        <div class="erc-hs-card__top">
                            <span class="erc-hs-card__icon"><i class="fa {{ $icon }}" aria-hidden="true"></i></span>
                            <span class="erc-hs-card__num">{{ $num }}</span>
                        </div>
                        <h3 class="erc-hs-card__title">{{ $title }}</h3>
                        @if ($intro)
                            <p class="erc-hs-card__text">{{ \Illuminate\Support\Str::limit($intro, 110, '…') }}</p>
                        @endif
                        {{-- <a href="{{ $link ?: route('web_contact_us') }}" class="erc-hs-card__btn" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i> Más Información
                        </a> --}}
                        <a href="{{ route('web_services') }}" class="erc-btn erc-btn--yellow">
                            Más Información <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* ============ ERIOS · Servicios (home) ============ */
        .erc-hs {
            position: relative;
            background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
            padding: 80px 0 90px;
            overflow: hidden;
        }
        .erc-hs::before,
        .erc-hs::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 198, 0, 0.12);
        }
        .erc-hs::before { width: 320px; height: 320px; top: -120px; right: -80px; }
        .erc-hs::after { width: 420px; height: 420px; bottom: -180px; left: -120px; }

        .erc-hs-head {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 46px;
            padding: 0 15px;
            position: relative;
            z-index: 1;
        }
        .erc-hs-eyebrow {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #ffc600;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .erc-hs-eyebrow::before,
        .erc-hs-eyebrow::after {
            content: '';
            position: absolute;
            bottom: 0;
            width: 35px;
            height: 2px;
            background: #ffc600;
        }
        .erc-hs-eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
        .erc-hs-eyebrow::after { left: 50%; transform: translateX(8px); }
        .erc-hs-head h2 {
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 14px;
        }
        .erc-hs-head p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 16px;
            line-height: 28px;
            margin: 0;
        }

        .erc-hs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
            position: relative;
            z-index: 1;
        }
        @media (max-width: 991px) {
            .erc-hs-grid { grid-template-columns: 1fr; }
        }

        .erc-hs-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 30px 30px 28px;
            display: flex;
            flex-direction: column;
            transition: transform .35s ease, background .35s ease, border-color .35s ease;
        }
        .erc-hs-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.09);
            border-color: rgba(255, 198, 0, 0.45);
        }
        .erc-hs-card__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .erc-hs-card__icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 198, 0, 0.14);
            color: #ffc600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: all .35s ease;
        }
        .erc-hs-card:hover .erc-hs-card__icon {
            background: #ffc600;
            color: #07294d;
            transform: rotate(-6deg);
        }
        .erc-hs-card__num {
            font-family: 'Montserrat', sans-serif;
            font-size: 44px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.1);
            line-height: 1;
            user-select: none;
        }
        .erc-hs-card__title {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            margin: 0 0 10px;
        }
        .erc-hs-card__text {
            color: rgba(255, 255, 255, 0.72);
            font-size: 14.5px;
            line-height: 25px;
            margin: 0 0 18px;
        }
        .erc-hs-card__btn {
            margin-top: auto;
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: #ffc600;
            color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            transition: all .35s ease;
        }
        .erc-hs-card__btn i { font-size: 17px; }
        .erc-hs-card__btn:hover {
            background: #25D366;
            color: #fff;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 211, 102, 0.35);
        }
        @media (max-width: 575px) {
            .erc-hs { padding: 60px 0 70px; }
            .erc-hs-head h2 { font-size: 27px; }
        }
    </style>
</div>
