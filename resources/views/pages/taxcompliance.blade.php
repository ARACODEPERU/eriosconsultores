@extends('layouts.webpage')

@section('meta_title', 'TAX & COMPLIANCE Consultores Tributarios')
@section('meta_description', 'TAX & COMPLIANCE de ERIOS Consultores: consultoría tributaria, cumplimiento normativo, planeamiento fiscal y defensa ante Sunat para empresas en Perú.')

@section('page_styles')
<style>
    /* ============ ERIOS · Página TAX & COMPLIANCE ============ */
    .erc-tax-sec { padding: 90px 0; }
    .erc-tax-sec--alt { background: #f5f8fc; }

    .erc-sec-head { max-width: 720px; margin: 0 auto 50px; text-align: center; }
    .erc-sec-eyebrow {
        display: inline-flex; align-items: center; gap: 12px;
        font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 13px;
        letter-spacing: 2.5px; text-transform: uppercase; color: #004aad;
    }
    .erc-sec-eyebrow::before, .erc-sec-eyebrow::after {
        content: ''; width: 35px; height: 2px; background: #ffc600;
    }
    .erc-sec-head h2 {
        font-family: 'Montserrat', sans-serif; font-size: 34px; font-weight: 800;
        color: #07294d; margin: 14px 0 12px; line-height: 1.25;
    }
    .erc-sec-head p { color: #505050; font-size: 15.5px; line-height: 27px; margin: 0; }

    /* Intro / sobre la práctica */
    .erc-tax-about { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 6fr); gap: 54px; align-items: center; }
    @media (max-width: 991px) { .erc-tax-about { grid-template-columns: 1fr; gap: 34px; } }
    .erc-tax-about__media { position: relative; }
    .erc-tax-about__imgwrap {
        border-radius: 18px; overflow: hidden;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        box-shadow: 0 14px 40px rgba(0, 74, 173, 0.18);
    }
    .erc-tax-about__img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .erc-tax-about__img--fallback { width: auto; max-width: 60%; margin: 0 auto; height: 400px; object-fit: contain; filter: brightness(0) invert(1); opacity: .92; padding: 30px 0; }
    .erc-tax-about__badge {
        position: absolute; left: -18px; top: 30px;
        display: inline-flex; align-items: center; gap: 9px;
        background: #ffc600; color: #07294d; border-radius: 50px;
        padding: 10px 20px; font-family: 'Montserrat', sans-serif;
        font-weight: 700; font-size: 13px; box-shadow: 0 10px 26px rgba(255, 198, 0, 0.35);
    }
    .erc-tax-about__accent { position: absolute; right: -20px; bottom: -20px; width: 55%; height: 55%; border: 3px solid #ffc600; border-radius: 18px; z-index: -1; }
    .erc-tax-about__title { font-size: 32px; font-weight: 800; color: #07294d; font-family: 'Montserrat', sans-serif; line-height: 1.25; margin: 0 0 16px; }
    .erc-tax-about__text { font-size: 15.5px; line-height: 27px; color: #505050; margin: 0 0 14px; }
    .erc-tax-points { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 22px; }
    @media (max-width: 480px) { .erc-tax-points { grid-template-columns: 1fr; } }
    .erc-tax-point {
        display: flex; gap: 12px; align-items: flex-start;
        background: #fff; border: 1px solid #e6edf6; border-radius: 14px;
        padding: 16px 18px; transition: all .3s ease;
    }
    .erc-tax-point:hover { border-color: rgba(255, 198, 0, .6); box-shadow: 0 10px 24px rgba(7, 41, 77, .08); transform: translateY(-3px); }
    .erc-tax-point i { color: #ffc600; font-size: 18px; margin-top: 2px; }
    .erc-tax-point b { color: #07294d; font-size: 14.5px; display: block; margin-bottom: 3px; }
    .erc-tax-point span { color: #505050; font-size: 13.5px; line-height: 21px; }

    /* Tarjetas de servicios */
    .erc-tax-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 26px; }
    @media (max-width: 991px) { .erc-tax-grid { grid-template-columns: 1fr; max-width: 560px; margin: 0 auto; } }
    .erc-tax-card {
        background: #fff; border: 1px solid #e6edf6; border-radius: 18px;
        padding: 30px 28px; transition: all .3s ease; display: flex; flex-direction: column;
    }
    .erc-tax-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(7, 41, 77, .12); border-color: rgba(255, 198, 0, .55); }
    .erc-tax-card__icon {
        width: 58px; height: 58px; border-radius: 16px;
        background: rgba(0, 74, 173, .08); color: #004aad;
        display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 18px;
        transition: all .3s ease;
    }
    .erc-tax-card:hover .erc-tax-card__icon { background: #ffc600; color: #07294d; }
    .erc-tax-card h3 { font-family: 'Montserrat', sans-serif; font-size: 19px; font-weight: 700; color: #07294d; margin: 0 0 10px; }
    .erc-tax-card p { color: #505050; font-size: 14px; line-height: 24px; margin: 0 0 16px; flex: 1; }
    .erc-tax-card ul { list-style: none; margin: 0; padding: 0; }
    .erc-tax-card ul li {
        display: flex; gap: 9px; align-items: flex-start;
        color: #40474f; font-size: 13.5px; line-height: 22px; margin-bottom: 7px;
    }
    .erc-tax-card ul li i { color: #28a745; font-size: 13px; margin-top: 4px; }

    /* Pasos de trabajo */
    .erc-tax-steps { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; counter-reset: step; }
    @media (max-width: 991px) { .erc-tax-steps { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 575px) { .erc-tax-steps { grid-template-columns: 1fr; } }
    .erc-tax-step {
        background: #fff; border: 1px solid #e6edf6; border-radius: 16px;
        padding: 26px 22px; text-align: center; transition: all .3s ease; position: relative;
    }
    .erc-tax-step:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(7, 41, 77, .10); border-color: rgba(255, 198, 0, .55); }
    .erc-tax-step__num {
        counter-increment: step;
        width: 46px; height: 46px; margin: 0 auto 14px; border-radius: 50%;
        background: #07294d; color: #ffc600; font-family: 'Montserrat', sans-serif;
        font-weight: 800; font-size: 17px; display: flex; align-items: center; justify-content: center;
    }
    .erc-tax-step__num::before { content: counter(step); }
    .erc-tax-step b { display: block; color: #07294d; font-size: 15px; font-family: 'Montserrat', sans-serif; margin-bottom: 6px; }
    .erc-tax-step span { color: #505050; font-size: 13.5px; line-height: 21px; }

    /* Banda final con CTA */
    .erc-tax-band {
        position: relative; overflow: hidden; color: #fff;
        background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
        padding: 74px 0; text-align: center;
    }
    .erc-tax-band::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; border: 2px solid rgba(255, 198, 0, .12); top: -120px; right: -80px; }
    .erc-tax-band::after { content: ''; position: absolute; width: 420px; height: 420px; border-radius: 50%; border: 2px solid rgba(255, 198, 0, .12); bottom: -180px; left: -120px; }
    .erc-tax-band .container { position: relative; z-index: 2; }
    .erc-tax-band .erc-sec-eyebrow { color: #fff; }
    .erc-tax-band h2 { font-family: 'Montserrat', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin: 14px 0 12px; }
    .erc-tax-band p { color: rgba(255, 255, 255, .78); font-size: 15.5px; line-height: 27px; max-width: 620px; margin: 0 auto 30px; }

    /* Formato homologado: degradado del logo + esquinas 14px (como el botón del menú) */
    .erc-btn { display: inline-flex; align-items: center; gap: 9px; font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 14.5px; border-radius: 14px; padding: 13px 30px; text-decoration: none; transition: all .3s ease; }
    .erc-btn--yellow {
        background:
            linear-gradient(100deg, rgba(8, 48, 88, 0.85) 0%, rgba(8, 48, 88, 0.45) 55%, rgba(8, 48, 88, 0) 85%),
            linear-gradient(100deg, rgba(0, 72, 176, 0.95) 0%, rgba(0, 72, 176, 0.80) 100%);
        color: #ffc600;
        box-shadow: 0 10px 26px rgba(8, 48, 88, .35);
    }
    .erc-btn--yellow:hover {
        background:
            linear-gradient(100deg, rgba(8, 48, 88, 0.55) 0%, rgba(8, 48, 88, 0.30) 55%, rgba(8, 48, 88, 0) 85%),
            linear-gradient(100deg, rgba(0, 160, 240, 0.95) 0%, rgba(0, 160, 240, 0.75) 60%, rgba(0, 160, 240, 0.55) 100%);
        color: #fff;
        transform: translateY(-2px);
        text-decoration: none;
    }
    .erc-btn--outline { border: 2px solid #fff; color: #fff; }
    .erc-btn--outline:hover { background: #ffc600; color: #07294d; border-color: #ffc600; text-decoration: none; }
    .erc-tax-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .erc-tax-actions--center { justify-content: center; }

    @media (max-width: 575px) {
        .erc-tax-sec { padding: 60px 0; }
        .erc-sec-head h2, .erc-tax-about__title, .erc-tax-band h2 { font-size: 26px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .erc-tax-card, .erc-tax-point, .erc-tax-step, .erc-btn { transition: none !important; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero compartido del sitio ======== --}}
    <x-page-hero
        eyebrow="TAX & COMPLIANCE ERIOS"
        title="Tax & Compliance"
        subtitle="Consultores tributarios: planeamiento fiscal, cumplimiento normativo y defensa especializada ante Sunat para que tu empresa pague lo justo y duerma tranquila." />

    {{-- ======== Intro / sobre la práctica ======== --}}
    <section class="erc-tax-sec">
        <div class="container">
            <div class="erc-tax-about" data-reveal>
                <div class="erc-tax-about__media">
                    <div class="erc-tax-about__imgwrap">
                        <img src="{{ asset('themes/webpage/images/logo-2.png') }}"
                            alt="TAX & COMPLIANCE Consultores Tributarios"
                            class="erc-tax-about__img erc-tax-about__img--fallback" loading="lazy">
                    </div>
                    <span class="erc-tax-about__badge"><i class="fa fa-balance-scale" aria-hidden="true"></i> Consultores Tributarios</span>
                    <span class="erc-tax-about__accent" aria-hidden="true"></span>
                </div>
                <div>
                    <span class="erc-sec-eyebrow">Tax &amp; Compliance</span>
                    <h2 class="erc-tax-about__title" style="margin-top: 12px;">Estrategia fiscal sólida, cumplimiento sin riesgos</h2>
                    <p class="erc-tax-about__text">
                        La práctica de <b>TAX &amp; COMPLIANCE</b> de ERIOS Consultores acompaña a empresas de todos
                        los regímenes con una mirada integral del tributo: no solo cumplimos obligaciones, diseñamos
                        la <b>estructura fiscal más eficiente</b> dentro de la ley y defendemos tus intereses ante
                        cualquier cuestionamiento de la administración.
                    </p>
                    <div class="erc-tax-points">
                        <div class="erc-tax-point">
                            <i class="fa fa-route" aria-hidden="true"></i>
                            <div><b>Planeamiento fiscal</b><span>Estructuración de operaciones y contratos con eficiencia tributaria.</span></div>
                        </div>
                        <div class="erc-tax-point">
                            <i class="fa fa-clipboard-check" aria-hidden="true"></i>
                            <div><b>Cumplimiento normativo</b><span>Protocolos internos y control de obligaciones ante Sunat.</span></div>
                        </div>
                        <div class="erc-tax-point">
                            <i class="fa fa-handshake" aria-hidden="true"></i>
                            <div><b>Defensa tributaria</b><span>Acompañamiento en fiscalizaciones, reclamaciones y apelaciones.</span></div>
                        </div>
                        <div class="erc-tax-point">
                            <i class="fa fa-globe-americas" aria-hidden="true"></i>
                            <div><b>Operación transnacional</b><span>Precios de transferencia y tributación de operaciones internacionales.</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== Servicios ======== --}}
    <section class="erc-tax-sec erc-tax-sec--alt">
        <div class="container">
            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">Servicios</span>
                <h2>Cobertura tributaria integral</h2>
                <p>Servicios de consultoría y cumplimiento para empresas en régimen general, MYPE y multinacionales con operaciones en Perú.</p>
            </div>
            <div class="erc-tax-grid">
                <article class="erc-tax-card" data-reveal>
                    <span class="erc-tax-card__icon"><i class="fa fa-chess" aria-hidden="true"></i></span>
                    <h3>Planeamiento tributario</h3>
                    <p>Análisis y diseño de la estrategia fiscal de tu negocio, en regla y con soporte documental.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Diagnóstico de eficiencia fiscal</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Opiniones y memos técnicos</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Elección de régimen tributario</span></li>
                    </ul>
                </article>
                <article class="erc-tax-card" data-reveal data-reveal-delay="120">
                    <span class="erc-tax-card__icon"><i class="fa fa-clipboard-list" aria-hidden="true"></i></span>
                    <h3>Cumplimiento y reporting</h3>
                    <p>Gestión estructurada de todas las obligaciones tributarias, formales y sustantivas.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Declaraciones mensuales y anuales</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Retenciones y percepciones</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Informes de cumplimiento internos</span></li>
                    </ul>
                </article>
                <article class="erc-tax-card" data-reveal data-reveal-delay="240">
                    <span class="erc-tax-card__icon"><i class="fa fa-gavel" aria-hidden="true"></i></span>
                    <h3>Controversias tributarias</h3>
                    <p>Defensa especializada en fiscalizaciones y procedimientos de cobranza.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Atención de auditorías Sunat</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Reclamaciones y recursos de apelación</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Recuperación de saldo a favor</span></li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    {{-- ======== Cómo trabajamos ======== --}}
    <section class="erc-tax-sec">
        <div class="container">
            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">Cómo trabajamos</span>
                <h2>Un método claro, sin sorpresas</h2>
            </div>
            <div class="erc-tax-steps">
                <div class="erc-tax-step" data-reveal>
                    <span class="erc-tax-step__num"></span>
                    <b>Evaluación</b>
                    <span>Mapeamos tu exposición fiscal y riesgos actuales.</span>
                </div>
                <div class="erc-tax-step" data-reveal data-reveal-delay="120">
                    <span class="erc-tax-step__num"></span>
                    <b>Estrategia</b>
                    <span>Diseñamos el plan de tributación y cumplimiento óptimo.</span>
                </div>
                <div class="erc-tax-step" data-reveal data-reveal-delay="240">
                    <span class="erc-tax-step__num"></span>
                    <b>Implementación</b>
                    <span>Ejecutamos el plan con soporte documental completo.</span>
                </div>
                <div class="erc-tax-step" data-reveal data-reveal-delay="360">
                    <span class="erc-tax-step__num"></span>
                    <b>Defensa continua</b>
                    <span>Monitoreamos cambios normativos y representamos ante Sunat.</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== Banda final con CTA ======== --}}
    <section class="erc-tax-band">
        <div class="container" data-reveal>
            <span class="erc-sec-eyebrow">Conversemos</span>
            <h2>Un equipo tributario de tu lado</h2>
            <p>Cuéntanos tu caso y recibe una primera opinión profesional sobre tu situación fiscal con Sunat.</p>
            <div class="erc-tax-actions erc-tax-actions--center">
                @php
                    $waLink = 'https://wa.me/51933435823?text=' . rawurlencode('¡Hola! Me interesa el servicio de TAX & COMPLIANCE de ERIOS Consultores.');
                @endphp
                <a class="erc-btn erc-btn--yellow" href="{{ $waLink }}" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i> Escríbeme ahora
                </a>
                <a class="erc-btn erc-btn--outline" href="{{ route('web_contact_us') }}">
                    Contáctanos <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
