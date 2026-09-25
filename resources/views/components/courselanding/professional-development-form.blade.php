@props(['landing'])

@php
    $courseName = $landing->course->description ?? ($landing->course->name ?? 'Curso');
    $uid = 'erc-cl-lead-' . ($landing->id ?: \Illuminate\Support\Str::slug($landing->url_slug ?: 'curso'));

    $brochureUrl = $landing->course?->brochure?->path_file;
@endphp

<section class="erc-cl-sec erc-cl-sec--dark erc-cl-lead">
    <div class="container">
        <x-courselanding.head
            eyebrow="Brochure del programa"
            title="Estás muy cerca de asegurar tu vacante"
            description="Completa tus datos y un asesor de ERIOS CONSULTORES se comunicará contigo por WhatsApp para resolver tus consultas y enviarte la información completa del programa."
            icon="fa-file-pdf-o"
            tone="dark" />

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="erc-cl-lead__card" data-reveal>
                    <div class="row no-gutters align-items-stretch">
                        <div class="col-lg-5">
                            <div class="erc-cl-lead__intro">
                                <span class="erc-cl-lead__eyebrow">Incluye</span>

                                <ul class="erc-checklist">
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i> Temario y plan de estudios completo</li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i> Plana docente y sus credenciales</li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i> Modalidad, fechas y opciones de inversión</li>
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i> Certificación al finalizar el programa</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="erc-cl-lead__form-wrap">
                                <form class="erc-cl-lead__form" data-erc-cl-lead data-endpoint="{{ route('apisubscriber') }}"
                                    novalidate>
                                    @csrf
                                    <input type="hidden" name="flow_id" value="{{ $landing->flow_id ?? '' }}">
                                    <input type="hidden" name="subject" value="{{ $courseName }}">
                                    <input type="hidden" name="message" value="Landing de curso - Descargó brochure">

                                    <div class="form-group">
                                        <label for="{{ $uid }}-name">Nombres y apellidos</label>
                                        <div class="erc-cl-lead__input">
                                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                                            <input type="text" id="{{ $uid }}-name" name="full_name"
                                                placeholder="Ingresa tu nombre completo" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="{{ $uid }}-country">País</label>
                                                <div class="erc-cl-lead__input">
                                                    <span><i class="fa fa-flag" aria-hidden="true"></i></span>
                                                    <select id="{{ $uid }}-country" name="country_phone" required>
                                                        <optgroup label="América del Sur">
                                                            <option value="+51" data-code="pe" selected>Perú (+51)</option>
                                                            <option value="+54" data-code="ar">Argentina (+54)</option>
                                                            <option value="+591" data-code="bo">Bolivia (+591)</option>
                                                            <option value="+55" data-code="br">Brasil (+55)</option>
                                                            <option value="+56" data-code="cl">Chile (+56)</option>
                                                            <option value="+57" data-code="co">Colombia (+57)</option>
                                                            <option value="+593" data-code="ec">Ecuador (+593)</option>
                                                            <option value="+595" data-code="py">Paraguay (+595)</option>
                                                            <option value="+598" data-code="uy">Uruguay (+598)</option>
                                                            <option value="+58" data-code="ve">Venezuela (+58)</option>
                                                        </optgroup>
                                                        <optgroup label="Norte y Centroamérica">
                                                            <option value="+1" data-code="us">Estados Unidos (+1)</option>
                                                            <option value="+52" data-code="mx">México (+52)</option>
                                                            <option value="+502" data-code="gt">Guatemala (+502)</option>
                                                            <option value="+503" data-code="sv">El Salvador (+503)</option>
                                                            <option value="+504" data-code="hn">Honduras (+504)</option>
                                                            <option value="+505" data-code="ni">Nicaragua (+505)</option>
                                                            <option value="+506" data-code="cr">Costa Rica (+506)</option>
                                                            <option value="+507" data-code="pa">Panamá (+507)</option>
                                                            <option value="+1" data-code="do">República Dominicana (+1)</option>
                                                        </optgroup>
                                                        <optgroup label="Europa">
                                                            <option value="+34" data-code="es">España (+34)</option>
                                                            <option value="+39" data-code="it">Italia (+39)</option>
                                                            <option value="+49" data-code="de">Alemania (+49)</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="{{ $uid }}-phone">WhatsApp</label>
                                                <div class="erc-cl-lead__input">
                                                    <span><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                                                    <input type="tel" id="{{ $uid }}-phone" name="phone"
                                                        placeholder="955 555 555" inputmode="numeric" minlength="8"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="{{ $uid }}-email">Correo electrónico</label>
                                        <div class="erc-cl-lead__input">
                                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                            <input type="email" id="{{ $uid }}-email" name="email"
                                                placeholder="ejemplo@correo.com" required>
                                        </div>
                                    </div>

                                    <p class="erc-cl-lead__privacy">
                                        Confirmo mi interés y quedo atento(a) al contacto para avanzar profesionalmente.
                                        Tu información será tratada de forma confidencial.
                                    </p>

                                    <div class="erc-cl-lead__feedback" data-erc-cl-feedback role="alert" aria-live="polite"></div>

                                    <button type="submit" class="erc-btn erc-btn--yellow erc-btn--block erc-btn--lg"
                                        data-erc-cl-submit>
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Recibir información e inscribirme
                                    </button>

                                    @if ($brochureUrl)
                                        <p class="erc-cl-lead__note">Tienes el brochure disponible para descarga una vez te contactemos.</p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ============ ERIOS · Landing de curso · Formulario de brochure ============ */
        .erc-cl-lead__card {
            background: #fff;
            border-radius: var(--erc-radius);
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(5, 29, 56, 0.35);
        }

        .erc-cl-lead__intro {
            height: 100%;
            padding: 42px 36px;
            background: var(--erc-soft);
        }
        .erc-cl-lead__eyebrow {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 12.5px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--erc-blue);
            margin-bottom: 18px;
        }
        /* La tarjeta es clara aunque la banda sea navy: hay que reponer los
           colores de la lista que la banda oscura vuelve blancos. */
        .erc-cl-lead__intro .erc-checklist li { font-size: 15px; line-height: 25px; color: var(--erc-text); }
        .erc-cl-lead__intro .erc-checklist li i { color: var(--erc-blue); }

        .erc-cl-lead__form-wrap { padding: 42px 36px; }
        .erc-cl-lead__form label {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--erc-navy);
            margin-bottom: 7px;
        }
        .erc-cl-lead__input { display: flex; align-items: stretch; }
        .erc-cl-lead__input span {
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
        .erc-cl-lead__input input,
        .erc-cl-lead__input select {
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
        .erc-cl-lead__input input:focus,
        .erc-cl-lead__input select:focus { outline: none; border-color: var(--erc-blue); box-shadow: 0 0 0 3px rgba(0, 74, 173, 0.1); }

        .erc-cl-lead__privacy { font-size: 13px; line-height: 21px; color: var(--erc-muted); margin: 6px 0 14px; }
        .erc-cl-lead__feedback:empty { display: none; }
        .erc-cl-lead__feedback {
            background: rgba(227, 6, 19, 0.07);
            border: 1px solid rgba(227, 6, 19, 0.25);
            color: #b3000c;
            font-size: 13.5px;
            line-height: 22px;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 14px;
        }
        .erc-cl-lead__note { font-size: 12.5px; color: var(--erc-muted); margin: 12px 0 0; text-align: center; }

        @media (max-width: 991px) {
            .erc-cl-lead__intro { padding: 32px 24px; }
            .erc-cl-lead__form-wrap { padding: 30px 24px; }
        }
    </style>
</section>

@include('components.courselanding.lead-form-script')
