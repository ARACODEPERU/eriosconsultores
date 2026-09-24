<div>
    <footer id="footer-part" class="erc-footer">
        {{-- ======== Banda principal ======== --}}
        <div class="erc-footer__main">
            <span class="erc-footer__circle erc-footer__circle--a" aria-hidden="true"></span>
            <span class="erc-footer__circle erc-footer__circle--b" aria-hidden="true"></span>
            <div class="container erc-footer__container">
                <div class="row">

                    {{-- Marca --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="erc-footer__col" data-reveal>
                            <img class="erc-footer__logo"
                                src="{{ asset('themes/webpage/images/Logo_Web_Negativo.png') }}"
                                alt="ERIOS CONSULTORES">
                            <p class="erc-footer__desc">
                                Consultoría tributaria, auditoría y fiscalización con estándares de calidad.
                                Más de 10 años impulsando el cumplimiento y el crecimiento de tu empresa.
                            </p>
                            <div class="erc-footer__social">
                                <a href="{{ $footer[3]->content }}" target="_blank" rel="noopener noreferrer"
                                    class="erc-footer__net" aria-label="Facebook">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                </a>
                                <a href="{{ $footer[4]->content }}" target="_blank" rel="noopener noreferrer"
                                    class="erc-footer__net" aria-label="Instagram">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                </a>
                                <a href="{{ $footer[5]->content }}" target="_blank" rel="noopener noreferrer"
                                    class="erc-footer__net" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin" aria-hidden="true"></i>
                                </a>
                                <a href="{{ optional($footer->firstWhere('position', 8))->content ?? '#' }}" @if($footer->where('position', 8)->count()) target="_blank" rel="noopener noreferrer" @endif
                                    class="erc-footer__net" aria-label="TikTok">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                </a>
                                <a href="{{ optional($footer->firstWhere('position', 9))->content ?? '#' }}" @if($footer->where('position', 9)->count()) target="_blank" rel="noopener noreferrer" @endif
                                    class="erc-footer__net" aria-label="X (Twitter)">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
                                </a>
                                <a href="{{ optional($footer->firstWhere('position', 10))->content ?? '#' }}" @if($footer->where('position', 10)->count()) target="_blank" rel="noopener noreferrer" @endif
                                    class="erc-footer__net" aria-label="YouTube">
                                    <i class="fab fa-youtube" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Navegar --}}
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="erc-footer__col" data-reveal data-reveal-delay="120">
                            <h6 class="erc-footer__title">Navegar</h6>
                            <ul class="erc-footer__links">
                                <li><a href="{{ route('index_main') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Home</a></li>
                                <li><a href="{{ route('web_about') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Nosotros</a></li>
                                <li><a href="{{ route('web_services') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Servicios</a></li>
                                <li><a href="{{ route('web_courses') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Cursos</a></li>
                                <li><a href="{{ route('web_teachers') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Docentes</a></li>
                                <li><a href="{{ route('web_contact_us') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Contáctanos</a></li>
                                <li><a href="https://www.zoho.com/mail/login.html" target="_blank" rel="noopener noreferrer"><i class="fa fa-angle-right" aria-hidden="true"></i>Web Mail</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Políticas --}}
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="erc-footer__col" data-reveal data-reveal-delay="240">
                            <h6 class="erc-footer__title">Políticas</h6>
                            <ul class="erc-footer__links">
                                <li><a href="{{ route('web_privacy_policies') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Políticas de Privacidad</a></li>
                                <li><a href="{{ route('web_return_policies') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Políticas de Devoluciones</a></li>
                                <li><a href="{{ route('web_complaints_book') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Libro de Reclamaciones</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Contacto --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="erc-footer__col" data-reveal data-reveal-delay="360">
                            <h6 class="erc-footer__title">Contáctanos</h6>
                            <ul class="erc-footer__contact">
                                <li>
                                    <span class="erc-footer__cicon"><i class="fa fa-home" aria-hidden="true"></i></span>
                                    <p>{{ $footer[0]->content }}</p>
                                </li>
                                <li>
                                    <span class="erc-footer__cicon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <p>{{ $footer[1]->content }}</p>
                                </li>
                                <li>
                                    <span class="erc-footer__cicon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <p><a class="erc-footer__mail" href="mailto:{{ $footer[2]->content }}">{{ $footer[2]->content }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ======== Barra de copyright ======== --}}
        <div class="erc-footer__bottom">
            <div class="container">
                <div class="erc-footer__bottom-inner">
                    <p>&copy; {{ date('Y') }} | ERIOS CONSULTORES Todos los derechos reservados.</p>
                    <p>Desarrollado por
                        <a href="https://aracodeperu.com/" target="_blank" rel="noopener noreferrer">ARACODE SMART SOLUTIONS</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* ============ ERIOS · Footer moderno ============ */
        .erc-footer { font-family: 'Montserrat', sans-serif; }

        .erc-footer__main {
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, #051d38 0%, #07294d 55%, #0b3a6b 100%);
            padding: 64px 0 46px;
        }
        .erc-footer__circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 198, 0, 0.06);
            pointer-events: none;
        }
        .erc-footer__circle--a { width: 320px; height: 320px; top: -140px; right: -90px; }
        .erc-footer__circle--b { width: 220px; height: 220px; bottom: -110px; left: -70px; }

        .erc-footer__container { position: relative; z-index: 1; }
        .erc-footer__col { padding: 10px 14px 22px; }
        @media (max-width: 767px) {
            .erc-footer__col { padding-bottom: 6px; }
        }

        .erc-footer__logo {
            width: 190px;
            height: auto;
            display: block;
            margin-bottom: 18px;
        }
        .erc-footer__desc {
            color: rgba(255, 255, 255, 0.72);
            font-size: 14px;
            line-height: 1.75;
            margin-bottom: 20px;
            max-width: 320px;
        }

        .erc-footer__title {
            position: relative;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin: 4px 0 22px;
            padding-bottom: 12px;
        }
        .erc-footer__title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 36px;
            height: 3px;
            border-radius: 3px;
            background: #ffc600;
        }

        /* ---- Enlaces ---- */
        .erc-footer__links { list-style: none; margin: 0; padding: 0; }
        .erc-footer__links li { margin-bottom: 12px; }
        .erc-footer__links a {
            display: inline-flex;
            align-items: baseline;
            gap: 8px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 14px;
            text-decoration: none;
            transition: color .3s ease, transform .3s ease;
        }
        .erc-footer__links a i {
            color: #ffc600;
            font-size: 13px;
            transition: transform .3s ease;
        }
        .erc-footer__links a:hover {
            color: #ffc600;
            text-decoration: none;
            transform: translateX(4px);
        }

        /* ---- Contacto ---- */
        .erc-footer__contact { list-style: none; margin: 0; padding: 0; }
        .erc-footer__contact li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        .erc-footer__cicon {
            flex: 0 0 auto;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 198, 0, 0.14);
            color: #ffc600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .erc-footer__contact p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            line-height: 1.6;
            margin: 4px 0 0;
        }
        .erc-footer__mail {
            color: #ffc600;
            text-decoration: none;
            transition: color .3s ease;
        }
        .erc-footer__mail:hover { color: #fff; text-decoration: none; }

        /* ---- Redes sociales ---- */
        .erc-footer__social { display: flex; gap: 10px; flex-wrap: wrap; }
        .erc-footer__net svg { width: 15px; height: 15px; display: block; }
        .erc-footer__net {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .3s ease;
        }
        .erc-footer__net:hover {
            background: #ffc600;
            border-color: #ffc600;
            color: #07294d;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(255, 198, 0, 0.25);
            text-decoration: none;
        }

        /* ---- Barra inferior ---- */
        .erc-footer__bottom {
            background: #04162b;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 18px 0;
        }
        .erc-footer__bottom-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
        }
        .erc-footer__bottom-inner p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13.5px;
            margin: 0;
        }
        .erc-footer__bottom-inner a {
            color: #ffc600;
            font-weight: 600;
            text-decoration: none;
            transition: color .3s ease;
        }
        .erc-footer__bottom-inner a:hover { color: #fff; text-decoration: none; }
        @media (max-width: 767px) {
            .erc-footer__bottom-inner { justify-content: center; text-align: center; }
        }
    </style>
</div>
