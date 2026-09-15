<div>
    <section id="teachers-part" class="pt-80 pb-100">
        <div class="container">

            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">{{ $teachers_presentation[0]->content }}</span>
                <h2>{{ $teachers_presentation[1]->content }}</h2>
                <p>{{ $teachers_presentation[2]->content }}</p>
            </div>

            {{-- Grid centrado dinámicamente: con center=True las filas incompletas quedan al medio --}}
            <div class="erc-teachers" style="display:grid; grid-template-columns: repeat(3, minmax(0,1fr)); justify-content:center;">
                @foreach ($teachers_information as $k => $teacher)
                    @php
                        $photo = $teacher->item->items[0]->content ?? '';
                        $name = $teacher->item->items[1]->content ?? '';
                        $role = $teacher->item->items[2]->content ?? '';
                        $bios = $teacher->item->items->slice(3)->values();
                        $modalId = 'teacher-modal-' . $teacher->id;
                    @endphp
                    <article class="erc-teacher-card erc-teacher-card--compact" data-reveal data-reveal-delay="{{ ($k % 3) * 120 }}">
                        <button type="button" class="erc-teacher-card__trigger" data-toggle="modal" data-target="#{{ $modalId }}" aria-label="Ver perfil de {{ $name }}">
                            <img src="{{ $photo ? asset('storage/' . $photo) : asset('themes/webpage/images/logo-2.png') }}"
                                alt="{{ $name }}" class="erc-teacher-card__photo"
                                onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-teacher-card__photo--fallback');">
                            <span class="erc-teacher-card__zoom"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                        </button>
                        <div class="erc-teacher-card__body">
                            <button type="button" class="erc-teacher-card__name-btn" data-toggle="modal" data-target="#{{ $modalId }}">
                                {{ $name }}
                            </button>
                            <span class="erc-teacher-card__role">{{ $role }}</span>
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
                            onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-teacher-card__photo--fallback');">
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
        /* ============ ERIOS · Docentes (tarjetas compactas + modal) ============ */
        .erc-teacher-card--compact {
            background: #fff;
            border: 1px solid #eceff5;
            border-radius: 16px;
            padding: 26px 22px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 6px 24px rgba(14, 23, 38, 0.06);
            transition: transform .35s ease, box-shadow .35s ease;
        }
        .erc-teacher-card--compact:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 74, 173, 0.14);
        }
        .erc-teacher-card__trigger {
            position: relative;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            border-radius: 50%;
            display: block;
        }
        .erc-teacher-card--compact .erc-teacher-card__photo {
            width: 110px;
            height: 110px;
        }
        .erc-teacher-card__zoom {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(0, 74, 173, 0.55);
            color: #fff;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .3s ease;
        }
        .erc-teacher-card__trigger:hover .erc-teacher-card__zoom,
        .erc-teacher-card__trigger:focus .erc-teacher-card__zoom { opacity: 1; }
        .erc-teacher-card__body { margin-top: 14px; }
        .erc-teacher-card__name-btn {
            background: none;
            border: none;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 16.5px;
            font-weight: 700;
            color: #1d2025;
            cursor: pointer;
            transition: color .3s ease;
        }
        .erc-teacher-card__name-btn:hover { color: #004aad; }
        .erc-teacher-card__role { display: block; margin-top: 4px; }
        .erc-teachers__more { text-align: center; margin-top: 44px; }

        /* ---- Modal ---- */
        .erc-teacher-modal .modal-dialog { max-width: 560px; }
        .erc-teacher-modal__content {
            border: none;
            border-radius: 16px;
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
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 198, 0, 0.7);
            margin-bottom: 12px;
        }
        .erc-teacher-modal__photo--fallback,
        img.erc-teacher-card__photo--fallback {
            object-fit: contain;
            background: linear-gradient(135deg, #004aad, #4a86e8);
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
    </style>
</div>
