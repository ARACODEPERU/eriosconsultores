<div>
    <section id="services-page" class="pt-70 pb-60">
        <div class="container">

            {{-- ======== Encabezado de sección ======== --}}
            <div class="erc-services-head">
                <span class="erc-eyebrow">Lo que hacemos</span>
                <h2>Servicios pensados para el crecimiento de tu empresa</h2>
                <p>Asesoría tributaria especializada, defensa ante SUNAT y auditoría preventiva con un equipo de
                    profesionales con amplia trayectoria.</p>
            </div>

            {{-- ======== Grid de tarjetas grandes ======== --}}
            <div class="erc-services-grid">
                @foreach ($services as $service)
                    @php
                        $image = $service->item->items[0]->content ?? '';
                        $title = $service->item->items[1]->content ?? '';
                        $intro = trim($service->item->items[2]->content ?? '');
                        $details = trim($service->item->items[3]->content ?? '');
                        $num = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                        // Separar el intro del detalle: si el detalle empieza con "➢" es la lista; si no, es párrafo continuación
                        $detailsIsList = str_starts_with($details, '➢');
                        $icon = match ($loop->iteration) {
                            1 => 'fa-calculator',
                            2 => 'fa-search',
                            3 => 'fa-balance-scale',
                            4 => 'fa-gavel',
                            default => 'fa-briefcase',
                        };
                    @endphp
                    <article class="erc-service-card">
                        <div class="erc-service-card__media">
                            <img src="{{ $image ? asset('storage/' . $image) : asset('themes/webpage/images/logo-2.png') }}"
                                alt="{{ $title }}" class="erc-service-card__img"
                                onerror="this.onerror=null;this.src='{{ asset('themes/webpage/images/logo-2.png') }}';this.classList.add('erc-service-card__img--fallback');">
                        </div>

                        <div class="erc-service-card__body">
                            <div class="erc-service-card__head">
                                <span class="erc-service-card__icon"><i class="fa {{ $icon }}"
                                        aria-hidden="true"></i></span>
                                <span class="erc-service-card__num">{{ $num }}</span>
                            </div>

                            <h3 class="erc-service-card__title">{{ $title }}</h3>

                            @if ($intro)
                                <p class="erc-service-card__text">{{ $intro }}</p>
                            @endif

                            @if ($detailsIsList)
                                @php
                                    $bullets = array_values(array_filter(array_map('trim', explode('➢', $details))));
                                @endphp
                                <ul class="erc-service-card__list">
                                    @foreach ($bullets as $bullet)
                                        <li><i class="fa fa-check-circle"
                                                aria-hidden="true"></i><span>{{ $bullet }}</span></li>
                                    @endforeach
                                </ul>
                            @elseif ($details)
                                <p class="erc-service-card__text">{{ $details }}</p>
                            @endif
                            
                            <div class="erc-service-card__actions">
                                <button type="button" class="erc-svc-btn erc-svc-btn--request" data-toggle="modal"
                                    data-target="#serviceRequestModal" data-service="{{ $title }}">
                                    Solicitar este servicio <i class="fa fa-arrow-right erc-anim-arrow"
                                        aria-hidden="true"></i>
                                </button>
                                <a href="https://wa.link/9q9g9v" target="_blank" rel="noopener"
                                    class="erc-svc-btn erc-svc-btn--wa">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i> Consultar
                                </a>
                            </div>

                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======== Modal de solicitud de servicio ======== --}}
    <div class="modal fade erc-svc-modal" id="serviceRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="serviceRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="erc-svc-modal__close" data-dismiss="modal" aria-label="Cerrar">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <div class="erc-svc-modal__head">
                    <span class="erc-svc-modal__eyebrow">Solicitud de servicio</span>
                    <h3 id="serviceRequestModalLabel">Agenda tu asesoría</h3>
                    <p>Completa el formulario y un especialista te contactará a la brevedad.</p>
                    <div class="erc-svc-modal__service">
                        <i class="fa fa-briefcase" aria-hidden="true"></i> <span id="serviceRequestName"></span>
                    </div>
                </div>
                <div class="erc-svc-modal__body">
                    <form id="serviceRequestForm" name="service_request_form" action="{{ route('apisubscriber') }}"
                        method="post" data-toggle="validator" class="erc-svc-form">
                        @csrf
                        <input type="hidden" name="country_phone" value="+51">
                        <input type="hidden" name="subject" id="serviceRequestSubject" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-form form-group">
                                    <input name="full_name" type="text" placeholder="Nombres Completos"
                                        data-error="El nombre es requerido." required="required">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single form -->
                            </div>
                            <div class="col-md-6">
                                <div class="single-form form-group">
                                    <input name="email" type="email" placeholder="Correo Electrónico"
                                        data-error="Se requiere un correo válido." required="required">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single form -->
                            </div>
                            <div class="col-md-6">
                                <div class="single-form form-group">
                                    <input name="phone" type="text" placeholder="Teléfono"
                                        data-error="El teléfono es requerido." required="required">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single form -->
                            </div>
                            <div class="col-md-12">
                                <div class="single-form form-group">
                                    <textarea name="message" placeholder="Escribir Mensaje"
                                        data-error="Déjanos un mensaje, por favor." required="required"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single form -->
                            </div>
                            <p class="form-message erc-svc-form-message"></p>
                            <div class="col-md-12">
                                <div class="single-form">
                                    <button type="submit" class="erc-svc-submit">Enviar solicitud <i
                                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div> <!-- single form -->
                            </div>
                        </div> <!-- row -->
                    </form>
                </div>
            </div> <!-- modal-content -->
        </div> <!-- modal-dialog -->
    </div> <!-- modal -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function () {
            var modal = document.getElementById('serviceRequestModal');
            var form = document.getElementById('serviceRequestForm');

            // Rellenar el nombre del servicio al abrir el modal
            document.addEventListener('click', function (e) {
                var trigger = e.target.closest('.erc-svc-btn--request');
                if (!trigger) return;
                var service = trigger.getAttribute('data-service') || '';
                document.getElementById('serviceRequestName').textContent = service;
                document.getElementById('serviceRequestSubject').value = service;
                // Limpiar errores previos de validación del servidor
                var msg = form.querySelector('.erc-svc-form-message');
                if (msg) msg.innerHTML = '';
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var submitBtn = form.querySelector('.erc-svc-submit');
                submitBtn.disabled = true;
                submitBtn.style.opacity = 0.25;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', form.getAttribute('action'), true);
                xhr.onload = function () {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = 1;

                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Solicitud enviada!',
                                text: response.message,
                                customClass: { container: 'sweet-modal-zindex' }
                            });
                        }
                        form.reset();
                        if (window.jQuery) jQuery('#serviceRequestModal').modal('hide');
                    } else if (xhr.status === 422) {
                        var errorResponse = JSON.parse(xhr.responseText);
                        var errorMessages = errorResponse.errors || {};
                        var container = form.querySelector('.erc-svc-form-message');
                        container.innerHTML = '';
                        for (var field in errorMessages) {
                            if (errorMessages.hasOwnProperty(field)) {
                                container.innerHTML += errorMessages[field].join(', ') + '<br>';
                            }
                        }
                    } else {
                        console.error('Error en la solicitud: ' + xhr.status);
                    }
                };

                xhr.send(new FormData(form));
            });
        })();
    </script>

    <style>
        /* ===== Acciones de la tarjeta ===== */
        .erc-service-card__actions {
            margin-top: auto;
            padding-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .erc-svc-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 22px;
            border-radius: 5px;
            border: 2px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all .35s ease;
            line-height: 1;
        }
        .erc-svc-btn:hover { text-decoration: none; transform: translateY(-2px); }
        .erc-svc-btn--request {
            background: #ffc600;
            color: #07294d;
            box-shadow: 0 6px 18px rgba(255, 198, 0, 0.22);
        }
        .erc-svc-btn--request:hover {
            background: #004aad;
            color: #ffc600;
            box-shadow: 0 10px 24px rgba(0, 74, 173, 0.4);
        }
        .erc-svc-btn--request:hover .erc-anim-arrow { transform: translateX(6px); }
        .erc-svc-btn--wa {
            border-color: rgba(37, 211, 102, 0.6);
            color: #25D366;
            background: transparent;
        }
        .erc-svc-btn--wa:hover {
            background: #25D366;
            border-color: #25D366;
            color: #fff;
            box-shadow: 0 10px 24px rgba(37, 211, 102, 0.35);
        }

        /* ===== Modal de solicitud ===== */
        .sweet-modal-zindex { z-index: 20000 !important; }
        .erc-svc-modal .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(7, 41, 77, 0.35);
        }
        .erc-svc-modal__close {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 5;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all .3s ease;
        }
        .erc-svc-modal__close:hover { background: #ffc600; color: #07294d; }
        .erc-svc-modal__head {
            position: relative;
            background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
            color: #fff;
            padding: 30px 34px 26px;
            overflow: hidden;
        }
        .erc-svc-modal__head::after {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 2px solid rgba(255, 198, 0, 0.15);
            top: -110px;
            right: -60px;
        }
        .erc-svc-modal__eyebrow {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #ffc600;
            margin-bottom: 8px;
        }
        .erc-svc-modal__head h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 26px;
            font-weight: 700;
            margin: 0 0 6px;
        }
        .erc-svc-modal__head p {
            color: rgba(255, 255, 255, 0.78);
            font-size: 14.5px;
            margin: 0;
        }
        .erc-svc-modal__service {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-top: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 8px 18px;
            font-size: 13.5px;
            font-weight: 600;
        }
        .erc-svc-modal__service i { color: #ffc600; }
        .erc-svc-modal__body { padding: 28px 34px 34px; }

        .erc-svc-form .single-form { margin-top: 16px; }
        .erc-svc-form .form-group { margin: 0; }
        .erc-svc-form input,
        .erc-svc-form textarea {
            width: 100%;
            height: 52px;
            padding: 0 18px;
            background: #f8fafd;
            border: 2px solid #e6ecf5;
            border-radius: 12px;
            color: #1d2025;
            font-size: 15px;
            outline: none;
            transition: all .3s ease;
        }
        .erc-svc-form textarea { height: 120px; padding: 14px 18px; resize: vertical; }
        .erc-svc-form input::placeholder,
        .erc-svc-form textarea::placeholder { color: #9aa5b5; }
        .erc-svc-form input:focus,
        .erc-svc-form textarea:focus {
            background: #fff;
            border-color: #004aad;
            box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
        }
        .erc-svc-form .help-block.with-errors { color: #e5484d; font-size: 12.5px; margin-top: 6px; }
        .erc-svc-form .list-unstyled { margin: 0; }
        .erc-svc-form-message { color: #e5484d; font-size: 13px; margin: 10px 0 0; }

        .erc-svc-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ffc600;
            color: #07294d;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 15px;
            padding: 13px 32px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all .35s ease;
            box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35);
        }
        .erc-svc-submit:hover {
            background: #004aad;
            color: #ffc600;
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(0, 74, 173, 0.3);
        }
        .erc-svc-submit[disabled] { opacity: .45; cursor: not-allowed; transform: none; }

        @media (max-width: 575px) {
            .erc-svc-modal__head { padding: 24px 22px 22px; }
            .erc-svc-modal__body { padding: 22px 22px 26px; }
            .erc-svc-btn { padding: 11px 18px; font-size: 13px; }
        }
    </style>

    {{-- ======== Banda CTA final ======== --}}
    <section class="erc-cta-band">
        <div class="container">
            <div class="erc-cta-band__inner">
                <div class="erc-cta-band__text">
                    <h3>¿Necesitas asesoría tributaria para tu empresa?</h3>
                    <p>Agenda una reunión con nuestros especialistas y recibe una propuesta a la medida de tu negocio.
                    </p>
                </div>
                <a href="{{ route('web_contact_us') }}" class="erc-cta-band__btn">
                    Contáctanos <i class="fa fa-arrow-right erc-anim-arrow" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</div>
