@extends('layouts.webpage')

@section('meta_title', 'Libro de Reclamaciones')
@section('meta_description', 'Libro de Reclamaciones de ERIOS CONSULTORES: registra tu reclamo o queja conforme al Código de Protección y Defensa del Consumidor. Tu solicitud será atendida a la brevedad.')

@section('page_styles')
<style>
    /* ============ ERIOS · Libro de Reclamaciones ============ */
    .erc-claims { padding: 90px 0 110px; background: #f4f7fb; }

    .erc-claims__head { text-align: center; max-width: 760px; margin: 0 auto 40px; padding: 0 15px; }
    .erc-claims__eyebrow {
        position: relative; display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700; font-size: 14px; letter-spacing: 2.5px;
        text-transform: uppercase; color: #004aad;
        padding: 0 44px 12px; margin-bottom: 12px;
    }
    .erc-claims__eyebrow::before, .erc-claims__eyebrow::after {
        content: ''; position: absolute; bottom: 0; width: 32px; height: 2px; background: #ffc600;
    }
    .erc-claims__eyebrow::before { left: 0; }
    .erc-claims__eyebrow::after { right: 0; }
    .erc-claims__head h2 { font-family: 'Montserrat', sans-serif; font-size: 34px; font-weight: 800; color: #1d2025; margin: 0 0 12px; }
    .erc-claims__head p { color: #6b7280; font-size: 15px; line-height: 26px; margin: 0; }

    /* Aviso legal */
    .erc-claims__notice {
        display: flex; gap: 16px; align-items: flex-start;
        background: #fff; border: 1px solid #eceff5; border-left: 4px solid #ffc600;
        border-radius: 14px; padding: 20px 24px;
        max-width: 900px; margin: 0 auto 48px;
        box-shadow: 0 6px 24px rgba(14, 23, 38, 0.05);
    }
    .erc-claims__notice i { color: #ffc600; font-size: 26px; margin-top: 2px; }
    .erc-claims__notice p { color: #505050; font-size: 13.5px; line-height: 1.75; margin: 0; }
    .erc-claims__notice strong { color: #07294d; }

    /* Layout */
    .erc-claims__form-card {
        background: #fff; border: 1px solid #eceff5; border-radius: 16px;
        padding: 38px 36px; box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
    }
    .erc-claims__form-head { margin-bottom: 28px; }
    .erc-claims__form-head span {
        display: inline-block; font-family: 'Montserrat', sans-serif;
        font-size: 11.5px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
        color: #004aad; background: rgba(0, 74, 173, 0.08);
        padding: 6px 14px; border-radius: 50px; margin-bottom: 12px;
    }
    .erc-claims__form-head h3 { font-family: 'Montserrat', sans-serif; font-size: 25px; font-weight: 800; color: #1d2025; margin: 0; }

    /* Campos (mismo lenguaje que /contactanos) */
    .erc-claims label { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 600; color: #07294d; margin-bottom: 7px; display: block; }
    .erc-claims label .req { color: #e5484d; }
    .erc-claims .form-control {
        height: 48px; border-radius: 12px; border: 1px solid #e3e9f2;
        background: #f6f9fd; font-size: 14px; color: #1d2025;
        box-shadow: none; transition: border-color .25s ease, box-shadow .25s ease;
        padding: 0 16px;
    }
    .erc-claims textarea.form-control { height: auto; padding: 13px 16px; }
    .erc-claims select.form-control { appearance: none; background-image: linear-gradient(45deg, transparent 50%, #004aad 50%), linear-gradient(135deg, #004aad 50%, transparent 50%); background-position: calc(100% - 20px) 21px, calc(100% - 14px) 21px; background-size: 6px 6px, 6px 6px; background-repeat: no-repeat; }
    .erc-claims .form-control:focus { border-color: #004aad; box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.12); background: #fff; }
    .erc-claims .field-error { color: #e5484d; font-size: 12.5px; margin-top: 6px; }
    .erc-claims .field-hint { color: #94a3b8; font-size: 12px; margin-top: 6px; }

    /* Selector Reclamo / Queja */
    .erc-claims__type { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .erc-claims__type input { position: absolute; opacity: 0; pointer-events: none; }
    .erc-claims__type label {
        position: relative; cursor: pointer; margin: 0;
        border: 2px solid #e3e9f2; border-radius: 12px;
        padding: 16px 18px 14px; text-align: center;
        transition: all .3s ease; background: #f6f9fd;
    }
    .erc-claims__type label i { display: block; font-size: 22px; color: #6b7280; margin-bottom: 8px; transition: color .3s ease; }
    .erc-claims__type label b { display: block; font-size: 15px; font-weight: 700; color: #1d2025; text-transform: uppercase; letter-spacing: .5px; }
    .erc-claims__type label small { display: block; color: #6b7280; font-size: 12px; line-height: 1.5; margin-top: 4px; }
    .erc-claims__type input:checked + label { border-color: #004aad; background: rgba(0, 74, 173, 0.06); box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.08); }
    .erc-claims__type input:checked + label i { color: #004aad; }
    .erc-claims__type input:focus-visible + label { outline: 3px solid #004aad; outline-offset: 3px; }

    /* Checkbox de aceptación */
    .erc-claims__accept {
        display: flex; gap: 12px; align-items: flex-start;
        background: #f6f9fd; border: 1px solid #e3e9f2; border-radius: 12px;
        padding: 16px 18px; margin-top: 26px;
    }
    .erc-claims__accept input { width: 19px; height: 19px; margin-top: 2px; accent-color: #004aad; cursor: pointer; flex: none; }
    .erc-claims__accept p { margin: 0; font-size: 13px; color: #505050; line-height: 1.7; }

    /* Botón enviar */
    .erc-claims__submit {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; height: 52px; margin-top: 26px;
        background: #ffc600; color: #07294d; border: none; border-radius: 50px;
        font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 700;
        cursor: pointer; box-shadow: 0 10px 24px rgba(255, 198, 0, 0.35);
        transition: all .3s ease;
    }
    .erc-claims__submit:hover { background: #004aad; color: #ffc600; transform: translateY(-2px); box-shadow: 0 14px 28px rgba(0, 74, 173, 0.3); }
    .erc-claims__submit[disabled] { opacity: .5; cursor: not-allowed; transform: none; }

    /* Columna informativa */
    .erc-claims__info {
        background: linear-gradient(160deg, #07294d 0%, #0b3a6b 70%, #0e4a8f 100%);
        border-radius: 16px; padding: 32px 30px; color: #fff;
        position: relative; overflow: hidden; height: 100%;
    }
    .erc-claims__info::after {
        content: ''; position: absolute; width: 190px; height: 190px; border-radius: 50%;
        border: 2px dashed rgba(255, 198, 0, 0.25); right: -70px; bottom: -70px;
    }
    .erc-claims__info i.erc-claims__info-icon {
        width: 54px; height: 54px; border-radius: 14px; background: rgba(255, 198, 0, 0.15);
        color: #ffc600; font-size: 24px;
        display: inline-flex; align-items: center; justify-content: center; margin-bottom: 18px;
    }
    .erc-claims__info h4 { font-family: 'Montserrat', sans-serif; font-size: 19px; font-weight: 700; margin: 0 0 10px; color: #fff; }
    .erc-claims__info > p { color: rgba(255, 255, 255, 0.78); font-size: 13.5px; line-height: 1.75; margin: 0 0 22px; }
    .erc-claims__step { display: flex; gap: 14px; margin-bottom: 18px; position: relative; z-index: 1; }
    .erc-claims__step-num {
        flex: none; width: 30px; height: 30px; border-radius: 50%;
        background: #ffc600; color: #07294d; font-weight: 700; font-size: 13.5px;
        display: inline-flex; align-items: center; justify-content: center;
        font-family: 'Montserrat', sans-serif;
    }
    .erc-claims__step b { display: block; font-size: 14px; margin-bottom: 3px; color: #fff; }
    .erc-claims__step span { font-size: 12.5px; color: rgba(255, 255, 255, 0.72); line-height: 1.6; }

    @media (max-width: 767px) {
        .erc-claims { padding: 60px 0 80px; }
        .erc-claims__head h2 { font-size: 27px; }
        .erc-claims__form-card { padding: 28px 22px; }
        .erc-claims__type { grid-template-columns: 1fr; }
        .erc-claims__info { margin-bottom: 30px; }
    }
</style>
@endsection

@section('content')

    <x-page-hero eyebrow="Protección al consumidor" title="Libro de Reclamaciones"
        subtitle="Registra tu reclamo o queja conforme a la Ley N° 29571. Tu solicitud será atendida y recibirás una respuesta a tu correo electrónico." />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <section class="erc-claims">
        <div class="container">

            <div class="erc-claims__head" data-reveal>
                <span class="erc-claims__eyebrow">Libro de Reclamaciones</span>
                <h2>Registra tu reclamo o queja</h2>
                <p>Cuéntanos qué sucedió: tu caso será revisado por nuestro equipo de atención al consumidor.</p>
            </div>

            <div class="erc-claims__notice" data-reveal>
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <p>
                    <strong>Según la Ley N° 29571, Código de Protección y Defensa del Consumidor,</strong>
                    ponemos a tu disposición este Libro de Reclamaciones. El
                    <strong>reclamo</strong> es la disconformidad sobre los productos o servicios contratados;
                    la <strong>queja</strong> es el malestar o descontento respecto a la atención al público.
                    Tus datos son tratados de manera confidencial conforme a la normativa de protección de datos personales.
                </p>
            </div>

            <div class="row">
                {{-- ======== Formulario ======== --}}
                <div class="col-lg-8">
                    <div class="erc-claims__form-card" data-reveal>
                        <div class="erc-claims__form-head">
                            <span>Formulario de reclamo</span>
                            <h3>Completa tus datos</h3>
                        </div>

                        <form method="POST" action="{{ route('web_complaints_book_store') }}" id="claims-form" novalidate>
                            @csrf

                            {{-- Tipo de solicitud --}}
                            <div class="form-group mb-4">
                                <label>Tipo de solicitud <span class="req">*</span></label>
                                <div class="erc-claims__type">
                                    <input type="radio" name="tipoReclamo" id="tipo-reclamo" value="reclamo" @checked(old('tipoReclamo') === 'reclamo') required>
                                    <label for="tipo-reclamo">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        <b>Reclamo</b>
                                        <small>Disconformidad sobre el producto o servicio contratado</small>
                                    </label>
                                    <input type="radio" name="tipoReclamo" id="tipo-queja" value="queja" @checked(old('tipoReclamo') === 'queja') required>
                                    <label for="tipo-queja">
                                        <i class="fa fa-commenting" aria-hidden="true"></i>
                                        <b>Queja</b>
                                        <small>Malestar respecto a la atención al público</small>
                                    </label>
                                </div>
                                @error('tipoReclamo')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            {{-- Datos personales --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="names">Nombres y apellidos <span class="req">*</span></label>
                                        <input type="text" name="names" id="names" class="form-control" value="{{ old('names') }}" placeholder="Ej. Juan Pérez García" required>
                                        @error('names')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipoIdentificacion">Tipo de documento <span class="req">*</span></label>
                                        <select name="tipoIdentificacion" id="tipoIdentificacion" class="form-control" required>
                                            <option value="" disabled {{ old('tipoIdentificacion') ? '' : 'selected' }}>Seleccione...</option>
                                            @foreach ($tipoDocumentos as $doc)
                                                <option value="{{ $doc->id }}" @selected(old('tipoIdentificacion') == $doc->id)>{{ $doc->description }}</option>
                                            @endforeach
                                        </select>
                                        @error('tipoIdentificacion')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni">Número de documento <span class="req">*</span></label>
                                        <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni') }}" maxlength="20" placeholder="Ej. 12345678" required>
                                        @error('dni')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono <span class="req">*</span></label>
                                        <input type="tel" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" maxlength="15" placeholder="Ej. 999 999 999" required>
                                        @error('telefono')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico <span class="req">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="tu@correo.com" required>
                                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                                        <div class="field-hint">Enviaremos la confirmación de registro y la respuesta a este correo.</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bien contratado --}}
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipoBien">Producto o servicio contratado <span class="req">*</span></label>
                                        <select name="tipoBien" id="tipoBien" class="form-control" required>
                                            <option value="" disabled {{ old('tipoBien') ? '' : 'selected' }}>Seleccione...</option>
                                            <option value="service" @selected(old('tipoBien') === 'service')>Servicio</option>
                                            <option value="product" @selected(old('tipoBien') === 'product')>Producto</option>
                                        </select>
                                        @error('tipoBien')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion_bien">Descripción del bien contratado <span class="req">*</span></label>
                                        <input type="text" name="descripcion_bien" id="descripcion_bien" class="form-control" value="{{ old('descripcion_bien') }}" placeholder="Ej. Servicio de asesoría tributaria" required>
                                        @error('descripcion_bien')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="moneda">Moneda del monto reclamado (opcional)</label>
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option value="" {{ old('moneda') ? '' : 'selected' }}>Sin monto</option>
                                            @foreach ($monedas as $moneda)
                                                <option value="{{ $moneda->id }}" @selected(old('moneda') == $moneda->id)>{{ $moneda->description }} ({{ $moneda->symbol }})</option>
                                            @endforeach
                                        </select>
                                        @error('moneda')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monto">Monto reclamado (opcional)</label>
                                        <input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto') }}" min="0" step="0.01" placeholder="Ej. 500.00">
                                        @error('monto')<div class="field-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Detalle del reclamo --}}
                            <div class="form-group mt-2">
                                <label for="reclamo">¿Cuál es su {{ strtolower(old('tipoReclamo', 'reclamo')) }}? <span class="req">*</span></label>
                                <textarea name="reclamo" id="reclamo" class="form-control" rows="4" placeholder="Describe los hechos de forma clara y detallada..." required>{{ old('reclamo') }}</textarea>
                                @error('reclamo')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label for="pedido">¿Cuál es su pedido? <span class="req">*</span></label>
                                <textarea name="pedido" id="pedido" class="form-control" rows="3" placeholder="Indica qué solución esperas..." required>{{ old('pedido') }}</textarea>
                                @error('pedido')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            {{-- Aceptación --}}
                            <div class="erc-claims__accept">
                                <input type="checkbox" name="acepto" id="acepto" value="1" @checked(old('acepto')) required>
                                <p>He leído y acepto el tratamiento de mis datos personales con la finalidad de tramitar esta solicitud, conforme a la Ley N° 29571 y la normativa de protección de datos personales.</p>
                            </div>
                            @error('acepto')<div class="field-error">{{ $message }}</div>@enderror

                            <button type="submit" class="erc-claims__submit" id="claims-submit">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar reclamo
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ======== Columna informativa ======== --}}
                <div class="col-lg-4">
                    <aside class="erc-claims__info" data-reveal data-reveal-delay="150">
                        <i class="fa fa-book erc-claims__info-icon" aria-hidden="true"></i>
                        <h4>¿Cómo funciona?</h4>
                        <p>Una vez registrado tu reclamo, recibirás un correo con el número de folio y nuestro equipo comenzará su revisión.</p>

                        <div class="erc-claims__step">
                            <span class="erc-claims__step-num">1</span>
                            <div>
                                <b>Registro</b>
                                <span>Completas el formulario y recibes tu folio por correo electrónico.</span>
                            </div>
                        </div>
                        <div class="erc-claims__step">
                            <span class="erc-claims__step-num">2</span>
                            <div>
                                <b>Revisión</b>
                                <span>Nuestro equipo de atención al consumidor analiza tu caso.</span>
                            </div>
                        </div>
                        <div class="erc-claims__step">
                            <span class="erc-claims__step-num">3</span>
                            <div>
                                <b>Respuesta</b>
                                <span>Te contactamos al correo registrado con la resolución.</span>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

        </div> <!-- container -->
    </section>

    {{-- Mensajes flash: éxito / error --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Reclamo registrado!',
                    text: {!! json_encode(session('success')) !!},
                    confirmButtonColor: '#004aad',
                    customClass: { container: 'sweet-modal-zindex' }
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Ups, ocurrió un problema',
                    text: {!! json_encode(session('error')) !!},
                    confirmButtonColor: '#004aad',
                    customClass: { container: 'sweet-modal-zindex' }
                });
            @endif

            {{-- Bloqueo anti doble envío --}}
            var form = document.getElementById('claims-form');
            var submit = document.getElementById('claims-submit');
            form.addEventListener('submit', function () {
                if (form.checkValidity()) {
                    submit.disabled = true;
                    submit.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Enviando...';
                }
            });
        });
    </script>
@endsection
