@extends('layouts.webpage')

@section('meta_title', 'Liderazgo')
@section('meta_description', 'Programas de liderazgo y coaching con Esther Rios: entrenadora certificada en liderazgo. Talleres, charlas y acompañamiento executive para equipos y líderes en Perú.')

@section('page_styles')
<style>
    /* ============ ERIOS · Página Liderazgo ============ */
    .erc-lead-sec { padding: 90px 0; }
    .erc-lead-sec--alt { background: #f5f8fc; }

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

    /* Tarjeta "Sobre Esther" */
    .erc-lead-about { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 6fr); gap: 54px; align-items: center; }
    @media (max-width: 991px) { .erc-lead-about { grid-template-columns: 1fr; gap: 34px; } }
    .erc-lead-about__media { position: relative; }
    .erc-lead-about__imgwrap {
        border-radius: 18px; overflow: hidden;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        box-shadow: 0 14px 40px rgba(0, 74, 173, 0.18);
    }
    .erc-lead-about__img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .erc-lead-about__img--fallback { width: auto; max-width: 60%; margin: 0 auto; height: 400px; object-fit: contain; filter: brightness(0) invert(1); opacity: .92; padding: 30px 0; }
    /* El aro pasa a filete con el degradado navy→celeste. Un borde no admite
       degradado, así que se pinta el relleno y se recorta el interior con una
       máscara, que deja las esquinas de 18px intactas. El prefijo .erc-lead-about
       es para ganarle al `border: 3px solid #00b6ff` del modo oscuro generado. */
    .erc-lead-about .erc-lead-about__accent {
        position: absolute; right: -20px; bottom: -20px; width: 55%; height: 55%;
        border: 3px solid transparent; border-radius: 18px;
        background: linear-gradient(100deg, #083058 0%, #00b6ff 100%) border-box;
        -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
        mask-composite: exclude;
        z-index: -1;
    }
    /* La píldora pasa a celeste de marca con la letra en blanco (antes amarillo con
       letra navy), y su sombra deja el halo amarillo. */
    .erc-lead-about__badge {
        position: absolute; left: -18px; top: 30px;
        display: inline-flex; align-items: center; gap: 9px;
        background: #00b6ff; color: #fff; border-radius: 50px;
        padding: 10px 20px; font-family: 'Montserrat', sans-serif;
        font-weight: 700; font-size: 13px; box-shadow: 0 10px 26px rgba(0, 182, 255, 0.38);
    }
    .erc-lead-about__title { font-size: 32px; font-weight: 800; color: #07294d; font-family: 'Montserrat', sans-serif; line-height: 1.25; margin: 0 0 16px; }
    .erc-lead-about__text { font-size: 15.5px; line-height: 27px; color: #505050; margin: 0 0 14px; }
    .erc-lead-pillars { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 22px; }
    @media (max-width: 480px) { .erc-lead-pillars { grid-template-columns: 1fr; } }
    .erc-lead-pillar {
        display: flex; gap: 12px; align-items: flex-start;
        background: #fff; border: 1px solid #e6edf6; border-radius: 14px;
        padding: 16px 18px; transition: all .3s ease;
    }
    .erc-lead-pillar:hover { border-color: rgba(0, 182, 255, .6); box-shadow: 0 10px 24px rgba(7, 41, 77, .08); transform: translateY(-3px); }
    /* El icono deja el amarillo por el celeste de marca: en el modo oscuro el CSS
       generado ya lo pintaba celeste (el script pasa el amarillo a #00b6ff), así que
       en claro quedaba como la única excepción. */
    .erc-lead-pillar i { color: #00b6ff; font-size: 18px; margin-top: 2px; }
    .erc-lead-pillar b { color: #07294d; font-size: 14.5px; display: block; margin-bottom: 3px; }
    .erc-lead-pillar span { color: #505050; font-size: 13.5px; line-height: 21px; }

    /* Tarjetas de programas */
    .erc-lead-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 26px; }
    @media (max-width: 991px) { .erc-lead-grid { grid-template-columns: 1fr; max-width: 560px; margin: 0 auto; } }
    .erc-lead-card {
        background: #fff; border: 1px solid #e6edf6; border-radius: 18px;
        padding: 30px 28px; transition: all .3s ease; display: flex; flex-direction: column;
    }
    .erc-lead-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(7, 41, 77, .12); border-color: rgba(0, 182, 255, .55); }
    .erc-lead-card__icon {
        width: 58px; height: 58px; border-radius: 16px;
        background: rgba(0, 74, 173, .08); color: #004aad;
        display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 18px;
        transition: all .3s ease;
    }
    /* La caja del icono pasa a celeste con el icono en blanco (antes el amarillo con
       el icono navy), como el resto de hovers con relleno celeste del sitio. */
    .erc-lead-card:hover .erc-lead-card__icon { background: #00b6ff; color: #fff; }
    .erc-lead-card__tag {
        align-self: flex-start; font-family: 'Montserrat', sans-serif;
        font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
        color: #004aad; background: rgba(0, 74, 173, .07); border-radius: 50px; padding: 5px 12px; margin-bottom: 12px;
    }
    .erc-lead-card h3 { font-family: 'Montserrat', sans-serif; font-size: 19px; font-weight: 700; color: #07294d; margin: 0 0 10px; }
    .erc-lead-card p { color: #505050; font-size: 14px; line-height: 24px; margin: 0 0 16px; flex: 1; }
    .erc-lead-card ul { list-style: none; margin: 0; padding: 0; }
    .erc-lead-card ul li {
        display: flex; gap: 9px; align-items: flex-start;
        color: #40474f; font-size: 13.5px; line-height: 22px; margin-bottom: 7px;
    }
    .erc-lead-card ul li i { color: #28a745; font-size: 13px; margin-top: 4px; }

    /* Banda de certificación / CTA final */
    .erc-lead-band {
        position: relative; overflow: hidden; color: #fff;
        background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
        padding: 74px 0; text-align: center;
    }
    /* La banda es navy: sus adornos dejan el amarillo y pasan a celeste. */
    .erc-lead-band::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; border: 2px solid rgba(0, 182, 255, .16); top: -120px; right: -80px; }
    .erc-lead-band::after { content: ''; position: absolute; width: 420px; height: 420px; border-radius: 50%; border: 2px solid rgba(0, 182, 255, .16); bottom: -180px; left: -120px; }
    .erc-lead-band .container { position: relative; z-index: 2; }
    .erc-lead-band .erc-sec-eyebrow { color: #fff; }
    /* La banda conserva el guion celeste plano: sobre el navy, el extremo navy del
       degradado general se perdería. Va con html[data-theme] delante para ganarle
       a ese degradado, que es más específico que el selector de la banda. */
    html[data-theme] .erc-lead-band .erc-sec-eyebrow::before,
    html[data-theme] .erc-lead-band .erc-sec-eyebrow::after { background: #00b6ff; }
    .erc-lead-band h2 { font-family: 'Montserrat', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin: 14px 0 12px; }
    .erc-lead-band p { color: rgba(255, 255, 255, .78); font-size: 15.5px; line-height: 27px; max-width: 620px; margin: 0 auto 30px; }

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
    .erc-lead-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .erc-lead-actions--center { justify-content: center; }

    .erc-wa-cta {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; height: 50px;
            background:
                linear-gradient(100deg, rgba(8, 48, 88, 0.85) 0%, rgba(8, 48, 88, 0.45) 55%, rgba(8, 48, 88, 0) 85%),
                linear-gradient(100deg, rgba(0, 72, 176, 0.95) 0%, rgba(0, 72, 176, 0.80) 100%);
            color: #ffc600;
        border-radius: 14px; font-family: 'Montserrat', sans-serif;
        font-size: 14.5px; font-weight: 700; text-decoration: none;
        box-shadow: 0 8px 22px rgba(8, 48, 88, .35); transition: all .3s ease;
    }
    .erc-wa-cta .fab.fa-whatsapp { font-size: 18px; }
    .erc-wa-cta:hover {
            background:
                linear-gradient(100deg, rgba(8, 48, 88, 0.55) 0%, rgba(8, 48, 88, 0.30) 55%, rgba(8, 48, 88, 0) 85%),
                linear-gradient(100deg, rgba(0, 160, 240, 0.95) 0%, rgba(0, 160, 240, 0.75) 60%, rgba(0, 160, 240, 0.55) 100%);
            color: #fff;
        transform: translateY(-2px); text-decoration: none;
    }

    @media (max-width: 575px) {
        .erc-lead-sec { padding: 60px 0; }
        .erc-sec-head h2, .erc-lead-about__title, .erc-lead-band h2 { font-size: 26px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .erc-lead-card, .erc-lead-pillar, .erc-btn, .erc-wa-cta { transition: none !important; }
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero compartido del sitio ======== --}}
    <x-page-hero
        eyebrow="Liderazgo ERIOS"
        title="Entrenamiento en Liderazgo"
        subtitle="Esther Rios, entrenadora certificada en liderazgo, guía a líderes y equipos a potenciar sus resultados con propósito, comunicación y alto desempeño." />

    {{-- ======== Sobre Esther / propuesta ======== --}}
    <section class="erc-lead-sec">
        <div class="container">
            <div class="erc-lead-about" data-reveal>
                <div class="erc-lead-about__media">
                    <div class="erc-lead-about__imgwrap">
                        <img src="{{ asset('themes/webpage/images/logo-2.png') }}"
                            alt="Entrenamiento en liderazgo con Esther Rios"
                            class="erc-lead-about__img erc-lead-about__img--fallback" loading="lazy">
                    </div>
                    <span class="erc-lead-about__badge"><i class="fa fa-certificate" aria-hidden="true"></i> Entrenadora Certificada</span>
                    <span class="erc-lead-about__accent" aria-hidden="true"></span>
                </div>
                <div>
                    <span class="erc-sec-eyebrow">Esther Rios</span>
                    <h2 class="erc-lead-about__title" style="margin-top: 12px;">Líderes que inspiran, equipos que transforman</h2>
                    <p class="erc-lead-about__text">
                        Como consultora tributaria, contable y empresarial, y <b>entrenadora certificada en liderazgo</b>,
                        Esther Rios acompaña a dueños de negocio, gerentes y equipos a desarrollar las habilidades
                        directivas que hoy exigen los entornos competitivos: comunicación efectiva, gestión del cambio,
                        delegación estratégica y cultura de resultados.
                    </p>
                    <div class="erc-lead-pillars">
                        <div class="erc-lead-pillar">
                            <i class="fa fa-bullseye" aria-hidden="true"></i>
                            <div><b>Propósito y visión</b><span>Alinear al equipo con los objetivos reales del negocio.</span></div>
                        </div>
                        <div class="erc-lead-pillar">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <div><b>Comunicación efectiva</b><span>Conversaciones que motivan y feedback que convierte.</span></div>
                        </div>
                        <div class="erc-lead-pillar">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div><b>Alto desempeño</b><span>Equipos comprometidos, autónomos y orientados a metas.</span></div>
                        </div>
                        <div class="erc-lead-pillar">
                            <i class="fa fa-sync-alt" aria-hidden="true"></i>
                            <div><b>Gestión del cambio</b><span>Liderazgo resiliente en procesos de transformación.</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== Programas ======== --}}
    <section class="erc-lead-sec erc-lead-sec--alt">
        <div class="container">
            <div class="erc-sec-head" data-reveal>
                <span class="erc-sec-eyebrow">Programas</span>
                <h2>Formaciones y experiencias de liderazgo</h2>
                <p>Programas diseñados a la medida de tu organización o como formación abierta, en modalidad En Vivo, Presencial o E-learning.</p>
            </div>
            <div class="erc-lead-grid">
                <article class="erc-lead-card" data-reveal>
                    <span class="erc-lead-card__icon"><i class="fa fa-chalkboard-teacher" aria-hidden="true"></i></span>
                    <span class="erc-lead-card__tag">Talleres &amp; Masterclass</span>
                    <h3>Talleres de liderazgo ejecutivo</h3>
                    <p>Experiencias prácticas y vivenciales para fortalecer habilidades directivas en cortos bloques de alto impacto.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Liderazgo con propósito y visión</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Comunicación asertiva y feedback</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Dinámicas y casos reales</span></li>
                    </ul>
                </article>
                <article class="erc-lead-card" data-reveal data-reveal-delay="120">
                    <span class="erc-lead-card__icon"><i class="fa fa-user-tie" aria-hidden="true"></i></span>
                    <span class="erc-lead-card__tag">Coaching 1:1</span>
                    <h3>Acompañamiento executive</h3>
                    <p>Sesiones individuales de coaching para directivos que buscan potenciar su desempeño y el de su equipo.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Plan de desarrollo personalizado</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Seguimiento y medición de avances</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Confidencialidad garantizada</span></li>
                    </ul>
                </article>
                <article class="erc-lead-card" data-reveal data-reveal-delay="240">
                    <span class="erc-lead-card__icon"><i class="fa fa-building" aria-hidden="true"></i></span>
                    <span class="erc-lead-card__tag">In house</span>
                    <h3>Programas para empresas</h3>
                    <p>Intervenciones de liderazgo alineadas a la estrategia del negocio, para equipos completos o cadenas de mando.</p>
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Diagnóstico inicial del equipo</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Ruta formativa a la medida</span></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><span>Certificación al finalizar</span></li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    {{-- ======== Banda final con CTA ======== --}}
    <section class="erc-lead-band">
        <div class="container" data-reveal>
            <span class="erc-sec-eyebrow">Comienza hoy</span>
            <h2>Liderazgo certificado para tu organización</h2>
            <p>Cuéntanos el reto de tu equipo y diseñamos juntos la experiencia de liderazgo que necesita: taller, coaching o programa in-house.</p>
            <div class="erc-lead-actions erc-lead-actions--center">
                @php
                    $waLink = 'https://wa.me/51933435823?text=' . rawurlencode('¡Hola! Me interesa el programa de Liderazgo con Esther Rios.');
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
