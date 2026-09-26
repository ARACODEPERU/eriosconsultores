<div>
    <section id="page-banner" class="erc-hero" style="background-image: url('{{ $imageUrl ?: $fallbackUrl }}');">
        <div class="erc-hero__overlay" aria-hidden="true"></div>
        <span class="erc-hero__ring erc-hero__ring--a" aria-hidden="true"></span>
        <span class="erc-hero__ring erc-hero__ring--b" aria-hidden="true"></span>

        <div class="container erc-hero__container">
            <div class="erc-hero__content">
                <span class="erc-hero__eyebrow">{{ $eyebrow }}</span>
                <h1 class="erc-hero__title">{{ $title }}</h1>
                @if($subtitle)
                    <p class="erc-hero__subtitle">{{ $subtitle }}</p>
                @endif
                <nav class="erc-hero__crumbs" aria-label="breadcrumb">
                    <ol>
                        <li><a href="{{ route('index_main') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
                        @if ($crumbLabel && $crumbUrl)
                            <li><a href="{{ $crumbUrl }}">{{ $crumbLabel }}</a></li>
                        @endif
                        <li class="erc-hero__crumb-current" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <style>
        /* ============ ERIOS · Hero interno ============ */
        .erc-hero {
            position: relative;
            background-size: cover;
            background-position: center;
            padding: 84px 0 88px;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
        }

        /* Overlay degradado navy: sólido a la izquierda (donde está el texto),
           transparente a la derecha para que se vea la imagen */
        .erc-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg,
                    rgba(5, 29, 56, 0.95) 0%,
                    rgba(7, 41, 77, 0.88) 45%,
                    rgba(11, 58, 107, 0.55) 100%);
        }
        .erc-hero__overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 198, 0, 0.05), transparent 40%);
        }

        /* Anillos decorativos amarillos (del diseño Docentes) */
        .erc-hero__ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(255, 198, 0, 0.18);
            pointer-events: none;
        }
        .erc-hero__ring--a { width: 300px; height: 300px; top: -110px; right: -70px; }
        .erc-hero__ring--b { width: 380px; height: 380px; bottom: -170px; left: -110px; }

        .erc-hero__container { position: relative; z-index: 2; }
        .erc-hero__content { max-width: 640px; }

        .erc-hero__eyebrow {
            display: inline-block;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #ffc600;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .erc-hero__eyebrow::before,
        .erc-hero__eyebrow::after {
            content: '';
            position: absolute;
            bottom: 0;
            width: 35px;
            height: 2px;
            background: #ffc600;
        }
        .erc-hero__eyebrow::before { left: 0; }
        .erc-hero__eyebrow::after { left: 43px; width: 12px; opacity: .55; }

        .erc-hero__title {
            color: #fff;
            font-size: 42px;
            font-weight: 700;
            line-height: 1.15;
            margin: 0 0 14px;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.35);
        }
        .erc-hero__subtitle {
            color: rgba(255, 255, 255, 0.82);
            font-size: 16px;
            line-height: 28px;
            margin: 0 0 18px;
            max-width: 560px;
        }

        .erc-hero__crumbs ol {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            padding: 0;
        }
        .erc-hero__crumbs li {
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
        }
        .erc-hero__crumbs a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #ffc600;
            text-decoration: none;
            transition: color .3s ease;
        }
        .erc-hero__crumbs a:hover { color: #fff; text-decoration: none; }
        .erc-hero__crumb-current {
            position: relative;
            padding-left: 16px;
        }
        .erc-hero__crumb-current::before {
            content: '/';
            position: absolute;
            left: 0;
            color: rgba(255, 255, 255, 0.4);
        }

        @media (max-width: 767px) {
            .erc-hero { padding: 56px 0 60px; text-align: center; }
            .erc-hero__content { margin: 0 auto; }
            .erc-hero__title { font-size: 30px; }
            .erc-hero__eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
            .erc-hero__eyebrow::after { left: 50%; transform: translateX(8px); width: 35px; opacity: 1; }
        }
    </style>
</div>
