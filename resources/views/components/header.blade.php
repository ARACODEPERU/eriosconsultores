<div>
    <header id="header-part" class="erc-header">

        {{-- ======== Topbar ======== --}}
        <div class="erc-topbar d-none d-lg-block">
            <div class="container erc-container-wide">
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
                        <a href="{{ optional($footer->firstWhere('position', 8))->content ?? '#' }}" @if($footer->where('position', 8)->count()) target="_blank" rel="noopener noreferrer" @endif
                            class="erc-topbar__net" aria-label="TikTok">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false" style="width: 12px; height: 12px; display: block;"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                        <a href="{{ optional($footer->firstWhere('position', 9))->content ?? '#' }}" @if($footer->where('position', 9)->count()) target="_blank" rel="noopener noreferrer" @endif
                            class="erc-topbar__net" aria-label="X (Twitter)">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false" style="width: 12px; height: 12px; display: block;"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
                        </a>
                        <a href="{{ optional($footer->firstWhere('position', 10))->content ?? '#' }}" @if($footer->where('position', 10)->count()) target="_blank" rel="noopener noreferrer" @endif
                            class="erc-topbar__net" aria-label="YouTube">
                            <i class="fab fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======== Navbar ======== --}}
        <div class="erc-nav">
            <div class="container erc-container-wide">
                <nav class="navbar navbar-expand-lg erc-nav__bar">
                    <a class="navbar-brand erc-nav__brand" href="{{ route('index_main') }}">
                        {{-- Logo en claro: imagen del CMS (o su respaldo). En oscuro se
                             muestra la versión negativa, la misma que usa el pie. --}}
                        <img class="erc-nav__logo erc-nav__logo--light" src="{{ asset('storage/' . $header[5]->content) }}" alt="ERIOS CONSULTORES"
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';">
                        <img class="erc-nav__logo erc-nav__logo--dark"
                            src="{{ asset('themes/webpage/images/Logo_Web_Negativo.png') }}"
                            alt="ERIOS CONSULTORES">
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
                                <a class="erc-nav__link {{ request()->routeIs('web_courses') ? 'active' : '' }}"
                                    href="{{ route('web_courses') }}">Escuela de Negocios</a>
                            </li>
                            <li class="nav-item dropdown erc-nav__drop">
                                <a class="erc-nav__link {{ request()->routeIs('web_services') || request()->routeIs('web_leadership') || request()->routeIs('web_accounting') || request()->routeIs('web_taxcompliance') ? 'active' : '' }} dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Servicios
                                </a>
                                <div class="dropdown-menu erc-nav__dropmenu">
                                    <a class="dropdown-item" href="{{ route('web_services') }}">Visión general</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ request()->routeIs('web_leadership') ? 'active' : '' }}" href="{{ route('web_leadership') }}">Liderazgo</a>
                                    <a class="dropdown-item {{ request()->routeIs('web_accounting') ? 'active' : '' }}" href="{{ route('web_accounting') }}">Contable</a>
                                    <a class="dropdown-item {{ request()->routeIs('web_taxcompliance') ? 'active' : '' }}" href="{{ route('web_taxcompliance') }}">Tax &amp; Compliance</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="erc-nav__link {{ request()->routeIs('web_contact_us') ? 'active' : '' }}"
                                    href="{{ route('web_contact_us') }}">Contacto</a>
                            </li>
                            <li class="nav-item erc-nav__theme-item">
                                <button type="button" id="erc-theme-toggle" class="erc-theme-toggle"
                                    aria-pressed="false" aria-label="Activar modo oscuro"
                                    title="Activar modo oscuro">
                                    {{-- En modo claro se muestra la luna (pulsa para ir a oscuro);
                                         en oscuro, el sol. --}}
                                    <i class="fa fa-moon erc-theme-toggle__icon erc-theme-toggle__icon--moon"
                                        aria-hidden="true"></i>
                                    <i class="fa fa-sun erc-theme-toggle__icon erc-theme-toggle__icon--sun"
                                        aria-hidden="true"></i>
                                </button>
                            </li>
                            <li class="nav-item erc-nav__cta-item">
                                <a class="erc-nav__cta" href="{{ route('login') }}" target="_blank" rel="noopener">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> Aula Virtual
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
        /* a.erc-topbar__item:hover { color: #ffc600; text-decoration: none; } */
        a.erc-topbar__item:hover { color: #fff; text-decoration: none; }
        .erc-topbar__icon {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: rgba(255, 198, 0, 0.16);
            /* color: #ffc600; */
            color: #fff;
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
        /* Contenedor más ancho que el estándar: el menú completo cabe con aire */
        .erc-container-wide { max-width: 1400px; width: 100%; margin: 0 auto; }
        .erc-nav__bar { padding: 10px 0; margin: 0; }
        .erc-nav__brand { padding: 0; margin: 0; }
        .erc-nav__brand img { width: 165px; height: auto; display: block; }
        .erc-nav__list { align-items: center; }
        .erc-nav__list .nav-item { padding: 0 2px; }
        .erc-nav__link {
            position: relative;
            display: inline-block;
            padding: 10px 11px !important;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            color: #1d2025 !important;
            transition: color .3s ease;
            white-space: nowrap;
        }
        .erc-nav__link::after {
            content: '';
            position: absolute;
            left: 11px;
            right: 11px;
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

        /* Dropdown de Servicios (áreas de práctica) */
        .erc-nav__dropmenu {
            position: absolute;
            top: 100%;
            left: 0;
            padding: 10px 6px;
            margin: 0;
            min-width: 220px;
            border: 1px solid #eceff5;
            border-radius: 14px;
            box-shadow: 0 14px 34px rgba(14, 23, 38, 0.12);
            background: #fff;
        }
        .erc-nav__dropmenu .dropdown-item {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #1d2025;
            border-radius: 8px;
            padding: 9px 14px;
            transition: all .25s ease;
        }
        .erc-nav__dropmenu .dropdown-item:hover,
        .erc-nav__dropmenu .dropdown-item.active {
            /* Resalte del submenú en el celeste de marca (el mismo del slider) */
            background: rgba(0, 160, 240, 0.14);
            color: #004aad;
        }
        .erc-nav__dropmenu .dropdown-divider { margin: 6px 8px; border-color: #eceff5; }
        .erc-nav__drop .dropdown-toggle::after {
            margin-left: 7px;
            vertical-align: middle;
            transition: transform .3s ease;
        }

        /* Desktop: el submenú abre automáticamente al pasar el mouse sobre 'Servicios' */
        @media (min-width: 992px) {
            .erc-nav__drop:hover > .erc-nav__dropmenu,
            .erc-nav__drop.show > .erc-nav__dropmenu {
                display: block;
            }
            .erc-nav__drop:hover .dropdown-toggle::after { transform: rotate(180deg); }
            /* Puente táctil de 8px para que el menú no se cierre al bajar el mouse */
            .erc-nav__drop::after {
                content: '';
                position: absolute;
                left: 0;
                right: 0;
                top: 100%;
                height: 8px;
            }
            .erc-nav__drop { position: relative; }
        }

        .erc-nav__cta-item { margin-left: 10px; }
        .erc-nav__cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            /* Degradado oficial invertido: navy denso sobre azul fuerte #0048B0 */
            background:
                linear-gradient(100deg,
                        rgba(8, 48, 88, 0.85) 0%,
                        rgba(8, 48, 88, 0.45) 55%,
                        rgba(8, 48, 88, 0) 85%),
                linear-gradient(100deg,
                        rgba(0, 72, 176, 0.95) 0%,
                        rgba(0, 72, 176, 0.80) 100%);
            /* color: #ffc600; */
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            padding: 10px 20px;
            /* Esquinas ligeramente redondeadas, como los cards del sitio */
            border-radius: 14px;
            text-decoration: none;
            transition: all .35s ease;
            white-space: nowrap;
        }
        .erc-nav__cta:hover {
            /* Hover unificado: amarillo de marca con texto navy */
            background: #ffc600;
            color: #07294d;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(255, 198, 0, 0.4);
        }

        /* ---- Logo según tema ----
           Selectores con la clase de la marca para ganar a la regla genérica
           .erc-nav__brand img (que fija display: block). ---- */
        .erc-nav__brand .erc-nav__logo--dark { display: none; }
        html[data-theme="dark"] .erc-nav__brand .erc-nav__logo--light { display: none; }
        html[data-theme="dark"] .erc-nav__brand .erc-nav__logo--dark { display: block; }

        /* ---- Interruptor de tema (claro/oscuro) ----
           En modo claro el botón muestra la luna ("pasa a oscuro"); en modo
           oscuro muestra el sol. ---- */
        .erc-nav__theme-item { margin-left: 8px; }
        .erc-theme-toggle {
            width: 40px;
            height: 40px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e3e8f0;
            border-radius: 50%;
            background: #f6f9fd;
            color: #07294d;
            font-size: 16px;
            line-height: 1;
            cursor: pointer;
            transition: background .3s ease, color .3s ease, border-color .3s ease, transform .3s ease;
        }
        .erc-theme-toggle:hover {
            background: #ffc600;
            border-color: #ffc600;
            color: #07294d;
            transform: translateY(-2px);
        }
        .erc-theme-toggle:focus-visible {
            outline: 2px solid #004aad;
            outline-offset: 2px;
        }
        html[data-theme="dark"] .erc-theme-toggle {
            background: #1b2a44;
            border-color: #33415a;
            color: #ffc600;
        }
        html[data-theme="dark"] .erc-theme-toggle:hover {
            background: #ffc600;
            border-color: #ffc600;
            color: #07294d;
        }
        /* Solo se pinta el icono del tema activo */
        .erc-theme-toggle__icon--sun { display: none; }
        html[data-theme="dark"] .erc-theme-toggle__icon--moon { display: none; }
        html[data-theme="dark"] .erc-theme-toggle__icon--sun { display: block; }

        /* ---- Toggler móvil ---- */
        .erc-nav__toggler {
            border: 2px solid #004aad;
            border-radius: 8px;
            padding: 8px 10px;
            transition: background .3s ease, border-color .3s ease;
        }
        /* Hover unificado: amarillo de marca con las barras en navy */
        .erc-nav__toggler:hover {
            background: #ffc600;
            border-color: #ffc600;
        }
        .erc-nav__toggler:hover .icon-bar { background: #07294d; }
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
            .erc-nav__theme-item { margin: 10px 0 0; }
            .erc-nav__brand img { width: 140px; }
        }
    </style>

    <script>
        /* Interruptor de tema. El sitio arranca en claro (ver layout) y la
           preferencia se guarda en localStorage. */
        (function () {
            var root = document.documentElement;
            var btn = document.getElementById('erc-theme-toggle');
            if (!btn) return;
            var moon = btn.querySelector('.erc-theme-toggle__icon--moon');
            var sun = btn.querySelector('.erc-theme-toggle__icon--sun');

            function isDark() { return root.getAttribute('data-theme') === 'dark'; }

            function paint() {
                var dark = isDark();
                var next = dark ? 'Activar modo claro' : 'Activar modo oscuro';
                btn.setAttribute('aria-pressed', dark ? 'true' : 'false');
                btn.setAttribute('aria-label', next);
                btn.setAttribute('title', next);
                if (moon) moon.style.display = dark ? 'none' : '';
                if (sun) sun.style.display = dark ? '' : 'none';
            }

            btn.addEventListener('click', function () {
                var dark = !isDark();
                root.setAttribute('data-theme', dark ? 'dark' : 'light');
                try { localStorage.setItem('erios-theme', dark ? 'dark' : 'light'); } catch (e) { }
                paint();
            });

            paint();
        })();
    </script>

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
