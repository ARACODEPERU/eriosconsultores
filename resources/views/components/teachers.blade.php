<div>
    <section id="teachers-part" class="pt-80 pb-100">
        <div class="container">

            {{-- Encabezado autocontenido (no depende del CSS de la home) --}}
            <div class="erc-tch-head" data-reveal>
                <span class="erc-tch-eyebrow">{{ $teachers_presentation[0]->content }}</span>
                <h2>{{ $teachers_presentation[1]->content }}</h2>
                <p>{{ $teachers_presentation[2]->content }}</p>
            </div>

            {{-- Grid centrado dinámicamente: filas incompletas quedan al medio --}}
            <div class="erc-teachers">
                @foreach ($teachers_information as $k => $teacher)
                    @php
                        $photo = $teacher->item->items[0]->content ?? '';
                        $name = $teacher->item->items[1]->content ?? '';
                        $role = $teacher->item->items[2]->content ?? '';
                        $bios = $teacher->item->items->slice(3)->values();
                        $modalId = 'teacher-modal-' . $teacher->id;
                    @endphp
                    <article class="erc-tch-card" data-reveal data-reveal-delay="{{ ($k % 3) * 120 }}">
                        <button type="button" class="erc-tch-card__trigger" data-toggle="modal" data-target="#{{ $modalId }}" aria-label="Ver perfil de {{ $name }}">
                            <span class="erc-tch-card__media">
                                <img src="{{ $photo ? asset('storage/' . $photo) : asset('themes/webpage/images/logo-2.png') }}"
                                    alt="{{ $name }}" class="erc-tch-card__photo"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-tch-card__photo--fallback');">
                                <span class="erc-tch-card__veil" aria-hidden="true">
                                    <span class="erc-tch-card__cta"><i class="fa fa-user" aria-hidden="true"></i> Ver perfil</span>
                                </span>
                            </span>
                        </button>
                        <div class="erc-tch-card__body">
                            <button type="button" class="erc-tch-card__name-btn" data-toggle="modal" data-target="#{{ $modalId }}">
                                {{ $name }}
                            </button>
                            <span class="erc-tch-card__role">{{ $role }}</span>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($showButton)
                <div class="erc-teachers__more" data-reveal>
                    <a href="{{ route('web_teachers') }}" class="erc-btn erc-btn--yellow">
                        Ver todos los docentes <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            @endif
        </div> <!-- container -->
    </section>

    {{-- ======== Modales con la información completa ======== --}}
    @foreach ($teachers_information as $teacher)
        @php
            $photo = $teacher->item->items[0]->content ?? '';
            $name = $teacher->item->items[1]->content ?? '';
            $role = $teacher->item->items[2]->content ?? '';
            $bios = $teacher->item->items->slice(3)->values();
            $modalId = 'teacher-modal-' . $teacher->id;
        @endphp
        <div class="modal fade erc-teacher-modal" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content erc-teacher-modal__content">
                    <button type="button" class="erc-teacher-modal__close" data-dismiss="modal" aria-label="Cerrar">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <div class="erc-teacher-modal__head">
                        <img src="{{ $photo ? asset('storage/' . $photo) : asset('themes/webpage/images/logo-2.png') }}"
                            alt="{{ $name }}" class="erc-teacher-modal__photo"
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-tch-card__photo--fallback');">
                        <h3 class="erc-teacher-modal__name">{{ $name }}</h3>
                        <span class="erc-teacher-modal__role">{{ $role }}</span>
                    </div>
                    <div class="erc-teacher-modal__body">
                        @if ($bios->count())
                            <ul>
                                @foreach ($bios as $bio)
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>{{ $bio->content }}</span></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        /* ============ ERIOS · Docentes (autocontenido) ============ */

        /* ---- Encabezado de sección ---- */
        .erc-tch-head { text-align: center; max-width: 720px; margin: 0 auto 50px; padding: 0 15px; }
        .erc-tch-eyebrow {
            position: relative; display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase; color: #004aad;
            padding: 0 44px 12px; margin-bottom: 12px;
        }
        .erc-tch-eyebrow::before, .erc-tch-eyebrow::after {
            content: ''; position: absolute; bottom: 0; width: 32px; height: 2px; background: #ffc600;
        }
        .erc-tch-eyebrow::before { left: 0; }
        .erc-tch-eyebrow::after { right: 0; }
        .erc-tch-head h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 34px; font-weight: 800; color: #1d2025; margin: 0 0 14px;
        }
        .erc-tch-head p { color: #6b7280; font-size: 15px; line-height: 26px; margin: 0; }

        /* ---- Grid centrado (filas incompletas al medio) ---- */
        .erc-teachers {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            justify-content: center;
            gap: 28px;
        }
        @media (max-width: 991px) { .erc-teachers { grid-template-columns: repeat(2, minmax(0,1fr)); } }
        @media (max-width: 575px) { .erc-teachers { grid-template-columns: 1fr; max-width: 340px; margin-left: auto; margin-right: auto; } }

        /* ---- Tarjeta con retrato grande ---- */
        .erc-tch-card {
            background: #fff;
            border: 1px solid #eceff5;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 6px 24px rgba(14, 23, 38, 0.07);
            transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
        }
        .erc-tch-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 44px rgba(0, 74, 173, 0.16);
            border-color: rgba(255, 198, 0, 0.55);
        }
        .erc-tch-card__trigger {
            display: block; width: 100%;
            background: none; border: none; padding: 0; cursor: pointer;
        }
        .erc-tch-card__media {
            position: relative; display: block;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            background: linear-gradient(135deg, #eef3fa, #e2ebf7);
        }
        .erc-tch-card__photo {
            width: 100%; height: 100%;
            object-fit: cover; object-position: center top;
            display: block;
            transition: transform .6s cubic-bezier(.22, .61, .36, 1);
        }
        .erc-tch-card__photo--fallback {
            object-fit: contain;
            background: linear-gradient(135deg, #004aad, #4a86e8);
            padding: 46px;
        }
        .erc-tch-card__trigger:hover .erc-tch-card__photo,
        .erc-tch-card__trigger:focus-visible .erc-tch-card__photo { transform: scale(1.06); }

        /* Overlay navy que sube desde abajo + badge "Ver perfil" */
        .erc-tch-card__veil {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(7, 41, 77, 0.88) 0%, rgba(7, 41, 77, 0.35) 42%, rgba(7, 41, 77, 0) 68%);
            opacity: 0;
            transition: opacity .4s ease;
            display: flex; align-items: flex-end; justify-content: center;
            padding-bottom: 26px;
        }
        .erc-tch-card__trigger:hover .erc-tch-card__veil,
        .erc-tch-card__trigger:focus-visible .erc-tch-card__veil { opacity: 1; }
        .erc-tch-card__cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: #ffc600; color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: .4px;
            padding: 9px 18px; border-radius: 50px;
            box-shadow: 0 8px 20px rgba(7, 41, 77, 0.35);
            transform: translateY(10px);
            transition: transform .4s ease;
        }
        .erc-tch-card__trigger:hover .erc-tch-card__cta { transform: translateY(0); }

        /* ---- Cuerpo: nombre + rol ---- */
        .erc-tch-card__body {
            padding: 18px 20px 22px;
            text-align: center;
            border-top: 3px solid #ffc600;
        }
        .erc-tch-card__name-btn {
            background: none; border: none; padding: 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 17px; font-weight: 700; color: #1d2025;
            cursor: pointer;
            position: relative;
            transition: color .3s ease;
        }
        .erc-tch-card__name-btn::after {
            content: ''; position: absolute; left: 50%; bottom: -5px;
            width: 0; height: 2px; background: #ffc600;
            transform: translateX(-50%);
            transition: width .35s ease;
        }
        .erc-tch-card__name-btn:hover { color: #004aad; }
        .erc-tch-card__name-btn:hover::after { width: 100%; }
        .erc-tch-card__role {
            display: block; margin-top: 10px;
            font-size: 13.5px; color: #6b7280;
        }

        /* ---- Accesibilidad: foco por teclado ---- */
        .erc-tch-card__trigger:focus-visible,
        .erc-tch-card__name-btn:focus-visible {
            outline: 3px solid #004aad;
            outline-offset: 3px;
            border-radius: 6px;
        }

        /* ---- Botón "Ver todos" ---- */
        .erc-teachers__more { text-align: center; margin-top: 48px; }
        .erc-teachers__more .erc-btn--yellow {
            display: inline-flex; align-items: center; gap: 10px;
            background: #ffc600; color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px; font-weight: 700;
            padding: 14px 30px; border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35);
            transition: all .35s ease;
        }
        .erc-teachers__more .erc-btn--yellow:hover {
            background: #004aad; color: #ffc600;
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(0, 74, 173, 0.3);
        }

        /* ---- Modal ---- */
        .erc-teacher-modal .modal-dialog { max-width: 560px; }
        .erc-teacher-modal__content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(7, 41, 77, 0.35);
        }
        .erc-teacher-modal__head {
            background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
            padding: 30px 28px 24px;
            text-align: center;
            position: relative;
        }
        .erc-teacher-modal__photo {
            width: 110px; height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 198, 0, 0.7);
            margin-bottom: 12px;
            background: #0b3a6b;
        }
        .erc-teacher-modal__photo--fallback {
            object-fit: contain;
            padding: 18px;
        }
        .erc-teacher-modal__name { color: #fff; font-size: 21px; font-weight: 700; margin: 0 0 4px; }
        .erc-teacher-modal__role { color: #ffc600; font-size: 13.5px; font-weight: 600; }
        .erc-teacher-modal__close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s ease;
            z-index: 2;
        }
        .erc-teacher-modal__close:hover { background: #ffc600; color: #07294d; }
        .erc-teacher-modal__body { padding: 24px 28px 28px; }
        .erc-teacher-modal__body ul { margin: 0; padding: 0; list-style: none; }
        .erc-teacher-modal__body li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            font-size: 14px;
            line-height: 23px;
            color: #505050;
            margin-bottom: 10px;
        }
        .erc-teacher-modal__body li i { color: #00ab55; margin-top: 4px; font-size: 14px; }

        /* ---- Responsivo del encabezado ---- */
        @media (max-width: 575px) {
            .erc-tch-head h2 { font-size: 27px; }
        }

        /* ---- Movimiento reducido ---- */
        @media (prefers-reduced-motion: reduce) {
            .erc-tch-card, .erc-tch-card__photo, .erc-tch-card__veil, .erc-tch-card__cta,
            .erc-tch-card__name-btn::after { transition: none !important; }
            .erc-tch-card:hover { transform: none; }
            .erc-tch-card__trigger:hover .erc-tch-card__photo { transform: none; }
        }
    </style>
</div>
