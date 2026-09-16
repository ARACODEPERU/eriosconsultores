<div>
    <header id="header-part" class="erc-header">

        {{-- ======== Topbar ======== --}}
        <div class="erc-topbar d-none d-lg-block">
            <div class="container">
                <div class="erc-topbar__inner">
                    <div class="erc-topbar__contact">
                        <a href="mailto:{{ $header[0]->content }}" class="erc-topbar__item">
                            <span class="erc-topbar__icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            {{ $header[0]->content }}
                        </a>
                        <span class="erc-topbar__sep"></span>
                        <span class="erc-topbar__item">
                            <span class="erc-topbar__icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                            {{ $header[1]->content }}
                        </span>
                    </div>
                    <div class="erc-topbar__social">
                        <span class="erc-topbar__follow">Síguenos en</span>
                        <a href="{{ $header[2]->content }}" target="_blank" rel="noopener noreferrer" class="erc-topbar__net" aria-label="Facebook">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="{{ $header[3]->content }}" target="_blank" rel="noopener noreferrer" class="erc-topbar__net" aria-label="Instagram">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="{{ $header[4]->content }}" target="_blank" rel="noopener noreferrer" class="erc-topbar__net" aria-label="LinkedIn">
                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======== Navbar ======== --}}
        <div class="erc-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg erc-nav__bar">
                    <a class="navbar-brand erc-nav__brand" href="{{ route('index_main') }}">
                        <img src="{{ asset('storage/' . $header[5]->content) }}" alt="Logo"
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';">
                    </a>
                    <button class="navbar-toggler erc-nav__toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto erc-nav__list">
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('index_main') ? 'active' : '' }}"
                                    href="{{ route('index_main') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('web_about') ? 'active' : '' }}"
                                    href="{{ route('web_about') }}">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('web_services') ? 'active' : '' }}"
                                    href="{{ route('web_services') }}">Servicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('web_teachers') ? 'active' : '' }}"
                                    href="{{ route('web_teachers') }}">Docentes</a>
                            </li>
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('web_contact_us') ? 'active' : '' }}"
                                    href="{{ route('web_contact_us') }}">Contáctanos</a>
                            </li>
                            <li class="nav-item erc-nav__cta-item">
                                <a class="erc-nav__cta" href="{{ route('login') }}" target="_blank" rel="noopener">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> Campus Virtual
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <style>
        /* ============ ERIOS · Header moderno ============ */
        .erc-topbar {
            background: linear-gradient(90deg, #07294d 0%, #0b3a6b 55%, #0e4a8f 100%);
            font-family: 'Montserrat', sans-serif;
        }
        .erc-topbar__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 42px;
            gap: 16px;
        }
        .erc-topbar__contact {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .erc-topbar__item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: color .3s ease;
        }
        a.erc-topbar__item:hover { color: #ffc600; text-decoration: none; }
        .erc-topbar__icon {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: rgba(255, 198, 0, 0.16);
            color: #ffc600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }
        .erc-topbar__sep { width: 1px; height: 16px; background: rgba(255, 255, 255, 0.22); }
        .erc-topbar__social { display: flex; align-items: center; gap: 8px; }
        .erc-topbar__follow {
            color: rgba(255, 255, 255, 0.65);
            font-size: 12.5px;
            font-weight: 500;
            margin-right: 4px;
        }
        .erc-topbar__net {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .3s ease;
        }
        .erc-topbar__net:hover {
            background: #ffc600;
            border-color: #ffc600;
            color: #07294d;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* ---- Navbar (header fijo completo; sticky no funciona dentro del header corto) ---- */
        .erc-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }
        /* El header es fixed (fuera del flujo): el body reserva su espacio.
           Desktop: topbar 42px + nav ~64px = 106px. Móvil: solo nav 64px. */
        body { padding-top: 106px; }
        @media (max-width: 991px) {
            body { padding-top: 64px; }
        }
        /* Al hacer scroll la topbar se desliza hacia arriba y queda solo la nav */
        .erc-topbar { transition: margin-top .35s ease; }
        .erc-header.erc-header--scrolled .erc-topbar { margin-top: -42px; }
        .erc-nav {
            background: #fff;
            box-shadow: 0 2px 18px rgba(14, 23, 38, 0.08);
        }
        .erc-nav__bar { padding: 10px 0; margin: 0; }
        .erc-nav__brand { padding: 0; margin: 0; }
        .erc-nav__brand img { width: 165px; height: auto; display: block; }
        .erc-nav__list { align-items: center; }
        .erc-nav__list .nav-item { padding: 0 2px; }
        .erc-nav__link {
            position: relative;
            display: inline-block;
            padding: 10px 14px !important;
            font-family: 'Montserrat', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #1d2025 !important;
            transition: color .3s ease;
        }
        .erc-nav__link::after {
            content: '';
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 2px;
            height: 2px;
            border-radius: 2px;
            background: #ffc600;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
        }
        .erc-nav__link:hover { color: #004aad !important; text-decoration: none; }
        .erc-nav__link:hover::after { transform: scaleX(1); }
        .erc-nav__link.active { color: #004aad !important; }
        .erc-nav__link.active::after { transform: scaleX(1); }

        .erc-nav__cta-item { margin-left: 10px; }
        .erc-nav__cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffc600;
            color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: all .35s ease;
            white-space: nowrap;
        }
        .erc-nav__cta:hover {
            background: #004aad;
            color: #ffc600;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0, 74, 173, 0.3);
        }

        /* ---- Toggler móvil ---- */
        .erc-nav__toggler {
            border: 2px solid #004aad;
            border-radius: 8px;
            padding: 8px 10px;
        }
        .erc-nav__toggler .icon-bar {
            display: block;
            width: 22px;
            height: 2px;
            border-radius: 2px;
            background: #004aad;
        }
        .erc-nav__toggler .icon-bar + .icon-bar { margin-top: 5px; }

        @media (max-width: 991px) {
            .erc-nav__list {
                padding: 12px 6px 16px;
                border-top: 1px solid #eceff5;
                margin-top: 10px;
            }
            .erc-nav__list .nav-item { padding: 0; }
            .erc-nav__link { display: block; padding: 10px 8px !important; }
            .erc-nav__link::after { display: none; }
            .erc-nav__cta-item { margin: 8px 0 0; }
            .erc-nav__brand img { width: 140px; }
        }
    </style>

    <script>
        (function () {
            var header = document.querySelector('.erc-header');
            if (!header) return;
            var ticking = false;
            function update() {
                header.classList.toggle('erc-header--scrolled', (window.scrollY || 0) > 40);
                ticking = false;
            }
            window.addEventListener('scroll', function () {
                if (!ticking) {
                    requestAnimationFrame(update);
                    ticking = true;
                }
            }, { passive: true });
            update();
        })();
    </script>
</div>
