@extends('layouts.webpage')

@section('meta_title', 'Servicios Contables')
@section('meta_description', 'Servicios contables con Esther Rios: contabilidad general, tributación, planillas, balances y regularización tributaria para empresas y negocios en Perú.')

@section('page_styles')
<style>
    /* ============ ERIOS · Página Servicios Contables ============ */
    .erc-acc-sec { padding: 90px 0; }
    .erc-acc-sec--alt { background: #f5f8fc; }

    .erc-sec-head { max-width: 720px; margin: 0 auto 50px; text-align: center; }
    .erc-sec-eyebrow {
        display: inline-flex; align-items: center; gap: 12px;
        font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 13px;
        letter-spacing: 2.5px; text-transform: uppercase; color: #004aad;
    }
    /* Los dos guiones del eyebrow dejan el amarillo por el degradado navy→celeste,
       espejados uno respecto al otro para que el celeste caiga hacia el texto. El
       selector arranca con html[data-theme] (el layout siempre lo fija) para cubrir
       todos los eyebrows de la página y para ganarle al celeste plano que el CSS
       generado del modo oscuro aplica aquí. Las bandas navy conservan su propio
       guion celeste, que va después y gana el empate. */
    html[data-theme] .erc-sec-eyebrow::before,
    html[data-theme] .erc-sec-eyebrow::after {
        content: ''; width: 35px; height: 2px;
    }
    html[data-theme] .erc-sec-eyebrow::before { background: linear-gradient(90deg, #083058 0%, #00b6ff 100%); }
    html[data-theme] .erc-sec-eyebrow::after { background: linear-gradient(90deg, #00b6ff 0%, #083058 100%); }
    .erc-sec-head h2 {
        font-family: 'Montserrat', sans-serif; font-size: 34px; font-weight: 800;
        color: #07294d; margin: 14px 0 12px; line-height: 1.25;
    }
    .erc-sec-head p { color: #505050; font-size: 15.5px; line-height: 27px; margin: 0; }

    /* Tarjeta intro / sobre el servicio */
    .erc-acc-about { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 6fr); gap: 54px; align-items: center; }
    @media (max-width: 991px) { .erc-acc-about { grid-template-columns: 1fr; gap: 34px; } }
    .erc-acc-about__media { position: relative; }
    .erc-acc-about__imgwrap {
        border-radius: 18px; overflow: hidden;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        box-shadow: 0 14px 40px rgba(0, 74, 173, 0.18);
    }
    .erc-acc-about__img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .erc-acc-about__img--fallback { width: auto; max-width: 60%; margin: 0 auto; height: 400px; object-fit: contain; filter: brightness(0) invert(1); opacity: .92; padding: 30px 0; }
    /* La píldora pasa a celeste de marca con la letra en blanco (antes amarillo con
       letra navy), y su sombra deja el halo amarillo. */
    .erc-acc-about__badge {
        position: absolute; left: -18px; top: 30px;
        display: inline-flex; align-items: center; gap: 9px;
        background: #00b6ff; color: #fff; border-radius: 50px;
        padding: 10px 20px; font-family: 'Montserrat', sans-serif;
        font-weight: 700; font-size: 13px; box-shadow: 0 10px 26px rgba(0, 182, 255, 0.38);
    }
    /* El aro pasa a filete con el degradado navy→celeste. Un borde no admite
       degradado, así que se pinta el relleno y se recorta el interior con una
       máscara, que deja las esquinas de 18px intactas. El prefijo .erc-acc-about
       es para ganarle al `border: 3px solid #00b6ff` del modo oscuro generado. */
    .erc-acc-about .erc-acc-about__accent {
        position: absolute; right: -20px; bottom: -20px; width: 55%; height: 55%;
        border: 3px solid transparent; border-radius: 18px;
        background: linear-gradient(100deg, #083058 0%, #00b6ff 100%) border-box;
        -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
        mask-composite: exclude;
        z-index: -1;
    }
    .erc-acc-about__title { font-size: 32px; font-weight: 800; color: #07294d; font-family: 'Montserrat', sans-serif; line-height: 1.25; margin: 0 0 16px; }
    .erc-acc-about__text { font-size: 15.5px; line-height: 27px; color: #505050; margin: 0 0 14px; }
    .erc-acc-points { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 22px; }
    @media (max-width: 480px) { .erc-acc-points { grid-template-columns: 1fr; } }
    .erc-acc-point {
        display: flex; gap: 12px; align-items: flex-start;
        background: #fff; border: 1px solid #e6edf6; border-radius: 14px;
        padding: 16px 18px; transition: all .3s ease;
    }
    .erc-acc-point:hover { border-color: rgba(0, 182, 255, .6); box-shadow: 0 10px 24px rgba(7, 41, 77, .08); transform: translateY(-3px); }
    .erc-acc-point i { color: #ffc600; font-size: 18px; margin-top: 2px; }
    .erc-acc-point b { color: #07294d; font-size: 14.5px; display: block; margin-bottom: 3px; }
    .erc-acc-point span { color: #505050; font-size: 13.5px; line-height: 21px; }

    /* Tarjetas de servicios */
    .erc-acc-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 26px; }
    @media (max-width: 991px) { .erc-acc-grid { grid-template-columns: 1fr; max-width: 560px; margin: 0 auto; } }
    .erc-acc-card {
        background: #fff; border: 1px solid #e6edf6; border-radius: 18px;
        padding: 30px 28px; transition: all .3s ease; display: flex; flex-direction: column;
    }
    .erc-acc-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(7, 41, 77, .12); border-color: rgba(0, 182, 255, .55); }
    .erc-acc-card__icon {
        width: 58px; height: 58px; border-radius: 16px;
        background: rgba(0, 74, 173, .08); color: #004aad;
        display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 18px;
        transition: all .3s ease;
    }
    /* La caja del icono pasa a celeste con el icono en blanco (antes el amarillo con
       el icono navy), como el resto de hovers con relleno celeste del sitio. */
    .erc-acc-card:hover .erc-acc-card__icon { background: #00b6ff; color: #fff; }
    .erc-acc-card h3 { font-family: 'Montserrat', sans-serif; font-size: 19px; font-weight: 700; color: #07294d; margin: 0 0 10px; }
    .erc-acc-card p { color: #505050; font-size: 14px; line-height: 24px; margin: 0 0 16px; flex: 1; }
    .erc-acc-card ul { list-style: none; margin: 0; padding: 0; }
    .erc-acc-card ul li {
        display: flex; gap: 9px; align-items: flex-start;
        color: #40474f; font-size: 13.5px; line-height: 22px; margin-bottom: 7px;
    }
    .erc-acc-card ul li i { color: #28a745; font-size: 13px; margin-top: 4px; }

    /* Pasos de trabajo */
    .erc-acc-steps { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; counter-reset: step; }
    @media (max-width: 991px) { .erc-acc-steps { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 575px) { .erc-acc-steps { grid-template-columns: 1fr; } }
    .erc-acc-step {
        background: #fff; border: 1px solid #e6edf6; border-radius: 16px;
        padding: 26px 22px; text-align: center; transition: all .3s ease; position: relative;
    }
    .erc-acc-step:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(7, 41, 77, .10); border-color: rgba(0, 182, 255, .55); }
    /* El número del paso es un chip navy: su letra deja el amarillo por el celeste. */
    /* Con dos clases gana a `.erc-acc-step span`, que pisaba el color y el tamaño
       y dejaba el número gris sobre el chip navy. */
    .erc-acc-step .erc-acc-step__num {
        counter-increment: step;
        width: 46px; height: 46px; margin: 0 auto 14px; border-radius: 50%;
        /* Chip navy: la letra deja el amarillo por el celeste de marca. */
        background: #07294d; color: #00b6ff; font-family: 'Montserrat', sans-serif;
        font-weight: 800; font-size: 17px; display: flex; align-items: center; justify-content: center;
    }
    .erc-acc-step__num::before { content: counter(step); }
    .erc-acc-step b { display: block; color: #07294d; font-size: 15px; font-family: 'Montserrat', sans-serif; margin-bottom: 6px; }
    .erc-acc-step span { color: #505050; font-size: 13.5px; line-height: 21px; }

    /* Banda final con CTA */
    .erc-acc-band {
        position: relative; overflow: hidden; color: #fff;
        background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
        padding: 74px 0; text-align: center;
    }
    /* La banda es navy: sus adornos dejan el amarillo y pasan a celeste. */
    .erc-acc-band::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; border: 2px solid rgba(0, 182, 255, .16); top: -120px; right: -80px; }
    .erc-acc-band::after { content: ''; position: absolute; width: 420px; height: 420px; border-radius: 50%; border: 2px solid rgba(0, 182, 255, .16); bottom: -180px; left: -120px; }
    .erc-acc-band .container { position: relative; z-index: 2; }
    .erc-acc-band .erc-sec-eyebrow { color: #fff; }
    /* La banda conserva el guion celeste plano: sobre el navy, el extremo navy del
       degradado general se perdería. Va con html[data-theme] delante para ganarle
       a ese degradado, que es más específico que el selector de la banda. */
    html[data-theme] .erc-acc-band .erc-sec-eyebrow::before,
    html[data-theme] .erc-acc-band .erc-sec-eyebrow::after { background: #00b6ff; }
    .erc-acc-band h2 { font-family: 'Montserrat', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin: 14px 0 12px; }
    .erc-acc-band p { color: rgba(255, 255, 255, .78); font-size: 15.5px; line-height: 27px; max-width: 620px; margin: 0 auto 30px; }

    /* Formato homologado: degradado del logo + esquinas 14px (como el botón del menú) */
    .erc-btn { display: inline-flex; align-items: center; gap: 9px; font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 14.5px; border-radius: 14px; padding: 13px 30px; text-decoration: none; transition: all .3s ease; }
    .erc-btn--yellow {
        background:
            linear-gradient(100deg, rgba(8, 48, 88, 0.85) 0%, rgba(8, 48, 88, 0.45) 55%, rgba(8, 48, 88, 0) 85%),
            linear-gradient(100deg, rgba(0, 72, 176, 0.95) 0%, rgba(0, 72, 176, 0.80) 100%);
        /* Sobre el degradado navy la letra va en blanca, como en el resto de
           botones del sitio (el celeste ahí solo daría 3,5:1). */
        color: #fff;
        box-shadow: 0 10px 26px rgba(8, 48, 88, .35);
    }
    .erc-btn--yellow:hover {
        background:
            linear-gradient(100deg, rgba(8, 48, 88, 0.55) 0%, rgba(8, 48, 88, 0.30) 55%, rgba(8, 48, 88, 0) 85%),
            linear-gradient(100deg, rgba(0, 182, 255, 0.95) 0%, rgba(0, 182, 255, 0.75) 60%, rgba(0, 182, 255, 0.55) 100%);
        color: #fff;
        transform: translateY(-2px);
        text-decoration: none;
    }
    .erc-btn--outline { border: 2px solid #fff; color: #fff; }
    /* Hover celeste con la letra en blanca, también en la banda navy. */
    .erc-btn--outline:hover { background: #00b6ff; color: #fff; border-color: #00b6ff; text-decoration: none; }
    .erc-acc-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .erc-acc-actions--center { justify-content: center; }

    @media (max-width: 575px) {
        .erc-acc-sec { padding: 60px 0; }
        .erc-sec-head h2, .erc-acc-about__title, .erc-acc-band h2 { font-size: 26px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .erc-acc-card, .erc-acc-point, .erc-acc-step, .erc-btn { transition: none !important; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero compartido del sitio ======== --}}
    <x-page-hero
        eyebrow="Contable ERIOS"
        title="Servicios Contables"
        subtitle="Contabilidad y tributación manejada por especialistas: llevamos tu contabilidad al día, planificamos tus impuestos y evitarte multas y sorpresas." />

    {{-- ======== Intro / sobre el servicio ======== --}}
    <section class="erc-acc-sec">
        <div class="container">
            <div class="erc-acc-about" data-reveal>
                <div class="erc-acc-about__media">
                    <div class="erc-acc-about__imgwrap">
                        <img src="{{ asset('themes/webpage/images/logo-2.png') }}"
                            alt="Servicios contables de ERIOS Consultores"
                            class="erc-acc-about__img erc-acc-about__img--fallback" loading="lazy">
                    </div>
                    <span class="erc-acc-about__badge"><i class="fa fa-calculator" aria-hidden="true"></i> Más de 15 años de experiencia</span>
                    <span class="erc-acc-about__accent" aria-hidden="true"></span>
                </div>
                <div>
                    <span class="erc-sec-eyebrow">Esther Rios</span>
                    <h2 class="erc-acc-about__title" style="margin-top: 12px;">Tu contabilidad en orden, tu negocio enfocado</h2>
                    <p class="erc-acc-about__text">
                        Como <b>contadora pública y consultora tributaria</b>, Esther Rios y su equipo asumen la
                        contabilidad de tu empresa con rigor técnico y cercanía: declaraciones puntuales, estados
                        financieros claros y asesoría permanente para que tomes decisiones con información confiable.
                    </p>
                    <div class="erc-acc-points">
                        <div class="erc-acc-point">
                            <i class="fa fa-file-invoice-dollar" aria-hidden="true"></i>
                            <div><b>Declaraciones puntuales</b><span>Sunat, planillas y obligaciones parcales sin retrasos ni multas.</span></div>
                        </div>
                        <div class="erc-acc-point">
                            <i class="fa fa-shield-alt" aria-hidden="true"></i>
                            <div><b>Cumplimiento total</b><span>Tu empresa al día con la normativa tributaria vigente.</span></div>
                        </div>
                        <div class="erc-acc-point">
                            <i class="fa fa-chart-pie" aria-hidden="true"></i>
                            <div><b>Información clara</b><span>Balances e indicadores que sí entiende el dueño del negocio.</span></div>
                        </div>
                        <div class="erc-acc-point">
                            <i class="fa fa-lightbulb" aria-hidden="true"></i>
                            <div><b>Asesoría permanente</b><span>Planeamiento tributario y soporte ante consultas de Sunat.</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== Servicios ======== --}}
    <section class="erc-acc-sec erc-acc-sec--alt">
        <div class="container">
            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">Servicios</span>
                <h2>Todo lo que tu contabilidad necesita</h2>
                <p>Planes flexibles para empresas, emprendimientos y personas naturales con negocio, en régimen general o MRyS.</p>
            </div>
            <div class="erc-acc-grid">
                <article class="erc-acc-card" data-reveal>
                    <span class="erc-acc-card__icon"><i class="fa fa-calculator" aria-hidden="true"></i></span>
                    <h3>Contabilidad general</h3>
                    <p>Llevanza completa de tu contabilidad mensual con revisión profesional permanente.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Registros y asientos contables</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Conciliaciones bancarias</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Estados financieros mensuales</span></li>
                    </ul>
                </article>
                <article class="erc-acc-card" data-reveal data-reveal-delay="120">
                    <span class="erc-acc-card__icon"><i class="fa fa-file-invoice" aria-hidden="true"></i></span>
                    <h3>Tributación y Sunat</h3>
                    <p>Declaraciones y obligaciones tributarias puntuales, con planeamiento fiscal responsable.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Declaración mensual (IGV, retenciones)</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Anual: renta, IR y otros</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Atención a notificaciones de Sunat</span></li>
                    </ul>
                </article>
                <article class="erc-acc-card" data-reveal data-reveal-delay="240">
                    <span class="erc-acc-card__icon"><i class="fa fa-users-cog" aria-hidden="true"></i></span>
                    <h3>Planillas y laborales</h3>
                    <p>Gestión de planilla completa con cargas, aportes y liquidaciones bien hechas.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Planilla electrónica PLAME</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Cargas sociales y beneficios</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Liquidaciones y certificados</span></li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    {{-- ======== Cómo trabajamos ======== --}}
    <section class="erc-acc-sec">
        <div class="container">
            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">Cómo trabajamos</span>
                <h2>Empezar es muy simple</h2>
            </div>
            <div class="erc-acc-steps">
                <div class="erc-acc-step" data-reveal>
                    <span class="erc-acc-step__num"></span>
                    <b>Diagnóstico</b>
                    <span>Revisamos tu situación contable y tributaria actual.</span>
                </div>
                <div class="erc-acc-step" data-reveal data-reveal-delay="120">
                    <span class="erc-acc-step__num"></span>
                    <b>Propuesta</b>
                    <span>Te presentamos un plan a la medida con alcances y honorarios.</span>
                </div>
                <div class="erc-acc-step" data-reveal data-reveal-delay="240">
                    <span class="erc-acc-step__num"></span>
                    <b>Implementación</b>
                    <span>Regularizamos lo pendiente y asumimos la operativa mensual.</span>
                </div>
                <div class="erc-acc-step" data-reveal data-reveal-delay="360">
                    <span class="erc-acc-step__num"></span>
                    <b>Seguimiento</b>
                    <span>Reportes periódicos y asesoría continua para tu toma de decisiones.</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== Banda final con CTA ======== --}}
    <section class="erc-acc-band">
        <div class="container" data-reveal>
            <span class="erc-sec-eyebrow">Conversemos</span>
            <h2>Recupera el control de tu contabilidad</h2>
            <p>Agenda un diagnóstico sin compromiso y conoce exactamente en qué está tu empresa frente a la Sunat.</p>
            <div class="erc-acc-actions erc-acc-actions--center">
                @php
                    $waLink = 'https://wa.me/51933435823?text=' . rawurlencode('¡Hola! Me interesa el servicio contable de ERIOS Consultores.');
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
