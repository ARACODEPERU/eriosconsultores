@props(['landing', 'onliItemId' => null])

@php
    $section = \App\Support\CourseLandingPresenter::sectionArray($landing->investment_section ?? null);
    $items = \App\Support\CourseLandingPresenter::items($landing->investment_section ?? null);

    $first = $items[0] ?? null;
    $second = $items[1] ?? null;

    $firstPrice = isset($first['price_now']) ? (float) $first['price_now'] : (float) ($landing->course->price ?? 0);
    $isFreeCourse = $firstPrice <= 0;
    $firstVisible = filled($first) && ($first['price_before_visible'] ?? false);

    $courseName = $landing->course->description ?? ($landing->course->name ?? 'Curso');
    $whatsappLink = $landing->whatsapp_link ?: null;
    $corporateLink = $landing->corporate_contact_link ?: $whatsappLink;

    // El item de tienda llega por prop; si no se envio se resuelve por el curso
    // para que el boton de inscripcion nunca quede con id 0.
    $cartItemId = $onliItemId ?: \App\Support\CourseLandingPresenter::onliItemId($landing);

    $identifier = 'erc-cl-inv-' . ($landing->id ?: \Illuminate\Support\Str::slug($landing->url_slug ?: 'curso'));
    $modalId = $identifier . '-asesor';

    $whatsappIcon = 'M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z';
@endphp

@if ($section !== [] || $isFreeCourse)
    <section class="erc-cl-sec erc-cl-sec--white erc-cl-inv" id="{{ $identifier }}">
        <div class="container">
            @if ($section !== [])
                <x-courselanding.head
                    :eyebrow="$section['name'] ?? null"
                    :title="$section['title'] ?? null"
                    :description="$section['description'] ?? null"
                    icon="fa-money" />
            @endif

            @if ($isFreeCourse && !$firstVisible)
                <div class="erc-cl-inv__free" data-reveal>
                    <span class="erc-cl-inv__free-badge">
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i> Acceso sin costo
                    </span>
                    <h3>Inscríbete gratis</h3>
                    <p>Este curso es gratuito. Agrégalo a tu carrito y completa tu inscripción sin costo.</p>
                    <button type="button" class="erc-btn erc-btn--yellow erc-btn--lg"
                        data-erc-cl-inscribe data-cart-id="{{ $cartItemId }}" data-course-name="{{ $courseName }}"
                        data-price="0" data-cart-url="{{ route('web_carrito') }}">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Inscribirme gratis
                    </button>
                </div>
            @endif

            @if ($items !== [])
                <div class="row justify-content-center">
                    {{-- Plan pronto pago --}}
                    @if ($first && $firstVisible)
                        <div class="col-md-6 col-lg-5" data-reveal>
                            <article class="erc-cl-inv__plan erc-cl-inv__plan--featured">
                                <header class="erc-cl-inv__plan-head">
                                    @if (filled($first['tag'] ?? null))
                                        <span class="erc-cl-inv__tag">{{ $first['tag'] }}</span>
                                    @endif
                                    <h3>{{ $first['title'] ?? '' }}</h3>
                                    <small>La más recomendada</small>
                                </header>

                                <div class="erc-cl-inv__plan-body">
                                    <div class="erc-cl-inv__price">
                                        @if ((float) ($first['price_now'] ?? 0) <= 0)
                                            <strong class="erc-cl-inv__free-text">Gratis</strong>
                                        @else
                                            <span class="erc-cl-inv__currency">S/</span>
                                            <strong>{{ $first['price_now'] }}</strong>
                                            <em>/ {{ $first['price_now_text'] ?? '' }}</em>
                                        @endif
                                    </div>

                                    @if ((float) ($first['price_now'] ?? 0) > 0)
                                        <p class="erc-cl-inv__before">
                                            <del>S/ {{ $first['price_before'] ?? '' }}</del>
                                            <span>/ {{ $first['price_before_text'] ?? '' }}</span>
                                        </p>
                                    @endif

                                    @if (filled($first['features'] ?? null))
                                        <ul class="erc-checklist erc-cl-inv__features">
                                            @foreach ($first['features'] as $feature)
                                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($isFreeCourse)
                                        <button type="button" class="erc-btn erc-btn--yellow erc-btn--block"
                                            data-erc-cl-inscribe data-cart-id="{{ $cartItemId }}"
                                            data-course-name="{{ $courseName }}" data-price="0"
                                            data-cart-url="{{ route('web_carrito') }}">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Inscribirme gratis
                                        </button>
                                    @else
                                        <button type="button" class="erc-btn erc-btn--yellow erc-btn--block"
                                            data-erc-cl-inscribe data-cart-id="{{ $cartItemId }}"
                                            data-course-name="{{ $courseName }}" data-price="{{ $firstPrice }}"
                                            data-cart-url="{{ route('web_carrito') }}">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Inscribirse ahora
                                        </button>
                                    @endif

                                    <button type="button" class="erc-btn erc-btn--outline erc-btn--block"
                                        data-toggle="modal" data-target="#{{ $modalId }}">
                                        <i class="fa fa-comments" aria-hidden="true"></i> Resolver mis consultas
                                    </button>
                                </div>
                            </article>
                        </div>
                    @endif

                    {{-- Plan corporativo --}}
                    @if ($second && ($second['price_before_visible'] ?? false))
                        <div class="col-md-6 col-lg-5" data-reveal data-reveal-delay="120">
                            <article class="erc-cl-inv__plan erc-cl-inv__plan--corporate">
                                <header class="erc-cl-inv__plan-head">
                                    <h3>{{ $second['tag'] ?? '' }}</h3>
                                    @if (filled($second['title'] ?? null))
                                        <small>{{ $second['title'] }}</small>
                                    @endif
                                </header>

                                <div class="erc-cl-inv__plan-body">
                                    <div class="erc-cl-inv__price">
                                        @if ((float) ($second['price_now'] ?? 0) <= 0)
                                            <strong class="erc-cl-inv__free-text">Gratis</strong>
                                        @else
                                            <span class="erc-cl-inv__currency">S/</span>
                                            <strong>{{ $second['price_now'] }}</strong>
                                            <em>/ {{ $second['price_now_text'] ?? '' }}</em>
                                        @endif
                                    </div>

                                    @if (filled($second['features'] ?? null))
                                        <ul class="erc-checklist erc-cl-inv__features">
                                            @foreach ($second['features'] as $feature)
                                                <li><i class="fa fa-check-circle" aria-hidden="true"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($corporateLink)
                                        <a href="{{ $corporateLink }}" target="_blank" rel="noopener noreferrer"
                                            class="erc-btn erc-btn--wa erc-btn--block">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" width="16" height="16" aria-hidden="true">
                                                <path d="{{ $whatsappIcon }}" />
                                            </svg>
                                            Contactar con un asesor
                                        </a>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Modal: un asesor resuelve las consultas --}}
        <div class="modal fade erc-cl-inv__modal" id="{{ $modalId }}" tabindex="-1" role="dialog"
            aria-labelledby="{{ $modalId }}-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $modalId }}-title">Estás muy cerca de asegurar tu vacante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p class="erc-cl-inv__modal-text">
                            Completa tus datos y un asesor de ERIOS CONSULTORES se comunicará contigo por WhatsApp para
                            resolver tus consultas y ayudarte con tu inscripción.
                        </p>

                        <form class="erc-cl-inv__form" data-erc-cl-lead
                            data-endpoint="{{ route('apisubscriber') }}" novalidate>
                            @csrf
                            <input type="hidden" name="flow_id" value="{{ $landing->flow_id ?? '' }}">
                            <input type="hidden" name="subject" value="{{ $courseName }}">
                            <input type="hidden" name="message" value="Landing de curso - Modal de consultas">

                            <div class="form-group">
                                <label for="{{ $modalId }}-name">Nombres y apellidos</label>
                                <div class="erc-cl-inv__input">
                                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" id="{{ $modalId }}-name" name="full_name"
                                        placeholder="Ingresa tu nombre completo" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="{{ $modalId }}-country">País</label>
                                        <div class="erc-cl-inv__input">
                                            <span><i class="fa fa-flag" aria-hidden="true"></i></span>
                                            <select id="{{ $modalId }}-country" name="country_phone" required>
                                                <option value="+51" data-code="pe" selected>Perú (+51)</option>
                                                <option value="+54" data-code="ar">Argentina (+54)</option>
                                                <option value="+591" data-code="bo">Bolivia (+591)</option>
                                                <option value="+56" data-code="cl">Chile (+56)</option>
                                                <option value="+57" data-code="co">Colombia (+57)</option>
                                                <option value="+593" data-code="ec">Ecuador (+593)</option>
                                                <option value="+52" data-code="mx">México (+52)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="{{ $modalId }}-phone">WhatsApp</label>
                                        <div class="erc-cl-inv__input">
                                            <span><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                                            <input type="tel" id="{{ $modalId }}-phone" name="phone"
                                                placeholder="955 555 555" inputmode="numeric" minlength="8"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="{{ $modalId }}-email">Correo electrónico</label>
                                <div class="erc-cl-inv__input">
                                    <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" id="{{ $modalId }}-email" name="email"
                                        placeholder="ejemplo@correo.com" required>
                                </div>
                            </div>

                            <p class="erc-cl-inv__privacy">Tu información será tratada de forma confidencial.</p>

                            <div class="erc-cl-inv__feedback" data-erc-cl-feedback role="alert" aria-live="polite"></div>

                            <button type="submit" class="erc-btn erc-btn--yellow erc-btn--block erc-btn--lg"
                                data-erc-cl-submit>
                                <i class="fa fa-whatsapp" aria-hidden="true"></i> Resolver mis últimas consultas
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* ============ ERIOS · Landing de curso · Inversión ============ */
            .erc-cl-inv__free {
                position: relative;
                overflow: hidden;
                text-align: center;
                background: linear-gradient(135deg, var(--erc-navy) 0%, #0b3a6b 60%, var(--erc-blue-mid) 100%);
                border-radius: var(--erc-radius);
                padding: 46px 30px;
                box-shadow: 0 18px 44px rgba(7, 41, 77, 0.24);
                margin-bottom: 30px;
            }
            .erc-cl-inv__free-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: rgba(255, 198, 0, 0.16);
                color: var(--erc-yellow);
                font-family: 'Montserrat', sans-serif;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 1.6px;
                text-transform: uppercase;
                padding: 7px 16px;
                border-radius: 50px;
                margin-bottom: 16px;
            }
            .erc-cl-inv__free h3 {
                font-family: 'Montserrat', sans-serif;
                font-size: 27px;
                font-weight: 700;
                color: #fff;
                margin: 0 0 12px;
            }
            .erc-cl-inv__free p {
                color: rgba(255, 255, 255, 0.8);
                font-family: 'Roboto', sans-serif;
                font-size: 16px;
                line-height: 28px;
                margin: 0 auto 24px;
                max-width: 620px;
            }

            .erc-cl-inv__plan {
                height: 100%;
                display: flex;
                flex-direction: column;
                background: #fff;
                border: 1px solid var(--erc-line);
                border-top: 5px solid var(--erc-yellow);
                border-radius: var(--erc-radius);
                overflow: hidden;
                box-shadow: var(--erc-shadow);
                transition: transform .35s ease, box-shadow .35s ease;
                margin-bottom: 26px;
            }
            .erc-cl-inv__plan:hover { transform: translateY(-6px); box-shadow: var(--erc-shadow-hover); }
            .erc-cl-inv__plan--corporate { border-top-color: var(--erc-navy); }

            .erc-cl-inv__plan-head {
                padding: 26px 26px 22px;
                border-bottom: 1px solid #eef2f7;
                background: rgba(255, 198, 0, 0.07);
            }
            .erc-cl-inv__plan--corporate .erc-cl-inv__plan-head { background: var(--erc-soft); }
            .erc-cl-inv__plan-head h3 {
                font-family: 'Montserrat', sans-serif;
                font-size: 20px;
                font-weight: 700;
                color: var(--erc-ink);
                margin: 0;
            }
            .erc-cl-inv__plan-head small { display: block; margin-top: 6px; font-size: 14px; color: var(--erc-muted); }
            .erc-cl-inv__tag {
                display: inline-block;
                background: var(--erc-yellow);
                color: var(--erc-navy);
                font-family: 'Montserrat', sans-serif;
                font-size: 11.5px;
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;
                padding: 5px 13px;
                border-radius: 50px;
                margin-bottom: 12px;
            }
            .erc-cl-inv__plan-body { flex: 1; display: flex; flex-direction: column; padding: 26px; }

            .erc-cl-inv__price { display: flex; align-items: baseline; justify-content: center; gap: 4px; margin-bottom: 10px; }
            .erc-cl-inv__price strong {
                font-family: 'Montserrat', sans-serif;
                font-size: 40px;
                font-weight: 800;
                color: var(--erc-blue);
                line-height: 1;
            }
            .erc-cl-inv__currency { font-family: 'Montserrat', sans-serif; font-weight: 700; color: var(--erc-blue); font-size: 20px; }
            .erc-cl-inv__price em { font-style: normal; color: var(--erc-muted); font-size: 14px; }
            .erc-cl-inv__free-text { color: var(--erc-green) !important; }
            .erc-cl-inv__before { text-align: center; margin: 0 0 20px; color: #94a3b8; font-size: 15px; }
            .erc-cl-inv__before del { color: #94a3b8; }

            .erc-cl-inv__features {
                margin: 0 0 24px;
                padding: 20px 0 0;
                border-top: 1px solid #eef2f7;
                flex: 1;
            }
            .erc-cl-inv__features li i { color: var(--erc-green); }
            .erc-cl-inv__plan-body .erc-btn { margin-bottom: 12px; }
            .erc-cl-inv__plan-body .erc-btn:last-child { margin-bottom: 0; }

            /* ---- Modal ---- */
            .erc-cl-inv__modal .modal-content {
                border: none;
                border-radius: var(--erc-radius);
                overflow: hidden;
                box-shadow: 0 24px 70px rgba(7, 41, 77, 0.3);
            }
            .erc-cl-inv__modal .modal-header {
                background: var(--erc-navy);
                color: #fff;
                border-bottom: none;
                padding: 20px 24px;
            }
            .erc-cl-inv__modal .modal-header .modal-title {
                font-family: 'Montserrat', sans-serif;
                font-size: 18px;
                font-weight: 700;
            }
            .erc-cl-inv__modal .modal-header .close {
                color: #fff;
                opacity: .85;
                text-shadow: none;
                font-size: 18px;
            }
            .erc-cl-inv__modal .modal-body { padding: 26px 24px 28px; }
            .erc-cl-inv__modal-text {
                font-family: 'Roboto', sans-serif;
                color: var(--erc-muted);
                font-size: 15px;
                line-height: 25px;
                margin-bottom: 20px;
            }

            .erc-cl-inv__form label {
                font-family: 'Montserrat', sans-serif;
                font-size: 14px;
                font-weight: 700;
                color: var(--erc-navy);
                margin-bottom: 7px;
            }
            .erc-cl-inv__input { display: flex; align-items: stretch; }
            .erc-cl-inv__input span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 44px;
                flex: none;
                background: var(--erc-soft);
                border: 1px solid #e3e9f2;
                border-right: none;
                border-radius: 10px 0 0 10px;
                color: var(--erc-blue);
            }
            .erc-cl-inv__input input,
            .erc-cl-inv__input select {
                flex: 1;
                width: 100%;
                height: 46px;
                padding: 0 14px;
                border: 1px solid #e3e9f2;
                border-radius: 0 10px 10px 0;
                background: #fff;
                font-family: 'Roboto', sans-serif;
                font-size: 14.5px;
                color: var(--erc-ink);
            }
            .erc-cl-inv__input input:focus,
            .erc-cl-inv__input select:focus { outline: none; border-color: var(--erc-blue); box-shadow: 0 0 0 3px rgba(0, 74, 173, 0.1); }
            .erc-cl-inv__privacy { font-size: 13px; color: var(--erc-muted); margin: 4px 0 14px; }
            .erc-cl-inv__feedback:empty { display: none; }
            .erc-cl-inv__feedback {
                background: rgba(227, 6, 19, 0.07);
                border: 1px solid rgba(227, 6, 19, 0.25);
                color: #b3000c;
                font-size: 13.5px;
                line-height: 22px;
                padding: 12px 14px;
                border-radius: 10px;
                margin-bottom: 14px;
            }

            @media (max-width: 767px) {
                .erc-cl-inv__plan-body, .erc-cl-inv__plan-head { padding: 22px 20px; }
                .erc-cl-inv__free { padding: 34px 22px; }
            }
        </style>
    </section>

    <script>
        (function () {
            if (window.ercClInvestmentReady) return;
            window.ercClInvestmentReady = true;

            var CART_KEY = 'carrito';

            function withSwal(callback) {
                if (window.Swal) { callback(); return; }

                var script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                script.onload = callback;
                script.onerror = callback;
                document.head.appendChild(script);
            }

            function readCart() {
                try {
                    var cart = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
                    return Array.isArray(cart) ? cart : [];
                } catch (error) {
                    return [];
                }
            }

            function addToCart(id) {
                var cart = readCart();
                var exists = cart.some(function (item) {
                    return parseInt(item.id, 10) === parseInt(id, 10);
                });

                if (!exists) {
                    cart.push({ id: parseInt(id, 10) });
                    localStorage.setItem(CART_KEY, JSON.stringify(cart));
                }

                return exists;
            }

            function closeModal(modal) {
                if (!modal) return;

                if (window.jQuery && window.jQuery.fn.modal) {
                    window.jQuery(modal).modal('hide');
                } else {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }

                document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) { backdrop.remove(); });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }

            document.addEventListener('click', function (event) {
                var button = event.target.closest('[data-erc-cl-inscribe]');
                if (!button) return;

                event.preventDefault();

                var id = button.getAttribute('data-cart-id');
                var name = button.getAttribute('data-course-name') || 'Curso';
                var price = parseFloat(button.getAttribute('data-price') || '0');
                var cartUrl = button.getAttribute('data-cart-url') || '/carrito';
                var isFree = price <= 0;

                if (!id || parseInt(id, 10) <= 0) {
                    withSwal(function () {
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Curso no disponible',
                                text: 'No encontramos este curso en la tienda. Escríbenos por WhatsApp y te ayudamos.',
                                confirmButtonColor: '#004aad'
                            });
                        }
                    });
                    return;
                }

                var alreadyInCart = addToCart(id);

                withSwal(function () {
                    if (!window.Swal) {
                        window.location.href = cartUrl;
                        return;
                    }

                    if (alreadyInCart) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ya está en tu carrito',
                            text: 'Este curso ya fue agregado anteriormente.',
                            showCancelButton: true,
                            confirmButtonText: 'Ir al carrito',
                            cancelButtonText: 'Seguir viendo',
                            confirmButtonColor: '#004aad',
                            cancelButtonColor: '#6b7280'
                        }).then(function (result) {
                            if (result.isConfirmed) window.location.href = cartUrl;
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: isFree ? '¡Inscripción gratuita!' : 'Curso agregado',
                        html: '<strong>' + name + '</strong> se agregó a tu carrito.' +
                            (isFree ? '<br><br><span style="color: #00ab55; font-weight: 600;">Este curso es gratuito. Ve al carrito para completar tu inscripción sin costo.</span>' : ''),
                        showCancelButton: true,
                        confirmButtonText: 'Ir al carrito',
                        cancelButtonText: 'Seguir viendo',
                        confirmButtonColor: '#004aad',
                        cancelButtonColor: '#6b7280'
                    }).then(function (result) {
                        if (result.isConfirmed) window.location.href = cartUrl;
                    });
                });
            });

        })();
    </script>

    @include('components.courselanding.lead-form-script')
@endif
