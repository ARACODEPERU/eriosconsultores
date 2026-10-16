<div>
    <section id="page-banner" class="erc-hero" style="background-image: url('{{ $imageUrl ?: $fallbackUrl }}');">
        <div class="erc-hero__overlay" aria-hidden="true"></div>
        <span class="erc-hero__ring erc-hero__ring--a" aria-hidden="true"></span>
        <span class="erc-hero__ring erc-hero__ring--b" aria-hidden="true"></span>

        <div class="container erc-hero__container">
            <div class="erc-hero__content">
                {{-- El eyebrow se retiró a petición del cliente: sin él el título
                     arranca más arriba. La prop $eyebrow se sigue aceptando para no
                     tocar las 13 páginas que la pasan; simplemente no se pinta. --}}
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

        /* Overlay idéntico al del slider de la portada: un solo degradado de dos
           capas (velo navy→celeste arriba, lavado celeste de marca abajo, en
           diagonal 100deg). De ese modo el hero interno y el de la home enseñan
           el mismo formato. Antes había aquí tres capas —dos velos y un lavado—
           que aclaraban de más la imagen y no coincidían con la portada. */
        .erc-hero__overlay {
            position: absolute;
            inset: 0;
            /* En CSS la primera capa listada es la que se pinta encima. */
            background:
                linear-gradient(100deg,
                        rgba(8, 48, 88, 0.72) 0%,
                        rgba(0, 182, 255, 0.65) 45%,
                        rgba(0, 182, 255, 0.15) 64%,
                        rgba(0, 182, 255, 0) 78%),
                linear-gradient(100deg,
                        rgba(0, 182, 255, 0.93) 0%,
                        rgba(0, 182, 255, 0.78) 34%,
                        rgba(0, 182, 255, 0.30) 62%,
                        rgba(0, 182, 255, 0.04) 100%);
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

        /* El breadcrumb va en navy, así que necesita una superficie clara debajo:
           la pastilla redondeada le da un suelo de contraste de ~11:1 sobre
           cualquier foto y, de paso, separa la miga del fondo. */
        .erc-hero__crumbs ol {
            list-style: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            padding: 7px 16px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 999px;
        }
        .erc-hero__crumbs li {
            font-size: 13.5px;
            font-weight: 600;
            color: #083058;
        }
        .erc-hero__crumbs a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #083058;
            text-decoration: none;
            transition: color .3s ease;
        }
        /* El navy tiene que ganar al celeste que el CSS generado del modo oscuro
           fuerza en este enlace para que siga leyéndose sobre la pastilla. */
        .erc-hero .erc-hero__crumbs a { color: #083058; }
        /* Dentro de la pastilla clara el hover blanco desaparecía: pasa a azul
           fuerte con subrayado, que es como se marca un enlace en texto. Va con
           la misma .erc-hero delante que la regla de arriba para ganarle el empate
           por orden y que el hover sí se note. */
        .erc-hero .erc-hero__crumbs a:hover { color: #004aad; text-decoration: underline; }
        .erc-hero__crumb-current {
            position: relative;
            padding-left: 16px;
        }
        .erc-hero__crumb-current::before {
            content: '/';
            position: absolute;
            left: 0;
            color: rgba(8, 48, 88, 0.45);
        }

        @media (max-width: 767px) {
            .erc-hero { padding: 56px 0 60px; text-align: center; }
            .erc-hero__content { margin: 0 auto; }
            .erc-hero__title { font-size: 30px; }
            /* En móvil el texto va centrado y cae sobre la parte más clara del
               degradado, así que aquí sí se añade un velo navy uniforme: sin él el
               título blanco se queda en torno a 2,4:1 sobre las fotos claras. El
               slider no lo necesita porque su texto va alineado a la izquierda. */
            .erc-hero__overlay::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg,
                        rgba(8, 48, 88, 0.66) 0%,
                        rgba(8, 48, 88, 0.58) 100%);
            }
        }
    </style>
</div>
