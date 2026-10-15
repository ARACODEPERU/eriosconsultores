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
        /* Mismos colores del logotipo ERIOS: azul fuerte #0048B0, celeste #00A0F0 y navy #083058 */
        .erc-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg,
                    rgba(0, 160, 240, 0.93) 0%,
                    rgba(0, 160, 240, 0.78) 34%,
                    rgba(0, 160, 240, 0.30) 62%,
                    rgba(0, 160, 240, 0.04) 100%);
        }
        /* Velo navy localizado bajo la zona de texto (izquierda): garantiza
           contraste AA del texto blanco/amarillo sin alterar el degradado azul,
           que se mantiene intacto en el resto del hero */
        .erc-hero__overlay::before {
            content: '';
            position: absolute;
            inset: 0;
            /* Velo navy del logo (#083058) para contraste del texto */
            background: linear-gradient(100deg,
                    rgba(8, 48, 88, 0.72) 0%,
                    rgba(8, 48, 88, 0.65) 45%,
                    rgba(8, 48, 88, 0.15) 64%,
                    rgba(8, 48, 88, 0) 78%);
        }
        /* El héroe es navy: el lavado y los aros dejan el amarillo por el celeste. */
        .erc-hero__overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 182, 255, 0.06), transparent 40%);
        }

        /* Anillos decorativos del diseño Docentes, ahora en celeste de marca */
        .erc-hero__ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(0, 182, 255, 0.2);
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
            color: #00b6ff;
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
            background: #00b6ff;
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
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            line-height: 28px;
            margin: 0 0 18px;
            max-width: 560px;
            text-shadow: 0 2px 12px rgba(5, 29, 56, 0.55);
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
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 1px 8px rgba(5, 29, 56, 0.55);
        }
        .erc-hero__crumbs a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #00b6ff;
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
            /* En móvil el texto está centrado: velo uniforme vertical para mantener el contraste */
            .erc-hero__overlay::before {
                background: linear-gradient(180deg,
                        rgba(8, 48, 88, 0.66) 0%,
                        rgba(8, 48, 88, 0.58) 100%);
            }
        }
    </style>
</div>
